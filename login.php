<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="css/style_log.css" media="screen" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
                <img src="img/logo-ip-transfer" alt="" /> </a>
        </div>
        <!-- END LOGO -->
            
            <form action="verification.php" method="POST">
                <h3>Veuillez vous identifier</h3>
                
                <!-- <label><b>Nom d'utilisateur</b></label> -->
                <input type="text" placeholder="👤  Identifiant" name="username" required>

                <!-- <label><b>Mot de passe</b></label> -->
                <input type="password" placeholder="🔒  Mot de passe" name="password" required>

                <input type="submit" id='submit' value='Connexion' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
            <div class="copyright"><p style="text-align: center;"> 2019 &copy; Deep Block </p></div>
        </div>
    </body>
</html>