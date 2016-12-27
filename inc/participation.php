<?php // CETTE PAGE REGROUPE DEUX FONCTIONS GERANT LA PARTICIPATION DES UTILISATEURS AUX VOTES ET JEUX PAR JOUR ?>
<?php
// ON FORCE LES GENS A SE CONNECTER
include("connected.php");

// CETTE FONCTION RENVOIE TRUE SI L'UTILISATEUR A DEJA PARTICIPE A L'ACTIVITE $activite
function participe($activite)
{
// ON CHERCHE LES NOMS ET PRENOMS DE L'USER
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom FROM ids WHERE user=?');
	$reponse->execute(array($_SESSION['user']));
	$infos = array('prenom' => '', 'nom' => '');
	while($donnees = $reponse->fetch())
	{
		$infos['prenom'] = $donnees['prenom'];
		$infos['nom'] = $donnees['nom'];
	}
	$reponse->closeCursor();

	$reponse = $bdd->prepare('SELECT nbParticipations FROM jours WHERE date=?');
	$reponse->execute(array(date('y-m-d')));
	$nbParticipations = 0;
	while($donnees = $reponse->fetch())
	{
		$nbParticipations = $donnees['nbParticipations'];
	}
	$reponse->closeCursor();

// ON VERIFIE SI CES INFORMATIONS SONT DEJA PRESENTES DANS LA BASE DES PARTICIPATIONS POUR LE JOUR ET L'ACTIVITE DONNES
	$ret = false;
	$reponse = $bdd->prepare('SELECT COUNT(*) FROM participations WHERE nom=? AND prenom=? AND activite=? AND date=?');
	$reponse->execute(array($infos['nom'], $infos['prenom'], $activite, date('y-m-d')));
	while($donnees = $reponse->fetch())
	{		
		if($donnees['COUNT(*)'] >= $nbParticipations)
		{
			$ret = true;
		}
	}
	$reponse->closeCursor();

// ON RENVOIE LE RESULTAT DU TEST
	return $ret;
}

function checkSolution($test)
{
	$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
	$reponse = $bdd->prepare('SELECT solutions FROM jours WHERE date=?');
	$reponse->execute(array(date('y-m-d')));
	$solution = "";
	while($donnees = $reponse->fetch())
	{
		if(! is_null($donnees['solution']))
		{
			$solution = $donnees['solution'];
		}
	}
	$reponse->closeCursor();

	return $solution == $test;
}

// CETTE FONCTION MET A JOUR LA BASE DES PARTICIPATIONS EN AJOUTANT UN UTILISATEUR POUR UN JOUR ET UNE ACTIVITE DONNES
function addParticipation($activite)
{
// ON RECUPERE SES NOMS ET PRENOMS
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom FROM ids WHERE user=?');
	$reponse->execute(array($_SESSION['user']));
	$infos = array('prenom' => '', 'nom' => '');
	while($donnees = $reponse->fetch())
	{
		$infos['prenom'] = $donnees['prenom'];
		$infos['nom'] = $donnees['nom'];
	}
	$reponse->closeCursor();
	
// ON AJOUT UNE ENTREE DANS LA BASE AVEC LES INFORMATIONS CORRESPONDANTES
	$reponse = $bdd->prepare('INSERT INTO participations (nom, prenom, activite, date) VALUES (?, ?, ?, ?)');
	$reponse->execute(array($infos['nom'], $infos['prenom'], $activite, date('y-m-d H:i:s')));
	$reponse->closeCursor();
}
?>
