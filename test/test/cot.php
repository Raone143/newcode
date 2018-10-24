<script>

function showHint()
{
	var xmlhttp;

	if (window.XMLHttpRequest)
	{
	  // code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	}
	else
	{
    	  // code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	  	  document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	    }
	}
	xmlhttp.open("POST","c.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	//xmlhttp.send("fname=Henry&lname=Ford");
	xmlhttp.send("s=test");
}
	
</script>
<div id="txtHint"></div>
<div onclick="showHint()">Click Me</div>