<?php include("../inc/connected.php"); ?>
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
	<?php include("../inc/header.php"); ?>
	
	<br/><br/>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$votes = 0;
		$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voteType=\'serie\' AND voteName=? AND date=?');
		$reponse->execute(array($_POST['serie'], date('y-m-d')));
		while($donnees = $reponse->fetch())
		{
		   $votes = $votes + $donnees['nbVotes'];
		}
		$reponse->closeCursor();
		
		if($votes == 0)
		{
			$reponse = $bdd->prepare('INSERT INTO votes (voteType, voteName, nbVotes, date) VALUES (\'serie\', ?, ?, ?)');
			$reponse->execute(array($_POST['serie'], 0, date('y-m-d')));
			$reponse->closeCursor();
		}
		$votes = $votes + 1;
		$reponse = $bdd->prepare('UPDATE votes SET nbVotes=? WHERE voteType=\'serie\' AND voteName=? AND date=?');
		$reponse->execute(array($votes, $_POST['serie'], date('y-m-d')));
		$reponse->closeCursor();
	?>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$series = array('A', 'B', 'C');
		$votes = array('A' => 0, 'B' => 0, 'C' => 0);
		foreach($series as $serie)
		{
			$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voteType=\'serie\' AND voteName=? AND date=?');
			$reponse->execute(array($serie, date('y-m-d')));
			while($donnees = $reponse->fetch())
			{
			   $votes[$serie] = $votes[$serie] + $donnees['nbVotes'];
			}
			$reponse->closeCursor();
		}
	?>

	<div class="stats">
		<p>
			Merci d'avoir voté ! Voici les statistiques en cours :
			<ul>
				<?php
					foreach($votes as $serie => $vote)
					{ ?>
						<li><span class="vote"><?php echo $serie; ?></span> : <?php echo $vote; ?> votes.</li>
					<?php }
				?>
			</ul>
		</p>
	</div>
	
	<br/>
	
	<p>
		Retour à la <a href="..\index.php">page d'accueil</a>.
	</p>

	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>
