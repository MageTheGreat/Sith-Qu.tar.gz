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

	<?php include("structure/header.php"); ?>
	
	<div>
		<p>
			Vous souhaitez dire merci au Président.
		</p>
	</div>

	<div class="form">
		<form action="merci.php" method="post">
			<p>
				Veuillez entrer vos prénoms et noms :
				<input type="text" name="prenom" />
				<input type="text" name="nom" />

				<br/><br/>				
				
				<center><input type="submit" value="Remercier le Président !" /></center>
			</p>
		</form>
	</div>

	<?php include("structure/footer.php"); ?>
	
</body>
</html>
