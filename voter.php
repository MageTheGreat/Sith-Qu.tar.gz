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
	<?php include("inc/participation.php"); ?>
	
	<br/><br/>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$reponse = $bdd->prepare('SELECT voteLink FROM jours WHERE date=?');
		$reponse->execute(array(date('y-m-d')));
		$voteLink = "";
		while($donnees = $reponse->fetch())
		{
			$voteLink = $donnees['voteLink'];
		}
		$reponse->closeCursor();
		
		if($voteLink == "")
		{
			header("Location: index.php");
		}
	?>
	
	<?php
		if(!participe("vote"))
		{
			header("Location: vote/".$voteLink);
		}
		else
		{ ?>
			Vous avez déjà voté !
			<br/><br/>
			Accéder aux <a href=<?php echo "vote/res_".$voteLink; ?>>résultats</a>.
			<br/>
		<?php }
	?>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		Mentions légales
	</div>
	
	<br/>
	
</body>
</html>
