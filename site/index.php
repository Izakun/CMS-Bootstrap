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

			}else{
				$opt = "<div class=\"alert alert-dismissible alert-warning\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<h4 class=\"alert-heading\">Erreur</h4>
						<p class=\"mb-0\">Votre mot de passe et votre nom d'utilisateur ne correspondent pas.</p>
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
		<div class="col-12">
			<p>GG tu es connecté</p>
		</div>
    </div>
</div>
<?php
require_once ("src/structure/footer.php")
?>