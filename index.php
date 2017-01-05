<?php // SI LA SESSION N'EST PAS ACTIVE, ON LA DEMARRE ?>
<?php // SI L'UTILISATEUR NE S'EST PAS ENCORE CONNECTE, ON LE SIGNALE AUX AUTRES PAGES ?>
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

<?php // DEFINITION DES META-DONNEES, FEUILLE DE STYLE, ET ICONE ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
<?php // INCLUSION DU FICHIER CONTENANT LE CODE HTML DE L'EN-TETE ?>
	<?php include("inc/header.php"); ?>
	
	<br/><br/>
	
<?php // SOMMAIRE : LOGO, VIDEO, CHOREE ?>
	<div>
		<p class="sommaireP">
			Cette année, les listeux du Rézo vous ont préparé des divertissements on ne peut plus qualis ! Au programme, vous trouverez :
			<ul>
				<li>Un magnifique logo, le <span class="listName">Queutar.gz</span> : <br/><img class="logoListe" src="img/Logo_Liste_alpha.png" width=30%/></li>
				<li>Un teaser vidéo digne des plus grands réalisateurs de science-fiction, le <i>(Nom quali à venir)</i> : <br/><i>(A venir)</i></li>
				<li>Une chorégraphie spécialement créée par des artistes de renom, la <span class="listName">Corée du Nord</span> : <br/><i>(A venir)</i></li>
			</ul>
		</p>
	</div>
	
	<br/><br/>

<?php // LIENS VERS LES DIFFERENTES FONCTIONNALITES DU SITH : MOT DU PRESIDENT, VOTES, JEUX ?>
	<div class="speech">
		<p>
			Retrouvez également le <a href="mot.php">mot de notre Président</a>.
		</p>
	</div>
	
	<br/>
	
	<div class="jeux">
		<p>
			Vous aurez aussi l'occasion de participer à des jeux et des votes afin de priver des adhérents d'Internet, ainsi que de vous en rendre l'accès dans le cas où vous en auriez été vous-même privé.
			<br/>
			Pour <span class="vote">voter</span>, cliquez sur <a href="vote.php">ce lien</a>.
			<br/>
			Pour <span class="vote">jouer</span>, cliquez sur <a href="jeu.php">ce lien</a>.
		<p>
	</div>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
