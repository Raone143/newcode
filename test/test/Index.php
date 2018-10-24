<?php
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
$table_name = 'user_information';

if(count($_REQUEST) > 0) {
    $search = "";
    if(isset($_REQUEST['ddlfield']) && isset($_REQUEST['search']))
       $search = " WHERE 1 AND ".$_REQUEST['ddlfield']. " LIKE '%". $_REQUEST['search_key']."%'";

    $info_list  = $class_obj->get_information($table_name, array("*"), $search, 0, 30);
}
else {
    $info_list  = $class_obj->get_information($table_name, array("*"), "", 0, 30);
}

$table_information = $class_obj->get_table_information($table_name);
$count_table_information = count($table_information);
for($j = 0; $j < $count_table_information; $j++) {
    $field_names[] = $table_information[$j]['Field'];
    $keys[]        = $table_information[$j]['Key'];
}
$count_fields = count($field_names);
?>
<form method="post" name="frm" id="frm">
<table border="0" cellpadding="4" cellspacing="1" width="100%">

    <tr>
        <td colspan="9">
            <select name="ddlfield" id="ddlfield">
                <option value="">Select Field</option>
                <?php
                    for($field_index = 0; $field_index < $count_fields; $field_index++) {
                            ?><option value="<?php echo $field_names[$field_index];?>"><?php echo ucwords(str_replace("_", " ", $field_names[$field_index]));?></option><?php
                    }
                ?>
            </select>
            <input type="text" name="search_key" id="search_key">
            <input type="submit" name="search" id="search" value="search">
            <a href="GenerateXML.php" style="text-decoration: none">Generate XML File</a>
        </td>
    </tr>

<?php
echo "<tr>";
for($findex = 0; $findex < $count_fields; $findex++) {

    echo "<th align='left' style='background: silver'>";

        echo ucwords(str_replace("_", " ",$field_names[$findex]));

    echo "</th>";
}
echo "<th align='left' style='background: silver'>Action</th>";
echo "</tr>";

foreach($info_list as $key=>$value) {

    if(is_array($value)) {
           echo "<tr>";
           foreach($value as $column_name=>$column_value) {
                echo "<td align='left' style='background: #F5F5F5'>".$column_value."</td>";
           }
           echo "<td align='left' style='background: #F5F5F5'>View</td>";
           echo "</tr>";
    }

}
?>
</table>
</form>