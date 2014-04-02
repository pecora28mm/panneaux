<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

$id = 0;
if (isset($_GET['id'])) {
	$id = (int)$_GET['id'];
}

if (isset($_POST['bureau'])) {
	$bureau = new Bureau();
	$bureau->load(array('id' => $_POST['bureau']['id']));
	$bureau->fill($bureau->clean($_POST['bureau']));
	$bureau->save();
	$id = $bureau->id; 
}

$bureau = new Bureau();
$bureau->load(array('id' => $id));
echo $bureau->edit();
