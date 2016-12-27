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
	
	<br/><br/>
	
<?php // FORMULAIRE DE CHOIX DE L'ETAGE ?>
	<div class="form">
		<form action="res_etage.php" method="post">
			<p>
				Veuillez indiquer l'étage auqel couper Internet :
				<select name="etage">
					<option value="1.A1">1.A1</option>
					<option value="1.A2">1.A2</option>
					<option value="1.A3">1.A3</option>
					<option value="1.A4">1.A4</option>
					<option value="1.B1">1.B1</option>
					<option value="1.B2">1.B2</option>
					<option value="1.B3">1.B3</option>
					<option value="1.B4">1.B4</option>
					<option value="1.C1">1.C1</option>
					<option value="1.C2">1.C2</option>
					<option value="1.C3">1.C3</option>
					<option value="1.C4">1.C4</option>
					<option value="1.D1">1.D1</option>
					<option value="1.D2">1.D2</option>
					<option value="1.D3">1.D3</option>
					<option value="1.D4">1.D4</option>
					<option value="2.A1">2.A1</option>
					<option value="2.A2">2.A2</option>
					<option value="2.A3">2.A3</option>
					<option value="2.A4">2.A4</option>
					<option value="2.B1">2.B1</option>
					<option value="2.B2">2.B2</option>
					<option value="2.B3">2.B3</option>
					<option value="2.B4">2.B4</option>
					<option value="2.C1">2.C1</option>
					<option value="2.C2">2.C2</option>
					<option value="2.C3">2.C3</option>
					<option value="2.C4">2.C4</option>
					<option value="2.D1">2.D1</option>
					<option value="2.D2">2.D2</option>
					<option value="2.D3">2.D3</option>
					<option value="2.D4">2.D4</option>
				</select>
				
				<center><input type="submit" value="Voter !" /></center>
			</p>
		</form>
	</div>
	
<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("../inc/footer.php"); ?>
	
</body>
</html>
