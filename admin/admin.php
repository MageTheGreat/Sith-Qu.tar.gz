<?php // ON FORCE LES GENS A SE CONNECTER ?>
<?php include("../inc/connected.php"); ?>
<?php // ON VERIFIE QU'ILS SONT BIEN ADMINISTRATEUR ?>
<?php include("check_admin.php"); ?>
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

<?php // ON VERIFIE LA PRESENCE D'UN MESSAGE DE RETOUR PROVENANT DE TRANCHER.PHP ?>
<?php
	if(isset($_GET['message']))
	{
// SI IL Y A UNE ERREUR, ON AFFICHE LE MESSAGE EN ROUGE
		if($_GET['error'] == "true")
		{ ?>
			<div class="messageError"><?php echo $_GET['message']; ?></div>
		<?php }
//SINON, ON L'AFFICHE EN VERT
		else
		{ ?>
			<div class="messageOk"><?php echo $_GET['message']; ?></div>
		<?php }
	}
?>

	<br/>
	
<?php // ON AFFICHE LA LISTE DES PERSONNES TRANCHEES AINSI QUE LES INFORMATIONS DE TRANCHAGE ?>
	<h1>LISTE DES PERSONNES TRANCHEES</h1>
<?php
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom, idTranchage FROM tranches WHERE date=?');
	$reponse->execute(array(date('y-m-d'))); ?>
		<table>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>id du tranchage</th>
			<th></th>
			<th></th>
		</tr>
	<?php while($donnees = $reponse->fetch())
	{ ?>
			<tr>
				<td><?php echo $donnees['nom']; ?></td>
				<td><?php echo $donnees['prenom']; ?></td>
				<td><?php echo $donnees['idTranchage']; ?></td>
				<td>
<?php // ON CREE LE FORMULAIRE DE DETRANCHAGE, AVEC LES INFOS NECESSAIRES A TRANCHER.PHP S'IL FAUT LES DETRANCHER ?>
					<form action="trancher.php" method="post">
						<input type="hidden" name="action" value="detrancher" />
						<input type="hidden" name="idTranchage" value=<?php echo $donnees['idTranchage']; ?> />
						<input type="hidden" name="nom" value=<?php echo $donnees['nom']; ?> />
						<input type="hidden" name="prenom" value=<?php echo $donnees['prenom']; ?> />
						
						<input type="submit" value="Détrancher" class="trancher" />
					</form>
				</td>
				<td class="last"></td>
			</tr>
	<?php } ?>
		</table>
	<?php $reponse->closeCursor();
?>

	<br/><br/><br/>

<?php // ON AFFICHE LA LISTE DES PERSONNES AYANT ETE DETRANCHEES AINSI QUE LES INFORMATIONS DE DETRANCHAGE ?>
	<h1>LISTE DES PERSONNES DETRANCHEES</h1>
<?php
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom, idTranchage FROM detranches WHERE date=?');
	$reponse->execute(array(date('y-m-d'))); ?>
		<table>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>id du tranchage</th>
			<th></th>
			<th></th>
		</tr>
	<?php while($donnees = $reponse->fetch())
	{ ?>
			<tr>
				<td><?php echo $donnees['nom']; ?></td>
				<td><?php echo $donnees['prenom']; ?></td>
				<td><?php echo $donnees['idTranchage']; ?></td>
				<td>
<?php // ON CREE LE FORMULAIRE DE TRANCHAGE, AVEC LES INFOS NECESSAIRES A TRANCHER.PHP S'IL FAUT LES RETRANCHER ?>
					<form action="trancher.php" method="post">
						<input type="hidden" name="action" value="trancher" />
						<input type="hidden" name="idTranchage" value=<?php echo $donnees['idTranchage']; ?> />
						<input type="hidden" name="nom" value=<?php echo $donnees['nom']; ?> />
						<input type="hidden" name="prenom" value=<?php echo $donnees['prenom']; ?> />
						
						<input type="submit" value="Retirer" class="trancher" />
					</form>
				</td>
				<td class="last"></td>
			</tr>
	<?php } ?>
		</table>
	<?php $reponse->closeCursor();
?>

	<br/><br/><br/>

<?php // ON AFFICHE LA LISTE DES PERSONNES SAUVEES PAR UNE ENIGME ?>
	<h1>LISTE DES PERSONNES SAUVEES</h1>
<?php
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom FROM sauves WHERE date=?');
	$reponse->execute(array(date('y-m-d'))); ?>
		<table>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th></th>
			<th></th>
		</tr>
	<?php while($donnees = $reponse->fetch())
	{ ?>
			<tr>
				<td><?php echo $donnees['nom']; ?></td>
				<td><?php echo $donnees['prenom']; ?></td>
				<td>
<?php // ON CREE LE FORMULAIRE DE RETIRAGE, AVEC LES INFOS NECESSAIRES A TRANCHER.PHP EN CAS D'ERREUR DE SAUVETAGE ?>
					<form action="trancher.php" method="post">
						<input type="hidden" name="action" value="retirer" />
						<input type="hidden" name="from" value="sauves" />
						<input type="hidden" name="nom" value=<?php echo $donnees['nom']; ?> />
						<input type="hidden" name="prenom" value=<?php echo $donnees['prenom']; ?> />
						
						<input type="submit" value="Retirer" class="trancher" />
					</form>
				</td>
				<td class="last"></td>
			</tr>
	<?php } ?>
		</table>
	<?php $reponse->closeCursor();
?>

	<br/><br/><br/>

<? // ON AFFICHE LA LISTE DES PERSONNES IMMUNISEES ?>
	<h1>LISTE DES PERSONNES IMMUNISEES</h1>
<?php
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom FROM immunises');
	$reponse->execute(NULL); ?>
		<table>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th></th>
			<th></th>
		</tr>
	<?php while($donnees = $reponse->fetch())
	{ ?>
			<tr>
				<td><?php echo $donnees['nom']; ?></td>
				<td><?php echo $donnees['prenom']; ?></td>
				<td>
<?php // ON CREE LE FORMULAIRE DE RETIRAGE, AVEC LES INFOS NECESSAIRES A TRANCHER.PHP EN CAS D'ERREUR D'IMMUNISATION ?>
					<form action="trancher.php" method="post">
						<input type="hidden" name="action" value="retirer" />
						<input type="hidden" name="from" value="immunises" />
						<input type="hidden" name="nom" value=<?php echo $donnees['nom']; ?> />
						<input type="hidden" name="prenom" value=<?php echo $donnees['prenom']; ?> />
						
						<input type="submit" value="Retirer" class="trancher" />
					</form>
				</td>
				<td class="last"></td>
			</tr>
	<?php } ?>
		</table>
	<?php $reponse->closeCursor();
?>

	<br/><br/><br/>

<?php // ON AFFICHE UN BOUTON RENVOYANT VERS LA PAGE D'ACTUALISATION DES TRANCHAGES ?>
	<form action="tranchage.php" method="post">
		<center><input type="submit" value="Actualiser le tranchage" class="refresh" /></center>
	</form>
	
	<br/>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("../inc/footer.php"); ?>
	
</body>
</html>
