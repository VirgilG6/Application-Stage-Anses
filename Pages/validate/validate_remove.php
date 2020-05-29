<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Formulaire 2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 

</head>


<body>



<?php

$DataBase = mysqli_connect("localhost", "root", "root", "bdprojet");


$DataBase->set_charset("utf8") ;


if (isset($_GET['IdProjet'])) {

$IdProjet = $_GET['IdProjet'];

}




if (isset($_GET['IdVieProjet'])) {

$IdVieProjet = $_GET['IdVieProjet'];


$RsqlDelete_tvie_projet = "DELETE FROM tvie_projet WHERE IdVieProjet = $IdVieProjet ";
$Resultat = mysqli_query ( $DataBase, $RsqlDelete_tvie_projet )  or  die(mysqli_error($DataBase) ) ;

}

if (isset($_GET['IdDescriptionProjet'])) {

$Acronyme = $_GET['Acronyme'];

$NomFichier = $_GET['NomFichier'];

$IdDescriptionProjet = $_GET['IdDescriptionProjet'];

define ('SITE_ROOT', realpath(dirname(__FILE__)));

unlink(SITE_ROOT.'/../../../Application/files/'.$Acronyme.'/'.$NomFichier);

$RsqlDelete_tvie_projet = "DELETE FROM tdescription_projet WHERE IdDescriptionProjet = $IdDescriptionProjet ";
$Resultat = mysqli_query ( $DataBase, $RsqlDelete_tvie_projet )  or  die(mysqli_error($DataBase) ) ;

}


if (isset($_GET['Personne'] )   )
 {
	foreach($_GET['Personne'] as $element)
    {
        $donnees = explode("-", $element);
        $IdPersonne = $donnees[0];
        $IdProjet = $donnees[1];

      
         
      $RsqlDelete_tpersonne = "DELETE FROM tpersonne WHERE IdPersonne = $IdPersonne ";
	  $Resultat = mysqli_query ( $DataBase, $RsqlDelete_tpersonne )  or  die(mysqli_error($DataBase) ) ;

    }

}

if (isset($_GET['Personne_externe'] )   )
 {
    foreach($_GET['Personne_externe'] as $element)
    {
        $donnees = explode("-", $element);
        $IdPersonne_externe = $donnees[0];
        $IdProjet = $donnees[1];

      
         
      $RsqlDelete_tpersonne_externe = "DELETE FROM tpersonne_externe WHERE IdPersonneExt = $IdPersonne_externe ";
      $Resultat = mysqli_query ( $DataBase, $RsqlDelete_tpersonne_externe )  or  die(mysqli_error($DataBase) ) ;

    }
}

if (isset($_GET['Personne_recruter'] )   )
 {
    foreach($_GET['Personne_recruter'] as $element)
    {
        $donnees = explode("-", $element);
        $IdPersonne_recruter = $donnees[0];
        $IdProjet = $donnees[1];

      
         
      $RsqlDelete_tpersonne_recruter = "DELETE FROM tpersonne_recruter WHERE IdPersonne_recruter = $IdPersonne_recruter ";
      $Resultat = mysqli_query ( $DataBase, $RsqlDelete_tpersonne_recruter )  or  die(mysqli_error($DataBase) ) ;

    }
}

if (isset($_GET['Chef'] )   )
 {
	foreach($_GET['Chef'] as $element)
    {
        $donnees = explode("-", $element);
        $IdChef = $donnees[0];
        $IdProjet = $donnees[1];

        echo $IdChef;
      
         
      $RsqlDelete_tchef = "DELETE FROM tchef WHERE IdChef = $IdChef ";      

    	$Resultat = mysqli_query ( $DataBase, $RsqlDelete_tchef )  or  die(mysqli_error($DataBase) ) ; 
    }

}

   mysqli_close ( $DataBase ) ;
header('Location:../remove_form.php?id='.$IdProjet);
exit();
?>


</body>
</html>