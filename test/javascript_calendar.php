<!DOCTYPE html>
<html>
<body>

<p id="demo"></p>
<p id="demo1"></p>
<p id="demo2"></p>
<script>
var d = new Date('2015', '05', '31');
var year = d.getFullYear();
var day = d.getDay();
var month = d.getMonth();

document.getElementById("demo").innerHTML = year;
document.getElementById("demo1").innerHTML = day;
document.getElementById("demo2").innerHTML = month;
</script>

</body>
</html>