<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require_once __DIR__."/../sources/bootloader.php";

class tests_Passages extends TableTestCase {
	function __construct() {
		parent::__construct();
		$this->initializeTables(
			"passages"
		);
	}
	
	function test_display() {
		$passage = new Passage();
		$passage->bureaux_id = "1";
		$passage->comment = "C'est vraiment une panneau terrible";
		$passage->etats_id = "2";
		$passage->actions_id = "3";
		$passage->day = mktime(0, 0, 0, 4, 3, 2014);
		$passage->save();

		$passages = new Passages();
		$passages->select();
		
		$this->assertPattern("/C'est vraiment une panneau terrible/", $passages->display());
		
		$this->truncateTable("passages");
	}
}
