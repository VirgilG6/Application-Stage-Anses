<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Suivi projet</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/nav.css">
  <style> 
    .fa-plus-square {
      font-size:40px;
      letter-spacing: 30px;
      color:black;
      }
      .container .fa-plus-square:hover {
        color:green;
    }


  </style>
 </head>
 <body>
 <?php
        session_start();

        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['mdp']))
            {
echo "      <div id='cssmenu'>  
              <ul>
                  <li><a href='index.php'>Accueil</a></li>
                  <li><a href='Pages/new_project.php'>Ajouter un projet</a></li>
                  <li><a href='my_project.php'>Mes projets</a></li>";
                  if ($_SESSION['user_role'] == 'ROLE_ADMIN') {

                    echo "					<li><a href='Pages/Admin/Administration.php'>Administration</a></li>";
                    
                    }
echo            " <li class='session'><a href='Pages/form_connection/disconnection.php'>Deconnexion</a></li>
                  <li class='session'><a href='#'>".$_SESSION['user_name']." ".$_SESSION['user_lastname']."</a></li>
              </ul>
 				    </div>  ";
            } else {
                header('Location:form_connection/connection.php');
            }
        } else {
            header('Location:form_connection/connection.php');
        }
    ?> 

  <div class="container">
   <div class="form-group">
    <div class="input-group">
     <input type="text" name="search_text" id="search_text" placeholder="Entrez votre recherche..." class="form-control" />
    </div>
   </div>
   <br />

   <div id="result"></div>
   
  </div>
     
 </body>

</html>



<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"research_my_project.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>