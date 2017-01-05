<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
function getUserId($nom, $prenom)
{
	$connectable_id = 0;
	
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT connectable_id FROM ids WHERE nom=? AND prenom=?');
	$reponse->execute(array($nom, $prenom));
	while($donnees = $reponse->fetch())
	{
		$connectable_id = $donnees['connectable_id'];
	}
	
	return $connectable_id;
}

function trancher($connectable_id)
{
	$ret = array('res' => false, 'id' => 0);
	
	/************************************/
	$url = 'https://192.168.92.18/disconnection/'.$connectable_id.'/create.xml?disconnection[connectable_id]='.$connectable_id.'&type=DisconnectionMisc&disconnection[object]=CampagneBDE&disconnection[end(1i)]=2017&disconnection[end(2i)]=1&disconnection[end(3i)]='.(date('d')+1);
	$context = stream_context_create(array('ssl' => array('verify_peer' => FALSE, 'verify_peer_name' => FALSE)));
	$file = file_get_contents($url, NULL, $context);
	if($file != '')
	{
		$tranchage = simplexml_load_string($file);
		
		$ret['res'] = $tranchage->resultat;
		$ret['id'] = $tranchage->disconnectionid;
	}
	else
	{
		$ret = NULL;
	}
	/************************************/
	
	//return array('res' => true, 'id' => 12345);
	return $ret;
}

function detrancher($tranchage_id)
{
	$res = false;
	
	/************************************/
	$url = 'https://192.168.92.18/disconnection/finish/'.$tranchage_id.'.xml';
	$context = stream_context_create(array('ssl' => array('verify_peer' => FALSE, 'verify_peer_name' => FALSE)));
	$file = file_get_contents($url, NULL, $context);
	if($file != '')
	{
		$tranchage = simplexml_load_string($file);
		
		$res = $tranchage->resultat;
	}
	/************************************/
	
	//return true;
	return $res;
}

	$message = "";
	$error = false;
	
	$id = 0;
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom, id FROM tranches WHERE date=? AND idTranchage=0');
	$reponse->execute(array(date('y-m-d')));
	while($donnees = $reponse->fetch())
	{
		$id = getUserId($donnees['nom'], $donnees['prenom']);
		if($id == 0)
		{
			$message .= $donnees['nom']." ".$donnees['prenom']." inconnu dans la base de données.";
			$error = true;
		}
		else
		{
			$ret = trancher($id);
			if($ret['res'] == false)
			{
				$message .= "Erreur de tranchage pour : ".$donnees['nom']." ".$donnees['prenom'].".";
				$error = true;
			}
			else
			{
				$update = $bdd->prepare('UPDATE tranches SET idTranchage='.$ret['id'].' WHERE id=?');
				$update->execute(array($donnees['id']));
				$update->closeCursor();
			}
		}
		
		$id = 0;
	}
	$reponse->closeCursor();
	
	
	$bdd = new PDO('mysql:host=localhost;dbname=qutargz;charset=utf8', 'qutargz', 'd1PNeCPnpTGn');
	$reponse = $bdd->prepare('SELECT nom, prenom, id, idTranchage FROM detranches WHERE date=?');
	$reponse->execute(array(date('y-m-d')));
	while($donnees = $reponse->fetch())
	{
		if($donnees['idTranchage'] != 0)
		{
			$res = detrancher($donnees['idTranchage']);
			if(!$res)
			{
				$message .= "Erreur de détranchage pour : ".$donnees['nom']." ".$donnees['prenom'].".";
				$error = true;
			}
			else
			{
				$update = $bdd->prepare('UPDATE detranches SET idTranchage=0 WHERE id=?');
				$update->execute(array($donnees['id']));
				$update->closeCursor();
			}
		}
	}
	$reponse->closeCursor();
	
	if($error)
	{
		header("Location: admin.php?message=".$message."&error=true");
	}
	else
	{
		header("Location: admin.php?message=Tout est à jour.&error=false");
	}
?>
