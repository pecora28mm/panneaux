<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

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
			'passages' => array(
				"CREATE TABLE passages (
				  id INT(21) NOT NULL AUTO_INCREMENT,
				  bureaux_id INT(21) NOT NULL DEFAULT '0',
				  comment MEDIUMTEXT NOT NULL DEFAULT '',
				  etats_id INT(11) NOT NULL DEFAULT '0',
				  actions_id INT(11) NOT NULL DEFAULT '0',
				  day INT(10) NOT NULL DEFAULT '0',
				  time INT(10) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
			),
		);
	}
}
