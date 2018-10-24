<?php

/*
$str = "It is for testing";

$condition = true;
$i = 0;
while($condition) {
	
	if($str[$i] == "") {
		$condition = false;
	}
	
}
$WHERE['OrgID'] = '12345';
$WHERE['MultiOrgID'] = '12345';
$WHERE['RequestID'] = '12345';

echo implode(" AND ", $WHERE);
*/
?>
<script>
content += "<tr><td>" + object.name + "</td>";
content += "<td>" + type + "</td>";
content += "<td>";
content += "<div class='attechment-view-icon' onclick=\"viewAttachment( '"+ object.key +"', '" + type + "')\"></div>"
content += "<div class='attechment-download-icon' onclick=\"downloadAttachment( '" + object.key + "', '" + type + "' )\"></div>";
content += "</td></tr>";
</script>