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
	
<?php // ON RECUPERE LE NOM DU VOTE DU JOUR ?>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
		$reponse = $bdd->prepare('SELECT voteName FROM jours WHERE date=?');
		$reponse->execute(array(date('y-m-d')));
		$voteName = "";
		while($donnees = $reponse->fetch())
		{
			$voteName = $donnees['voteName'];
		}
		$reponse->closeCursor();
	?>
	
<?php // LA PRESENTATION DU VOTE ?>
	<div class="textVote">
		C'est sur cette page qu'une bataille acharnée va se jouer pour savoir quelles voies, séries, groupes de TD, rez ou encore aile ou étage va se trouver sans Internet pour une durée indéterminée !<br/>
		Vous votez aujourd'hui pour <span class="vote"><?php echo $voteName; ?></span>.
	</div>
	
<?php // LE BOUTON POUR VOTER ?>
	<div class="form">
		<form action="voter.php" method="post">
			<p>
				<center><input type="submit" value="Voter !" /></center>
			</p>
		</form>
	</div>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
