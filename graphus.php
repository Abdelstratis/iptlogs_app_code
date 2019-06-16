<!DOCTYPE html>
<html>
<head>
  <title>Données</title>
</head>
<body>



     <?php 

          require_once 'connexion.php';
          require_once 'requete__us.php';

     ?>
 
 <!DOCTYPE HTML>
<html>
<head>  
  <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
    
      title:{
      text: "Nombre visiteurs cumulés par mois"
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