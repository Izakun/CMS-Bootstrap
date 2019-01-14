<?php
require_once("src/structure/header.php");
require_once("src/controller/user.php");
$user = new user();
$opt = null;

if(!empty($_POST)){
	if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password_conf"]) && !empty($_POST["email"])){
		if ($_POST["password"] === $_POST["password_conf"]){
			$register = $user->createUser($_POST["username"], $_POST["password"], $_POST["email"]);
			if($register){
				$_SESSION["flash"] = array("success", "Succès", "Votre inscription est valide, veuillez vous connecter pour avoir acces au site.");
				header("location: login.php");
			}else{
				$opt = "<div class=\"alert alert-dismissible alert-warning\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<h4 class=\"alert-heading\">Erreur</h4>
						<p class=\"mb-0\">Le nom d'utilisateur ou l'adresse mail est déjà utilisé.</p>
					</div>";
			}
		}else{
			$opt = "<div class=\"alert alert-dismissible alert-warning\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<h4 class=\"alert-heading\">Erreur</h4>
						<p class=\"mb-0\">Vos mot de passes ne correspondent pas.</p>
					</div>";
		}
	}else{
		$opt ="	<div class=\"alert alert-dismissible alert-warning\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
					<h4 class=\"alert-heading\">Erreur</h4>
					<p class=\"mb-0\">Veuillez rensegner tous les champs.</p>
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
            <form action="register.php" method="POST" class="form-group">
                <label class="col-form-label" for="inputDefault">Identifiant</label>
                <input type="text" class="form-control" placeholder="Identifiant" name="username" required>
                <label class="col-form-label" for="inputDefault">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                <label class="col-form-label" for="inputDefault">Confirmation du mot de passe</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="password_conf" required>
                <label class="col-form-label" for="inputDefault">Email</label>
                <input type="email" class="form-control" placeholder="dupond.pierre@gmail.com" name="email" required></br>
				<a href="login.php" type="button" class="btn btn-secondary">Connexion</a>
				<input type="submit" class="btn btn-primary float-right" value="Inscription">
			</form>
        </div>
    </div>
</div>
<?php
require_once ("src/structure/footer.php")
?>