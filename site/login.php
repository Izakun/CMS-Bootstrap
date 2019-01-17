<?php
require_once("templates/default/header.php");

//$default->checkConnected($_SESSION);
if(!empty($_SESSION["auth"])){
	$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["default"]["alreadyConnect"]);
	header("location: index.php");
}

if(!empty($_POST)){
	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		$auth = $user->login(array("username"=>$_POST["username"], "password"=>$_POST["password"]));
		if($auth["ok"]){
			$_SESSION["auth"] = $auth["userController"];
			header("location: index.php");
		}else{
			$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["login"]["badId"]);
		}
	}else{
		$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["login"]["completAll"]);
	}
}

?>
<div class="col-4 offset-4">
	<form action="login.php" method="POST" class="form-group">
		<label class="col-form-label" for="inputDefault">Identifiant</label>
		<input type="text" class="form-control" placeholder="Identifiant" name="username" required>
		<label class="col-form-label" for="inputDefault">Mot de passe</label>
		<input type="password" class="form-control" placeholder="Mot de passe" name="password" required></br>
		<a href="register.php" type="button" class="btn btn-secondary">Inscription</a>
		<input type="submit" class="btn btn-primary float-right" value="Connexion">
	</form>
	<a class="btn btn-link" href="reset.php">Mot de passe oublié ?</a>
</div>
<?php
require_once("templates/default/footer.php");
?>