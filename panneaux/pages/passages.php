<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

echo "<h2>".__("The last 100 passages")."</h2>";
$passages = new Passages();
$passages->set_order("time", "DESC");
$passages->set_limit(100, 0);
$passages->select();
echo $passages->display();
