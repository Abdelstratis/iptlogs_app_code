<?php  
include 'connexion.php';

try {

	$delete = "DELETE FROM `registre`";
	$sql = "alter table registre auto_increment = 1;";
	
	$connect->exec($delete);
	$connect->exec($sql);


	echo "<br>Reset exécuté";
	
} catch(PDOExecption $e){
	echo $sql . "<br>" . $e->getMessage();
}



?>