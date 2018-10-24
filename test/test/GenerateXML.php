<?php
//Include Database Connection and Class To Access Data
include_once("DatabaseConnection.php");
include_once("AccessDataBaseClass.php");

$table_name = "user_information";

//Create an object for FirstClass
$class_obj = new AccessDataBaseClass();

$table_information = $class_obj->get_table_information($table_name);
$count_table_information = count($table_information);

for($j = 0; $j < $count_table_information; $j++) {
    $field_names[] = $table_information[$j]['Field'];
}

$count_fields = count($field_names);

$xml_string  = '<?xml version="1.0" encoding="UTF-8"?>';
$xml_string .= '<record_information>';
$xml_string .= '<user_name>Testing</user_name>';
$xml_string .= '</record_information>';

?>
<script>
    var d = document;
    var xmlFieldsArray = new Array();

    function select_fields() {
        var formObj = d.frmCreateXMLForm;
        var options_length = formObj.ddlRecordInformation.length;
        var ddlRecObj = d.getElementById('ddlRecordInformation');
        var createXmlOption = false;
        for(i = 0; i < options_length; i++) {
           if(ddlRecObj.options[i].selected == true) {
               var selectedValue = ddlRecObj.options[i].value;
               var selectedText  = ddlRecObj.options[i].text;
               var selectedDdlObj = d.getElementById('ddlMXMLFields');

               //XmlField Array Length
               var xmlFieldsLength = xmlFieldsArray.length;
               xmlFieldsArray[xmlFieldsLength] = selectedValue;

               for(k = 0; k < xmlFieldsLength; k++) {
                   if(xmlFieldsArray[k] == selectedValue) {
                       createXmlOption = true;
                       k = xmlFieldsLength;
                   }
               }
               if(createXmlOption == false) {
                   selectedDdlObj.options[selectedDdlObj.length] = new Option(selectedText, selectedValue);
               }

            }
        }
    }

    function remove_selected_fields() {
        var formObj = d.forms['frmCreateXMLForm'];
        var options_length = formObj.ddlMXMLFields.length;
        var ddlXmlObj = d.getElementById('ddlMXMLFields');

        for(i = options_length - 1; i >= 0; i--) {
            if(ddlXmlObj.options[i].selected == true) {
                   ddlXmlObj.remove(i);
            }
        }
    }
</script>
<form method="post" name="frmCreateXMLForm" id="frmCreateXMLForm">
    <table align="center" border="0">
       <tr>
           <td>

               <select multiple="multiple" name="ddlRecordInformation[]" id="ddlRecordInformation" style="width:150px;height: 100px">
                   <?php
                   for($k = 0; $k < $count_fields; $k++) {
                       ?><option value="<?php echo $field_names[$k];?>"><?php echo $field_names[$k];?></option><?php
                   }
                   ?>
               </select>



           </td>

           <td align="center">

               <input type="button" name="AddFields" id="AddFields" value="Add Fields" onclick="select_fields()">
               <br>
               <input type="button" name="RemoveFields" id="RemoveFields" value="Remove Fields" onclick="remove_selected_fields()">

           </td>

           <td>

               <select multiple="multiple" name="ddlMXMLFields[]" id="ddlMXMLFields" style="width:150px;height: 100px">

               </select>

           </td>

           <td>

               <div style="width: 150px;height: 100px;overflow-y: scroll;border: 1px solid #a9a9a9">

               </div>

           </td>
       </tr>

</table>
</form>