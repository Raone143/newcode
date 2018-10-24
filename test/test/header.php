<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
</head>
<body>

</body>
</html>
<?php 
$method = $_SERVER['REQUEST_METHOD'];
print_r($method);
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));
print_r($request);
function rest_put($request) {
	print_r($request);
}

switch ($method) {
	case 'PUT':
		rest_put($request);
		break;
	case 'POST':
		rest_put($request);
		break;
	case 'GET':
		rest_put($request);
		break;
	case 'HEAD':
		rest_put($request);
		break;
	case 'DELETE':
		rest_put($request);
		break;
	case 'OPTIONS':
		rest_put($request);
		break;
	default:
		break;
}
?>