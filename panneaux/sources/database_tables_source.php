<?php
/* Nouvelle Donne -- Copyright (C) No Parking 2014 - 2014 */

class Database_Tables_Source {
	protected $db;

	function __construct($db = null) {
		if ($db == null) {
			$db = new db();
		}
		$this->db = $db;
	}

	function enumerate() {
		return array(
			  'bureaux' => array(
				  "CREATE TABLE bureaux (
					id INT(21) NOT NULL AUTO_INCREMENT,
					name VARCHAR(255) NOT NULL DEFAULT '',
			  		address MEDIUMTEXT NOT NULL DEFAULT '',
			  		postcode VARCHAR(100) NOT NULL DEFAULT '',
			  		city VARCHAR(255) NOT NULL DEFAULT '',
					PRIMARY KEY (`id`)
				   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
				),
		);
	}
}
