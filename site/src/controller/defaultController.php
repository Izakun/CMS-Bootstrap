<?php

class defaultController
{
	public function getTrad(){
		$translate = file_get_contents('translate/fr.json');
		return json_decode($translate, true);
	}

	// a modifier pour l'appeler que dans le header.php pour chech l'autorisation des pages si connecté ou non
	public function checkConnected($session){
		if(!empty($session["auth"])){
			$this->setAlertMessage("warning", "Erreur", $this->getTrad()["alert"]["default"]["alreadyConnect"]);
			header("location: index.php");
		}else{
			$this->setAlertMessage("warning", "Erreur", $this->getTrad()["alert"]["default"]["notAuthorized"]);
			header("location: login.php");
		}
	}

	public function setAlertMessage($style, $title, $content){
		$_SESSION["flash"] = array($style, $title, $content);
	}

	public function showAlertMessage($message){
		if(!empty($message["flash"])){
			echo "	<div class=\"col-12\" id=\"alert-message\">
						<div class=\"alert alert-dismissible alert-" . $message["flash"][0] . "\">
							<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
							<h4 class=\"alert-heading\">" . $message["flash"][1] . "</h4>
							<p class=\"mb-0\">" . $message["flash"][2] . "</p>
						</div>
					</div>";
			unset($_SESSION["flash"]);
		}
	}
}