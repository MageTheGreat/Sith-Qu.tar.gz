<?php // SI LA SESSION N'EST PAS ACTIVE, ON LA DEMARRE ?>
<?php // SI L'UTILISATEUR NE S'EST PAS ENCORE CONNECTE, ON DETRUIT LA SESSION ET ON LE RENVOIT A L'INDEX POUR QU'IL SE CONNECTE ?>
<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{
		session_start();
	}
	if(!isset($_SESSION['connected']))
	{
		session_destroy();
		header("Location: index.php");
	}
?>

<?php // ON PLACE ICI LE CODE HTML CORRESPONDANT A L'EN-TETE DE CHAQUE PAGE DU SITH ?>
<footer>
<?php // ON SAUTE UNE LIGNE, ET ON AFFICHE UNE BARRE BLANCHE PUIS UNE LIGNE VIDE ?>
	<br/>
	<hr/>
	<br/>

	<div class="footer">
<?php // ON AFFICHE LE PIED DE PAGE ?>
		Mentions légales
		<br/><br/>
		<a href="index.php">Retour à la page d'accueil</a><br/>
		<br/>
		<a href="commentaires.php">Ajouter un commentaire</a><br/>
		<a href="chatons.php">Voir des chatons</a><br/>
	</div>
	
	<br/>
	
</header>
