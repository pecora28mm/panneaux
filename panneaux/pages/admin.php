<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

$passage = new Passage();
$bureau = new Bureau();

echo "<h2>".__("The admin page")."</h2>";
echo "
<ul>
<li>".$passage->link(__("Add a passage"))."</li>
<li><a href=\"index.php?page=passages.php\">Lister les derniers passages</a></li>
<li><a href=\"index.php?page=bureaux.php\">Lister les bureaux</a></li>
<li>".$bureau->link(__("Add a bureau"))."</li>
<li><a href=\"index.php?page=apropos.php\">A propos</a></li>
</ul>";
