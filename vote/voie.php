<?php include("../inc/connected.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="fr" />
	<meta name="Supélec Rézo" content="Sith Web de la liste Supélec Rézo 2016" />
	
	<link rel="stylesheet" type="text/css" href="../style.css">
	
	<title>Sith Web Qu.tar.gz</title>
</head>

<body>
	<?php include("../inc/header.php"); ?>
	
	<br/><br/>
	
	<div class="form">
		<form action="res_voie.php" method="post">
			<p>
				Veuillez indiquer la voie à laquelle couper Internet :
				<select name="voie">
					<option value="PAG1">PAG1</option>
					<option value="PAG2">PAG2</option>
					<option value="PAG3">PAG3</option>
					<option value="DAG1">DAG1</option>
					<option value="DAG2">DAG2</option>
					<option value="DAG3">DAG3</option>
				</select>
				
				<center><input type="submit" value="Voter !" /></center>
			</p>
		</form>
	</div>
	
	<br/>
	
	<hr/>
	
	<div class="footer">
		
	</div>
	
</body>
</html>
