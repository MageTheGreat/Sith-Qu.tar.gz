<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{
		session_start();
	}
	if(!isset($_SESSION['connected']))
	{
		$_SESSION['connected'] = false;
	}
?>
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
		<p class="sommaireP">
			Cette année, les listeux du Rézo vous ont préparé des divertissements on ne peut plus qualis ! Au programme, vous trouverez :
			<ul>
				<li>Un magnifique logo, le <span class="listName">Queutar.gz</span> : <br/><img class="logoListe" src="img/Logo_Liste.jpg" width=20%/></li>
				<li>Un teaser vidéo digne des plus grands réalisateurs de science-fiction, le <i>(Nom quali a venir)</i> : <br/><i>(A venir)</i></li>
				<li>Une chorégraphie spécialement créée par des artistes de renom, la <span class="listName">Corée du Nord</span> : <br/><i>(A venir)</i></li>
			</ul>
		</p>
	</div>
	
	<br/><br/>
	
	<div class="speech">
		<p>
			Retrouvez également le <a href="mot.php">mot de notre président</a>.
		</p>
	</div>
	
	<br/>
	
	<div class="jeux">
		<p>
			Vous aurez aussi l'occasion de participer à des jeux et des votes afin de priver des adhérents d'Internet, ainsi que de vous rendre l'accès dans le cas où vous en auriez été vous-même privé.
			<br/>
			Pour voter, cliquez sur <a href="vote.php">ce lien</a>.
			<br/>
			Pour jouer, cliquez sur <a href="jeu.php">ce lien</a>.
		<p>
	</div>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		Mentions légales
	</div>
	
	<br/>
	
</body>
</html>
