<?php
require_once("templates/default/header.php");
require_once("src/controller/adminController.php");
require_once("src/controller/articleController.php");

if(empty($_SESSION["auth"]) || $_SESSION["auth"]["admin"] != 1){
	$default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["default"]["notAuthorized"]);
	header("location: index.php");
}

if(!empty($_POST)){
    if(!empty($_POST["id"])){
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
        } elseif($_POST["action"] === "upgrade") {
            if ($admin->upgradeUser($_POST["id"])) {
                $default->setAlertMessage("success", "Succès", $default->getTrad()["alert"]["admin"]["upgradeOk"]);
            } else {
                $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["upgradeKo"]);
            }
        }
    }

    if(!empty($_POST["articleTitle"]) && !empty($_POST["articleSubject"])){
        if ($_POST["action"] === "create"){
            $create = $article->create(array("title"=>$_POST["articleTitle"], "subject"=>$_POST["articleSubject"], "show"=>$_POST["articleShow"], "comment"=>$_POST["articleComment"], "author"=>$user->getId()));
        }
    } else {
        $default->setAlertMessage("warning", "Erreur", $default->getTrad()["alert"]["admin"]["article"]["completAll"]);
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
                            <form action="admin.php" method="post">
                                <div class="form-group">
                                    <label for="articleTitle">Titre de l'article</label>
                                    <input type="text" class="form-control" id="articleTitle" name="articleTitle" required>
                                </div>
                                <div class="form-group">
                                    <label for="articleSubject">Sujet</label>
                                    <textarea class="form-control" id="articleSubject" name="articleSubject" rows="5" required></textarea>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="articleShow" checked="1">
                                        Afficher l'article
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="articleComment" checked="0">
                                        Autoriser les commentaires
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-success" name="action" value="create">Créer</button>
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