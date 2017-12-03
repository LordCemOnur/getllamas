<?php
//error_reporting(E_ALL);
session_start();
unset($_SESSION["TheUser"]);
setcookie("llama_cookie","whatever",time()-3600);
//session_unset();
header("Location: index.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Tilte</title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

	<body>
Bye!
	</body>

	</html>