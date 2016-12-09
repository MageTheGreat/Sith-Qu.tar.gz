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
		<span class="intro">Bienvenue sur le Sith Web de la liste du Rézo 2016 <span class="listName">Qu.tar.gz</span> !</span>
		<img class="logoRezo2" src="img/Logo_Rezo_w.png" width=15%/>
	</div>
	
	<br/><br/>
	
	<div>
		<p>
			Merci <span class="test"><?php echo $_POST['prenom'].' '.$_POST['nom'];?></span>, nous transmettrons votre chaleureux message au Président.
			<br/>
			Peut-être vous rendra-t-il la pareille un jour...
		</p>
	</div>

	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$jour = 0;
		$reponse = $bdd->query('SELECT MAX(jour) FROM jours');
		while($donnees = $reponse->fetch())
		{
		   $jour = $donnees['MAX(jour)'];
		}
		$reponse->closeCursor();
		$reponse = $bdd->prepare('INSERT INTO merci (nom, prenom, jour) VALUES (?, ?, ?)');
		$reponse->execute(array($_POST['nom'], $_POST['prenom'], $jour));
		$reponse->closeCursor();
	?>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>