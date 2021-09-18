<!-- Need to implement -->
<?php
$whereFilters = "";
$orderFilter = "Breed"
?>

<!-- TODO: Remove after testing -->
<?php
echo "console.log(\"pre-get-print\")";
echo "console.log(\"" . strval($_GET) . "\")";
foreach (array_keys($_GET) as $akey) {
    echo "console.log(\"$akey: " . $_GET[$akey] . "\")";
}
?>

<!-- Create array with filter variables only -->
<?php
function filterVarList(string $filterTable, array $pageVars)
{
    require_once 'config/constants.php';
    $res = mysqli_query($conn, "SELECT field_name FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
    $filters = [];
    while ($row = mysqli_fetch_array($res)) {
        $fitlers[] = $row['field_name'];
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
function createWhereFilters(array $filters, $filterTable)
{
    //if empty return empty string
    if (empty($filters)) {
        return "";
    }

    // get which fields are strings
    require_once 'config/constants.php';
    $res = mysqli_query($conn, "SELECT field_name, is_string FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
    $isString = [];
    while ($row = mysqli_fetch_array($res)) {
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
function createOrderBy(array $pageVars, $filterTable)
{
    require_once 'config/constants.php';
    if (!empty($pageVars) and (isset($pageVars['sortby']) or isset($pageVars['ascending']))) {
        // get list of possible sortby fields
        $res = mysqli_query($conn, "SELECT field_name FROM $filterTable WHERE sort_by = 1 ORDER BY sort_order");
        $sortBy = [];
        while ($row = mysqli_fetch_array($res)) {
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
$filters = filterVarList($filterTable, $_GET);
$whereFilters = createWhereFilters($filters, $filterTable);
$orderFilter = createOrderBy($_GET, $filterTable);
?>

<!-- Add the current filters to be selected and removed -->
<?php
if (!empty($filters)) {
    $existing = "<table>
	<colgroup span=\"2\"></colgroup>
	<tr>
		<th colspan=\"2\" scope=\"colgroup\">Current Filters</th>
	</tr>";
    require_once 'config/constants.php';
    $res = mysqli_query($conn, "SELECT field_name, display_name FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
    while ($row = mysqli_fetch_array($res)) {
        if (in_array($row['field_name'], array_keys($filters))) {
            $existing .= "<tr><th scope=\"col\"><a href=\"";
            $existing .= createLink($page, $_GET, 1, array($row['field_name'] => $filters[$row['field_name']]));
            $existing .= "\">" . $row['display_name'] . "</a></th>" . "<th scope=\"col\">" . $filters[$row['field_name']] . "</th>" . "</tr>";
        }
    }
    $existing .= "</table>";
    echo $existing;
}
?>

<!-- Add all filters to div -->
<?php
$res = mysqli_query($conn, "SELECT field_name, display_name FROM $filterTable WHERE filter_by = 1 ORDER BY filter_order");
$newFilters = "";
while ($row = mysqli_fetch_array($res)) {
    $res2 = mysqli_query($conn, "SELECT " . $row['field_name'] .
        "as field_value, COUNT(*) as field_count FROM $table WHERE $whereFilters "  .
        "GROUP BY " . $row['field_name']);
    if (!empty($row2 = mysqli_fetch_array($res2))) {
        $newFilters .= "<table>
        <colgroup span=\"2\"></colgroup>
        <tr>
            <th colspan=\"2\" scope=\"colgroup\">" . $row['display_name'] . "</th>
        </tr>";
        $newFilters .= "<tr><th scope=\"col\"><a href=\"";
        $newFilters .= createLink($page, $_GET, 0, array($row['field_name'] => $row2['field_value']));
        $newFilters .= "\">" . $row['field_value'] . "</a></th>" . "<th scope=\"col\">" . $row['field_count'] . "</th>" . "</tr>";
        while ($row2 = mysqli_fetch_array($res2)) {
            $newFilters .= "<tr><th scope=\"col\"><a href=\"";
            $newFilters .= createLink($page, $_GET, 0, array($row['field_name'] => $row2['field_value']));
            $newFilters .= "\">" . $row['field_value'] . "</a></th>" . "<th scope=\"col\">" . $row['field_count'] . "</th>" . "</tr>";
        }
        $newFilters .= "</table>";
    }
}
echo $newFilters;
?>