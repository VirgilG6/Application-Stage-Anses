<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bdprojet;charset=utf8', 'root', 'root');

session_start();

$Code = $_GET['Code'];
$Intitule = $_GET['Intitule'];
$Acronyme = $_GET['Acronyme'];
$UniteL = $_GET['UniteL'];
$Domaine = $_GET['Domaine'];

$DataBase = mysqli_connect("localhost", "root", "root", "bdprojet");

$DataBase->set_charset("utf8") ;

if(isset($_GET['UniteAssocier'])) {

  foreach ($_GET['UniteAssocier'] as $key => $value)
  {
    $value = $_GET['UniteAssocier'];
  }

    $UniteAssocier = implode (" / "  ,$value);
}


if(isset($_GET['Domaine_technique'])) {

  foreach ($_GET['Domaine_technique'] as $key => $value1)
    {
      $value1 = $_GET['Domaine_technique'];
    }
    
    $Domaine_technique = implode (" / "  ,$value1);
}


if(isset($_GET['Type_substance'])) {

  foreach ($_GET['Type_substance'] as $key => $value2)
    {
      $value2 = $_GET['Type_substance'];
    }
      
    $Type_substance = implode (" / "  ,$value2);
}


if(isset($_GET['Type_methode'])) {

  foreach ($_GET['Type_methode'] as $key => $value3)
    {
      $value3 = $_GET['Type_methode'];
      
    }
      
    $Type_methode = implode (" / "  ,$value3);
}


if(isset($_GET['Ajouter_domaine_technique'])) {

  foreach ($_GET['Ajouter_domaine_technique'] as $key => $value4)
    {
      $value4 = $_GET['Ajouter_domaine_technique'];

      $domaine_technique = implode (" / "  ,$value4);

      $reqcode = $bdd->prepare("INSERT INTO tdomtech (Domainetechnique) VALUES (?)");
      $reqcode->execute(array($domaine_technique));
    }
      
    $Ajouter_domaine_technique = implode (" / "  ,$value4);

    $Ajouter_domaine = $Domaine_technique ." / ".$Ajouter_domaine_technique;
} else {
  $Ajouter_domaine = $Domaine_technique;
}


if(isset($_GET['Ajouter_substance'])) {

  foreach ($_GET['Ajouter_substance'] as $key => $value5)
    {
      $value5 = $_GET['Ajouter_substance'];

      $substance = implode (" / "  ,$value5);


      $reqcode = $bdd->prepare("INSERT INTO ttypesubstance (Typesubstance) VALUES (?)");
      $reqcode->execute(array($substance));
    }
      
    $Ajouter_substance = implode (" / "  ,$value5);

    $Ajouter_substance = $Type_substance ." / ".$Ajouter_substance;
} else {
  $Ajouter_substance = $Type_substance;
}


if(isset($_GET['Ajouter_methode'])) {

  foreach ($_GET['Ajouter_methode'] as $key => $value6)
    {
      $value6 = $_GET['Ajouter_methode'];

      $methode = implode (" / "  ,$value6);

      $reqcode = $bdd->prepare("INSERT INTO ttypemethode (Typemethode) VALUES (?)");
      $reqcode->execute(array($methode));
    }
      
    $Ajouter_methode = implode (" / "  ,$value6);

    $Ajouter_type_methode = $Type_methode ." / ".$Ajouter_methode;
} else {
  $Ajouter_type_methode = $Type_methode;
} 





   $reqcode = $bdd->prepare("SELECT * FROM tprojet WHERE Code= ?");
   $reqcode->execute(array($Code));
   $codeexist = $reqcode->rowCount();
   if($codeexist == 1) {

    date_default_timezone_set('UTC');
    $date = date('y');

    $nbrelettre = rand(2, 2);
     for ($sa=0;$sa<$nbrelettre;$sa++) 
     {
         $lettres = range('A', 'Z');
         $motgenere = $lettres[array_rand($lettres)];
         $motgenere2 = $lettres[array_rand($lettres)];
        
     }
   
     $motcomplet = $date ."". $motgenere ."". $motgenere2;
     $Code = $motcomplet;
    } 
      $reqcode = $bdd->prepare("SELECT * FROM tprojet WHERE Code= ?");
      $reqcode->execute(array($Code));
      $codeexist = $reqcode->rowCount();
        
        if ($codeexist == 0) {

          $reqcode = $bdd->prepare("INSERT INTO tprojet (Code,Intitule,Acronyme,UniteL,UniteAssocier,Domaine,Domaine_technique,Type_substance,Type_methode,Statut_projet,PrenomPorteur,NomPorteur,RefUser) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
          $reqcode->execute(array($Code,$Intitule,$Acronyme,$UniteL,$UniteAssocier,$Domaine,$Ajouter_domaine,$Ajouter_substance,$Ajouter_type_methode,"Initié",$_SESSION["user_name"],$_SESSION["user_lastname"],$_SESSION["IdUser"]));

        }


 


  //--- Déconnection de la base de données
  mysqli_close ( $DataBase ) ;

header('Location:../../index.php');
exit();
 	
 	
?>


</body>
</html>