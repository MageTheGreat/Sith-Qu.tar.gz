<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="..\style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
	<div class="header">
		<img class="logoRezo1" src="..\img/Logo_Rezo_w.png" width=15%/>
		<span class="intro">Bienvenue sur le Sith Web de la liste du Rézo 2016 <span class="listName">Qu.tar.gz</span> !</span>
		<img class="logoRezo2" src="..\img/Logo_Rezo_w.png" width=15%/>
	</div>
	
	<br/><br/>
	
	<div>
		<?php
			$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
			$answer = '';
			$reponse = $bdd->prepare('SELECT reponse FROM enigmes WHERE id=?');
			$reponse->execute(array($_POST['id']));
			while($donnees = $reponse->fetch())
			{
			   $answer = $donnees['reponse'];
			}
			$reponse->closeCursor();
			
			if($_POST['reponse'] == $answer)
			{
				echo "Vous avez répondu correctement à l'énigme.";
				$reponse = $bdd->prepare('INSERT INTO request (nom, prenom, date) VALUES (?, ?, ?)');
				$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d')));
				$reponse->closeCursor();
			}
			else
			{
				echo "Vous n'avez pas obtenu la réponse à l'énigme.";
			}
		?>
	</div>
	
	<br/>
	
	<p>
		Retour à la <a href="..\index.html">page d'accueil</a>.
	</p>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		Mentions légales
	</div>
	
	<br/>
	
</body>
</html>
