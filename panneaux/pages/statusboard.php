<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$statusboard = new Statusboard();
if (isset($_REQUEST['pattern'])) {
	$statusboard->pattern = $_REQUEST['pattern'];
}
if (isset($_REQUEST['etats_id'])) {
	$statusboard->etats_id = (int)$_REQUEST['etats_id'];
}
if (isset($_REQUEST['actions_id'])) {
	$statusboard->actions_id = (int)$_REQUEST['actions_id'];
}
echo "<h2>".__("The status board")."</h2>";
echo $statusboard->filter();
echo "<br /><br />";
echo $statusboard->display();
