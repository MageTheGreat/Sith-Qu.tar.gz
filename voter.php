<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Sup�lec R�zo" content="Sith Web de la liste Sup�lec R�zo 2016" />
	
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
	<div class="header">
		<img class="logoRezo1" src="img/Logo_Rezo_w.png" width=15%/>
		<div class="intro">
			<p>
				Voici le Sith Web de la liste du R�zo 2016 <span class="listName">Qu.tar.gz</span> !
			</p>
		</div>
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
	</div>
	
	<br/><br/>
	
	<?php header("Location: vote/".$_POST['link']); ?>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		Mentions l�gales
	</div>
	
	<br/>
	
</body>
</html>
