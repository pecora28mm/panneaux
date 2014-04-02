<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

require_once __DIR__."/../sources/bootloader.php";

class tests_Bureaux extends TableTestCase {
	function __construct() {
		parent::__construct();
		$this->initializeTables(
			"bureaux"
		);
	}
	
	function test_display() {
		$bureau = new Bureau();
		$bureau->name = "Bureau de vote n°1 Allennes les Marais";
		$bureau->address = "Salle Polyvalente\nRue de Verdun";
		$bureau->postcode = "59251";
		$bureau->city = "Allennes-les-Marais";
		$bureau->save();

		$bureaux = new Bureaux();
		$bureaux->select();
		
		$this->assertPattern("/Bureau de vote n°1 Allennes les Marais/", $bureaux->display());
		
		$this->truncateTable("bureaux");
	}
}
