<?php // SI LA SESSION N'EST PAS ACTIVE, ON LA DEMARRE ?>
<?php // SI L'UTILISATEUR NE S'EST PAS ENCORE CONNECTE, ON LE REDIRIGE VERS LA PAGE DE CONNEXION ?>
<?php
	if(session_status() != PHP_SESSION_ACTIVE)
	{
		session_start();
	}
	if(isset($_SESSION['connected']) && !$_SESSION['connected'])
	{
		if(file_exists("connect.php"))
		{
			header("Location: connect.php");
		}
		else
		{
			header("Location: ../connect.php");
		}
	}
?>
