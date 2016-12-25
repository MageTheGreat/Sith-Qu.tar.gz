<?php // ON FORCE LES GENS A SE CONNECTER ?>
<?php include("inc/connected.php"); ?>
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

<?php // ON CHERCHE LES INFOS DE L'UTILISATEUR ?>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
		$reponse = $bdd->prepare('SELECT nom, prenom FROM ids WHERE user=?');
		$reponse->execute(array($_SESSION['user']));
		$infos = array('prenom' => '', 'nom' => '');
		while($donnees = $reponse->fetch())
		{
			$infos['prenom'] = $donnees['prenom'];
			$infos['nom'] = $donnees['nom'];
		}
		$reponse->closeCursor();
	?>
	
	<br/><br/>
	
<?php // TEXTE DE REMERCIEMENT DU REMERCIEMENT ?>
	<div>
		<p>
			Merci <span class="nom"><?php echo $infos['prenom'].' '.$infos['nom'];?></span>, nous transmettrons votre chaleureux message au Président.
			
			<br/><br/>
			
			Peut-être vous rendra-t-il la pareille un jour...
		</p>
	</div>

<?php // AJOUT DES DONNEES DE L'UTILISATEUR DANS LA BASE DES REMERCIEMENTS ?>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
		$reponse = $bdd->prepare('INSERT INTO merci (nom, prenom, date) VALUES (?, ?, ?)');
		$reponse->execute(array($infos['nom'], $infos['prenom'], date('y-m-d')));
		$reponse->closeCursor();
	?>
	
	<br/>
	
	<p>
		Retour à la <a href="index.php">page d'accueil</a>.
	</p>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
