<?php 

    include_once 'connexion.php';

    try {

    $delete = "DELETE FROM `registre`";
    $sql = "alter table registre auto_increment = 1;";
    
    $connect->exec($delete);
    $connect->exec($sql);


    echo "<br>Reset exécuté<br>";
    
    } catch(PDOExecption $e){
    echo $sql . "<br>" . $e->getMessage();
    }


    /*
    - - nameFile - -
    */

    //date du jour
    $date = date("Ymd");


    //automatisation nom du fichier
    $nameFile = "access_".$date;

    echo "<br>--------Nom du fichier--------<br>";
    echo $nameFile;
    echo "<br>------------------<br>";
    
    //Ouvre le fichier 
    $fp = @fopen("opsone/$nameFile.log","r") or die("fichier non existant !"); 

    //Pour la mise en ligne : path : --> 
    //$fp = @fopen("/var/www/vhosts/deepblock.fr/iptlogs.deepblock.fr/opsone/$nameFile.log","r") or die("fichier non existant !");

    //on parcourt toutes les lignes de ce fichier
    while (!feof($fp)) {
        $data[] = fgets($fp, 4096); // lecture du contenu de la ligne


    };
    //on ferme le fichier une fois terminé
    fclose($fp);
    // $i = 1;
    
   foreach ($data as $value) {
    
        try{
    
            $insert = $connect->prepare("INSERT INTO registre (enregistrement) VALUES (:info)");
            $insert->bindValue(':info', $value,PDO::PARAM_STR);
            $insert->execute();

            echo'Insertion réussie ! <br>';
            
        }
        catch(PDOException $e){
            
            echo "Erreur : <br>" . $e->getMessage();
            
        }

   }

    //rename("/var/www/vhosts/deepblock.fr/iptlogs.deepblock.fr/opsone/$nameFile.log", "/var/www/vhosts/deepblock.fr/iptlogs.deepblock.fr/opsone/archive/$nameFile.log");



?>