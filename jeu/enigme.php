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
<?php // INCLUSION DU FICHIER INDIQUANT SI LES GENS ONT DEJA JOUE OU NON ?>
	<?php include("../inc/participation.php"); ?>
	
	<br/><br/>
	
<?php // SI LA PERSONNE N'A PAS ENCORE JEU, ON AJOUTE SON JEU A LA BASE DE DONNEES DES PARTICIPATIONS ?>
	<?php
		addParticipation("jeu");

// ON CHOISIT ALEATOIREMENT UNE ENIGME		
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8',	'root',	'');
		$max = 0;
		$reponse = $bdd->query('SELECT MAX(id) FROM enigmes');
		while($donnees = $reponse->fetch())
		{
		   $max = $donnees['MAX(id)'];
		}
		$reponse->closeCursor();
		$id = rand(1, $max);
		
		$question = '';
		$reponse = $bdd->prepare('SELECT question FROM enigmes WHERE id=?');
		$reponse->execute(array($id));
		while($donnees = $reponse->fetch())
		{
		   $question = $donnees['question'];
		}
		$reponse->closeCursor();
	?>

<?php // FORMULAIRE POUR LA REPONSE ?>
	<div class="form">
		<form action="check.php" method="post">
			<p>
				<input type="hidden" name="id" value=<?php echo $id; ?> />
				
				La question est :<br/>
				<center><?php echo $question; ?></center><br/>
				Entrez votre réponse :
				<input type="text" name="reponse" />
				
				<br/><br/>
					
				<center><input type="submit" value="Valider" /></center>
			</p>
		</form>
	</div>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("../inc/footer.php"); ?>
	
</body>
</html>
