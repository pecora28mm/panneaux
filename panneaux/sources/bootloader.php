<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

require __DIR__."/../configuration/configuration.php";

require __DIR__."/collector.php";
require __DIR__."/db.php";
require __DIR__."/misc.php";
require __DIR__."/record.php";

require __DIR__."/bureau.php";
require __DIR__."/bureaux.php";
require __DIR__."/html_input.php";
require __DIR__."/html_tag.php";
require __DIR__."/html_textarea.php";

if (function_exists("date_default_timezone_set")) {
	date_default_timezone_set($GLOBALS['param']['locale_timezone']);
}
