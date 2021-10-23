<html>

<body>
    <?php
    // adding default values
    $whereFilters = "";
    $orderFilter = "Breed";
    ?>

    <?php
    /**
     * Allows printing to console of nested arrays (2 levels) to console
     * 
     * $data: The variable, array or nested array you want to print
     */
    function debug_to_console($data)
    {
        echo "<script>";
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subkey => $subvalue) {
                        echo "console.log(" . "'" . $key . ": " . $value . ": " . $subkey . ": " . $subvalue . "');";
                    }
                } else {
                    echo "console.log(" . "'" . $key . ": " . $value . "');";
                }
            }
        } else {
            echo "console.log(" . "'" . $data . "');";
        }
        echo "</script>";
    }
    ?>


    <?php
    /**
     * Removes page variables that are not used for filtering or sorting
     * 
     * $filterTable: The name of the table in the db to be used for filtering
     * $pageVars: The list of variables you want to 'clean'
     * $conn: An active connection to the db
     * 
     * Returns: pageVars with all keys that don't match filters or sorts removed
     */
    function filterVarList(string $filterTable, array $pageVars, $conn)
    {
        $res = mysqli_query($conn, "SELECT field_name FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
        $filters = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $filters[] = $row['field_name'];
        }
        foreach (array_keys($pageVars) as $var) {
            if (!(in_array($var, $filters))) {
                unset($pageVars[$var]);
            }
        }
        return $pageVars;
    }
    ?>


    <?php
    /**
     * Creates a page link with the existing variables +/- any variables that should be added or removed
     * 
     * $page: The page url without any variables
     * $pageVars: The variables that where passed to the page
     * $drop: If true, keys in the $filtersToModify list will be removed from the $pageVars, 
     *      if false, value pairs in $filtersToModify replace or are added to page variables added to the url
     * 
     * Return: The url string with the variables that should be passed
     */
    function createLink(string $page, array $pageVars = [], bool $drop = false, array $filtersToModify = [])
    {
        foreach ($filtersToModify as $key => $value) {
            if ($drop) {
                unset($pageVars[$key]);
            } else {
                $pageVars[$key] = $value;
            }
        }
        if (!empty($pageVars)) {
            $qs = http_build_query($pageVars);
            return $page . '?' . $qs;
        }
        return $page;
    }
    ?>


    <?php
    /**
     * Creates a string that contains the where clauses that would filter the results based on the filters passed
     * 
     * $filters: The value pairs the query should be filtered by
     * $filterTable: The table containing the filter information, strings must be treated differently to numbers
     * $conn: An active connection to the db
     * 
     * Returns: A string containing the where clauses that would filter the results based on the filters passed
     */
    function createWhereFilters(array $filters, $filterTable, $conn)
    {
        //if empty return empty string
        if (empty($filters)) {
            return "";
        }

        // get which fields are strings
        $res = mysqli_query($conn, "SELECT field_name, is_string FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
        $isString = [];
        while ($row = mysqli_fetch_assoc($res)) {
            $isString[$row['field_name']] = $row['is_string'];
        }

        // creates where clause string
        // starts with 'AND' and is encapsulated so it works correctly with any other filters already added to the query
        $whereFilters = "AND (";
        foreach ($filters as $filter => $value) {
            // if string the values must be encapsulated in ""
            if ($isString[$filter]) {
                // if value is an array use the 'IN' clause so any matching value is ok
                if (is_array($value)) {
                    $inFilter = '';
                    foreach ($value as $subVal) {
                        $inFilter .= "\"$subVal\",";
                    }
                    $whereFilters .= " $filter IN (" . rtrim($inFilter, ",") . ") AND ";
                } else {
                    // used '=' when a single value is passed
                    $whereFilters .= " $filter = \"$value\" AND ";
                }
                // if value is numeric and encapsulated in "" it would break the query
                // does the same as above without the ""
            } else {
                if (is_array($value)) {
                    $inFilter = '';
                    foreach ($value as $subVal) {
                        $inFilter .= "$subVal,";
                    }
                    $whereFilters .= " $filter IN (" . rtrim($inFilter, ",") . ") AND ";
                } else {
                    $whereFilters .= " $filter = $value AND ";
                }
            }
        }

        // 'AND' is added after each filter and thus there is an extra at the end
        $whereFilters = rtrim($whereFilters, "AND ");
        $whereFilters .= ") ";
        return $whereFilters;
    }
    ?>



    <?php
    /**
     * Creates the sort by string to be added to the main sql query
     * 
     * $pageVars: The variables to look for a sort by value in and if there is an ascending key
     * $filterTable: The name of the db table to confirm that variable requested is a valid sort filter
     * 
     * Returns: the sort by string name and ' desc' when set to descending order
     */
    function createOrderBy(array $pageVars, string $filterTable, $conn)
    {
        if (!empty($pageVars) and (isset($pageVars['sortby']) or isset($pageVars['ascending']))) {
            // get list of possible sortby fields
            $res = mysqli_query($conn, "SELECT field_name FROM $filterTable WHERE sort_by = 1 ORDER BY sort_order");
            $sortBy = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $sortBy[] = $row['field_name'];
            }
            if (isset($pageVars['sortby']) and in_array($pageVars['sortby'], $sortBy)) {
                $orderFilter = $pageVars['sortby'];
            } else {
                $orderFilter = "Breed";
            }
            if (isset($pageVars['ascending']) and $pageVars['ascending'] == 'false') {
                $orderFilter .= " DESC";
            }
            return $orderFilter;
        }
        // choosing a different default sort variable based on the filter table
        if ($filterTable == "breed_filters") {
            return "Breed";
        }
        return "d.name";
    }
    ?>


    <?php
    /**
     * Uses the functions above to generate values passed to the sql query for filtering and sorting
     * the results being displayed
     */
    $filters = filterVarList($filterTable, $_GET, $conn);
    $orderFilter = createOrderBy($_GET, $filterTable, $conn);
    // where filter used for displaying results
    $whereFilters = createWhereFilters($filters, $filterTable, $conn);
    // I need to remove the WHERE AND depending on the where filters for showing the filters
    $whereFiltersForFilter = $whereFilters;
    ?>


    <?php
    /**
     * Returns a user readible string equavilent of the field value depending on
     * if it is an array, is a class value or boolean value
     * 
     * $field_name: numeric, string or array,
     *      if array: 'Multiple' is returneds
     *      if string: $field_name is returned
     *      if numeric: is mapped to a string based on $is_class and $is_bool
     * $is_class: if $field_name is a class value it is mapped to the respective class string
     * $is_bool: if $field_name is a boolean value it is mapped to the respective bool string
     * 
     * Returns: The relevant user readible string for the $field_name
     */
    function getFieldName($field_name, $is_class, $is_bool)
    {
        // if an array of values just return 'Multiple'
        if (is_array($field_name)) {
            return "Multiple";
        }
        // creating the name arrays for classes
        $class_names = array(
            1 => "Very Low",
            2 => "Low",
            3 => "Medium",
            4 => "High",
            5 => "Very High"
        );
        // if class map to the relevant class string
        if ($is_class == 1) {
            return $class_names[$field_name];
        }
        // if boolean map to the relevant bool string
        if ($is_bool == 1) {
            if ($field_name == 1) {
                return "Yes";
            }
            return "No";
        }
        // otherwise return value passed
        return $field_name;
    }
    ?>

    <!-- Add the current filters to be selected and removed -->
    <?php
    /**
     * Generates a html table of the existing filter pairs
     * which when each filter is clicked it removes it as a filter
     * and refreshes the page
     */
    if (!empty($filters)) {
        $existing = "<table class='filter-current'>
	<colgroup span=\"2\"></colgroup>
	<tr>
		<th colspan=\"2\" scope=\"colgroup\">Current Filters</th>
	</tr>";
        $res = mysqli_query($conn, "SELECT field_name, display_name, class_field, bool_field 
        FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
        while ($row = mysqli_fetch_assoc($res)) {
            if (in_array($row['field_name'], array_keys($filters))) {
                $existing .= "<tr><th scope=\"col\"><a href=\"";
                $existing .= createLink($page, $_GET, 1, array($row['field_name'] => $filters[$row['field_name']]));
                $existing .= "\">" . $row['display_name'] . "</a></th>" . "<th scope=\"col\">" .
                    getFieldName($filters[$row['field_name']], $row['class_field'], $row['bool_field']) . "</th>" . "</tr>";
            }
        }
        $existing .= "</table>";
        echo $existing;
        // need to add the "WHERE to the where filter so it works when no filters are included
        $whereFiltersForFilter = "WHERE " . substr($whereFilters, 4);
    }
    ?>


    <?php
    /**
     * Generates the each filter that is available as a table
     * The possible values for the filter and the number of results that would be displayed are added to a
     * second table that when selected adds them as a filter
     */
    // getting filter information from database
    $res = mysqli_query($conn, "SELECT field_name, display_name, class_field, bool_field 
    FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
    $newFilters = "";
    // generating a table for each filter available
    while ($row = mysqli_fetch_assoc($res)) {
        $res2 = mysqli_query($conn, "SELECT " . $row['field_name'] .
            " as field_value, COUNT(*) as field_count FROM $table " . $whereFiltersForFilter .
            "GROUP BY " . $row['field_name']);
        if (!empty($row2 = mysqli_fetch_assoc($res2))) {
            $newFilters .= "<table class='filter-1' onselectstart='return false'>
        <tr class='filter-2'>
            <th colspan=\"2\" scope=\"colgroup\">" . $row['display_name'] . "</th>
        </tr></table>
        <table class='filter-results'>
        <colgroup span=\"2\"></colgroup>";
            // generating a table for each of the available options with a filter and the number
            // of results that would be displayed if the filter was selected
            $newFilters .= "<tr class='filter-3'><th scope=\"col\"><a href=\"";
            $newFilters .= createLink($page, $_GET, 0, array($row['field_name'] => $row2['field_value']));
            $newFilters .= "\">" . getFieldName($row2['field_value'], $row['class_field'], $row['bool_field']) .
                "</a></th>" . "<th scope=\"col\">" . $row2['field_count'] . "</th>" . "</tr>";
            while ($row2 = mysqli_fetch_assoc($res2)) {
                $newFilters .= "<tr class='filter-3'><th scope=\"col\"><a href=\"";
                $newFilters .= createLink($page, $_GET, 0, array($row['field_name'] => $row2['field_value']));
                $newFilters .= "\">" . getFieldName($row2['field_value'], $row['class_field'], $row['bool_field']) . "</a></th>" .
                    "<th  class='yes'scope=\"col\">" . $row2['field_count'] . "</th>" . "</tr>";
            }
            $newFilters .= "</table>";
        }
    }
    // adds filter tables to html
    echo $newFilters;
    ?>
    <!-- Script for displaying filters -->
    <script>
        var elements = document.getElementsByClassName("filter-1");
        for (var i = 0; i < elements.length; i++) {
            // Add onclick function for all filter headings
            document.getElementsByClassName("filter-1")[i].addEventListener("click", function(e) {
                e = e || window.event;
                // Get clicked filter
                var target = e.target || e.srcElement
                var next = target.nextSibling;
                // Get filters options associated with heading
                var filters = next.nextSibling;
                if (filters.style.display == "flex") {
                    // Close if already open
                    filters.style.display = "none";
                } else {
                    // Open if closed
                    var rect = target.getBoundingClientRect();
                    filters.style.display = "flex";
                    filters.style.left = rect.left + "px";
                    filters.style.top = rect.bottom - 1 + "px";
                }
            }, false);
        }
    </script>
</body>

</html>