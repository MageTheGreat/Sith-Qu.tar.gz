<?php // SI LA SESSION N'EST PAS ACTIVE, ON LA DEMARRE ?>
<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{
		session_start();
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

<?php // CODE EFFECTIF DE DECONNEXION ?>
	<?php
// SI LES VATIABLES SONT DEFINIES, ON LES DETRUIT
		if(isset($_SESSION['user']))
		{
			unset($_SESSION['user']);
		}
		
		if(isset($_SESSION['connected']))
		{
			unset($_SESSION['connected']);
		}
		
// ON DETRUIT LA SESSION (FORCEMENT ACTIVE D'APRES LE HAUT DE LA PAGE)
		session_destroy();
		
// ON RETOURNE A L'INDEX
		header("Location: index.php");
	?>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
