<!DOCTYPE html>
<html>
<head>
	<title>BCP</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<style type="text/css">
	
	#infos{
	background-color: #eeeeee;
	}
	h6,h5,h4,h3,h2,h1{
		font-family: 'poppins', sans-serif;
	}
	p{
		font-family: sans-serif;
	}
</style>

<?php 

	require_once 'connexion.php';

	$dbtable = 'test';

	function after ($elem, $inthat)
    {
        if (!is_bool(strpos($inthat, $elem)))
        return substr($inthat, strpos($inthat,$elem)+strlen($elem));
    };
	function before ($elem, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $elem));
    };
	function between ($elem, $that, $inthat)
    {
        return before ($that, after($elem, $inthat));
    };

    function isNumber($nbr){

    	if (ord($nbr) >= 48 && ord($nbr) <= 57) {
    		return false;
    	}elseif ((ord($nbr) >= 65 && ord($nbr) <= 90) || (ord($nbr) >= 97 && ord($nbr) <= 122)) {
    		return true;
    	}

    };


    function isBruit($elem){

    	if ( isNumber($elem[0]) === false ) {
	  	//echo "<br>--------il y a un chiffre-----------<br>";
	  	return false;
		}elseif ( isNumber($elem[0]) === true) {
			//il y a une lettre

			//2ème caractère on continue
			if ( isNumber($elem[1]) === false) {
	  		//echo "<br>--------il y a un chiffre-----------<br>";
			return false;
	  	

			}elseif (isNumber($elem[1]) === true) {
			//il y a une lettre

				//3ème caractère on continue
				if ( isNumber($elem[2]) === true) {
	  			//echo "<br>--------il y a une lettre-----------<br>";

				//donc c'est bon
				}elseif (isNumber($elem[2]) === false) {
				// pas bon
				return false;
				}
			}
		}
    };

    function other($element,$valeur){

    	//global $result;


    	if ($valeur >= 3) {

			if (isBruit($element) === false) {
				//$result = 'unset';
				return false;
			}

		}elseif ($valeur < 3 && $valeur > 1) {
		
				if (isNumber($element[0]) === true && isNumber($element[1]) === true){
				//c'est une lettre-lettre

				}elseif (isNumber($element[0]) === false) {
				//$result = 'unset';
					return false;
				// format : chiffre-qlqchose

				}elseif (isNumber($element[1]) === false){
					return false;
				//$result = 'unset';
				//format : chiffre-lettre
				//chiffre-chiffre
				//lettre-chiffre
				}

		}elseif ($valeur <= 1) {
		
				if (isNumber($element[0]) === false) {
				// 1
				//$result = 'unset';
					return false;
				}else{

				}
		}
    };

    /*---*/




	$reqSelect = $connect->prepare("SELECT * FROM registre");
	$reqSelect->execute();

	//$sub = array();
	$i=0;
	
	while ($donnees = $reqSelect->fetch()) {
		
		$sub[] = $donnees['enregistrement'];

	}


