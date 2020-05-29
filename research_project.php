<!DOCTYPE html>
<html>
<head>
	<title></title>
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
  <style> 
    .fa-folder-plus {
      font-size:40px;
    }

  </style>
</head>
<body>

<?php

//fetch.php
$connect = mysqli_connect("localhost", "root", "root", "bdprojet");

$connect->set_charset("utf8") ;


$i = 0 ;

$query = "
  SELECT * FROM tprojet ORDER BY IdProjet
 ";

 $output = '';

 $result = mysqli_query($connect, $query);

 while($row = mysqli_fetch_array($result))
 {
  $output .= ' ' ;
  
                $i = $i + 1 ;

  }


$output = '';

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM tprojet 
  WHERE ucase(Code) LIKE '%".$search."%' OR  lcase(Code) LIKE '%".$search."%'
  OR ucase(Acronyme) LIKE '%".$search."%' OR lcase(Acronyme) LIKE '%".$search."%' 
  OR ucase(Statut_projet) LIKE '%".$search."%' OR lcase(Statut_projet) LIKE '%".$search."%' 
  OR ucase(UniteL) LIKE '%".$search."%' OR lcase(UniteL) LIKE '%".$search."%'


 ";
}
else
{
 $query = "
  SELECT * FROM tprojet ORDER BY IdProjet
 ";
}

$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) > 0)
{
 $output .= ' 
  <div class="limiter">
    <div class="container-table100">
          <div class="wrap-table100">
          <label class="nbr_project"> '.$i.' <i class="fas fa-project-diagram" title="Projet"></i>  </label>
            <div class="table100 ver3 m-b-110">
              <div class="table100-head">
                <table>
                  <thead>
                    <tr class="row100 head">
                      <th class="cell100 column1">Code</th>
                      <th class="cell100 column2">Unite</th>
                      <th class="cell100 column3">Acronyme</th>
                      <th class="cell100 column4">intitulé</th>
                      <th class="cell100 column5">Statut</th>
                      <th class="cell100 column6">Afficher</th>
                    </tr>
                  </thead>
                </table>
              </div>
          <div class="table100-body" class="js-pscroll">
            <table>
            <tbody>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr class="row100 body">
                  <td> <input type="hidden" name="id" value=' .$row["IdProjet"]. '</td>
                  <td> <input type="hidden" name="id" value=' .$row["IdProjet"]. '</td>
                  <td class="cell100 column1" >'.  $row["Code"] .'</td>
                  <td class="cell100 column2">'.  $row["UniteL"] . ' / '.  $row["UniteAssocier"] . '</td>
                  <td class="cell100 column3">'.  $row["Acronyme"] .'</td>
                  <td class="cell100 column4">'.  $row["Intitule"] . '</td>  
                  <td  class="cell100 column5">'. $row["Statut_projet"] . '</td>
                    <td  class="cell100 column6"> <a href=Pages/display_form.php?id='.$row["IdProjet"].'>
                    <i class="fas fa-eye"> </i> </td> </a>
                </tr> ';
                $i = $i + 1 ;
  }

 echo $output;
}
else
{
 echo 'Aucun projet trouvé';
}
?>
<?php
 
?>


</body>
</html>