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
		<div class="intro">
			<p>
				Voici le Sith Web de la liste du Rézo 2016 <span class="listName">Qu.tar.gz</span> !
			</p>
		</div>
		<div class="connect">
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
	</div>
	
	<br/><br/>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$reponse = $bdd->prepare('SELECT jeuName, jeuLink FROM jours WHERE date=?');
		$reponse->execute(array(date('y-m-d')));
		$jeuInfos = array('jeuName' => '', 'jeuLink' => '');
		while($donnees = $reponse->fetch())
		{
			$jeuInfos['jeuName'] = $donnees['jeuName'];
			$jeuInfos['jeuLink'] = $donnees['jeuLink'];
		}
		$reponse->closeCursor();
	?>
	
	<div>
		<p>
			Tout d'abord, sachez que vous avez perdu au jeu.<br/><br/>
			Vous jouez aujourd'hui au <?php echo $jeuInfos['jeuName']; ?>.
		</p>
	</div>
	
	<form action="compris.php" method="post">
		<input type="hidden" name="link" value=<?php echo $jeuInfos['jeuLink']; ?> />
	
		<center><input  type="submit" value="Je veux jouer !" /></center>
	</form>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		Mentions légales
	</div>
	
	<br/>
	
</body>
</html>
