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
<?php // INCLUSION DU FICHIER INDIQUANT SI LES GENS ONT DEJA VOTE OU NON ?>
	<?php include("inc/participation.php"); ?>
	
	<br/><br/>
	
<?php // ON CHERCHE LE LIEN DU VOTE DU JOUR ?>
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
		
// SI ON NE TROUVE PAS LE LIEN, ON REDIRIGE VERS L'INDEX
		if($voteLink == "")
		{
			header("Location: index.php");
		}
	?>
	
<?php // ON REGARDE SI L'UTILISATEUR A DEJA VOTE ?>
	<?php
// SI NON, ON LE REDIRIGE VERS LA PAGE DU VOTE
		if(!participe("vote"))
		{
			header("Location: vote/".$voteLink);
		}
// SINON, ON L'INFORME QU'IL N'A PLUS LE DROIT DE VOTER, MAIS PEUT VOIR LES RESULTATS
		else
		{ ?>
			<p>
				Vous avez déjà voté !
				<br/><br/>
				Accéder aux <a href=<?php echo "vote/res_".$voteLink; ?>>résultats</a>.
				<br/>
				Retour à la <a href="index.php">page d'accueil</a>.
			</p>
		<?php }
	?>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
