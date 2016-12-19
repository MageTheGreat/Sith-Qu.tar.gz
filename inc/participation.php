<?php
include("connected.php");

function participe($activite)
{
	$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
	$reponse = $bdd->prepare('SELECT nom, prenom FROM ids WHERE user=?');
	$reponse->execute(array($_SESSION['user']));
	$infos = array('prenom' => '', 'nom' => '');
	while($donnees = $reponse->fetch())
	{
		$infos['prenom'] = $donnees['prenom'];
		$infos['nom'] = $donnees['nom'];
	}
	$reponse->closeCursor();

	$ret = false;
	$reponse = $bdd->prepare('SELECT * FROM participations WHERE nom=? AND prenom=? AND activite=? AND date=?');
	$reponse->execute(array($infos['nom'], $infos['prenom'], $activite, date('y-m-d')));
	while($donnees = $reponse->fetch())
	{		
		if($donnees['nom'] != "")
		{
			$ret = true;
		}
	}
	$reponse->closeCursor();

	return $ret;
}

function addParticipation($activite)
{
	$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
	$reponse = $bdd->prepare('SELECT nom, prenom FROM ids WHERE user=?');
	$reponse->execute(array($_SESSION['user']));
	$infos = array('prenom' => '', 'nom' => '');
	while($donnees = $reponse->fetch())
	{
		$infos['prenom'] = $donnees['prenom'];
		$infos['nom'] = $donnees['nom'];
	}
	$reponse->closeCursor();
	
	$reponse = $bdd->prepare('INSERT INTO participations (nom, prenom, activite, date) VALUES (?, ?, ?, ?)');
	$reponse->execute(array($infos['nom'], $infos['prenom'], $activite, date('y-m-d')));
	$reponse->closeCursor();
}
?>
