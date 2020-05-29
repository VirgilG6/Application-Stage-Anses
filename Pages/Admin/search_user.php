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
                <a class="navbar-brand" href="../../index.html">Administration</a> 
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
                        <a class="active-menu"  href="administration.php"><i class="fas fa-tachometer-alt"></i> Tableau de bord </a>
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
$connect = mysqli_connect("localhost", "root", "root", "bdprojet");

$connect->set_charset("utf8") ;

$output = '';

$i = 0;

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM tuser 
  WHERE ucase(user_lastname) LIKE '%".$search."%' OR  lcase(user_lastname) LIKE '%".$search."%'
  OR ucase(user_name) LIKE '%".$search."%' OR  lcase(user_name) LIKE '%".$search."%'
 LIMIT 0,12";
}
else
{
 $query = "
  SELECT * FROM tuser ORDER BY user_lastname  LIMIT $i;
 ";
}


$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= ' 
  <table id="admin_table"> 
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   			<tr>
  			   <td> <a href="show_user.php?id='.$row['IdUser'].'"> <input type="submit" class="bouton" value="'.$row['user_lastname'].' '.$row['user_name'].'"/> </a>	</td> 
 			  </tr>';
       
  }

 echo $output;
}

?>

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
