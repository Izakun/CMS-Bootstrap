<?php
require_once("templates/default/header.php");
require_once("src/controller/adminController.php");

if(empty($_SESSION["auth"]) || $_SESSION["auth"]["admin"] != 1){
	$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["default"]["notAuthorized"]);
	header("location: index.php");
}

if(!empty($_POST) && !empty($_POST["id"])){
    if ($_POST["action"] === "remove"){
        if($admin->removeUser($_POST["id"])){
            $default->setAlertMessage("success", "Succès", $default->getTrad()["alert"]["admin"]["removedOk"]);
        }else{
            $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["removedKo"]);
        }
    } elseif ($_POST["action"] === "downgrade"){
        if($admin->downgradeUser($_POST["id"])){
            $default->setAlertMessage("success", "Succès", $default->getTrad()["alert"]["admin"]["downgradOk"]);
        }else{
            $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["downgradKo"]);
        }
    } elseif($_POST["action"] === "upgrade"){
        if($admin->upgradeUser($_POST["id"])){
            $default->setAlertMessage("success", "Succès", $default->getTrad()["alert"]["admin"]["upgradeOk"]);
        }else{
            $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["upgradeKo"]);
        }
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
                    <th>Admin</th>
                </tr>
                </thead>
                <tbody class="cours">
                <?php foreach ($admin->getAllUser() as $key => $value): ?>
                    <form action="admin.php" method="post">
                        <tr class='active'>
                            <td><input type="hidden" name="id" value="<?php echo $value["id"]; ?>">
                                <?php echo ($value["admin"] == 1 ? "<i class='fas fa-crown'></i> " : "") . $value["username"]  ?>
                            </td>
                            <td>
                                <button class='btn btn-danger btn' type="submit" name="action" value="remove"><i class="fas fa-trash"></i></button>
                            </td>
                            <td>
<<<<<<< HEAD
                                <button class='btn btn-primary btn' type="submit" name="action" value="upgrade"><i class="fas fa-user-cog"></i></button>
                            </td>
                            <td>
                                <button class='btn btn-primary btn' type="submit" name="action" value="downgrade"><i class="fas fa-user-cog"></i></button>
=======
                                <button class='btn btn-<?php echo ($value["admin"] == 1 ? "warning" : "info")?> btn' type="submit" name="action" value="<?php echo ($value["admin"] == 1 ? "downgrade" : "upgrade")?>">
                                    <?php echo ($value["admin"] == 1 ? "<i class='fas fa-user-minus'></i>" : "<i class='fas fa-user-plus'></i>")?>
                                </button>
>>>>>>> 717a154ba210703420cf6948a178cb5ad55c5d0a
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