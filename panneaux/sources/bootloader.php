<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require __DIR__."/../configuration/configuration.php";
require __DIR__."/../configuration/fr_FR.php";

require __DIR__."/collector.php";
require __DIR__."/db.php";
require __DIR__."/misc.php";
require __DIR__."/record.php";

require __DIR__."/../libraries/adodb-time.inc.php";

require __DIR__."/bureau.php";
require __DIR__."/bureaux.php";
require __DIR__."/html_checkbox.php";
require __DIR__."/html_input.php";
require __DIR__."/html_input_ajax.php";
require __DIR__."/html_input_date.php";
require __DIR__."/html_select.php";
require __DIR__."/html_select_ajax.php";
require __DIR__."/html_tag.php";
require __DIR__."/html_textarea.php";
require __DIR__."/passage.php";
require __DIR__."/passages.php";

if (function_exists("date_default_timezone_set")) {
	date_default_timezone_set($GLOBALS['param']['locale_timezone']);
}
