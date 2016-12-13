﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

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
		$reponse = $bdd->prepare('SELECT voteName, voteLink FROM jours WHERE date=?');
		$reponse->execute(array(date('y-m-d')));
		$voteInfos = array('voteName' => '', 'voteLink' => '');
		while($donnees = $reponse->fetch())
		{
			$voteInfos['voteName'] = $donnees['voteName'];
			$voteInfos['voteLink'] = $donnees['voteLink'];
		}
		$reponse->closeCursor();
	?>
	
	<div class="textVote">
		C'est sur cette page qu'une bataille acharnée va se jouer pour savoir quelles voies, séries, groupes de TD, rez ou encore aile ou étage va se trouver sans Internet pour une durée indéterminée !<br/>
		Vous votez aujourd'hui pour une <span class="vote"><?php echo $voteInfos['voteName']; ?></span>.
	</div>
	
	<div class="form">
		<form action="voter.php" method="post">
			<p>
				<input type="hidden" name="link" value=<?php echo $voteInfos['voteLink']; ?> />
				
				<center><input type="submit" value="Voter !" /></center>
			</p>
		</form>
	</div>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>
