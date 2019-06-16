<?php 

	//date du jour
	$dates = date("d/m/Y");

	$heure = date("H:i");

	
	//automatisation nom du fichier
	//$nameFile = "access_".$date;

	//insertion enregistrements -- registre
	//include_once 'log.php';

	//analyse donnees
	//include_once 'analyseData.php';

	//deplacement fichier vers -- archive (suppr old)
	//rename("/var/www/vhosts/deepblock.fr/iptlogs.deepblock.fr/opsone/$nameFile.log", "/var/www/vhosts/deepblock.fr/iptlogs.deepblock.fr/opsone/archive/$nameFile.log");

	echo "Fichier Analysé et archivé";

	$fichier = fopen('/var/www/vhosts/deepblock.fr/iptlogs.deepblock.fr/log/log.txt', 'w+');
	
	$texte = "Fichier traité le " . $dates . " à " . $heure;

	fwrite($fichier, $texte);

	fclose($fichier);

 ?>