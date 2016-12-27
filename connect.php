<?php // SI LA SESSION N'EST PAS ACTIVE, ON LA DEMARRE ?>
<?php // SI L'UTILISATEUR EST DEJA CONNECTE, ON LE RENVOIE VERS L'INDEX ?>
<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{
		session_start();
	}
	if(isset($_SESSION['connected']) && $_SESSION['connected'])
	{
		header("Location: index.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php // DEFINITION DES META-DONNEES, FEUILLE DE STYLE, ET ICONE ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
<?php // INCLUSION DU FICHIER CONTENANT LE CODE HTML DE L'EN-TETE ?>
	<?php include("inc/header.php"); ?>

	<br/><br/>

<?php // MODULE DE CONNEXION ?>
	<div class="connect2">
			<p>
				<form action="login.php" method="post">
					<span class="connectText">Connexion :</span>
					<br/><br/>
					<i>Pseudo :</i> <input type="text" name="user" placeholder="Entrez votre pseudo" />
					<br/>
					<i>Mot de passe :</i> <input type="password" name="pass" placeholder="Entrez votre mot de passe" />

					<br/><br/>

					<center><input type="submit" value="Connexion" /></center>
				</form>
			</p>
		</div>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
