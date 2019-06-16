<!DOCTYPE html>
<html>
<head>
	<title>Données</title>
</head>
<body>



     <?php 

          require_once 'connexion.php';
          //require_once 'requete__.php';

          $dbtable = 'test';

          $ip = $_POST['adresseIp'];

         $req1 = $connect->prepare("SELECT COUNT(ip) FROM $dbtable WHERE dates BETWEEN '2019-01-01' AND '2019-01-31' AND ip = '$ip' ");
        $req1->execute();

        $janCos = $req1->fetchAll();

        foreach ($janCos as $janCo) {
               $janCo = $janCo['COUNT(ip)'];
        }

        $req2 = $connect->prepare("SELECT COUNT(ip) FROM $dbtable WHERE dates BETWEEN '2019-02-01' AND '2019-02-31' AND ip = '$ip';
        ");
        $req2->execute();

        $fevCos = $req2->fetchAll();

        foreach ($fevCos as $fevCo) {
               $fevCo = $fevCo['COUNT(ip)'];
        }

        $req3 = $connect->prepare("SELECT COUNT(ip) FROM $dbtable WHERE dates BETWEEN '2019-03-01' AND '2019-03-31' AND ip = '$ip';
        ");
        $req3->execute();

        $marsCos = $req3->fetchAll();

        foreach ($marsCos as $marsCo) {
               $marsCo = $marsCo['COUNT(ip)'];
        }

        $req4 = $connect->prepare("SELECT COUNT(ip) from $dbtable WHERE dates BETWEEN '2019-04-01' AND '2019-04-31' AND ip = '$ip';
        ");
        $req4->execute();

        $avrilCos = $req4->fetchAll();

        foreach ($avrilCos as $avrilCo) {
               $avrilCo = $avrilCo['COUNT(ip)'];
        }

        $req5 = $connect->prepare("SELECT COUNT(ip) from $dbtable WHERE dates BETWEEN '2019-05-01' AND '2019-05-31' AND ip = '$ip';
        ");
        $req5->execute();

        $maiCos = $req5->fetchAll();

        foreach ($maiCos as $maiCo) {
               $maiCo = $maiCo['COUNT(ip)'];
        }

        $req6 = $connect->prepare("SELECT COUNT(ip) from $dbtable WHERE dates BETWEEN '2019-06-01' AND '2019-06-31' AND ip = '$ip';
        ");
        $req6->execute();

        $juinCos = $req6->fetchAll();

        foreach ($juinCos as $juinCo) {
               $juinCo = $juinCo['COUNT(ip)'];
        }

        $req7 = $connect->prepare("SELECT COUNT(ip) from $dbtable WHERE dates BETWEEN '2019-07-01' AND '2019-07-31' AND ip = '$ip';
        ");
        $req7->execute();

        $juilletCos = $req7->fetchAll();

        foreach ($juilletCos as $juilletCo) {
               $juilletCo = $juilletCo['COUNT(ip)'];
        }

        $req8 = $connect->prepare("SELECT COUNT(ip) from $dbtable WHERE dates BETWEEN '2019-08-01' AND '2019-08-31' AND ip = '$ip';
        ");
        $req8->execute();

        $aoutCos = $req8->fetchAll();

        foreach ($aoutCos as $aoutCo) {
               $aoutCo = $aoutCo['COUNT(ip)'];
        }

        $req9 = $connect->prepare("SELECT COUNT(ip) from $dbtable WHERE dates BETWEEN '2019-09-01' AND '2019-09-31' AND ip = '$ip';
        ");
        $req9->execute();

        $sepCos = $req9->fetchAll();

        foreach ($sepCos as $sepCo) {
               $sepCo = $sepCo['COUNT(ip)'];
        }

        $req10 = $connect->prepare("SELECT COUNT(ip) FROM $dbtable WHERE dates BETWEEN '2019-10-01' AND '2019-10-31' AND ip = '$ip';
        ");
        $req10->execute();

        $octCos = $req10->fetchAll();

        foreach ($octCos as $octCo) {
               $octCo = $octCo['COUNT(ip)'];
        }

        $req11 = $connect->prepare("SELECT COUNT(ip) FROM $dbtable WHERE dates BETWEEN '2019-11-01' AND '2019-11-31' AND ip = '$ip';
        ");
        $req11->execute();

        $novCos = $req11->fetchAll();

        foreach ($novCos as $novCo) {
               $novCo = $novCo['COUNT(ip)'];
        }

        $req12 = $connect->prepare("SELECT COUNT(ip) FROM $dbtable WHERE dates BETWEEN '2019-12-01' AND '2019-12-31' AND ip = '$ip';
        ");
        $req12->execute();

        $decCos = $req12->fetchAll();

        foreach ($decCos as $decCo) {
               $decCo = $decCo['COUNT(ip)'];
        }

     ?>
 
 <!DOCTYPE HTML>
<html>
<head>  
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
    
      title:{
      text: "Nombre de connexions par mois | ip : <?php echo $ip ?>"
      },
      axisX: {
        valueFormatString: "MMM",
        interval: 1,
        intervalType: "month"
      },
       data: [
      {        
        type: "spline",
        
        dataPoints: [
        { x: new Date(2012, 00, 1), y: <?php echo $janCo; ?> },
        { x: new Date(2012, 01, 1), y: <?php echo $fevCo; ?> },
        { x: new Date(2012, 02, 1), y: <?php echo $marsCo; ?> },
        { x: new Date(2012, 03, 1), y: <?php echo $avrilCo; ?> },
        { x: new Date(2012, 04, 1), y: <?php echo $maiCo; ?> },
        { x: new Date(2012, 05, 1), y: <?php echo $juinCo; ?> },
        { x: new Date(2012, 06, 1), y: <?php echo $juilletCo; ?> },
        { x: new Date(2012, 07, 1), y: <?php echo $aoutCo; ?> },
        { x: new Date(2012, 08, 1), y: <?php echo $sepCo; ?> },
        { x: new Date(2012, 09, 1), y: <?php echo $octCo; ?> },
        { x: new Date(2012, 10, 1), y: <?php echo $novCo; ?> },
        { x: new Date(2012, 11, 1), y: <?php echo $decCo; ?> }        
        ]
      }       
        
      ]
    });

    chart.render();
  }
  </script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script></head>
<body>
  <div id="chartContainer" style="height: 300px; width: 100%;">
  </div>
</body>
</html>