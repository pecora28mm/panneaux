<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$bureaux = new Bureaux();

if (isset($_REQUEST['action']) and $_REQUEST['action'] == "search") {
	$bureaux->pattern = $_REQUEST['name'];
	$bureaux->select();
}

echo json_encode($bureaux->names());
