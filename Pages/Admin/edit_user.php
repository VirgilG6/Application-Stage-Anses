<?php

session_start();

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['mdp']))
    {  
      if ($_SESSION['user_role'] != 'ROLE_ADMIN') {
         header("Location:../form_connection/disconnection.php");
         exit;
      }
      
    } else {
      header("Location:../form_connection/disconnection.php");
      exit;
    }
} else {
    header("Location:../form_connection/disconnection.php");
    exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administration</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />


        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 


</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Administration.php">Administration</a> 
            </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a class="active-menu"  href="Administration.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord </a>
                    </li>			                  
                    <li>
                      <a class="active-menu"  href="../../index.php"><i class="fas fa-tablet-alt"></i> Retour à l'application </a>
                    </li> 
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
         <div id="page-wrapper" >
        <div id="page-inner">
        <?php
            $id = $_GET['id'];

            $connect = mysqli_connect("localhost", "root", "root", "bdprojet");

            $connect->set_charset("utf8") ;

            $Rsql = "SELECT * FROM tuser Where IdUser = $id";

            $result = mysqli_query($connect, $Rsql);

            while($row = mysqli_fetch_array($result))
                {
                          $name = $row['user_name'];
                          $lastname = $row['user_lastname'];
                          $Email = $row['user_email'];
                          $admin = $row['user_role'];
                }

        echo "<h1> Bienvenue sur le profil de ".$name." ".$lastname."</h1>";
        ?>
        <hr> 
        <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Informations
                        </div>
                        <div class="panel-body">
                        <?php
                        echo $name." ".$lastname."<br> <br>";

                        echo "Email  : ".$Email;
                        ?>
                        </div>
                    </div>            
                </div>
                      <div class="col-md-6 col-sm-12 col-xs-12">                     
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Administration
                        </div>
                        <div class="panel-body">
                        <?php
                        echo "<form action='Validate_user_edit.php'>";
                        echo "<input type='hidden' name='id' value='".$id."'>";

                        if ($admin == "ROLE_USER" ) {
                            echo "Cette personne n'est pas administrateur <br>
                                Voulez-vous le passer en administrateur ? Oui  <input type='radio' name='A' value='ROLE_ADMIN' > Non  <input type='radio' name='A' value='0' >";
                        }
                        else {
                           echo "Cette personne est administrateur <br>
                           Voulez-vous enlever cette personne des administrateurs ? Oui  <input type='radio' name='A' value='ROLE_USER' > Non  <input type='radio' name='A' value='1' >";
                        }
                       echo "  </div> </div>  
                        <input type='submit' value='Valider'> </form>";
                        ?>


                        
                              
                
                
           </div>     
        </div>     
    </div>
                    
               
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>