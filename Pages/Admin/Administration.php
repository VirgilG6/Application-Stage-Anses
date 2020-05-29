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

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Suivi projet</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 

  </head>
  <body>
    <div class="container">
      <div id="add">
      </div>
          <input type="text" name="search_text" id="search_text" placeholder="Entrez la personne recherchée..." class="form-control" />
      <br/>

      <div id="result"></div>
      </div>
    </div>
  </body>
</html>



<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"search_user.php",
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