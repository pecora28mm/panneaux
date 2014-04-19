<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$bureaux = new Bureaux();
if (isset($_REQUEST['pattern'])) {
	$pattern = strip_tags($_REQUEST['pattern']);
	$bureaux->pattern = strip_tags($pattern);
}
$bureaux->set_order("postcode", "ASC");
$bureaux->select();

echo "<h2>".(isset($search) ? __("The bureaux with '%s'", array($search)) :  __("The bureaux"))."</h2>";
echo $bureaux->display();
