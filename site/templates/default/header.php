<?php
session_start();

require_once("src/controller/defaultController.php");
require_once("src/controller/userController.php");
require_once("src/controller/adminController.php");
$default = new defaultController();
$user = new userController();
$admin = new adminController();
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="asset/css/theme/sandstone.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<title>Login</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="#">Navbar</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Features</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Pricing</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">About</a>
			</li>
		</ul>
		<?php if(!empty($_SESSION["auth"])):?>
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $_SESSION["auth"]["username"];?>
			</button>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item text-right" href="#">Profil</a>
				<div class="dropdown-divider"></div>
                <?php if($_SESSION["auth"]["admin"] == 1):?>
				<a class="dropdown-item text-right" href="admin.php">Administration</a>
				<div class="dropdown-divider"></div>
                <?php endif; ?>
				<a class="dropdown-item text-right" href="index.php?disconnect=true">Déconnexion</a>
			</div>
		</div>
		<?php endif; ?>
	</div>
</nav>
<div class="container">
	<div class="row" style="padding-top: 20px">
<?php
$default->showAlertMessage($_SESSION);
?>