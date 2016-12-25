<?php // SI LA SESSION N'EST PAS ACTIVE, ON LA DEMARRE ?>
<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{
		session_start();
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
	
<?php // CODE EFFECTIF DE CONNEXION ?>
	<?php
// SI ON N'A PAS RECU LE PSEUDO DE L'UTILISATEUR ON LE REDIRIGE VERS L'INDEX (ACCES NON AUTORISE A CETTE PAGE)
		if(!isset($_POST['user']))
		{
			header("Location: index.php");
		}
		
// ON SE CONNECTE A LA BSE DE DONNEES DES COMPTES
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
		$ok = false;
		$reponse = $bdd->prepare('SELECT pass FROM ids WHERE user=?');
		$reponse->execute(array($_POST['user']));
		while($donnees = $reponse->fetch())
		{
// SI LE MOT DE PASSE CORRESPOND A UNE DES ENTREES (NORMALEMENT UNIQUES), L'UTILISATEUR PEUT ETRE CONNECTE
			if(strcmp(strtolower(md5($_POST['pass'])), strtolower($donnees['pass'])) == 0)
			{
				$ok = true;
			}
		}
		$reponse->closeCursor();

// SI LA CONNEXION S'EST BIEN DEROULEE
		if($ok)
		{
// ON MET A JOUR LES VARIABLES DE SESSION
			$_SESSION['user'] = $_POST['user'];
			$_SESSION['connected'] = true;
			
// ON REGARDE S'IL EST TRANCHE
			$reponse = $bdd->prepare('SELECT nom, prenom FROM ids WHERE user=?');
			$reponse->execute(array($_SESSION['user']));
			$infos = array('prenom' => '', 'nom' => '');
			while($donnees = $reponse->fetch())
			{
				$infos['prenom'] = $donnees['prenom'];
				$infos['nom'] = $donnees['nom'];
			}
			$reponse->closeCursor();

			$_SESSION['tranche'] = false;
			$reponse = $bdd->prepare('SELECT * FROM tranchages WHERE nom=? AND prenom=? AND date=?');
			$reponse->execute(array($infos['nom'], $infos['prenom'], date('y-m-d')));
			while($donnees = $reponse->fetch())
			{
				$_SESSION['tranche'] = true;
			}
			$reponse->closeCursor();
			
// SI L'UTILISATEUR A ETE REDIRIGE DEPUIS UNE PAGE (MODULE DE CONNEXION DANS L'EN-TETE), ON LE REDIRIGE VERS SA PAGE D'ORIGINE
			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "login.php")
			{
				header("Location: ".$_SERVER['HTTP_REFERER']);
			}
// SINON, ON LE REDIRIGE VERS L'INDEX
			else
			{
				header("Location: index.php");
			}
		}
// SI LA CONNEXION N'A ETE VALIDEE
		else
		{ ?>
<?php // ON AFFICHE UN MESSAGE ?>
			<p>
				La connexion a échoué.
				<br/>
				Veuillez vérifier vos pseudos et mots de passe.
				<br/><br/>
				Retour à <a href="connect.php">la page de connexion</a>.
			</p>
		<?php }
	?>

<?php // INCLUSION DU FICHIER CONTENANT LE PIED DE PAGE ?>	
	<?php include("inc/footer.php"); ?>
	
</body>
</html>