foreach ($sub as $key => $enr) {

	$nums = array( '/fr/marques/', '/fr/brevets/', '/fr/modeles/', '/en/trademarks/', '/en/designs/', '/en/patents/' );
		
	$elementsMarque = array(' /fr/marques/', ' /en/trademarks/');
	$elementsBrevet = array(' /fr/brevets/', ' /en/designs/');
	$elementsModele = array(' /fr/modeles/', ' /en/patents/');

	foreach ( $nums as $num ) {
   		if ( ( $pos = stripos( $enr, $num ) ) !== false ) {

	        $tab[]=explode(' ', $enr);

	        foreach ($tab as $intab) {
	        	$status = $intab[8];
	        
	        }
	        

	        $res = between ('GET ', ' ', $enr);
	       // $ip = before('-', $enr);
	       // $date = between('- - [', ':', $enr);
	       // $heure = between(':', ' +', $enr);

	        if ( (stripos( $res, $num ) ) !== false ){
	        	$res = between ('GET ', ' ', $enr);
	       	 	$ip = before('-', $enr);
	        	$date = between('- - [', ':', $enr);
	        	$heure = between(':', ' +', $enr);

	        	if ( (stripos( $res, '%' ) ) !== false ) {
 					//rien
 					
 				}elseif ( (stripos( $res, '?' ) ) !== false ) {
 					$res2 = before('?', $res);

 				}elseif ( (stripos( $res, '-' ) ) !== false ) {
 					
 					//traitement Début algo

 					if (strlen($res) > 38) {
 						unset($res2);
 						goto end;
 					}

 					$res2 = $res;

 					$apsTiret = after('-', $res);

					//echo "<br>--------Après tiret 1-----------<br>";
					//echo $apsTiret;
					//echo "<br>----------entre tiret 1-------------<br>";
					//echo $entreTiret;

					// $value = ord($apsTiret[0]);

					$value = strlen($apsTiret);

					echo $value;

					// echo "<br>";
					// echo "valeur"  . $value;


					
					if (other($apsTiret,$value) === false) {
						unset($res2);

						goto end;
						//$result1[] = 'no1';
						
						//echo $apsTiret;
						//goto end;
					}else{
						$res2 = $res2;
						
						goto end;
						//echo $apsTiret;
						//goto end;
					}


					//si y'a une autre partie (2)

					if ((stripos( $apsTiret, '-' ) ) !== false ) {
						$apsapsTiret = after('-', $apsTiret);
						$value2= strlen($apsapsTiret);
						
						if ((stripos( $apsapsTiret, '-' ) ) !== false ) {
							$entreentreTiret = before('-', $apsapsTiret);
							$value3= strlen($entreentreTiret);

							if (other($entreentreTiret, $value3) === false){
								unset($res2);
								//$result2[] = 'no2';
								
								goto end;


							}else{
								$res2 = $res2;
								goto end;
							}

						}else{
							if (other($apsapsTiret, $value2) === false){
								
								unset($res2);
								//$result2[] = 'no2';
								
								goto end;
							}else{
								$res2 = $res2;
								goto end;
							}
							
						}
						
					}


					// si y'en une dernière partie (3)

					if (isset($apsapsTiret)) {
						
						if ((stripos( $apsapsTiret, '-' ) ) !== false) {
							$apsapsapsTiret = after('-', $apsapsTiret);
							$value4= strlen($apsapsapsTiret);
							
							if ((stripos( $apsapsapsTiret, '-' ) ) !== false ) {
								$entreentreentreTiret = before('-', $apsapsapsTiret);
								$value5= strlen($entreentreentreTiret);

								if (other($entreentreentreTiret, $value5) === false) {
									
									unset($res2);
									//$result3[] = 'no3';
									
									goto end;
								}else{
									$res2 = $res2;
									goto end;
								}
			

							}else{
								if (other($apsapsapsTiret, $value4) === false) {
									
									unset($res2);
									
									goto end;
								}else{
									$res2 = $res2;
									goto end;
								}
								
							}
							
						}

					}
					

				//end elseif --> début algo
				end :
 				}else{
 					$res2 = $res;
 				}

 				//end : 

				//echo "<br><br>--------RES-----------<br>";
	 			//echo $res2;
				//echo "<br>--------RES-----------<br><br>";

	        ?>

	        <?php
	        $date = implode('-', array_reverse(explode('/', $date)));

	        $newDate = date('Y-m-d', strtotime($date));

	        	if ($res2 != NULL) {
	        		
	        	
	        		
			        try{
						$insert = $connect->prepare("INSERT INTO $dbtable (ip,url,dates,heure,statut) VALUES (:ip,:url,:dates,:heure,:statut)");
						
						//on lie l'objet :objet a $objet
						$insert->bindValue(':ip', $ip,PDO::PARAM_STR);
						$insert->bindValue(':url', $res2,PDO::PARAM_STR);
						$insert->bindValue(':dates', $newDate,PDO::PARAM_STR);
						$insert->bindValue(':heure', $heure,PDO::PARAM_STR);
						$insert->bindValue(':statut', $status,PDO::PARAM_STR);
						
						//on execute la commande
						$insert->execute();
						echo'Insertion Réussie <br>';
						
					}
					catch(PDOException $e){
						
					    echo "<br>Erreur : <br>" . $e->getMessage();
						
					}


				//end du if : test 'NULL'
				}

			//end if 2
			}

		//du if 1
    	}

    //foreach 2
	}
	
//foreach 1
}
	
	$requete = $connect->prepare("SELECT count(enregistrement) FROM registre ");
			$requete->execute();
			$countReg = $requete->fetch();
			$compteur = $countReg['count(enregistrement)'];
			$time = date("Y-m-d");

			try{
				$insert = $connect->prepare("INSERT INTO compteur (filtrage,dates) VALUES (:filtrage,:dateEnr)");
				
				//on lie l'objet :objet a $objet
				$insert->bindValue(':filtrage', $compteur,PDO::PARAM_STR);
				$insert->bindValue(':dateEnr', $time,PDO::PARAM_STR);
				
				//on execute la commande
				$insert->execute();
				
			}
			catch(PDOException $e){
				
			    echo "<br>Erreur : <br>" . $e->getMessage();
			}
 ?>

 	 <!-- <a href="ihm.php"><button>Voir l'IHM</button></a> -->
			
</body>
</html>




<?php 
	//echo "<br>-------------------------<br>";
	 			//echo $res2;
	 			//echo "<br>-------------------------<br>";


		        //echo $res2;

		        //$elems[] = $res2;
		        //$ips[] = $ip;


		        //recupère après le 1er tiret
		        //$apsTiret = after('-', $res2);

		        


		        /*----------------------------------------*/

		        //var_dump($elems);

		         
		        //  if ( (stripos( $elems[$i], $elems[$i-1] ) ) !== false AND $ips[$i] == $ips[$i-1]) {
		        //  $res2 = NULL;

		        //  }

		        //  if ( (stripos( $elems[$i], $elems[$i-2] ) ) !== false AND $ips[$i] == $ips[$i-2]) {
		        //  	$res2 = NULL;
		        //  }



		        // $i = $i + 1;


		    	//     if ((strlen($res2)) > 35 ) {
			   //      echo "<br>-------------------------<br>";
		 			// echo $res2. '----->' .'chaîne + 35 caracères.';
		 			// echo "<br>-------------------------<br>";
		    	//     }


		        /*------------------------------------*/


/*
		    foreach ($stock as $res2) {
		       	echo "<br>-----------RES2--------------<br>";
		 		echo $res2;
		 		echo "<br>-------------------------<br>";
		    }
*/		       
 ?>