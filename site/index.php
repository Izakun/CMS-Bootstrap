<?php
require_once("src/structure/header.php");

//$default->checkConnected($_SESSION);
if(empty($_SESSION["auth"])){
	$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["default"]["notConnected"]);
	header("location: login.php");
}

if(!empty($_GET["disconnect"])){
	unset($_SESSION["auth"]);
	$default->setAlertMessage("success", "Succès", $default->getTrad()["alert"]["default"]["disconnect"]);
	header("location: login.php");
}
?>
<div class="col-12">
	<p>GG tu es connecté <?php echo $_SESSION["auth"]["username"];?></p>
</div>
<?php
require_once ("src/structure/footer.php")
?>