<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require __DIR__."/../sources/bootloader.php";

$page = __DIR__."/../pages/home.php";
if (isset($_GET['page']) and preg_match("/^[a-z\.-]*\.php$/", $_GET['page'])) {
	$page = __DIR__."/../pages/".$_GET['page'];
	if (!file_exists($page)) {
		$page = __DIR__."/../pages/404.php";
	}
}

if (!isset($_GET['method']) or $_GET['method'] != "json") {
	echo "
	<html>
		<head>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
			<script src=\"medias/js/calendar.js\" language=\"JavaScript\" type=\"text/javascript\"></script>
			<script src=\"medias/js/common.js\" language=\"JavaScript\" type=\"text/javascript\"></script>
			<script src=\"medias/js/jquery.js\" language=\"JavaScript\" type=\"text/javascript\"></script>
			<script src=\"medias/js/common.jquery.js\" language=\"JavaScript\" type=\"text/javascript\"></script>
			<script src=\"medias/js/spin.js\" language=\"JavaScript\" type=\"text/javascript\"></script>
			</head>
		<body>";
}

require $page;

if (!isset($_GET['method']) or $_GET['method'] != "json") {
	echo "
		</body>
	</html>";
}