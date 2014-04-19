<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

class Template {
	function header() {
		return '
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Les panneaux de Nouvelle Donne</title>
		<link href="medias/css/bootstrap.min.css" rel="stylesheet">
		<link href="medias/css/styles.css" rel="stylesheet">
		</head>
 	<body>';
	}
	
	function navigation() {
		return '
<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Panneaux de campagne ND</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<form class="navbar-form navbar-left" role="search" action="index.php?page=bureaux.php" method="post">
				<div class="form-group">
					<input name="pattern" type="text" class="form-control" placeholder="Code postal ou ville">
				</div>
				<button type="submit" class="btn btn-default">Envoyer</button>
			</form>
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Actions <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="index.php?page=passage.php">Ajouter un passage</a></li>
						<li><a href="index.php?page=statusboard.php">Vérifier le tableau de bord</a></li>
						<li><a href="index.php?page=passages.php">Lister les derniers passages</a></li>
						<li><a href="index.php?page=bureaux.php">Lister les bureaux</a></li>
						<li class="divider"></li>
						<li><a href="index.php?page=apropos.php">A propos</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>';
	}

	function content_top() {
		return '<div class="container-max"><div class="container-fluid">';
	}

	function content_bottom() {
		return '</div></div>';
	}

	function footer() {
		return '
		<script src="medias/js/jquery.js"></script>
		<script src="medias/js/calendar.js"></script>
		<script src="medias/js/common.jquery.js"></script>
		<script src="medias/js/common.js"></script>
		<script src="medias/js/spin.js"></script>
		<script src="medias/js/bootstrap.min.js"></script>
	</body>
</html>';
	}
}
