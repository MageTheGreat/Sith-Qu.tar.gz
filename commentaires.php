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
	
	<br/>
	
	
<?php // ON AFFICHE LE FORMULAIRE D'AJOUT DE COMMENTAIRE ?>
	<div class="addCommentaire">
		AJOUTER UN <span class="comm">COMMENTAIRE</span>
		<br/><br/>
		<form action="commentaires.php#end" method="post">
			<input type="hidden" name="user" value=<?php echo $_SESSION['user']; ?> />
			
			<!-- <input type="text" name="comm" placeholder="Votre commentaire" /> -->
			<textarea rows=5 cols=50 name="comm" placeholder="Votre commentaire"></textarea>
			<br/>
			<input type="submit" value="Envoyer un commentaire" /><br/>
		</form>
	</div>
	<br/><br/><br/>
	
<?php // S'IL LE FAUT, ON AJOUTE LES COMMENTAIRES OU LES REPONSES ?>
	<?php
		if(isset($_POST['comm']) && $_POST['comm'] != '')
		{
			$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
			$reponse = $bdd->prepare('INSERT INTO commentaires (texte, reponse, user, heure, date) VALUES (?, 0, ?, ?, ?)');
			$reponse->execute(array(htmlspecialchars($_POST['comm']), $_POST['user'], date('H:i:s'), date('y-m-d')));
			$reponse->closeCursor();
		}
		if(isset($_POST['reponse']) && $_POST['reponse'] != '')
		{
			$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
			$reponse = $bdd->prepare('INSERT INTO commentaires (texte, reponse, user, heure, date) VALUES (?, ?, ?, ?, ?)');
			$reponse->execute(array(htmlspecialchars($_POST['reponse']), $_POST['id'], $_POST['user'], date('H:i:s'), date('y-m-d')));
			$reponse->closeCursor();
		}
// ON CHERCHE, SI ELLE EXISTE, L'ANCRE VERS LAQUELLE "POINTE" L'URL
	$anchor = 0;
	$highligh = false;
	if(isset($_POST['anchor']))
	{
		$anchor = $_POST['anchor'];
	}
	?>

<?php // ON AFFICHE TOUS LES MESSAGES ET COMMENTAIRES ?>
<?php
// ON CHERCHE LES COMMENTAIRES DU JOUR, IDENTIFIES PAR UN ATTRIBUT REPONSE A 0
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT id, texte, user, heure FROM commentaires WHERE reponse=0 AND date=?');
	$reponse->execute(array(date('y-m-d')));
	while($ids = $reponse->fetch())
	{ ?>
<?php // ON AJOUTE UNE ANCRE PAR COMMENTAIRE ?>
		<a id=<?php echo $ids['id']; ?>></a>
<?php // ON LES AFFICHE ?>
		<div class="commentaire">
			<span class="nom"><?php echo $ids['user']; ?></span> <span class="ecrit">a écrit à</span> <span class="time"><?php echo $ids['heure']; ?></span> :
			<br/>
			<?php echo nl2br($ids['texte']); ?>
			<hr/><br/>
	<?php
// ON CHERCHE TOUTES LES REPONSES ASSOCIEES
			if($anchor == $ids['id'])
			{
				$highligh = true;
			}
			$last = $ids['id'];
			$reponse2 = $bdd->prepare('SELECT id, texte, user, heure FROM commentaires WHERE reponse=? AND date=?');
			$reponse2->execute(array($ids['id'], date('y-m-d')));
			while($texts = $reponse2->fetch())
			{
				$last = $texts['id']; ?>
<?php // ON AJOUTE UNE ANCRE PAR REPONSE ?>
				<a id=<?php echo $texts['id']; ?>></a>
<?php // ON LES AFFICHE ?>
				<?php if($highligh)
				{ 
					$highligh = false;	?>
					<div class="highlighReponse">
				<?php }
				else
				{ ?>
					<div class="reponse">
				<?php } ?>
					<span class="nom"><?php echo $texts['user']; ?></span> <span class="repondu">a répondu à</span> <span class="time"><?php echo $texts['heure']; ?></span> :
					<br/>
					<?php echo nl2br($texts['texte']); ?>
				</div>
				<br/>
				<?php
				if($anchor == $last)
				{
					$highligh = true;
				}
			}
			$reponse2->closeCursor();
		?>
<?php // ON AFFICHE LE FORMULAIRE D'AJOUT DE REPONSE A LA FIN DE TOUTES LES REPONSES ?>
			<div class="addReponse">
				<form action=<?php echo 'commentaires.php#'.$last; ?> method="post">
					<input type="hidden" name="id" value=<?php echo $ids['id']; ?> />
					<input type="hidden" name="user" value=<?php echo $_SESSION['user']; ?> />
					<input type="hidden" name="anchor" value=<?php echo $last; ?> />
					
					<!-- <input type="text" name="reponse" placeholder="Votre réponse" /> -->
					<br/>
					<textarea rows=5 cols=50 name="reponse" placeholder="Votre réponse"></textarea>
					<br/>
					<input type="submit" value="Envoyer une réponse" />
				</form>
			</div>
		</div>
		<br/><br/><br/>
	<?php }
	$reponse->closeCursor();
?>

<?php // AJOUT DE L'ANCRE FINALE ?>
<a id="end"></a>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>

