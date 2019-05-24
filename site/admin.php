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

<div class="col-lg-12">
    <div class="card border-secondary">
        <div class="card-header">Gestion des articles</div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-secondary">
                        <div class="card-header">Créer un article</div>
                        <div class="card-body">
                            <form>
                                <fieldset>
                                    <div class="form-group">
                                        <label for="articleTitle">Titre de l'article</label>
                                        <input type="text" class="form-control" id="articleTitle">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleTextarea">Example textarea</label>
                                        <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" checked="">
                                                Afficher l'article
                                            </label>
                                        </div>
                                        <div class="form-check disabled">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" value="" disabled="">
                                                Autoriser les commentaires
                                            </label>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-success">Créer</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-secondary">
                        <div class="card-header">Gestion des articles</div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row row-space">
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
                                <button class='btn btn-<?php echo ($value["admin"] == 1 ? "warning" : "info")?> btn' type="submit" name="action" value="<?php echo ($value["admin"] == 1 ? "downgrade" : "upgrade")?>">
                                    <?php echo ($value["admin"] == 1 ? "<i class='fas fa-user-minus'></i>" : "<i class='fas fa-user-plus'></i>")?>
                                </button>
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