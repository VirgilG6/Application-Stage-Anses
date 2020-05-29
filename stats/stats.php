
<?php

$connect = mysqli_connect("localhost", "root", "root", "bdprojet") ;

$connect->set_charset("utf8") ;

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>     

<body>

<h2>Statistiques</h2>

<form action="" method="POST">
  <div class="custom-select" style="width:200px;">
  
    <select name="Annee">
      <option Value="">Année </option>
      <?php for($i = 2020 ; $i < 2100 ; $i++ ) {
     echo  "<option style='overflow-y:scroll;height:80px;background-color:white;width:210px;'>".$i."</option>";
      }
      ?>
    </select>
  </div> <br> <br>
<form action="" method="POST">
  <div class="custom-select" style="width:200px;">
    <select name="UniteL">
      <option Value="">Unité Porteur</option>
      <option>Toutes les unités Porteur</option>
      <option>ARC</option>
      <option>TC</option>
      <option>AB2R</option>
      <option>EMAD</option>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;">
    <select name="UniteA">
      <option Value="">Unité Associé</option>
      <option>Toutes les unités Associés</option>
      <option>ARC</option>
      <option>TC</option>
      <option>AB2R</option>
      <option>EMAD</option>
      <option>Direction</option>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;"> <!-- Afficher avec BD -->
    <select name="Domaine_technique">
      <option Value="">Domaine technique</option>
      <option>Tous les domaines techniques</option>
      <?php 
      
        $Rsql = "SELECT Domainetechnique FROM tdomtech GROUP BY Domainetechnique";
      
        $result = mysqli_query($connect, $Rsql);
							
        while($row = mysqli_fetch_array($result)) 
        {
          if($row['Domainetechnique'] != NULL ) 
          {
            echo "<option>".$row['Domainetechnique']."</option>";
          }
        }
      ?>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;"> <!-- Afficher avec BD -->
    <select name="Type_substance">
      <option Value="">Type de substance</option>
      <option>Toutes les types de substances</option>
      <?php 
      
        $Rsql = "SELECT Typesubstance FROM ttypesubstance GROUP BY Typesubstance";
      
        $result = mysqli_query($connect, $Rsql);
							
        while($row = mysqli_fetch_array($result)) 
        {
          if($row['Typesubstance'] != NULL ) 
          {
            echo "<option>".$row['Typesubstance']."</option>";
          }
        }
      ?>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;"> <!-- Afficher avec BD -->
    <select name="Type_methode">
      <option Value="">Type de méthode</option>
      <option>Toutes les types de méthodes</option>
      <?php 
      
        $Rsql = "SELECT Typemethode FROM ttypemethode GROUP BY Typemethode";
      
        $result = mysqli_query($connect, $Rsql);
							
        while($row = mysqli_fetch_array($result)) 
        {
          if($row['Typemethode'] != NULL ) 
          {
            echo "<option>".$row['Typemethode']."</option>";
          }
        }
      ?>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;">
    <select name="Status_dossier">
      <option Value="">Status dossier</option> 
      <option>Tous les status de dossier</option>           
      <option>Retenu</option>
      <option>Non retenu</option>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;"> <!-- Afficher avec BD -->
    <select name="Financeur">
      <option Value="">Financeurs</option>
      <option>Tous les financeurs </option>
      <?php 
      
        $Rsql = "SELECT Nom_financement FROM tprojet GROUP BY Nom_financement";
      
        $result = mysqli_query($connect, $Rsql);
							
        while($row = mysqli_fetch_array($result)) 
        {
          if($row['Nom_financement'] != NULL ) 
          {
            echo "<option>".$row['Nom_financement']."</option>";
          }
        }
      ?>
    </select>
  </div> <br> <br>
  <div class="custom-select" style="width:200px;">
    <label> Budget </label>
    <label> Oui </label> <input type="radio" name="Budget" value="Oui"/> <label> Non </label> <input type="radio" name="Budget" value="Non"/> 
  </div> <br> <br>


  


  <input type="submit" name="formstats" value="Rechercher" />
</form>


</body>
<script src="js/select.js"></script>
</html>

<?php 

$nbrProjet = 0;

