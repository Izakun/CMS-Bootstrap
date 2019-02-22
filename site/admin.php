<?php
require_once("templates/default/header.php");
require_once("src/controller/adminController.php");

if(empty($_SESSION["auth"]) || $_SESSION["auth"]["admin"] != 1){
	$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["default"]["notAuthorized"]);
	header("location: index.php");
}

if(!empty($_POST) && !empty($_POST["id"])){
	if($admin->removeUser($_POST["id"])){
		$default->setAlertMessage("success", "Succè", $default->getTrad()["alert"]["admin"]["removedOk"]);
	}else{
		$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["removedKo"]);
	}if($admin->downgradeUser($_POST["id"])){
        $default->setAlertMessage("success", "Succè", $default->getTrad()["alert"]["admin"]["downgradOk"]);
    }else{
        $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["downgradKo"]);
    }if($admin->upgradeUser($_POST["id"])){
        $default->setAlertMessage("success", "Succè", $default->getTrad()["alert"]["admin"]["upgradeOk"]);
    }else{
        $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["upgradeKo"]);
    }
}
?>

<div class="col-lg-4">
    <div class="card border-secondary">
        <div class="card-header">Gestion des comptes</div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Utilisateur</th>
                    <th>Supprimer</th>
                </tr>
                </thead>
                <tbody class="cours">
                <?php foreach ($admin->getAllUser() as $key => $value): ?>
                    <form action="admin.php" method="post">
                        <tr class='active'>
                            <td><input type="hidden" name="id" value="<?php echo $value["id"]; ?>"><?php echo $value["username"];?></td>
                            <td>
                                <button class='btn btn-danger btn' type="submit"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require_once("templates/default/footer.php");
?>