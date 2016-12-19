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
