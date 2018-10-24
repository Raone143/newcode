<?php
error_reporting(E_ALL);

// Send the headers
header('Content-type: text/xml');

include_once('DatabaseConnection.php');
include_once('AccessDataBaseClass.php');

//Create an object for FirstClass
$class_obj = new AccessDataBaseClass();
$table_exists = $class_obj->check_table_exist($_REQUEST['ddl_tables_list']);

if(!empty($_REQUEST['start']) && is_numeric($_REQUEST['start'])) $from = (int)$_REQUEST['start'];
else $from = 0;

if(!empty($_REQUEST['limit']) && is_numeric($_REQUEST['limit'])) $records_per_page = (int)$_REQUEST['limit'];
else $records_per_page = 10;

$keys = array_keys($_REQUEST['xml_field_name']);
$fields = implode(',', $keys);

$sel_fields = 'SELECT '.$fields.' FROM '.$_REQUEST['ddl_tables_list'].' LIMIT '.$from.', '.$records_per_page;
$res_fields = mysql_query($sel_fields);
$rec_count  = mysql_num_rows($res_fields);

echo '<?xml version=\'1.0\' encoding=\'UTF-8\' ?>';
echo '<RecordsInformation>';

if(!$table_exists) {
    echo "Invalid Request";
}
else
{
    if($rec_count == 0) {
        echo 'No Records';
    }
    else
    {
        while($row_information = mysql_fetch_assoc($res_fields)) {
            echo '<Record>';
            if(count($_REQUEST['xml_field_name']) > 0) {
                foreach($_REQUEST['xml_field_name'] as $key=>$value) {
                    $value = trim(preg_replace('/[^a-zA-Z0-9_ s]/', '',$value));
                    echo '<'.str_replace(' ', '_', $value).'>'.htmlspecialchars($row_information[$key]).'</'.str_replace(' ', '_', $value).'>';
                }
            }
            else {
                echo 'No Records';
            }
            echo '</Record>';
        }
    }
}
echo '</RecordsInformation>';