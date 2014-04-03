<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$passages = new Passages();
$passages->select();
echo $passages->display();
