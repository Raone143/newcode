<?php
//error_reporting(E_STRICT);
if(isset($_REQUEST['CUE'])) {
     unlink("install.php");
     header("Location:index.php");
     exit;
}
if(file_exists('install.php')) {
    header("Location:install.php");
    exit;
}

//Include Database Connection and Class To Access Data
include_once("DatabaseConnection.php");
include_once("AccessDataBaseClass.php");

//Create an object for FirstClass
$class_obj = new AccessDataBaseClass();

//Display Tables List
$tables_list = $class_obj->get_all_tables_in_database();

//Display the list
if(isset($_REQUEST['ddl_tables_list']) && $_REQUEST['ddl_tables_list'])
    $table_name = $_REQUEST['ddl_tables_list'];
else
    $table_name = $tables_list[0];

$s_key = "";
$selected = "";

$table_information = $class_obj->get_table_information($table_name);
$count_table_information = count($table_information);

for($j = 0; $j < $count_table_information; $j++) {
    $field_names[] = $table_information[$j]['Field'];
    $keys[]        = $table_information[$j]['Key'];
}

$start = 0;
if(isset($_REQUEST['start']) && $_REQUEST['start'] != "" && (int)is_numeric($_REQUEST['start'])) $start = (int)$_REQUEST['start'];
$limit = 6;

if(count($_REQUEST) > 0) {
    $search = "";

    if(isset($_REQUEST['search_key']))
        $s_key = $_REQUEST['search_key'];

    $RequestCondition = (isset($_REQUEST['ddlfield']) && trim($_REQUEST['ddlfield']) != "" && isset($_REQUEST['search_key']) && trim($_REQUEST['search_key']) != "");

    if($RequestCondition && trim($_REQUEST['ddlwordtype']) == 1) {
        $search = " WHERE 1 AND ".$_REQUEST['ddlfield']. " = '". $_REQUEST['search_key']."'";
    }
    else if($RequestCondition && trim($_REQUEST['ddlwordtype']) == 2) {
        $search = " WHERE 1 AND ".$_REQUEST['ddlfield']." LIKE '%". $_REQUEST['search_key']."%'";
    }
    else {
        $search = " WHERE 1";
    }

    if(!empty($_REQUEST['sort_k']) && $_REQUEST['sort_k'] != '' && $_REQUEST['sort_k'] == 'DESC') $sort_key = 'ASC';
    else if(!empty($_REQUEST['sort_k']) && $_REQUEST['sort_k'] != '' && $_REQUEST['sort_k'] == 'ASC') $sort_key = 'DESC';
    else $sort_key = 'DESC';

    //
    $order = '';
    $sort_value = '';
    if(!empty($_REQUEST['sort_v']) && $_REQUEST['sort_v'] != '') $sort_value = $_REQUEST['sort_v'];
    if(in_array($sort_value, $field_names)) $order = " ORDER BY ".$sort_value." ".$sort_key;

    $info_list  = $class_obj->get_information($table_name, array("*"), $search, $order, $start, $limit);
    $records_count = $class_obj->get_total_records_count($table_name, $search);

    $REQUEST_PARAMS = "";
    if(isset($RequestCondition) && !empty($_REQUEST['ddlwordtype']) && ($_REQUEST['ddlwordtype'] == 1 || $_REQUEST['ddlwordtype'] == 2)) {
        $REQUEST_PARAMS = "&ddlfield=".$_REQUEST['ddlfield']."&ddlwordtype=".$_REQUEST['ddlwordtype']."&search_key=".$_REQUEST['search_key'];
    }
}
else {

    if(!empty($_REQUEST['sort_k']) && $_REQUEST['sort_k'] != '' && $_REQUEST['sort_k'] == 'DESC') $sort_key = 'ASC';
    else if(!empty($_REQUEST['sort_k']) && $_REQUEST['sort_k'] != '' && $_REQUEST['sort_k'] == 'ASC') $sort_key = 'DESC';
    else $sort_key = 'DESC';

    //
    $order = '';
    $sort_value = '';
    if(!empty($_REQUEST['sort_v']) && $_REQUEST['sort_v'] != "") $sort_value = $_REQUEST['sort_v'];
    if(in_array($sort_value, $field_names)) $order = " ORDER BY ".$sort_value." ".$sort_key;

    $info_list  = $class_obj->get_information($table_name, array("*"), '', $order, $start, $limit);
    $records_count = $class_obj->get_total_records_count($table_name, '');
}

$count_fields = count($field_names);

$word_type = array("1"=>"Exact word", "2"=>"Part of word");
?>
<style>
    .sipagenumber {
        text-decoration: none;
        border: 1px solid #bc8f8f;
        padding: 3px 5px 5px 5px;
        color: black;
        background-color: #f5f5f5;
        margin: 5px;
    }
    .sicpagenumber {
        text-decoration: none;
        border: 1px solid #bc8f8f;
        padding: 3px 5px 5px 5px;
        color: #ff6347;
        background-color: #f5f5f5;
        margin: 5px;
    }
