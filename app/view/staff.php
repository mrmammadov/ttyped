<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>This is home page</h1>

	<?php 
		foreach ($staff_list as $key => $value)  { 
			print_r($value);
		}
	?>		
</body>
</html>