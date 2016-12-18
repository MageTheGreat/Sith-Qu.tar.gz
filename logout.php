<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
	<?php include("inc/header.php"); ?>
	
	<br/><br/>
	
	<?php
		if(isset($_SESSION['user']))
		{
			unset($_SESSION['user']);
		}
		
		session_destroy();
		
		header("Location: index.php");
	?>
	
	<hr/>
	
	<div class="footer">
		Mentions légales
	</div>
	
	<br/>
	
</body>
</html>
