<?php // CETTE PAGE TESTE LA PRESENCE DE L'UTILISATEUR CONNECTE DANS LA BASE DE DONNEES DES ADMINS ?>
<?php
	if(!isset($_SESSION['user']))
	{
		header('Location: ../index.php');
	}
	else
	{
		$admin = false;
		$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
		$reponse = $bdd->prepare('SELECT * FROM admins WHERE user=?');
		$reponse->execute(array($_SESSION['user']));
		while($donnees = $reponse->fetch())
		{
			$admin = true;
		}
		$reponse->closeCursor();
		if($admin)
		{
			
		}
		else
		{
			header('Location: ../index.php');
		}
	}
?>
