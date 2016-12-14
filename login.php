<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>

	<?php include("structure/header.php"); ?>
	
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$ok = false;
		$reponse = $bdd->prepare('SELECT pass FROM ids WHERE user=?');
		$reponse->execute(array($_POST['user']));
		while($donnees = $reponse->fetch())
		{
			if(strcmp(strtolower(md5($_POST['pass'])), strtolower($donnees['pass'])) == 0)
			{
				$ok = true;
			}
		}
		$reponse->closeCursor();
		
		if($ok == true)
		{ ?>
			<p>
				Vous êtes connecté !
				<br/>
				Bienvenu <span class="nom"><?php echo $_POST['user']; ?></span> !
				<br/><br/>
			</p>
		<?php }
		else
		{ ?>
			<p>
				La connexion a échoué.
				<br/>
				Veuillez vérifier vos pseudos et mots de passe.
				<br/><br/>
			</p>
		<?php }
	?>
	
	<?php include("structure/footer.php"); ?>
	
</body>
</html>
