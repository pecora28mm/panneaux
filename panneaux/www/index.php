<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

require __DIR__."/../sources/bootloader.php";

$page = __DIR__."/../pages/home.php";
if (isset($_GET['page']) and preg_match("/^[a-z]*\.php$/", $_GET['page'])) {
	$page = __DIR__."/../pages/".$_GET['page'];
	if (!file_exists($page)) {
		$page = __DIR__."/../pages/home.php";
	}
}

echo "<html><body>";

require $page;

echo "</body></html>";
