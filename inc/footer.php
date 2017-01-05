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
		<?php if(file_exists("index.php"))
		{ ?>
			<a href="index.php">Retour à la page d'accueil</a><br/>
		<?php }
		else
		{ ?>
			<a href="../index.php">Retour à la page d'accueil</a><br/>
		<?php } ?>
		<br/>
		<?php if(file_exists("commentaires.php"))
		{ ?>
			<a href="commentaires.php">Accéder aux commentaires</a><br/>
		<?php }
		else
		{ ?>
			<a href="../commentaires.php">Accéder aux commentaires</a><br/>
		<?php } ?>
		<?php if(file_exists("chatons.php"))
		{ ?>
			<a href="chatons.php">Voir des chatons</a><br/>
		<?php }
		else
		{ ?>
			<a href="../chatons.php">Voir des chatons</a><br/>
		<?php } ?>
	</div>
	
	<br/>
	
</header>
