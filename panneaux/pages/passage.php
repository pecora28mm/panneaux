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

if ($passage->id != 0 and $passage->time >= time() - 360 and $passage->time <= time()) {
	echo "<h2>".__("Modify a passage")."</h2>";
	echo $passage->edit_existing();
} else {
	$passage->reset();
	echo "<h2>".__("Add a passage")."</h2>";
	echo $passage->edit_new();
}
