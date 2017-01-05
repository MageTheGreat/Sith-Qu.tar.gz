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
	
	<br/><br/>
	
<?php // ON CHOISIT ALEATOIREMENT UNE IMAGE		
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$max = 0;
	$reponse = $bdd->query('SELECT MAX(id) FROM chatons');
	while($donnees = $reponse->fetch())
	{
	   $max = $donnees['MAX(id)'];
	}
	$reponse->closeCursor();
	$id = rand(1, $max);
	
// SI ON A RAFRAICHI LA PAGE POUR AFFICHER UN AUTRE CHATON, MAIS QU'IL EST IDENTIQUE AU PRECEDENT, ON RAFRAICHIT A NOUVEAU LA PAGE
	if(isset($_POST['prev']) && $id == $_POST['prev'])
	{
		header('Location: chatons.php');
	}
	
	$filename = '';
	$description = '';
	$reponse = $bdd->prepare('SELECT filename, description FROM chatons WHERE id=?');
	$reponse->execute(array($id));
	while($donnees = $reponse->fetch())
	{
	   $filename = $donnees['filename'];
	   $description = $donnees['description'];
	}
	$reponse->closeCursor();
?>

<?php // ON AFFICHE L'IMAGE ?>
<?
// SI L'IMAGE N'EXISTE PAS, ON RECHARGE LA PAGE
	if(!file_exists("cha/".$filename))
	{
		header('Location: chatons.php');
	} ?>
<?php // SINON, ON L'AFFICHE NORMALEMENT, AVEC SA DESCRIPTION ?>
	<div class="chaton">
		<img src=<?php echo "cha/".$filename; ?> width=500pt />
		<br/>
		<?php echo $description; ?>
	</div>
	
<?php // ON PROPOSE UN BOUTON POUR RAFRAICHIR LA PAGE ?>
	<form action="chatons.php" method="post">
		<input type="hidden" name="prev" value=<?php echo $id; ?> />
		<center><input type="submit" value="Encore !"/></center>
	</form
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
