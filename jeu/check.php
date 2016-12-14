<div>
	<?php
		$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
		$answer = '';
		$reponse = $bdd->prepare('SELECT reponse FROM enigmes WHERE id=?');
		$reponse->execute(array($_POST['id']));
		while($donnees = $reponse->fetch())
		{
		   $answer = $donnees['reponse'];
		}
		$reponse->closeCursor();
		
		if($_POST['reponse'] == $answer)
		{
			echo "Vous avez répondu correctement à l'énigme.";
			$reponse = $bdd->prepare('INSERT INTO request (nom, prenom, date) VALUES (?, ?, ?)');
			$reponse->execute(array($_POST['nom'], $_POST['prenom'], date('y-m-d')));
			$reponse->closeCursor();
		}
		else
		{
			echo "Vous n'avez pas obtenu la réponse à l'énigme.";
		}
	?>
</div>

<br/>

<p>
	Retour à la <a href="..\index.html">page d'accueil</a>.
</p>