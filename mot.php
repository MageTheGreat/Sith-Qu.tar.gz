<?php // ON FORCE LES GENS A SE CONNECTER ?>
<?php include("inc/connected.php"); ?>
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
	
<?php // LE MOT DU PRESIDENT ?>
	<div class="textMot">
		Président, Président, Président !!!
	</div>
	
<?php // LE LIEN POUR DIRE MERCI ?>
	<div>
		<p>
			Vous pouvez remerci le Président en cliquant sur <a href="merci_conf.php">ce lien</a>.
		</p>
	</div>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
