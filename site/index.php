<?php
require_once("src/structure/header.php");
require_once("src/controller/user.php");
$user = new user();

if(empty($_SESSION["auth"])){
	$_SESSION["flash"] = array("warning", "Erreur", "Vous devez etre connecter pour avoir acces à cette partie du site.");
	header("location: login.php");
}

?>
<div class="container">
    <div class="row">
		<div class="col-12">
			<p>GG tu es connecté <?php echo $_SESSION["auth"]["username"];?></p>
		</div>
    </div>
</div>
<?php
require_once ("src/structure/footer.php")
?>