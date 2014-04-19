<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$passage = new Passage();
$statusboard = new Statusboard();

echo "
<ul>
<li>".$passage->link(__("Add a passage"))."</li>
<li>".$statusboard->link(__("Check status board"))."</li>
</ul>";
