     <?php 

          require_once 'connexion.php';
          //require_once 'requete__.php';

          $dbtable = 'infolog';

          $ip = $_POST['adresseIp'];

         $req1 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) FROM $dbtable WHERE dates BETWEEN '2019-01-01' AND '2019-01-31' AND ip = '$ip' AND url LIKE '%/en/%' ");
        $req1->execute();

        $janCos = $req1->fetchAll();

        foreach ($janCos as $janCo) {
               $janCo = $janCo['COUNT(DISTINCT(ip))'];
        }

        $req2 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) FROM $dbtable WHERE dates BETWEEN '2019-02-01' AND '2019-02-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req2->execute();

        $fevCos = $req2->fetchAll();

        foreach ($fevCos as $fevCo) {
               $fevCo = $fevCo['COUNT(DISTINCT(ip))'];
        }

        $req3 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) FROM $dbtable WHERE dates BETWEEN '2019-03-01' AND '2019-03-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req3->execute();

        $marsCos = $req3->fetchAll();

        foreach ($marsCos as $marsCo) {
               $marsCo = $marsCo['COUNT(DISTINCT(ip))'];
        }

        $req4 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) from $dbtable WHERE dates BETWEEN '2019-04-01' AND '2019-04-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req4->execute();

        $avrilCos = $req4->fetchAll();

        foreach ($avrilCos as $avrilCo) {
               $avrilCo = $avrilCo['COUNT(DISTINCT(ip))'];
        }

        $req5 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) from $dbtable WHERE dates BETWEEN '2019-05-01' AND '2019-05-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req5->execute();

        $maiCos = $req5->fetchAll();

        foreach ($maiCos as $maiCo) {
               $maiCo = $maiCo['COUNT(DISTINCT(ip))'];
        }

        $req6 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) from $dbtable WHERE dates BETWEEN '2019-06-01' AND '2019-06-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req6->execute();

        $juinCos = $req6->fetchAll();

        foreach ($juinCos as $juinCo) {
               $juinCo = $juinCo['COUNT(DISTINCT(ip))'];
        }

        $req7 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) from $dbtable WHERE dates BETWEEN '2019-07-01' AND '2019-07-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req7->execute();

        $juilletCos = $req7->fetchAll();

        foreach ($juilletCos as $juilletCo) {
               $juilletCo = $juilletCo['COUNT(DISTINCT(ip))'];
        }

        $req8 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) from $dbtable WHERE dates BETWEEN '2019-08-01' AND '2019-08-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req8->execute();

        $aoutCos = $req8->fetchAll();

        foreach ($aoutCos as $aoutCo) {
               $aoutCo = $aoutCo['COUNT(DISTINCT(ip))'];
        }

        $req9 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) from $dbtable WHERE dates BETWEEN '2019-09-01' AND '2019-09-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req9->execute();

        $sepCos = $req9->fetchAll();

        foreach ($sepCos as $sepCo) {
               $sepCo = $sepCo['COUNT(DISTINCT(ip))'];
        }

        $req10 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) FROM $dbtable WHERE dates BETWEEN '2019-10-01' AND '2019-10-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req10->execute();

        $octCos = $req10->fetchAll();

        foreach ($octCos as $octCo) {
               $octCo = $octCo['COUNT(DISTINCT(ip))'];
        }

        $req11 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) FROM $dbtable WHERE dates BETWEEN '2019-11-01' AND '2019-11-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req11->execute();

        $novCos = $req11->fetchAll();

        foreach ($novCos as $novCo) {
               $novCo = $novCo['COUNT(DISTINCT(ip))'];
        }

        $req12 = $connect->prepare("SELECT COUNT(DISTINCT(ip)) FROM $dbtable WHERE dates BETWEEN '2019-12-01' AND '2019-12-31' AND ip = '$ip' AND url LIKE '%/en/%' ;
        ");
        $req12->execute();

        $decCos = $req12->fetchAll();

        foreach ($decCos as $decCo) {
               $decCo = $decCo['COUNT(DISTINCT(ip))'];
        }

     ?>