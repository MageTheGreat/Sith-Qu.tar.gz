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
	
<?php // ON RECUPERE LE NOM DU JEU DU JOUR ?>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8',	'root',	'');
		$reponse = $bdd->prepare('SELECT jeuName FROM jours WHERE date=?');
		$reponse->execute(array(date('y-m-d')));
		$jeuName = "";
		while($donnees = $reponse->fetch())
		{
			$jeuName = $donnees['jeuName'];
		}
		$reponse->closeCursor();
	?>
	
<?php // LA PRESENTATION DU JEU, ON INFORME LES GENS QU'ILS ONT PERDU AU VRAI JEU ?>
	<div>
		<p>
			Tout d'abord, sachez que vous avez perdu au jeu.<br/><br/>
			Vous jouez aujourd'hui <span class="vote"><?php echo $jeuName; ?></span>.
		</p>
	</div>
	
	<form action="jouer.php" method="post">
		<center><input  type="submit" value="Je veux jouer !" /></center>
	</form>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
