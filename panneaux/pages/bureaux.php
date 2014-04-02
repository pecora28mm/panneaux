<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

$bureaux = new Bureaux();
$bureaux->select();
echo $bureaux->display();
