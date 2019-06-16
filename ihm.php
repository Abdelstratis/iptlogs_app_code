<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>IHM</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.1/c3.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.1/c3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.2/d3.min.js"></script>
</head>
<body>

	<div style="display: none;">
		<?php 
		include_once('connexion.php');
	 	?>
	</div>
		
	<?php 

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

    ?>

	<div>
		<?php 


			$requetec = $connect->prepare("SELECT SUM(filtrage) FROM compteur ");
			$requetec->execute();
			$sumFilt = $requetec->fetch();

			$requeteDte = $connect->prepare("SELECT max(dates) FROM compteur ");
			$requeteDte->execute();
			$dateEnr = $requeteDte->fetch();

			?>

		<!-- 	<div class="top">
			</div> -->

	</div>

	<div id="content">
            
        <!-- <a href='principale.php?deconnexion=true'><button>Déconnexion</button></a> -->
            
        <!-- tester si l'utilisateur est connecté -->
        <?php
            session_start();
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:index.php");
                   }
                }
       
        ?>
            
    </div>

    <div id="contenu_all">

    	<div class="partie">
					<p>Dernier fichier traité le <br><b><?php $dateJ = $dateEnr['max(dates)']; $date = new DateTime($dateJ);
								echo $date->format('d/m/Y'); ?>&nbsp;&nbsp;</b><img src="https://img.icons8.com/metro/26/000000/planner.png"></p>
		</div>

    	<div class="partie">
					<p>Nombre d'enregistrements filtrés <br><b><?php echo $sumFilt['SUM(filtrage)']; ?>&nbsp;&nbsp;</b><img src="https://img.icons8.com/metro/26/000000/fine-print.png"></p>
		</div>

		<div class="partie">
		 	<form method="POST" action="ihm.php">
			<p>Zone de recherche d'une <b>adresse IP </b></p><input type="text" name="adresseIp">
			<input class="but" type="submit" value="Rechercher">

			</form>
		</div>	

		<div class="partie">
			<a href="ihm.php"><button>Retour  &#8617;</button></a>
			<a href="ihm.php"><button>FR</button></a>
			<a href="ihmUS.php"><button>US</button></a>
			<a href="manuel.php"><button>CRON</button></a>
			<a href='principale.php?deconnexion=true'><button class="deco">Déconnexion</button></a>
		</div>
		 
	
	</div>
	<br>
	<br>
	<section id="graphique">
		<?php require_once 'zgraph.php';

			if (isset($_POST['adresseIp'])) {
				$ip = $_POST['adresseIp'];
				require_once 'requete2.php';
				?>

				<?php
				require_once 'zgraphip.php';
 				 ?>

				<?php
			}
		 ?>

	
	</section>
	<br>
	<br>
	<button id="marque">Marque</button>
	<button id="brevet">Brevet</button>
	<button id="modele">Modele</button>
	<a href="ihm.php"><button class="reini">Réinitialiser</button></a>

	<section id="partieMarque">
		
		<?php 

		//$res = $connect->prepare("SELECT * FROM infolog");
		//$res->execute();

		//nombre de consultation de marques / brevets / modeles
		if (isset($ip)) {
			$reqSelect = $connect->prepare("SELECT url,dates ,COUNT(DISTINCT(dates))  FROM $dbtable WHERE ip = '$ip' GROUP BY url,dates");
		}else{
			$reqSelect = $connect->prepare("SELECT url,dates ,COUNT(DISTINCT(dates)) FROM $dbtable GROUP BY url");
		}
		
		$reqSelect->execute();

		//$donnees = $res->fetchAll();
		$datas = $reqSelect->fetchAll();


		//gestion des statuts

		if (isset($ip)) {
			$reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM $dbtable WHERE ip = '$ip' GROUP BY url, statut");
		}else{
			$reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM $dbtable GROUP BY url, statut");
		}
		
		$reqS1->execute();
		$values = $reqS1->fetchAll();

		$query = array();

		foreach($values as $value)
		{	
				$query[ $value['url'] ][ $value['statut'] ] = $value['count(statut)'] ;	     
		}
		//var_dump($query, true);
	 ?>
		<table>
			<thead>
			<tr>
				<th>Marque</th>
				<th>Nbr Consultation</th>
				<th>Date</th>
				<th>Status OK requête</th>
				<th>Status Redirection</th>
				<th>Status page non trouvé</th>
				<th>Status Erreur serveur</th>
			</tr>
		</thead>
			<?php  
	 		foreach ($datas as $data) {

	 			$brand = $data['url'];

	 			if(stristr($brand, '/fr/marques/') === false) {

 				}else{
 					
 				
			?>
			<tbody>
			<tr>
				<td style="cursor: pointer;" onclick="location.href='ihm.php?valeur=<?php echo $data['url']; ?>'">
					<?php
						//echo $donnee['url'];
						//$brand = $data['url'];

						if(stristr($brand, '/fr/marques/') === false) {

 						}else{

 							$newBrand = after('/fr/marques/', $brand);
 							echo $newBrand;
 							
 						}

					?>
				</td>
				<td>
					<?php
						if(stristr($brand, '/fr/marques/') === false) {
  							 
 						}else{
 							echo $data['COUNT(DISTINCT(dates))'];
 						}
						
					 ?>
				</td>
				<td>
					<?php 
						$date = $data['dates'];
						$newDate = implode('/', array_reverse(explode('-', $date)));

						if(stristr($brand, '/fr/marques/') === false) {
  							 
 						}else{
 							echo $newDate;
 						}
						
					 ?>
				</td>
				<td>
					<?php
						if(stristr($brand, '/fr/marques/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$marque = $data['url'];
								if (isset($query[$marque]['200'])) {
									print_r($query[$marque]['200']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($brand, '/fr/marques/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$marque = $data['url'];
								if (isset($query[$marque]['302']) or isset($query[$marque]['301']) or isset($query[$marque]['300']) ) {
									if (isset($query[$marque]['300'])) {
										$code = $query[$marque]['300'];
									}else{
										$code = 0;
									}

									if (isset($query[$marque]['301'])) {
										$code1 = $query[$marque]['301'];
									}else{
										$code1 = 0;
									}
									
									if (isset($query[$marque]['302'])) {
										$code2 = $query[$marque]['302'];
									}else{
										$code2 = 0;
									}
									

									$result = $code + $code1 + $code2;
									echo $result;
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($brand, '/fr/marques/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$marque = $data['url'];
								if (isset($query[$marque]['404'])) {
									print_r($query[$marque]['404']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($brand, '/fr/marques/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$marque = $data['url'];
								if (isset($query[$marque]['500'])) {
									print_r($query[$marque]['500']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
			</tr>
		<?php } } ?>
		<tbody>
		</table>
	</section>

	

	<section id="partieBrevet">
		
		<?php 

		//$res = $connect->prepare("SELECT * FROM infolog");
		//$res->execute();

		//nombre de consultation de marques / brevets / modeles
		if (isset($ip)) {
			$reqSelect = $connect->prepare("SELECT url,dates ,COUNT(DISTINCT(dates)) FROM $dbtable WHERE ip = '$ip' GROUP BY url,dates");
		}else{
			$reqSelect = $connect->prepare("SELECT url,dates ,COUNT(DISTINCT(dates)) FROM $dbtable GROUP BY url");
		}
		
		$reqSelect->execute();

		//$donnees = $res->fetchAll();
		$datas = $reqSelect->fetchAll();


		//gestion des statuts
		if (isset($ip)) {
			$reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM $dbtable WHERE ip = '$ip' GROUP BY url, statut");
		}else{
			$reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM $dbtable GROUP BY url, statut");
		}

		$reqS1->execute();
		$values = $reqS1->fetchAll();

		$query = array();

		foreach($values as $value)
		{	
				$query[ $value['url'] ][ $value['statut'] ] = $value['count(statut)'] ;	     
		}
		//var_dump($query, true);
	 ?>
		<table>
			<thead>
			<tr>
				<th>Brevet</th>
				<th>Nbr Consultation</th>
				<th>Date</th>
				<th>Status OK requête</th>
				<th>Status Redirection</th>
				<th>Status page non trouvé</th>
				<th>Status Erreur serveur</th>
			</tr>
		</thead>
			<?php  
	 		foreach ($datas as $data) {

	 			$designs = $data['url'];

	 			if(stristr($designs, '/fr/brevets/') === false) {

 				}else{
 					
 				
			?>
			<tbody>
			<tr>
				<td style="cursor: pointer;" onclick="location.href='ihm.php?valeur=<?php echo $data['url']; ?>'">
					<?php
						//echo $donnee['url'];
						//$designs = $data['url'];

						if(stristr($designs, '/fr/brevets/') === false) {

 						}else{

 							$newBrand = after('/fr/brevets/', $brand);
 							echo $newBrand;
 						}

					?>
				</td>
				<td>
					<?php
						if(stristr($designs, '/fr/brevets/') === false) {
  							 
 						}else{
 							echo $data['COUNT(DISTINCT(dates))'];
 						}
						
					 ?>
				</td>
				<td>
					<?php 
						$date = $data['dates'];
						$newDate = implode('/', array_reverse(explode('-', $date)));

						if(stristr($designs, '/fr/brevets/') === false) {
  							 
 						}else{
 							echo $newDate;
 						}
						
					 ?>
				</td>
				<td>
					<?php
						if(stristr($designs, '/fr/brevets/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['200'])) {
									print_r($query[$modele]['200']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($designs, '/fr/brevets/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['302']) or isset($query[$modele]['301']) or isset($query[$modele]['300']) ) {
									if (isset($query[$modele]['300'])) {
										$code = $query[$modele]['300'];
									}else{
										$code = 0;
									}

									if (isset($query[$modele]['301'])) {
										$code1 = $query[$modele]['301'];
									}else{
										$code1 = 0;
									}
									
									if (isset($query[$modele]['302'])) {
										$code2 = $query[$modele]['302'];
									}else{
										$code2 = 0;
									}
									

									$result = $code + $code1 + $code2;
									echo $result;
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($designs, '/fr/brevets/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['404'])) {
									print_r($query[$modele]['404']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($designs, '/fr/brevets/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['500'])) {
									print_r($query[$modele]['500']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
			</tr>
		<?php } } ?>
		</tbody>
		</table>
	</section>

	<section id="partieModele">
		
		<?php 

		//$res = $connect->prepare("SELECT * FROM infolog");
		//$res->execute();

		//nombre de consultation de marques / brevets / modeles
		if (isset($ip)) {
			$reqSelect = $connect->prepare("SELECT url,dates ,COUNT(DISTINCT(dates)) FROM $dbtable WHERE ip = '$ip' GROUP BY url,dates");
		}else{
			$reqSelect = $connect->prepare("SELECT url,dates ,COUNT(DISTINCT(dates)) FROM $dbtable GROUP BY url");
		}

		$reqSelect->execute();

		//$donnees = $res->fetchAll();
		$datas = $reqSelect->fetchAll();


		//gestion des statuts
		if (isset($ip)) {
			$reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM $dbtable WHERE ip = '$ip' GROUP BY url, statut");
		}else{
			$reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM $dbtable GROUP BY url, statut");
		}
		$reqS1->execute();
		$values = $reqS1->fetchAll();

		$query = array();

		foreach($values as $value)
		{	
				$query[ $value['url'] ][ $value['statut'] ] = $value['count(statut)'] ;	     
		}
		//var_dump($query, true);
	 ?>
		<table>
			<thead>
			<tr>
				<th>Modele</th>
				<th>Nbr Consultation</th>
				<th>Date</th>
				<th>Status OK requête</th>
				<th>Status Redirection</th>
				<th>Status page non trouvé</th>
				<th>Status Erreur serveur</th>
			</tr>
		</thead>
			<?php  
	 		foreach ($datas as $data) {

	 			$patents = $data['url'];

	 			if(stristr($patents, '/fr/modeles/') === false) {

 				}else{
 					
 				
			?>
			<tbody>
			<tr>
				<td style="cursor: pointer;" onclick="location.href='ihm.php?valeur=<?php echo $data['url']; ?>'">
					<?php
						//echo $donnee['url'];
						//$patents = $data['url'];

						if(stristr($patents, '/fr/modeles/') === false) {

 						}else{

 							$newBrand = after('/fr/modeles/', $brand);
 							echo $newBrand;
 						}

					?>
				</td>
				<td>
					<?php
						if(stristr($patents, '/fr/modeles/') === false) {
  							 
 						}else{
 							echo $data['COUNT(DISTINCT(dates))'];
 						}
						
					 ?>
				</td>
				<td>
					<?php 
						$date = $data['dates'];
						$newDate = implode('/', array_reverse(explode('-', $date)));

						if(stristr($patents, '/fr/modeles/') === false) {
  							 
 						}else{
 							echo $newDate;
 						}
						
					 ?>
				</td>
				<td>
					<?php
						if(stristr($patents, '/fr/modeles/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['200'])) {
									print_r($query[$modele]['200']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($patents, '/fr/modeles/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['302']) or isset($query[$modele]['301']) or isset($query[$modele]['300']) ) {
									if (isset($query[$modele]['300'])) {
										$code = $query[$modele]['300'];
									}else{
										$code = 0;
									}

									if (isset($query[$modele]['301'])) {
										$code1 = $query[$modele]['301'];
									}else{
										$code1 = 0;
									}
									
									if (isset($query[$modele]['302'])) {
										$code2 = $query[$modele]['302'];
									}else{
										$code2 = 0;
									}
									

									$result = $code + $code1 + $code2;
									echo $result;
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($patents, '/fr/modeles/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['404'])) {
									print_r($query[$modele]['404']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
				<td>
					<?php 
						if(stristr($patents, '/fr/modeles/') === false) {
  							 
 						}else{
							if ($data['url']) {
								$modele = $data['url'];
								if (isset($query[$modele]['500'])) {
									print_r($query[$modele]['500']);
								}else{
									echo "0";
								}
							}
						}
					 ?>
				</td>
			</tr>
		<?php } } ?>
		</tbody>
		</table>
	</section>

	<section id="partieInfos">
		<?php 

			if (isset($_GET['valeur'])) {
				$marqueValue = $_GET['valeur'];

				$res1 = $connect->prepare("SELECT DISTINCT(ip),dates,concat(hour(heure),':', minute(heure), ':', second(heure)) as heure FROM `$dbtable` WHERE url='$marqueValue' GROUP BY dates ORDER BY dates ASC, heure ASC");
				$res1->execute();
				$vlues = $res1->fetchAll();

				echo "Marque selectionnée : " . $marqueValue;

				?>

				<table>
					<thead>
					<tr>
						<th>Listes Ip</th>
						<th>Date</th>
						<th>Heure</th>
					</tr>
				</thead>

					<?php 
						foreach ($vlues as $value) {
						
					 ?>
					 <tbody>
					<tr>
						<td><?php echo $value['ip'];?>	
						</td>
						<td>
							<?php 
								$time = $value['dates'];
								$date = new DateTime($time);
								echo $date->format('d/m/Y');
							?>
						</td>
						<td>
							<?php 
								$hour = $value['heure'];
								$heure = new DateTime($hour);
								echo $heure->format('H:i:s');
							?>
						</td>
					</tr>
					<?php } ?>
					</tbody>
				</table>

				<?php
			}
		?>
	</section>

	<?php 
		// $reqS1 = $connect->prepare("SELECT url, statut, count(statut) FROM infolog GROUP BY url, statut");
		// $reqS1->execute();
		// $values = $reqS1->fetchAll();

		// $query = array();

		// foreach($values as $value)
		// {	
		// 		$query[ $value['url'] ][ $value['statut'] ] = $value['count(statut)'] ;	     
		// }

		// for ($i=0; $i < count($query); $i++) { 
			
		// 	//$query[$i][ $value['url'] ][ $value['statut'] ] = $value['count(statut)'] ;
		// }
		 
		// // echo var_export($query, true);

		// var_dump($query, true);

		// foreach ($query as $subquery) {
		// 	# code...
		// }
	 ?>

	<script type="text/javascript">

		
			
		var marque = document.getElementById('marque');
		var brevet = document.getElementById('brevet');
		var modele = document.getElementById('modele');

		var partieMarque = document.getElementById('partieMarque');
		var partieBrevet = document.getElementById('partieBrevet');
		var partieModele = document.getElementById('partieModele');

		var partieInfos = document.getElementById('partieInfos');

		marque.addEventListener('click', function(){
			partieBrevet.style.display = 'none';
			partieModele.style.display = 'none';

			partieMarque.style.display = 'block';
		},false);

		brevet.addEventListener('click', function(){
			partieMarque.style.display = 'none';
			partieModele.style.display = 'none';

			partieBrevet.style.display = 'block';
		},false);

		modele.addEventListener('click', function(){
			partieMarque.style.display = 'none';
			partieBrevet.style.display = 'none';

			partieModele.style.display = 'block';
		},false);

		partieMarque.style.display = 'none';
		partieBrevet.style.display = 'none';
		partieModele.style.display = 'none';




	</script>
</body>
</html>

