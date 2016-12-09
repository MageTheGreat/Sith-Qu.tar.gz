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

	<div class="header">
		<img class="logoRezo1" src="img/Logo_Rezo_w.png" width=15%/>
		<span class="intro">Voici le Sith Web de la liste du Rézo 2016 <span class="listName">Qu.tar.gz</span> !</span>
		<img class="logoRezo2" src="img/Logo_Rezo_w.png" width=15%/>
	</div>
	
	<br/>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$votes = 0;
		$jour = 0;
		$reponse = $bdd->query('SELECT MAX(jour) FROM jours');
		while($donnees = $reponse->fetch())
		{
		   $jour = $donnees['MAX(jour)'];
		}
		$reponse->closeCursor();
		$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voie=? AND jour=?');
		$reponse->execute(array($_POST['voie'], $jour));
		while($donnees = $reponse->fetch())
		{
		   $votes = $votes + $donnees['nbVotes'];
		}
		$reponse->closeCursor();
		
		if($votes == 0)
		{
			$reponse = $bdd->prepare('INSERT INTO votes (nbVotes, voie, jour) VALUES (?, ?, ?)');
			$reponse->execute(array(0, $_POST['voie'], $jour));
			$reponse->closeCursor();
		}
		$votes = $votes + 1;
		$reponse = $bdd->prepare('UPDATE votes SET nbVotes=? WHERE voie=? AND jour=?');
		$reponse->execute(array($votes, $_POST['voie'], $jour));
		$reponse->closeCursor();
	?>

	<div class="stats">
		<p>
			Merci d'avoir voté ! Voici les statistiques en cours :
		</p>
		<!-- GRAPHE TOTALEMENT BULLSHIT -->
	</div>

	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>