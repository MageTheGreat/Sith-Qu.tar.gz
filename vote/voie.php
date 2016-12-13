<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="../style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>

	<div class="header">
		<img class="logoRezo1" src="../img/Logo_Rezo_w.png" width=15%/>
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
	
	<br/>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$votes = 0;
		$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voteType=\'voie\' AND voteName=? AND date=?');
		$reponse->execute(array($_POST['voie'], date('y-m-d')));
		while($donnees = $reponse->fetch())
		{
		   $votes = $votes + $donnees['nbVotes'];
		}
		$reponse->closeCursor();
		
		if($votes == 0)
		{
			$reponse = $bdd->prepare('INSERT INTO votes (voteType, voteName, nbVotes, date) VALUES (\'voie\', ?, ?, ?)');
			$reponse->execute(array($_POST['voie'], 0, date('y-m-d')));
			$reponse->closeCursor();
		}
		$votes = $votes + 1;
		$reponse = $bdd->prepare('UPDATE votes SET nbVotes=? WHERE voteType=\'voie\' AND voteName=? AND date=?');
		$reponse->execute(array($votes, $_POST['voie'], date('y-m-d')));
		$reponse->closeCursor();
	?>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$voies = array('PAG1', 'PAG2', 'PAG3', 'DAG1', 'DAG2', 'DAG3');
		$votes = array('PAG1' => 0, 'PAG2' => 0, 'PAG3' => 0, 'DAG1' => 0, 'DAG2' => 0, 'DAG3' => 0);
		foreach($voies as $voie)
		{
			$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voteType=\'voie\' AND voteName=? AND date=?');
			$reponse->execute(array($voie, date('y-m-d')));
			while($donnees = $reponse->fetch())
			{
			   $votes[$voie] = $votes[$voie] + $donnees['nbVotes'];
			}
			$reponse->closeCursor();
		}
	?>

	<div class="stats">
		<p>
			Merci d'avoir voté ! Voici les statistiques en cours :
			<ul>
				<?php
					foreach($votes as $voie => $vote)
					{ ?>
						<li><span class="vote"><?php echo $voie; ?></span> : <?php echo $vote; ?> votes.</li>
					<?php }
				?>
			</ul>
		</p>
	</div>

	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>
