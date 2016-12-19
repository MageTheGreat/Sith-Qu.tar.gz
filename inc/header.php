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

<header>
	<div class="header">
		<?php if(file_exists("img/Logo_Rezo_w.png"))
		{ ?>
			<img class="logoRezo1" src="img/Logo_Rezo_w.png" width=15%/>
		<?php }
		else
		{ ?>
			<img class="logoRezo1" src="../img/Logo_Rezo_w.png" width=15%/>
		<?php } ?>
		<div class="intro">
			<p>
				Voici le Sith Web de la liste du Rézo 2016 <span class="listName">Qu.tar.gz</span> !
			</p>
		</div>
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
