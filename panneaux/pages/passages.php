<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$passages = new Passages();
$passages->set_order("time", "DESC");
$passages->select();
echo $passages->display();
