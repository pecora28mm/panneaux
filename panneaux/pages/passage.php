<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$id = 0;
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
}

if (isset($_POST['passage'])) {
	$passage = new Passage();
	$passage->load(array('id' => $_POST['passage']['id']));
	$passage->fill($passage->clean($_POST['passage']));
	$passage->save();
	$id = $passage->id; 
}

$passage = new Passage();
$passage->load(array('id' => $id));
echo $passage->edit();
