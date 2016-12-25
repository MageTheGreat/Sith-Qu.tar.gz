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
<header>
	<div class="header">
<?php // ON CHERCHE LE LOGO DU REZO A AFFICHER A GAUCHE ?>
		<div class="logoRezo1">
			<?php if(file_exists("img/Logo_Rezo_w.png"))
			{ ?>
				<a href="index.php"><img src="img/Logo_Liste_alpha.png" width="100%"></a>
			<?php }
			else
			{ ?>
				<a href="../index.php"><img src="../img/Logo_Liste_alpha.png" width="100%"></a>
			<?php } ?>
		</div>
<?php // ON AFFICHE LE MESSAGE D'INTRODUCTION ?>
		<div class="intro">
			<p>
				Voici le Sith Web de la liste du Rézo 2017 <span class="listName">Qu.tar.gz</span> !
			</p>
		</div>
<?php // ON AFFICHE LE GESTIONNAIRE DE CONNEXION, OU BIEN SON ID S'IL EST DEJA CONNECTE ?>
		<?php if(!isset($_SESSION['user']))
			{ ?>
				<div class="connect">
					<p>
						<form action="login.php" method="post">
							<span class="connectText">Connexion :</span>
							<br/><br/>
							<i>Pseudo :</i> <input type="text" name="user" placeholder="Entrez votre pseudo" />
							<br/>
							<i>Mot de passe :</i> <input type="password" name="pass" placeholder="Entrez votre mot de passe" />

							<br/><br/>
							
							<center><input type="submit" value="Connexion" /></center>
						</form>
					</p>
				</div>
			<?php }
			else
			{ ?>
				<div class="connect">
					<p>
						Vous êtes connecté en tant que <span class="nom"><?php echo($_SESSION['user']); ?></span>.
						<br/><br/>
						<?php if(isset($_SESSION['tranche']) && $_SESSION['tranche'])
						{ ?>
							<span class="tranche">Vous n'avez plus accès à Internet !</span>
						<?php }
						else
						{ ?>
							<span class="nonTranche">Vous avez accès à Internet !</span>
						<?php } ?>
						<br/><br/>
						<?php
						if(file_exists("logout.php"))
						{ ?>
							<a href="logout.php">Se déconnecter</a>
						<?php }
						else
						{ ?>
							<a href="../logout.php">Se déconnecter</a>
						<?php } ?>
					</p>
				</div>
			<?php } ?>
	</div>
</header>