// si on clique sur rechercher ...
if (isset($_POST['formstats'])) 
{
// si année selectionné on récupère la valeur 
if(isset($_POST['Annee']) && !empty($_POST['Annee'])) 
{
  $Annee = $_POST['Annee'];
  echo "Année : ".$Annee."<br />";
}

  $RsqlAnnee = "DATE_FORMAT(Date_de_debut, '%Y') = '$Annee'";

// si Unite Porteur selectionné et non vide  
  if(isset($_POST['UniteL']) && !empty($_POST['UniteL']) && $_POST['UniteL'] == "Toutes les unités Porteur")
  {
    $RsqlUniteL = "";
  } 
  // sinon UniteL = valeur de l'option
  elseif(isset($_POST['UniteL']) && !empty($_POST['UniteL'])) {
    $UniteL = $_POST['UniteL'];
    echo "UniteL : ".$UniteL."<br />";

    $RsqlUniteL = "AND UniteL = '$UniteL'";
  }
// si choisi toutes les unités UniteA1 = ARC ...
  if(isset($_POST['UniteA']) && !empty($_POST['UniteA']) && $_POST['UniteA'] == "Toutes les unités Associés") 
  {
    $RsqlUniteA = "";
  } 
  // sinon UniteA = valeur de l'option
  elseif(isset($_POST['UniteA']) && !empty($_POST['UniteA'])) 
  { 
    $UniteA = $_POST['UniteA'];
    echo "UniteA : ".$UniteA."<br />";
    $RsqlUniteA = "AND UniteAssocier = '$UniteA'";
  }
  // si on choisi Tous les domaines techniques (a faire avec BD)
  if(isset($_POST['Domaine_technique']) && !empty($_POST['Domaine_technique']) && $_POST['Domaine_technique'] == "Tous les domaines techniques" ) {
    $RsqlDomaine_technique = "";
  }
  elseif(isset($_POST['Domaine_technique']) && !empty($_POST['Domaine_technique'])) //sinon Dommaine technique prend la valeur de l'option
  {
    $Domaine_technique = $_POST['Domaine_technique'];

    echo "Domaine technique : ".$Domaine_technique."<br />";

    $RsqlDomaine_technique = "AND Domaine_technique = '$Domaine_technique'";
  }
  // si status_dossier = tous les status
  if(isset($_POST['Status_dossier']) && !empty($_POST['Status_dossier']) && $_POST['Status_dossier'] == "Tous les status de dossier" ) 
  {
    $RsqlStatus_dossier = "";
  }
  elseif(isset($_POST['Status_dossier']) && !empty($_POST['Status_dossier'])) //sinon status_dossier prend la valeur de l'option
  {
    $Status_dossier = $_POST['Status_dossier'];

    echo "Status_dossier : ".$Status_dossier."<br />";

    $RsqlStatus_dossier = "AND Statut_dossier = '$Status_dossier'";
  }
  if(isset($_POST['Financeur']) && !empty($_POST['Financeur']) && $_POST['Financeur'] == "Tous les financeurs" ) 
  {
    $RsqlFinanceur = "";
  }
  elseif(isset($_POST['Financeur']) && !empty($_POST['Financeur'])) //sinon financeur prend la valeur de l'option
  {
    $Financeur = $_POST['Financeur'];

    echo "Financeur : ".$Financeur."<br />";

    $RsqlFinanceur = "AND Nom_financement = '$Financeur'";
  }
  if(isset($_POST['Type_substance']) && !empty($_POST['Type_substance']) && $_POST['Type_substance'] == "Toutes les types de substances" ) 
  {
    $RsqlType_substance = "";
  }
  elseif(isset($_POST['Type_substance']) && !empty($_POST['Type_substance'])) //sinon Type_substance prend la valeur de l'option
  {
    $Type_substance = $_POST['Type_substance'];

    echo "Type_substance : ".$Type_substance."<br />";

    $RsqlType_substance = "AND Type_substance = '$Type_substance'";
  }
  if(isset($_POST['Type_methode']) && !empty($_POST['Type_methode']) && $_POST['Type_methode'] == "Toutes les types de méthodes" ) 
  {
    $RsqlType_methode = "";
  }
  elseif(isset($_POST['Type_methode']) && !empty($_POST['Type_methode'])) //sinon Type_substance prend la valeur de l'option
  {
    $Type_methode = $_POST['Type_methode'];

    echo "Type_methode : ".$Type_methode."<br />";

    $RsqlType_methode = "AND Type_methode = '$Type_methode'";
  }

 
  if(isset($_POST['Budget']) && !empty($_POST['Budget']) && $_POST['Budget'] == "Oui" ) 
  {
    $RsqlFinancement = "SELECT SUM(budget_recu) as 'somme' FROM tprojet";

  } else if(isset($_POST['Budget']) && !empty($_POST['Budget']) && $_POST['Budget'] == "Non" ) 
  {
    $RsqlFinancement = "SELECT * FROM tprojet";
  }







  
//=============================================================================================//

  if (isset($_POST['Annee']) && !empty($_POST['Annee'])) 
  {
    if (isset($_POST['UniteL']) && !empty($_POST['UniteL']) && $_POST['UniteL']) 
    {
      if (isset($_POST['UniteA']) && !empty($_POST['UniteA']) && $_POST['UniteA']) 
      {
        if (isset($_POST['Domaine_technique']) && !empty($_POST['Domaine_technique'])) 
        {
          if(isset($_POST['Status_dossier']) && !empty($_POST['Status_dossier'])) 
          {
            if(isset($_POST['Financeur']) && !empty($_POST['Financeur'])) 
            {
              if(isset($_POST['Type_substance']) && !empty($_POST['Type_substance'])) 
              {
                if(isset($_POST['Type_methode']) && !empty($_POST['Type_methode'])) 
                {
                  if (isset($_POST['Budget']) && !empty($_POST['Budget']))
                  {
                    
                    $Rsql1 = "$RsqlFinancement WHERE $RsqlAnnee $RsqlUniteL $RsqlUniteA $RsqlStatus_dossier $RsqlFinanceur $RsqlType_substance $RsqlType_methode";

                    echo "Rsql1 = ".$Rsql1." <br />";

                    $result = mysqli_query($connect, $Rsql1);
                    
                    if(mysqli_num_rows($result) > 0)
                    {
                      while($row = mysqli_fetch_array($result)) 
                      {
                        if($_POST['Budget'] == "Oui" ) 
                        {
                          echo "SOMME :". $row['somme']."</br>";
                        }
                      }            
                    }
                    $Rsql2 = "SELECT * FROM tprojet WHERE $RsqlAnnee $RsqlUniteL $RsqlUniteA $RsqlStatus_dossier $RsqlFinanceur $RsqlType_substance $RsqlType_methode";

                    echo "Rsql2 = ".$Rsql2." <br />";

                    $result = mysqli_query($connect, $Rsql2);

                    while($row = mysqli_fetch_array($result))
                      {
                        $nbrProjet = $nbrProjet+1;
                      }
                    echo "NbrProjet : ".$nbrProjet;
                  }
                }
              }   
            }
          }  
        }
      }
    } 
  }
}
?>