</style>
<form method="post" name="frmAccessDatabase" id="frmAccessDatabase" action="index.php">
<table border="0" cellpadding="4" cellspacing="1" width="100%">

    <tr>
        <td style="width:80px" nowrap="wrap">Tables List</td>
        <td colspan="8">
            <select name="ddl_tables_list" id="ddl_tables_list" onchange="this.form.submit();">
                <option value="">Select Table</option>
                    <?php
                    for($table_index = 0; $table_index < count($tables_list); $table_index++) {
                        if(isset($table_name) && $table_name != "")
                            $tselected = ($table_name == $tables_list[$table_index]) ? "selected='selected'" : "";
                        ?>
                        <option value="<?php echo $tables_list[$table_index];?>" <?php if(!empty($tselected)) echo $tselected; ?>>
                            <?php echo $tables_list[$table_index];?>
                        </option>
                        <?php
                        unset($tselected);
                    }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <td nowrap="wrap">Search</td>

        <td colspan="8">

            <select name="ddlfield" id="ddlfield">
                <option value="">Select Field</option>
                <?php
                    for($field_index = 0; $field_index < $count_fields; $field_index++) {
                        if(isset($_REQUEST['ddlfield']) && $_REQUEST['ddlfield'] != "")
                            $selected = ($_REQUEST['ddlfield'] == $field_names[$field_index]) ? "selected='selected'" : "";
                            ?><option value="<?php echo $field_names[$field_index];?>" <?php if(!empty($selected)) echo $selected; ?>><?php echo ucwords(str_replace("_", " ", $field_names[$field_index]));?></option><?php
                            unset($selected);
                    }
                ?>
            </select>

            <select name="ddlwordtype" id="ddlwordtype">
                <?php
                foreach($word_type as $wkey=>$wvalue) {
                    if(isset($_REQUEST['ddlwordtype']) && $_REQUEST['ddlwordtype'] != "")
                        $wselected = ($_REQUEST['ddlwordtype'] == $wkey) ? "selected='selected'" : "";
                    ?><option value="<?php echo $wkey;?>" <?php if(!empty($wselected)) echo $wselected; ?>><?php echo $wvalue;?></option><?php
                    unset($wselected);
                }
                ?>
            </select>
            <input type="text" name="search_key" id="search_key" value="<?php echo $s_key; ?>">
            <input type="submit" name="search" id="search" value="search">
            </td>
    </tr>

    <tr>
        <td><a href="index.php" style="text-decoration:none;color:#ff6347">Reset All</a></td>
        <td colspan="8">
            Generate &nbsp;
            <a href="GenerateXML.php" style="text-decoration:none;color:#ff6347">XML Web service</a> /
            <a href="GenerateJSON.php" style="text-decoration:none;color:#ff6347">JSON Web service</a>

        </td>
    </tr>
<?php
echo "<tr>";
for($findex = 0; $findex < $count_fields; $findex++) {
	?>
	<span style="color:#F3F5F7"></span>
	<?php
    echo "<td align='left' style='border: 1px solid #bc8f8f;'>";
        if(!empty($REQUEST_PARAMS))
            echo "<a href='index.php?sort_k=".$sort_key."&sort_v=".$field_names[$findex].$REQUEST_PARAMS."' style='color:#8b0000;font-weight:bold;text-decoration: none'>";
        else
            echo "<a href='index.php?sort_k=".$sort_key."&sort_v=".$field_names[$findex]."' style='color:#8b0000;font-weight:bold;text-decoration: none'>";

        echo ucwords(str_replace("_", " ", $field_names[$findex]));
        echo "</a>";
    echo "</td>";
}
echo "<th align='left' style='border: 1px solid #bc8f8f;color: #8b0000;font-weight: bold;width: 80px;'>Action</th>";
echo "</tr>";

if(count($info_list) > 0) {

    foreach($info_list as $key=>$value) {
        if(is_array($value)) {
            echo "<tr>";
            foreach($value as $column_name=>$column_value) {
                $column_value = ($column_value != "") ? $column_value : "&nbsp";
                echo "<td align='left' style='background: white;border: 1px solid #bc8f8f'>".$column_value."</td>";
            }
            echo "<td align='left' style='background: white;border: 1px solid #bc8f8f'>
                <a href=\"javascript:void(0);\" onclick=\"alert('No action')\" style='text-decoration: none;color: #8B0000'>View &nbsp; Edit</a>
            </td>";
            echo "</tr>";
        }
    }

}
else {
    echo "<tr><td colspan='9' align='left' style='color:#990000;font-size: 25px;font-weight: bold;'>No records found in selected table</td></tr>";
}
?>
<tr>
    <td colspan="9" style="height: 20px;">&nbsp;</td>
</tr>
<tr>
    <td align="left" colspan="9" style="height: 70px;">
        <?php
        $REQUEST = "";

        if(!empty($_REQUEST['sort_v']) && $_REQUEST['sort_v'] != "") {
            if(in_array($sort_value, $field_names)) $REQUEST .= "&sort_k=".$_REQUEST['sort_k']."&sort_v=".$_REQUEST['sort_v'];
        }


        if(isset($RequestCondition) && !empty($_REQUEST['ddlwordtype']) && ($_REQUEST['ddlwordtype'] == 1 || $_REQUEST['ddlwordtype'] == 2)) {
            $REQUEST .= "&ddlfield=".$_REQUEST['ddlfield']."&ddlwordtype=".$_REQUEST['ddlwordtype']."&search_key=".$_REQUEST['search_key'];
        }

        $REQUEST .= "&ddl_tables_list=".$table_name;

        if($records_count > $limit)
            $class_obj->pagination($start, $limit, $records_count, '', $REQUEST);
        ?>
    </td>
</tr>
</table>
</form>