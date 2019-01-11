<?php
require_once ("src/structure/header.php");
require_once ("src/controller/user.php");
$user = new user();
$opt = null;

if(!empty($_POST)){
	if(!empty($_POST["username"]) && !empty($_POST["password"])){
		$auth = $user->auth($_POST["username"], $_POST["password"]);
		if($auth){

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
		<div class="col-12" id="error">
			<?php echo $opt; ?>
		</div>
        <div class="col-4 offset-4">
            <form action="login.php" method="POST" class="form-group">
                <label class="col-form-label" for="inputDefault">Identifiant</label>
                <input type="text" class="form-control" placeholder="Identifiant" name="username" required>
                <label class="col-form-label" for="inputDefault">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                <input type="submit" class="btn btn-success" value="Connexion">
            </form>
            <a class="btn btn-link" href="reset.php">Mot de passe oublié ?</a>
        </div>
    </div>
</div>
<?php
require_once ("src/structure/footer.php")
?>