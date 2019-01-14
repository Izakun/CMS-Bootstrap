<?php
require_once("src/structure/header.php");
require_once("src/controller/user.php");
$user = new user();
$opt = null;

if(!empty($_POST)){
	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		$auth = $user->auth($_POST["username"], $_POST["password"]);
		if($auth[0]){
			$_SESSION["auth"] = array("id"=>$auth[1]["id"], "username"=>$auth[1]["username"], "email"=>$auth[1]["email"]);
//			$_SESSION["auth"] = array($auth[1]["id"], $auth[1]["username"], $auth[1]["email"]);
			header("location: index.php");
		}else{
			$opt = "<div class=\"alert alert-dismissible alert-warning\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<h4 class=\"alert-heading\">Erreur</h4>
						<p class=\"mb-0\">Votre mot de passe et votre nom d'utilisateur ne correspondent pas.</p>
					</div>";
		}
	}else{
		$opt ="	<div class=\"alert alert-dismissible alert-warning\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
					<h4 class=\"alert-heading\">Erreur</h4>
					<p class=\"mb-0\">Veuillez rensegner votre identifiant et votre mot de passe.</p>
				</div>";
	}
}

?>
<div class="container">
    <div class="row">
		<div class="col-12" id="message">
			<?php
			if($opt !== "")
				echo $opt;
			if(!empty($_SESSION["flash"])){
				echo "	<div class='alert alert-dismissible alert-" . $_SESSION["flash"][0] . "'>
							<button type='button' class='close' data-dismiss='alert'>&times;</button>
							<h4 class='alert-heading'>" . $_SESSION["flash"][1] . "</h4>
							<p class='mb-0'>" . $_SESSION["flash"][2] . "</p>
						</div>";
				unset($_SESSION["flash"]);
			}
			?>
		</div>
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
    </div>
</div>
<?php
require_once ("src/structure/footer.php")
?>