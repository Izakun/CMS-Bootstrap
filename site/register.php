<?php
require_once("templates/default/header.php");

//$default->checkConnected($_SESSION);
if(!empty($_SESSION["auth"])){
	$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["default"]["alreadyConnect"]);
	header("location: index.php");
}

if(!empty($_POST)){
	if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password_conf"]) && !empty($_POST["email"])){
		if ($_POST["password"] === $_POST["password_conf"]){
			if($user->createUser(array("username"=>$_POST["username"], "password"=>$_POST["password"], "email"=>$_POST["email"]))){
				$default->setAlertMessage("success", "Succès", $default->getTrad()["alert"]["register"]["valide"]);
				header("location: login.php");
			}else{
				$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["register"]["alreadyUsed"]);
			}
		}else{
			$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["register"]["badPassword"]);
		}
	}else{
		$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["register"]["completAll"]);
	}
}

?>
<div class="col-4 offset-4">
	<form action="register.php" method="POST" class="form-group">
		<label class="col-form-label" for="inputDefault">Identifiant</label>
		<input type="text" class="form-control" placeholder="Identifiant" name="username" required>
		<label class="col-form-label" for="inputDefault">Mot de passe</label>
		<input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
		<label class="col-form-label" for="inputDefault">Confirmation du mot de passe</label>
		<input type="password" class="form-control" placeholder="Mot de passe" name="password_conf" required>
		<label class="col-form-label" for="inputDefault">Email</label>
		<input type="email" class="form-control" placeholder="dupond.pierre@gmail.com" name="email" required></br>
        <input type="button" class="btn btn-secondary" value="Connexion" onclick="document.location.href='login.php'">
		<input type="submit" class="btn btn-primary float-right" value="Inscription">
	</form>
</div>
<?php
require_once("templates/default/footer.php")
?>