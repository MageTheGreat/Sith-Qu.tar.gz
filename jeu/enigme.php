<?php
	$bdd = new PDO('mysql:host=localhost;dbname=sith-qutargz;charset=utf8',	'root',	'');
	$max = 0;
	$reponse = $bdd->query('SELECT MAX(id) FROM enigmes');
	while($donnees = $reponse->fetch())
	{
	   $max = $donnees['MAX(id)'];
	}
	$reponse->closeCursor();
	$id = rand(1, $max);
	
	$question = '';
	$reponse = $bdd->prepare('SELECT question FROM enigmes WHERE id=?');
	$reponse->execute(array($id));
	while($donnees = $reponse->fetch())
	{
	   $question = $donnees['question'];
	}
	$reponse->closeCursor();
?>

<div class="form">
	<form action="check.php" method="post">
		<p>
			<input type="hidden" name="id" value=<?php echo $id; ?> />
			
			La question est :<br/>
			<center><?php echo $question; ?></center><br/>
			Entrez votre réponse :
			<input type="text" name="reponse" />
			
			<br/><br/>
			
			Veuillez entrer vos prénoms et noms :
			<input type="text" name="prenom" />
			<input type="text" name="nom" />
			
			<br/><br/>				
				
			<center><input type="submit" value="Valider" /></center>
		</p>
	</form>
</div>