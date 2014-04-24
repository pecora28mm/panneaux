<?php
/* Nouvelle Donne -- Copyright (C) Perrick Penet-Avez 2014 - 2014 */

require __DIR__."/../sources/bootloader.php";

$db = new Db();
$db->query("TRUNCATE bureaux");

$handle = fopen(__DIR__."/data/villes_france.csv", "r");
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	echo "Ville : ++".$data[3]."++\n";
	$codespostaux[$data[3]] = $data[7];
}
$codespostaux['AIX-LES-ORCHIES'] = "59310";
$codespostaux['LILLE (HELLEMMES)'] = "59260";
$codespostaux['SAINT-POL-SUR-MER'] = "59430";
$codespostaux['COUDEKERQUE'] = "59430";
$codespostaux['SAINT-WAAST-LA-VALLEE'] = "59570";
$codespostaux['FORT-MARDYCK'] = "59430";
$codespostaux['MONCHEAUX-SUR-ECAILLON'] = "59224";
$codespostaux['CAPELLE-SUR-ECAILLON'] = "59213";

$data = file_get_contents(__DIR__."/data/bureaux-de-vote-59.txt");
$lines = explode("\n", $data);

foreach ($lines as $line) {
	if ($line === strtoupper($line) and !is_numeric($line) and !empty($line)) {
		$passage = 0;
		$ville = trim($line);
		$ville = str_replace("- ", "-", $ville);
		$ville = str_replace("Û", "U", $ville);
		$ville = str_replace("Â", "A", $ville);
		$ville = str_replace("É", "E", $ville);
		$ville = str_replace("Ê", "E", $ville);
		
		$ville = preg_replace("/(.*) \(LA\)$/", "LA \\1", $ville);
		$ville = preg_replace("/(.*) \(LA \)$/", "LA \\1", $ville);
		$ville = preg_replace("/(.*) \(LE\)$/", "LE \\1", $ville);
		$ville = preg_replace("/(.*) \(LES\)$/", "LES \\1", $ville);
		$ville = preg_replace("/(.*) \(LES \)$/", "LES \\1", $ville);

		$ville = str_replace("W AAST", "WAAST", $ville);
		$ville = str_replace("EBLINGHEM", "EBBLINGHEM", $ville);
		$ville = str_replace("HEM LENGLET", "HEM-LENGLET", $ville);
		$ville = str_replace("NOYELLES-LEZ-SECLIN", "NOYELLES-LES-SECLIN", $ville);
		$ville = str_replace("WEMERS-CAPPEL", "WEMAERS-CAPPEL", $ville);
		$ville = str_replace("ESCAUPONT", "ESCAUTPONT", $ville);
		$ville = str_replace("INCHY-EN-CAMBRESIS", "INCHY", $ville);
		$ville = str_replace("FLINES-LES-RACHES", "FLINES-LEZ-RACHES", $ville);
		$ville = str_replace("BAVINCOVE", "BAVINCHOVE", $ville);
		$ville = str_replace("WULVERDHINGHE", "WULVERDINGHE", $ville);
		$ville = str_replace("BRUAY-SUR-ESCAUT", "BRUAY-SUR-L'ESCAUT", $ville);
		$ville = str_replace("SAILLY-LES-CAMBRAI", "SAILLY-LEZ-CAMBRAI", $ville);
		$ville = str_replace("LE POMMEREUIL", "POMMEREUIL", $ville);
		$ville = str_replace("SOMMAING-SUR-ECAILLON", "SOMMAING", $ville);
		$ville = str_replace("MOUSTIER", "MOUSTIER-EN-FAGNE", $ville);
		
		echo "Ville : ++".$ville."++\n";
	}
	if ($passage == 3) {
		$nombre_de_bureaux = (int)$line;
	} elseif ($passage == 4) {
		$adresses = explode(",", $line);
// 		if ($nombre_de_bureaux != count($bureaux)) {
// 			echo "Problème à : ".$ville." avec : ".$nombre_de_bureaux." bureaux théoriques\n";
// 			$i = 1;
// 			foreach ($bureaux as $bureau) {
// 				echo "Bureau : ".$i." - ".$bureau."\n";
// 				$i++;
// 			}
// 			echo "\n";
// 		}
		if (is_array($adresses)) {
			foreach ($adresses as $adresse) {
				$adresse = trim($adresse);
				if (strlen($adresse) > 0) {
					$adresse = preg_replace("/(\.)$/", "", $adresse);
					$adresse = strtoupper($adresse[0]).substr($adresse, 1);
// 	 				echo "Bureau : ".$adresse."\n";
	 				
	 				$bureau = new Bureau();
					$bureau->name = $adresse." - ".ucwords($ville);
					$bureau->address = $adresse;
					$bureau->city = $ville;
					if ($bureau->match_existing(array("name", "address", "city"))) {
						$bureau->load();
	 				}
	 				$bureau->postcode = isset($codespostaux[$ville]) ? substr($codespostaux[$ville], 0, 5) : ""; 
	 				$bureau->save();
				}
			}
		}
	}
	$passage++;
}
