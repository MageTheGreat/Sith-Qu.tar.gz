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
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$reponse = $bdd->prepare('SELECT jeuName FROM jours WHERE date=?');
		$reponse->execute(array(date('y-m-d')));
		$jeuInfos = array('jeuName' => '');
		while($donnees = $reponse->fetch())
		{
			$jeuInfos['jeuName'] = $donnees['jeuName'];
		}
		$reponse->closeCursor();
	?>
	
	<div>
		<p>
			Tout d'abord, sachez que vous avez perdu au jeu.<br/><br/>
			Vous jouez aujourd'hui au <?php echo $jeuInfos['jeuName']; ?>.
		</p>
	</div>
	
	<form action="jeu.php" method="post">
		<input type="hidden" name="jeu" value=<?php echo $jeuInfos['jeuName']; ?> />
	
		<center><input  type="submit" value="Je veux jouer !" /></center>
	</form>
	
	<?php include("structure/footer.php"); ?>
	
</body>
</html>