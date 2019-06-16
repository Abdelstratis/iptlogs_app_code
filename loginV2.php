<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
		<title>DEEP BLOCK</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
		<!--
		<base href="https://appcm.deepblock.fr/" />
		-->
        <meta content="LEGAPOL" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
		 <link href="https://appcm.deepblock.fr/themes/deepblocklogin/custom/custom.css" rel="stylesheet" type="text/css" />  
   <link rel="icon" type="image/png" href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/favicon-16x16.png" sizes="16x16">
   <link rel="icon" type="image/png" href="https://appcm.deepblock.fr/themes/deepblocklogin/assets/favicon-32x32.png" sizes="32x32">
   <!-- reCaptcha v2 -->
   <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
    <!-- END HEAD -->
    <body class=" login">

        <style type="text/css">
            input[type=submit] {
    background-color: #1150A3;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}
        </style>
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="index.php">
                <img src="https://appcm.deepblock.fr/images/client/logo_login.png" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">            <!-- BEGIN LOGIN FORM -->
			 <form name="login" action="verification.php" method="post" class="login-form">
			  <h4 class="form-title">Veuillez vous identifier</h4>
  

                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Identifiant:</label>
                    <div class="input-icon">
                        <i class="fa fa-user"></i>
						<input type="text" name="username" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Identifiant" />					</div>
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Mot de passe :</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" class="form-control placeholder-no-fix" autocomplete="off" placeholder="Mot de passe " />						 
                  </div>
                </div>

	<!--
              <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Mot de passe :</label>
                <div class="input-icon">
                        <i class="fa fa-desktop"></i>
                        <select name="entities_id" class="form-control"><option value="0">Votre organisation</option></select>                </div>
             </div>				
	-->			
                <div class="form-actions">
                    
                    <!--<a id="register-back-btn" type="button" href="https://appcm.deepblock.fr/usr/stage/create_account.php" class="btn red btn-outline pull-left">Nouveau client ?</a>-->
                    
                    <button style="text-align: center;" type="submit"> Connexion </button>
                </div>
            </form>
            <!-- END LOGIN FORM -->

           
        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright"> 2019 &copy; Deep Block </div>
        <!-- END COPYRIGHT -->
        <!--[if lt IE 9]>
<script src="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/respond.min.js"></script>
<script src="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>



        <script src="https://appcm.deepblock.fr/themes/deepblocklogin/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->

        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="https://appcm.deepblock.fr/themes/deepblocklogin/assets/pages/scripts/login-4-modified.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>
</html>