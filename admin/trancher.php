<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
	$message = "";
	$error = true;

	if(isset($_POST['action']) && $_POST['action'] == "detrancher")
	{
		if(!isset($_POST['idTranchage']))
		{
			$message .= "Erreur : id de tranchage inconnu.";
		}
		elseif(!isset($_POST['nom']) || !isset($_POST['prenom']))
		{
			$message .= "Erreur : nom ou prénom inconnu(s).";
		}
		else
		{
			$id = 0;
			
			$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
			$reponse = $bdd->prepare('SELECT id FROM tranches WHERE nom=? AND prenom=? AND date=? AND idTranchage=?');
			$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d'), $_POST['idTranchage']));
			while($donnees = $reponse->fetch())
			{
				$id = $donnees['id'];
			}
			$reponse->closeCursor();
			
			if($id == 0)
			{
				$message .= "Erreur : entrée non présente dans la base de données. Veuillez vérifier les informations.";
			}
			else
			{
				$reponse = $bdd->prepare('DELETE FROM tranches WHERE id=?');
				$reponse->execute(array($id));
				$reponse->closeCursor();
				
				$reponse = $bdd->prepare('INSERT INTO detranches (nom, prenom, date, idTranchage) VALUES (?, ?, ?, ?)');
				$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d'), $_POST['idTranchage']));
				$reponse->closeCursor();
				
				$message .= "Succès : ".$_POST['nom']." ".$_POST['prenom']." détranché.";
				$error = false;
			}
		}
	}
	elseif(isset($_POST['action']) && $_POST['action'] == "trancher")
	{
		if(!isset($_POST['idTranchage']))
		{
			$message .= "Erreur : id de tranchage inconnu.";
		}
		elseif(!isset($_POST['nom']) || !isset($_POST['prenom']))
		{
			$message .= "Erreur : nom ou prénom inconnu(s).";
		}
		else
		{
			$id = 0;
			
			$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
			$reponse = $bdd->prepare('SELECT id FROM detranches WHERE nom=? AND prenom=? AND date=? AND idTranchage=?');
			$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d'), $_POST['idTranchage']));
			while($donnees = $reponse->fetch())
			{
				$id = $donnees['id'];
			}
			$reponse->closeCursor();
			
			if($id == 0)
			{
				$message .= "Erreur : entrée non présente dans la base de données. Veuillez vérifier les informations.";
			}
			else
			{
				$reponse = $bdd->prepare('DELETE FROM detranches WHERE id=?');
				$reponse->execute(array($id));
				$reponse->closeCursor();
				
				$reponse = $bdd->prepare('INSERT INTO tranches (nom, prenom, date, idTranchage) VALUES (?, ?, ?, 0)');
				$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d')));
				$reponse->closeCursor();
				
				$message .= "Succès : ".$_POST['nom']." ".$_POST['prenom']." tranchage prêt. Actualiser pour valider.";
				$error = false;
			}
		}
	}
	elseif(isset($_POST['action']) && $_POST['action'] == "retirer")
	{
		if(!isset($_POST['from']))
		{
			$message .= "Erreur : base source inconnue.";
		}
		elseif(!isset($_POST['nom']) || !isset($_POST['prenom']))
		{
			$message .= "Erreur : nom ou prénom inconnu(s).";
		}
		else
		{
			$id = 0;
			
			$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
			$reponse = $bdd->prepare('SELECT id FROM '.$_POST['from'].' WHERE nom=? AND prenom=?');
			$reponse->execute(array($_POST['nom'], $_POST['prenom']));
			while($donnees = $reponse->fetch())
			{
				$id = $donnees['id'];
			}
			$reponse->closeCursor();
			
			if($id == 0)
			{
				$message .= "Erreur : personne non présente dans la base de données. Veuillez vérifier l'identité.";
			}
			else
			{
				$reponse = $bdd->prepare('DELETE FROM '.$_POST['from'].' WHERE id=?');
				$reponse->execute(array($id));
				$reponse->closeCursor();
				
				$message .= "Succès : ".$_POST['nom']." ".$_POST['prenom']." retiré de la base ".$_POST['from'].".";
				$error = false;
			}
		}
	}
	else
	{
		$message .= "Erreur : action non définie.";
	}
	
	if($error)
	{
		header("Location: admin.php?message=".$message."&error=true");
	}
	else
	{
		header("Location: admin.php?message=".$message."&error=false");
	}
?>