<?php include("inc/connected.php"); ?>
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
	<?php include("inc/header.php"); ?>
	
	<br/><br/>
	
	<div>
		<p>
			Merci <span class="nom"><?php echo $_POST['prenom'].' '.$_POST['nom'];?></span>, nous transmettrons votre chaleureux message au Président.
			
			<br/><br/>
			
			Peut-être vous rendra-t-il la pareille un jour...
		</p>
	</div>

	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$reponse = $bdd->prepare('INSERT INTO merci (nom, prenom, date) VALUES (?, ?, ?)');
		$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d')));
		$reponse->closeCursor();
	?>
	
	<br/>
	
	<p>
		Retour à la <a href="index.php">page d'accueil</a>.
	</p>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>
