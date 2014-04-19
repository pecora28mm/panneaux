<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

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

$passages = new Passages();
$passages->bureaux_id = $id;
$passages->set_order("time", "DESC");
$passages->select();

$bureau = new Bureau();
$bureau->load(array('id' => $id));

echo "<h2>".__("The last passages for '%s' in %s", array($bureau->name, $bureau->city))."</h2>";
echo $bureau->link_to_new_passage();
echo $passages->display();

echo "<h2>".__("Modify the bureau '%s' in %s", array($bureau->name, $bureau->city))."</h2>";
echo $bureau->edit();
