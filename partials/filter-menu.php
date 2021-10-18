<!-- Need to implement -->
<?php
$whereFilters = "";
$orderFilter = "Breed";


?>

<!-- Create array with filter variables only -->
<?php
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

<!-- create function for return link to current page -->
<?php
function createLink(string $page, array $pageVars = [], bool $drop = false, array $filtersToModify = [])
{
    // if (!(empty($pageVars))) {
    $page .= "?";
    foreach (array_keys($pageVars) as $filter) {
        // add all filters unless the are meant to be dropped
        if (!($drop and in_array($filter, array_keys($filtersToModify)))) {
            $page .= $filter . "=" . $pageVars[$filter] . "&";
        }
    }
    if (!$drop and !empty($filtersToModify)) {
        foreach (array_keys($filtersToModify) as $filter) {
            $page .= $filter . "=" . $filtersToModify[$filter] . "&";
        }
    }
    $page = rtrim($page, '&');
    $page = rtrim($page, '?');
    // }
    return $page;
}
?>

<!-- Function for creating additional where clauses -->
<?php
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
    $whereFilters = "AND (";
    foreach (array_keys($filters) as $filter) {
        if ($isString[$filter]) {
            $whereFilters .= " $filter = \"$filters[$filter]\" AND ";
        } else {
            $whereFilters .= " $filter = $filters[$filter] AND ";
        }
    }
    $whereFilters = rtrim($whereFilters, "AND ");
    $whereFilters .= ") ";
    return $whereFilters;
}
?>



<!-- Function for creating order clause -->
<?php
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

<!-- Creating filters for current query -->
<?php
$filters = filterVarList($filterTable, $_GET, $conn);
$orderFilter = createOrderBy($_GET, $filterTable, $conn);
// where filter used for displaying results
$whereFilters = createWhereFilters($filters, $filterTable, $conn);
// I need to remove the WHERE AND depending on the where filters for showing the filters
$whereFiltersForFilter = $whereFilters;
?>

<!-- Rename filters that are classes or bools -->
<?php
function getFieldName($field_name, $is_class, $is_bool)
{
    // creating the name arrays for classes
    $class_names = array(
        1 => "Very Low",
        2 => "Low",
        3 => "Medium",
        4 => "High",
        5 => "Very High"
    );
    if ($is_class == 1) {
        return $class_names[$field_name];
    }
    if ($is_bool == 1) {
        if ($field_name == 1) {
            return "Yes";
        }
        return "No";
    }
    return $field_name;
}
?>

<!-- Add the current filters to be selected and removed -->
<?php
if (!empty($filters)) {
    $existing = "<table class='filter-current'>
	<colgroup span=\"2\"></colgroup>
	<tr>
		<th colspan=\"2\" scope=\"colgroup\">Current Filters</th>
	</tr>
    </table>
    <table class='filter-results'>
	<colgroup span=\"2\"></colgroup>";
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

<!-- Add all filters to div -->
<?php
$res = mysqli_query($conn, "SELECT field_name, display_name, class_field, bool_field 
    FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
$newFilters = "";
while ($row = mysqli_fetch_assoc($res)) {
    $res2 = mysqli_query($conn, "SELECT " . $row['field_name'] .
        " as field_value, COUNT(*) as field_count FROM $table " . $whereFiltersForFilter .
        "GROUP BY " . $row['field_name']);
    if (!empty($row2 = mysqli_fetch_assoc($res2))) {
        $newFilters .= "<table class='filter-1'>
        <tr class='filter-2'>
            <th colspan=\"2\" scope=\"colgroup\">" . $row['display_name'] . "</th>
        </tr>";
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
echo $newFilters;
?>