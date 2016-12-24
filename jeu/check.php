<?php // ON FORCE LES GENS A SE CONNECTER ?>
<?php include("../inc/connected.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php // DEFINITION DES META-DONNEES, FEUILLE DE STYLE, ET ICONE ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="..\style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
<?php // INCLUSION DU FICHIER CONTENANT LE CODE HTML DE L'EN-TETE ?>
	<?php include("../inc/header.php"); ?>
	
<?php // ON RECUPERE LES INFOS DE L'UTILISATEUR ?>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8',	'root',	'');
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
	
<?php // ON VERIFIE LA REPONSE ?>
	<div>
		<?php
			$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8',	'root',	'');
			$answer = '';
			$reponse = $bdd->prepare('SELECT reponse FROM enigmes WHERE id=?');
			$reponse->execute(array($_POST['id']));
			while($donnees = $reponse->fetch())
			{
			   $answer = $donnees['reponse'];
			}
			$reponse->closeCursor();
			
// SI L'UTILISATEUR A TROUVE LA BONNE REPONSE, ON L'AJOUTE A LA BASE DE DONNEES DES SAUVES
			if($_POST['reponse'] == $answer)
			{
				echo "Vous avez répondu correctement à l'énigme.";
				$reponse = $bdd->prepare('INSERT INTO sauves (nom, prenom, date) VALUES (?, ?, ?)');
				$reponse->execute(array($infos['nom'], $infos['prenom'], date('y-m-d')));
				$reponse->closeCursor();
			}
// SINON, ON L'INFORME QU'IL N'A PAS TROUVE LA REPONSE
			else
			{
				echo "Vous n'avez pas obtenu la réponse à l'énigme.";
			}
		?>
	</div>
	
	<br/>
	
	<p>
		Retour à la <a href="..\index.php">page d'accueil</a>.
	</p>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("../inc/footer.php"); ?>
	
</body>
</html>
