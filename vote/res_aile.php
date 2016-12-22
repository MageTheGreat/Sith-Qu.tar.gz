<?php // ON FORCE LES GENS A SE CONNECTER ?>
<?php include("../inc/connected.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php // DEFINITION DES META-DONNEES, FEUILLE DE STYLE, ET ICONE ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="../style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
<?php // INCLUSION DU FICHIER CONTENANT LE CODE HTML DE L'EN-TETE ?>
	<?php include("../inc/header.php"); ?>
<?php // INCLUSION DU FICHIER INDIQUANT SI LES GENS ONT DEJA VOTE OU NON ?>
	<?php include("../inc/participation.php"); ?>
	
	<br/><br/>
	
<?php // SI LA PERSONNE N'A PAS ENCORE VOTE, ON AJOUTE SON VOTE A LA BASE DE DONNEES DES PARTICIPATIONS ?>
	<?php
		if(!participe("vote"))
		{
			addParticipation("vote");
			
			$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
			$votes = 0;
			$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voteType=\'aile\' AND voteName=? AND date=?');
			$reponse->execute(array($_POST['aile'], date('y-m-d')));
			while($donnees = $reponse->fetch())
			{
			   $votes = $votes + $donnees['nbVotes'];
			}
			$reponse->closeCursor();
			
			if($votes == 0)
			{
				$reponse = $bdd->prepare('INSERT INTO votes (voteType, voteName, nbVotes, date) VALUES (\'aile\', ?, ?, ?)');
				$reponse->execute(array($_POST['aile'], 0, date('y-m-d')));
				$reponse->closeCursor();
			}
			$votes = $votes + 1;
			$reponse = $bdd->prepare('UPDATE votes SET nbVotes=? WHERE voteType=\'aile\' AND voteName=? AND date=?');
			$reponse->execute(array($votes, $_POST['aile'], date('y-m-d')));
			$reponse->closeCursor();
		}
	?>
	
<?php // ON RECUPERE LES VOTES EN VUE DE LES AFFICHER ?>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$ailes = array('1.A', '1.B', '1.C', '1.D', '2.A', '2.B', '2.C', '2.D');
		$votes = array('1.A' => 0, '1.B' => 0, '1.C' => 0, '1.D' => 0, '2.A' => 0, '2.B' => 0, '2.C' => 0, '2.D' => 0);
		foreach($ailes as $aile)
		{
			$reponse = $bdd->prepare('SELECT nbVotes FROM votes WHERE voteType=\'aile\' AND voteName=? AND date=?');
			$reponse->execute(array($aile, date('y-m-d')));
			while($donnees = $reponse->fetch())
			{
			   $votes[$aile] = $votes[$aile] + $donnees['nbVotes'];
			}
			$reponse->closeCursor();
		}
	?>

<?php // ON AFFICHE LES VOTES ?>
	<div class="stats">
		<p>
			Merci d'avoir voté ! Voici les statistiques en cours :
			<ul>
				<?php
					foreach($votes as $aile => $vote)
					{ ?>
						<li><span class="vote"><?php echo $aile; ?></span> : <?php echo $vote; ?> votes.</li>
					<?php }
				?>
			</ul>
		</p>
	</div>
	
	<br/>
	
	<p>
		Retour à la <a href="..\index.php">page d'accueil</a>.
	</p>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("../inc/footer.php"); ?>
	
</body>
</html>
