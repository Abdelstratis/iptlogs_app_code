<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.1/c3.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.1/c3.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.2/d3.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
</head>
<body>

    <style type="text/css">
        body{font-family: 'oxygen', sans-serif;}
            .c3-title{
                font-size: 3em;
            }

        @media screen and (max-width:500px) {
            .c3-title{
                font-size: 1.5em;
            }
        }
    </style>
    
    <?php 

        require_once 'connexion.php';
        require_once 'requete2.php';

     ?>


    <div id="chart"></div>

<script type="text/javascript">

    var chart = c3.generate({
    title: {
        show: false,
        text: 'Nombre de visiteurs cumulés par mois | ip <?php echo $ip ?>'   ,
        position: 'top-center',   // top-left, top-center and top-right
        padding: {
          top: 20,
          right: 20,
          bottom: 40,
          left: 50
        }
      },
    data: {
        x: 'x',
        columns: [
            ['x', 'Jan', 'Fev', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Aout', 'Sept', 'Oct', 'Nov', 'Dec'],
            ['Connexion(s)', <?php echo $janCo; ?>, <?php echo $fevCo; ?>, <?php echo $marsCo; ?>, <?php echo $avrilCo; ?>, <?php echo $maiCo; ?>, <?php echo $juinCo; ?>, <?php echo $juilletCo; ?>, <?php echo $aoutCo; ?>, <?php echo $sepCo; ?> ,<?php echo $octCo; ?> ,<?php echo $novCo; ?>, <?php echo $decCo; ?>]
        ],
        type: 'spline',
    },
    axis: {
        x: {
            label: 'Mois',
            type: 'category',
            tick: {
                rotate: 0,
                multiline: false
            }
        },
        y: {
            min: 0
        }

    },
    color: {
        pattern: ['#7FAE2A']
    },
    grid: {
        x: {
            show: true
        },
        y: {
            show: true
        }
    }
    });

    d3.select('#chart .c3-title')
    .style("dominant-baseline", "central")
    .style('font-family', 'oxygen, sans-serif')
    .style('text-align', 'center');

    d3.select('#chart text')
    .style('font-family', 'oxygen, sans-serif');
</script>

</body>
</html>