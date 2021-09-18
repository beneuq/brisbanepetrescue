<!-- Need to implement -->
<?php
$whereFilters = "";
$orderFilter = "Breed"
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
    consolePrintArgs("Initial Filters:", $filters, "End Initial filters", "Filters to match:", array_keys($pageVars), "End filters to match");
    foreach (array_keys($pageVars) as $var) {
        if (!(in_array($var, $filters))) {
            consolePrintArgs("Unset: $var");
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
    if (!(empty($pageVars))) {
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
    }
    return $page;
}
?>

<!-- Function for creating additional where clauses -->
<?php
function createWhereFilters(array $filters, $filterTable, $conn)
{
    //if empty return empty string
    if (empty($filters)) {
        consolePrintArgs("Empty filters");
        return "";
    }

    // get which fields are strings
    $res = mysqli_query($conn, "SELECT field_name, is_string FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
    $isString = [];
    while ($row = mysqli_fetch_assoc($res)) {
        consolePrintArgs("Where Q Row:", $row, "Where Q Row End");
        $isString[$row['field_name']] = $row['is_string'];
    }
    consolePrintArgs("filters:", $filters, "End filters", "isString:", $isString, "End isString");
    $whereFilters = "AND (";
    foreach (array_keys($filters) as $filter) {
        consolePrintArgs("filter:", $filter, "End fiter");
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
    return "Breed";
}
?>

<!-- Creating filters for current query -->
<?php
$filters = filterVarList($filterTable, $_GET, $conn);
$orderFilter = createOrderBy($_GET, $filterTable, $conn);
consolePrintArgs("Starting where filters");
// where filter used for displaying results
$whereFilters = createWhereFilters($filters, $filterTable, $conn);
// I need to remove the WHERE AND depending on the where filters for showing the filters
$whereFiltersForFilter = $whereFilters;
?>

<!-- Add the current filters to be selected and removed -->
<?php
if (!empty($filters)) {
    $existing = "<table>
	<colgroup span=\"2\"></colgroup>
	<tr>
		<th colspan=\"2\" scope=\"colgroup\">Current Filters</th>
	</tr>";
    $res = mysqli_query($conn, "SELECT field_name, display_name FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
    while ($row = mysqli_fetch_assoc($res)) {
        if (in_array($row['field_name'], array_keys($filters))) {
            $existing .= "<tr><th scope=\"col\"><a href=\"";
            $existing .= createLink($page, $_GET, 1, array($row['field_name'] => $filters[$row['field_name']]));
            $existing .= "\">" . $row['display_name'] . "</a></th>" . "<th scope=\"col\">" . $filters[$row['field_name']] . "</th>" . "</tr>";
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
$res = mysqli_query($conn, "SELECT field_name, display_name FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
$newFilters = "";
while ($row = mysqli_fetch_assoc($res)) {
    consolePrintArgs("Filter Main Q Row:", $row);
    consolePrintArgs("SELECT " . $row['field_name'] .
        " as field_value, COUNT(*) as field_count FROM $table " . $whereFiltersForFilter .
        "GROUP BY " . $row['field_name']);
    $res2 = mysqli_query($conn, "SELECT " . $row['field_name'] .
        " as field_value, COUNT(*) as field_count FROM $table " . $whereFiltersForFilter .
        "GROUP BY " . $row['field_name']);
    if (!empty($row2 = mysqli_fetch_assoc($res2))) {
        $newFilters .= "<table>
        <colgroup span=\"2\"></colgroup>
        <tr>
            <th colspan=\"2\" scope=\"colgroup\">" . $row['display_name'] . "</th>
        </tr>";
        consolePrintArgs("Filter Secondary Q Row", $row2, "End filter seconday q row");
        $newFilters .= "<tr><th scope=\"col\"><a href=\"";
        $newFilters .= createLink($page, $_GET, 0, array($row['field_name'] => $row2['field_value']));
        $newFilters .= "\">" . $row2['field_value'] . "</a></th>" . "<th scope=\"col\">" . $row2['field_count'] . "</th>" . "</tr>";
        while ($row2 = mysqli_fetch_assoc($res2)) {
            consolePrintArgs("Filter Secondary Q Row", $row2, "End filter seconday q row");
            $newFilters .= "<tr><th scope=\"col\"><a href=\"";
            $newFilters .= createLink($page, $_GET, 0, array($row['field_name'] => $row2['field_value']));
            $newFilters .= "\">" . $row2['field_value'] . "</a></th>" . "<th scope=\"col\">" . $row2['field_count'] . "</th>" . "</tr>";
        }
        $newFilters .= "</table>";
    }
    consolePrintArgs("End Main Q Row");
}
echo $newFilters;
?>