<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$id = 0;
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
} elseif (isset($_GET['bureaux_id'])) {
	$bureaux_id = (int)$_GET['bureaux_id'];
}

if (isset($_POST['passage'])) {
	$passage = new Passage();
	$passage->load(array('id' => $_POST['passage']['id']));
	$passage->fill($passage->clean($_POST['passage']));
	$passage->save();
	$id = $passage->id; 
}

$passage = new Passage();
$passage->load($id);
if (isset($bureaux_id)) {
	$passage->bureaux_id = $bureaux_id;
}
echo "<h2>".(($id == 0) ? __("Add a passage") : __("Modify a passage"))."</h2>";
echo $passage->edit();
