<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$bureaux = new Bureaux();
$bureaux->select();
echo json_encode($bureaux->names());
