<?php
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

$table_information = $class_obj->get_table_information($table_name);
$count_table_information = count($table_information);

for($j = 0; $j < $count_table_information; $j++) {
    $field_names[] = $table_information[$j]['Field'];
}

$count_fields = count($field_names);
?>
<script>
    var d = document;
    var divInputObj;

    function addTextElement(dynamicInputElementId) {
        divInputObj = d.getElementById('DynamicInputElement');
        var newInputElement = d.createElement('input');

        newInputElement.setAttribute('id',dynamicInputElementId);
        newInputElement.setAttribute('name','xml_field_name['+dynamicInputElementId+']');
        newInputElement.setAttribute('value',dynamicInputElementId);
        newInputElement.setAttribute('style','width:130px;');

        divInputObj.appendChild(newInputElement);
    }

    function removeTextElement(inputElementId) {
        divInputObj = d.getElementById('DynamicInputElement');
        divInputObj.removeChild(d.getElementById(inputElementId));
    }

    function select_fields() {
        var formObj = d.frmCreateXMLForm;
        var optionsLength = formObj.ddlRecordInformation.length;
        var ddlRecObj = d.getElementById('ddlRecordInformation');

        for(i = 0; i < optionsLength; i++) {
           var createObj = true;
           if(ddlRecObj.options[i].selected == true) {
               var selectedValue = ddlRecObj.options[i].value;
               var selectedText  = ddlRecObj.options[i].text;
               var selectedDdlObj = d.getElementById('ddlMXMLFields');
               var selectedObjLength = selectedDdlObj.length;

               for(j = 0; j < selectedObjLength; j++) {
                  if(selectedDdlObj.options[j].value == selectedValue) {
                      createObj = false;
                  }
               }

               if(createObj) {
                   selectedDdlObj.options[selectedObjLength] = new Option(selectedText, selectedValue);
                   addTextElement(selectedValue);
               }
            }
        }
    }

    function remove_selected_fields() {
        var formObj = d.forms['frmCreateXMLForm'];
        var optionsLength = formObj.ddlMXMLFields.length;
        var ddlXmlObj = d.getElementById('ddlMXMLFields');

        for(i = optionsLength - 1; i >= 0; i--) {
            if(ddlXmlObj.options[i].selected == true) {
                removeTextElement(ddlXmlObj.options[i].value);
                ddlXmlObj.remove(i);
            }
        }
    }

    function select_table(frmObj) {
        this.action = '';
        frmObj.submit();
    }

    function create_xml_file(frmObj) {
        frmObj.action = 'C.php';
        frmObj.submit();
    }
</script>



<form method="post" name="frmCreateXMLForm" id="frmCreateXMLForm" action="">
    <table align="center" border="0" cellspacing="5">

        <tr>
            <td style="width:80px">Tables List</td>
            <td colspan="3">
                <select name="ddl_tables_list" id="ddl_tables_list" onchange="select_table(this.form);">
                    <option value="">Select Table</option>
                    <?php
                    for($table_index = 0; $table_index < count($tables_list); $table_index++) {
                        if(isset($table_name) && $table_name != "")
                            $tselected = ($table_name == $tables_list[$table_index]) ? " selected='selected'" : "";
                        ?>
                        <option value="<?php echo $tables_list[$table_index];?>"<?php if(!empty($tselected)) echo $tselected;?>><?php echo $tables_list[$table_index];?></option>
                        <?php
                        unset($tselected);
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td colspan="4">&nbsp;
                
            </td>
        </tr>

        <tr>
            <td style="color: #333333">
                Fields in selected table
            </td>
            <td style="color: #333333">
                &nbsp;
            </td>
            <td style="color: #333333">
                Selected fields for xml
            </td>
            <td style="color: #333333">
                Display name in xml file
            </td>
        </tr>

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

               <div style="width: 150px;height: 100px;overflow-y: scroll;border: 1px solid #a9a9a9" id="DynamicInputElement">

               </div>

           </td>
       </tr>


        <tr>
            <td colspan="4">
                <input type="button" name="CreateXMLWebService" id="CreateXMLWebService" value="Submit" onclick="create_xml_file(this.form);">
            </td>
        </tr>

</table>
</form>