<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Formulaire 2</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
	<link rel="stylesheet" type="text/css" href="../css/Formulaire.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<script src="../js/jquery-3.4.1.js"> </script>
	  
				
	<script>
function afficherLeader()
{   
    document.getElementById('champ').style.visibility='visible'; 

}

function effacerLeader()
{   
    document.getElementById('champ').style.visibility='hidden';   
}

function afficherFinancement()
{   
    document.getElementById('champs').style.visibility='visible'; 

}

function effacerFinancement()
{   
    document.getElementById('champs').style.visibility='hidden';   
}


		function insererLigne_Fin() {
	    	var cell, ligne;
	 
	    	// on récupère l'identifiant (id) de la table qui sera modifiée
	    	var tableau = document.getElementById("idTable");
	    	// nombre de lignes dans la table (avant ajout de la ligne)
	    	var nbLignes = tableau.rows.length;
	 
	    	ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
	                                   	// le paramètre est dans ce cas (-1)
	 
	    	// création et insertion des cellules dans la nouvelle ligne créée
	    	cell = ligne.insertCell(0);
	    	cell.innerHTML = "<input type='Date' name='date_vie_projet'>";
	 
	    	cell = ligne.insertCell(1);
	    	cell.innerHTML = "<textarea class='text' name='description_date_projet'></textarea>";

			cell = ligne.insertCell(2);
	    	cell.innerHTML = "<input type='Date' name='date_de_soumission'>";

			cell = ligne.insertCell(3);
	    	cell.innerHTML = "<input type='Date' name='date_de_reponse'>";
			
			cell = ligne.insertCell(4);
	    	cell.innerHTML = " <input type='checkbox' name='acceptation' value='Accepté'> <label> Oui </label>  <br /> <input type='checkbox' name='acceptation' value='Pas accepté'> <label> Non </label>";
		}


		function insererLigne_Fin1() {
	    	var cell, ligne;
	 
	    	// on récupère l'identifiant (id) de la table qui sera modifiée
	    	var tableau = document.getElementById("idTable1");
	    	// nombre de lignes dans la table (avant ajout de la ligne)
	    	var nbLignes = tableau.rows.length;
	 
	    	ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
	                                   	// le paramètre est dans ce cas (-1)
	 
	    	// création et insertion des cellules dans la nouvelle ligne créée
	    	cell = ligne.insertCell(0);
	    	cell.innerHTML = "<textarea name='Description_Document' class='text'></textarea>";
	 
	    	cell = ligne.insertCell(1);
	    	cell.innerHTML = "<input type='file' name='fichier' required/>";
		}	

		$(document).ready(function(){
		$(".tabs li a").click(function() {
		
		// Active state for tabs
		$(".tabs li a").removeClass("active");
		$(this).addClass("active");
		
		// Active state for Tabs Content
		$(".tab_content_container > .tab_content_active").removeClass("tab_content_active").fadeOut(200);
		$(this.rel).fadeIn(500).addClass("tab_content_active");
		
	});	

});		
	</script>
</head>



<body>
<?php
        session_start();

        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['mdp']))
            {
    echo "      <div id='cssmenu'>  
					<ul>
						<li><a href='../index.php'> Accueil </a></li>
						<li><a href='new_project.php'>Ajouter un projet</a></li>
						<li><a href='../my_project.php'> Mes projets</a></li>";

						if ($_SESSION['user_role'] == 'ROLE_ADMIN') {

echo "					<li><a href='Admin/Administration.php'>Administration</a></li>";

						}
echo "					<li class='session submit'><a href='form_connection/disconnection.php'>Deconnexion</a></li>
						<li class='session'><a href='#'>".$_SESSION['user_name']." ".$_SESSION['user_lastname']."</a></li>
					</ul>
 				</div>  ";
            } else {
                header('Location:form_connection/connection.php');
            }
        } else {
            header('form_connection/connection.php');
        }
    ?> 



<div class="wrapper">
    <ul class="tabs">
        <li><a href="javascript:void(0); return false;" rel="#tabcontent1" class="tab active">Suivi du projet</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent2" class="tab">Equipe</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent3" class="tab">Vie du projet</a></li>
        <li><a href="javascript:void(0); return false;" rel="#tabcontent4" class="tab">Documents associés</a></li>
    </ul>


<?php

$IdProjet = $_GET['id'];

$connect = mysqli_connect("localhost", "root", "root", "bdprojet");

$connect->set_charset("utf8") ;

$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							$Statut_dossier = $row['Statut_dossier'];
				}

				if ($Statut_dossier == 'Non retenu') {
					header('Location:Formulaire.php?id='.$IdProjet);
					exit();
				}


echo "<form method='POST' action='validate/validate_edit.php' enctype='multipart/form-data'>
	<center>

	<div class='tab_content_container'>
	<div class='tab_content tab_content_active' id='tabcontent1'>
			<table border='5' cellpadding='8' cellspacing='6' id='top-table' >
				<tr>";

				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Code"].'  </label> </td> ';

				}
				echo $output; 


							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<input type="hidden" name="Acronyme" value="'.$row['Acronyme'].'"/> <td> <label>' .$row["Acronyme"].'  </label> </td> ';

				}
				echo $output;

							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Type_substance"].'  </label> </td> ';

				}
				echo $output;

							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Type_methode"].'  </label> </td> ';

				}
				echo $output;


							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label name="Intitule">'.$row["Intitule"].'</label> </td>';

				}
				echo $output;
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							
							if ($row["Statut_dossier"] == 'Retenu') 
							{
								$output .= '<td> <label>'.$row["Statut_dossier"].'</label> ';
								
							}
							 	elseif ($row["Statut_dossier"] == 'En attente') 
							 {
							 	$output .= '<td> <label>'.$row["Statut_dossier"].'</label> <br> 
							 	<input type="checkbox" name="Statut_D[]" > Non retenu ';
							 }
							elseif ($row["Statut_dossier"] == '') 
							{
								$output .= '<td> <label>'.$row["Statut_dossier"].'</label> <br> 
							 	<input type="checkbox" name="Statut_D[]" > Non retenu ';
							}else {
								$output .= '<td> <label>'.$row["Statut_dossier"].'</label> ';
							}
				}
				echo $output;
			echo	"	</tr>
				<tr> ";

					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label name="UniteL">'.$row["UniteL"].' / '.$row["UniteAssocier"].'</label> </td> ';

				}
				echo $output; 
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <input type="hidden" name="Domaine" value="'.$row["Domaine"].'" /> <label >'.$row["Domaine"].'</label> </td> ';

				}
				echo $output; 
							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Domaine_technique"].'  </label> </td> ';

				}
				echo $output;

						$rqSql = "SELECT Date_de_debut  from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
						

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td > <label > Date de début : <input type="Date" name="Date_de_debut" Value="' .$row["Date_de_debut"].'">  </label> </td> ';

				}
				echo $output; 

						$rqSql = "SELECT Date_de_fin_prevue  from tprojet where IdProjet = $IdProjet";
						// Exécution de la requête
						
						$output = '';
						
					

						$result = mysqli_query($connect, $rqSql);
						
						while($row = mysqli_fetch_array($result)) {
							
						$output .= '<td> <label > Date de fin prévue : <input type="Date"  name="Date_de_fin_prevue" Value="' .$row["Date_de_fin_prevue"].'">  </label> </td> ';

				}
				echo $output;

						$rqSql = "SELECT Date_de_fin  from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
						

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label > Date de fin : <input type="Date"  name="Date_de_fin" Value="' .$row["Date_de_fin"].'">  </label> </td> ';

				}
				echo $output; 
				

					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Statut_projet"].'  </label> </td> ';

				}
				echo $output; 

			echo		"
				</tr>
			</table>";	


			echo "<br><br>
			<input type='hidden' value='".$IdProjet."' name='id' >
			<table border='5' cellpadding='8' cellspacing='6'>
				<tr> 
					<td> <label> Description </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <textarea class="text" name="Description_Projet">'.$row["Description_Projet"].'</textarea> </td>';
							 
							 $Domaine = $row['Domaine'];

				}
				echo $output; 
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
						
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 
							 $Leader = $row["Leader"];
							 $Programme = $row["Programme_de_travail"];
							 $Nom_Leader = $row["Nom_Leader"];
							 $Source = $row["source_financement"];
							 $Nom_Financement = $row["Nom_financement"];
							}

							 	
			echo "	</tr>
				<tr>
					<td> <label> Programme de travail </label> </td>
					<td> ";

					if ($Programme == '') {
						echo "	<input type='radio' name='P' value='Oui' /> <label> Oui </label> 
						<input type='radio' name='P' value='Non' /> <label> Non </label> ";
					}
					if ($Programme == 'Oui') {

					echo "	<input type='radio' name='P' value='Oui' checked='checked'/> <label> Oui </label> 
						<input type='radio' name='P' value='Non' /> <label> Non </label> ";
					}

					if ($Programme == 'Non') {
						echo "	<input type='radio' name='P' value='Oui' /> <label> Oui </label> 
						<input type='radio' name='P' value='Non' checked='checked'/> <label> Non </label>"; 
					}
				echo "	</td>
				</tr>
				<tr>
					<td> <label> Leader </label> </td>
					<td> ";
					
					
					if ($Leader == '') {
							echo	"<input type='radio' onchange='effacerLeader()' name='L' value='Oui' /> <label> Oui </label>
						<input type='radio' onchange='afficherLeader()' name='L' value='Non' /> <label> Non </label>
						<div id='champ' style='visibility:hidden'> Qui est le leader ? <input name='Nom_Leader' type='text' value='".$Nom_Leader."' </div> ";

					}

					if ($Leader == 'Oui') {

					echo	"<input type='radio' onchange='effacerLeader()' name='L' value='Oui' checked='checked'/> <label> Oui </label>
						<input type='radio' onchange='afficherLeader()' name='L' value='Non' /> <label> Non </label>
						<div id='champ' style='visibility:hidden'> Qui est le leader ? <input type='text' > </div> ";	
						}
					if ($Leader == 'Non') {
						echo	"<input type='radio' onchange='effacerLeader()' name='L' value='Oui' checked/> <label> Oui </label>
						<input type='radio' onchange='afficherLeader()' name='L' value='Non' checked='checked' /> <label> Non </label>";
					
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
						
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							$output = '<div id="champ" style="visibility:visible" > Qui est le leader ? <input name="Nom_Leader" type="text" value="'.$row['Nom_Leader'].'"> </div> '; 
							 
						}
   						echo $output;	 
					}
				echo "	</td>
				</tr>";
				if ($Domaine == 'R&D') {
					echo " <tr> <td> <label> Budget demandé </label> </td> ";
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
								// Exécution de la requête
								
								$output = '';
								
								

								$result = mysqli_query($connect, $rqSql);
								
								while($row = mysqli_fetch_array($result)) {
									
								$output .= '<td> <textarea class="text" name="Budget_demande">'.$row["Budget_demande"].'</textarea>  </td>';

					}
					echo $output; 
					echo "	</tr>";
					echo "<td> <label> Budget reçu </label> </td> ";
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
								// Exécution de la requête
								
								$output = '';
								
								

								$result = mysqli_query($connect, $rqSql);
								
								while($row = mysqli_fetch_array($result)) {
									
								$output .= '<td> <textarea class="text" name="budget_recu">'.$row["budget_recu"].'</textarea>  </td>';

					}
					echo $output; 
					echo "</tr>
					<tr> <td> <label> Code laboratoire </label> </td> 
					<td> <label> 201023295G </label> </td>
					</tr>";
				

					echo " </tr> <td> <label> Source de financement </label> </td> ";

					if ($Source == '') {
							echo	" <td> <input type='checkbox' onchange='effacerFinancement()' name='F[]' value='Interne' /> <label> Interne </label>
						<input type='checkbox' onchange='afficherFinancement()' name='F[]' value='Externe' /> <label> Externe </label> 
						<div id='champs' style='visibility:hidden'> Qui est la source ? <input type='text'  name='Nom_Financement' value='".$Nom_Financement."'> </div> </td> ";
					}

					if ($Source == 'Interne')  {
						

					echo	" <td> <input type='checkbox' onchange='effacerFinancement()' name='F[]' value='Interne' checked='checked'/> <label> Interne </label>
						<input type='checkbox' onchange='afficherFinancement()' name='F[]' value='Externe' /> <label> Externe </label> </td>";	
						}
					
					if ($Source == 'Interne / Externe')  {
						echo	" <td> <input type='checkbox' onchange='effacerFinancement()' name='F[]' value='Interne' checked='checked'/> <label> Interne </label>
						<input type='checkbox' onchange='afficherFinancement()' name='F[]' value='Externe' checked='checked'/> <label> Externe </label>
						<div id='champs' style='visibility:visible'> Qui est la source ? <input name='Nom_Financement' type='text' value='".$Nom_Financement."'> </div> </td>";
						}

					if ($Source == 'Externe') {
						echo	" <td> <input type='checkbox' onchange='effacerFinancement()' name='F[]' value='Interne'/> <label> Interne </label>
						<input type='checkbox' onchange='afficherFinancement()' name='F[]' value='Externe' checked='checked' /> <label> Externe </label>"; 

						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
								// Exécution de la requête
								
								$output = '';
								
								

								$result = mysqli_query($connect, $rqSql);
								
								while($row = mysqli_fetch_array($result)) {
									
								$output .= '<div id="champs" style="visibility:visible" > Qui est la source? <input name="Nom_Financement" type="text" value="'.$row['Nom_financement'].'"> </div>';

						}
						echo $output; 
					}
				}
			echo	" </td> <tr> 
					<td> <label> N° de convention interne </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <textarea class="text" name="NumConvention_interne">'.$row["NumConvention_interne"].'</textarea>  </td>';

				}
				echo $output;
			echo "	</tr>
			  <tr> 
					<td> <label> N° de convention externe </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <textarea class="text" name="NumConvention_externe">'.$row["NumConvention_externe"].'</textarea>  </td>';

				}
				echo $output;
			echo "	</tr>
			</table>

			<br><br>
			</div>

			<div class='tab_content' id='tabcontent2'>

			<table border='5' cellpadding='8' cellspacing='6'>
				<tr>
					<td> <label> Porteur du projet </label> </td> 
					<td>";
					?>
		<?php					
		if ($_SESSION['user_role'] == "ROLE_ADMIN") {

	echo 	"<div style='overflow-y:scroll;height:80px;background-color:white;width:210px;'> ";
	
	$rqSql = "SELECT * FROM tuser WHERE IdUser NOT IN ( SELECT RefUser FROM tprojet WHERE IdProjet =  $IdProjet) ";
	
	$output = '';
	
	$result = mysqli_query($connect, $rqSql);
								
	while($row = mysqli_fetch_array($result)) {
									
	$output .= '<input type="checkbox" name="Chef[]" id="$c" value="'.$row["IdUser"].' | ' .$row["user_name"] .'|' .$row["user_lastname"] .' "/>   
			<label for="$c" name="Chef[]">' .$row["user_lastname"] .' ' .$row["user_name"] .'</label> <br> ' ; 
								
	$c = $c + 1;
	}
	echo $output;
	echo "</div>";
	} else {
	
	$rqSql = "SELECT * FROM tprojet WHERE IdProjet = $IdProjet ORDER BY NomPorteur ASC";
								
	$output = '';
	
	$result = mysqli_query($connect, $rqSql);
								
	while($row = mysqli_fetch_array($result)) {
									
	$output .= '  <label> ' .$row["NomPorteur"].' ' .$row["PrenomPorteur"].' </label>' ; 
	}
	echo $output;
	
	
	}
							
	?>
			<?php
				echo 	"</td>
				</tr>
				<tr> 	
						<td> <label> Membre de l'équipe projet (interne) </label> </td>
						<td> ";
						?>
							<?php
							echo 	"<div style='overflow-y:scroll;height:80px;background-color:white;width:210px;'> ";
							$rqSql = "SELECT * FROM tuser WHERE IdUser NOT IN ( SELECT RefUser FROM tpersonne WHERE RefProjet = $IdProjet ) ORDER BY user_name ASC";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							

							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '
							 	<input type="checkbox" name="Personne[]" id="$c" value="'.$row["IdUser"].' | ' .$row["user_lastname"] .' | ' .$row["user_name"] .' | ' .$row["user_email"] .'" />   
							<label for="$c" name="personne[]">' .$row["user_lastname"] .' ' .$row["user_name"] .'</label><br>' ; 


							 $c = $c + 1;
							}
							echo $output;

							
						echo 	"</div>";
						?>

<?php
				echo 	" </td> 
				</tr>
				<tr>
				
					<td> <label>Membre de l'équipe projet (interne recruté) </label> </td> "; 
					
			$rqSql = "SELECT Nom_recruter FROM tpersonne_recruter ORDER BY Nom_recruter ASC"; 

			echo " <td>
				<input list='browsers' name='Nom_recruter' placeholder='Nom'>
				<datalist id='browsers'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
			 $output .= '
			     <option value="'.$row["Nom_recruter"].'">';
			}
			echo $output;
			echo	"</datalist>";

			$rqSql = "SELECT Prenom_recruter FROM tpersonne_recruter ORDER BY Prenom_recruter ASC"; 

			echo " 
				<input list='browsers2' name='Prenom_recruter' placeholder='Prénom'>
				<datalist id='browsers2'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Prenom_recruter"].'">';
			}
			echo $output;
			echo	"</datalist>";
			
			$rqSql = "SELECT Email_recruter FROM tpersonne_recruter ORDER BY Email_recruter ASC"; 

			echo " 
				<input list='browsers4' name='Email_recruter' placeholder='Email'>
				<datalist id='browsers4'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Email_recruter"].'">';
			}
			echo $output;
			echo	"</datalist>

			
				<select name='Categorie'>
					<option> Catégorie 1 </option>
					<option> Catégorie 2 </option>
					<option> Catégorie 3 </option>
					<option> Stagiaire   </option>
				</select>
			";
			
			$rqSql = "SELECT Date_de_debut_recruter FROM tpersonne_recruter ORDER BY Date_de_debut_recruter ASC"; 

			echo " 
				<input type='date' list='browsers5' name='Date_de_debut_recruter' placeholder='Date de début'>
				<datalist id='browsers5'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Date_de_debut_recruter"].'">';
			}
			echo $output;
			echo	"</datalist>";
			$rqSql = "SELECT Date_de_fin_recruter FROM tpersonne_recruter ORDER BY Date_de_fin_recruter ASC"; 

			echo " 
				<input type='date' list='browsers5' name='Date_de_fin_recruter' placeholder='Date de fin'>
				<datalist id='browsers5'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Date_de_fin_recruter"].'">';
			}
			echo $output;
			echo	"</datalist>
			</td>
			</tr>";
			?>

			<?php
				echo 	" </td> 
				</tr>
				<tr>
				
					<td> <label>Membre de l'équipe projet (externe) </label> </td> "; 
					 
			// echo " <td> <input type='text' name='Nom_externe' id='Nom_externe' placeholder='Nom'> <br> <br>
			// <input type='text' name='Prenom_externe' id='Prenom_externe' placeholder='Prénom'>
			$rqSql = "SELECT NomExt FROM tpersonne_externe ORDER BY NomExt ASC"; 

			echo " <td>
				<input list='browsers6' name='Nom_externe' placeholder='Nom'>
				<datalist id='browsers6'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
			 $output .= '
			     <option value="'.$row["NomExt"].'">';
			}
			echo $output;
			echo	"</datalist>";

			$rqSql = "SELECT PrenomExt FROM tpersonne_externe ORDER BY PrenomExt ASC"; 

			echo " 
				<input list='browsers7' name='Prenom_externe' placeholder='Prénom'>
				<datalist id='browsers7'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["PrenomExt"].'">';
			}
			echo $output;
			echo	"</datalist>";

			$rqSql = "SELECT Organisme FROM tpersonne_externe ORDER BY Organisme ASC"; 

			echo " 
				<input list='browsers8' name='Organisme' placeholder='Organisme'>
				<datalist id='browsers8'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Organisme"].'">';
			}
			echo $output;
			echo	"</datalist>";
			
			$rqSql = "SELECT EmailExt FROM tpersonne_externe ORDER BY EmailExt ASC"; 

			echo " 
				<input list='browsers9' name='EmailExt' placeholder='Email'>
				<datalist id='browsers9'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["EmailExt"].'">';
			}
			echo $output;
			echo	"</datalist>";
			
			$rqSql = "SELECT TelephoneExt FROM tpersonne_externe ORDER BY Telephone ASC"; 

			echo " 
				<input list='browsers10' name='Telephone_externe' placeholder='Telephone'>
				<datalist id='browsers10'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Telephone"].'">';
			}
			echo $output;
			echo	"</datalist>";

			$rqSql = "SELECT Statut FROM tpersonne_externe ORDER BY Statut ASC"; 

			echo " 
				<input list='browsers11' name='Statut' placeholder='Statut'>
				<datalist id='browsers11'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Statut"].'">';
			}
			echo $output;
			echo	"</datalist> <br/>";
			
			$rqSql = "SELECT Date_de_debut_externe FROM tpersonne_externe ORDER BY Date_de_debut_externe ASC"; 

			echo " 
				<input type='date' list='browsers12' name='Date_de_debut_externe' placeholder='Date de début'>
				<datalist id='browsers12'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Date_de_debut_externe"].'">';
			}
			echo $output;
			echo	"</datalist>";
			$rqSql = "SELECT Date_de_fin_externe FROM tpersonne_externe ORDER BY Date_de_fin_externe ASC"; 

			echo " 
				<input type='date' list='browsers13' name='Date_de_fin_externe' placeholder='Date de fin'>
				<datalist id='browsers13'>";

			$output = '';

		    $result = mysqli_query($connect, $rqSql);
			
			while($row = mysqli_fetch_array($result)) {
				
			 $output .= '
			  <option value="'.$row["Date_de_fin_externe"].'">';
			}
			echo $output;
			echo	"</datalist>
			</td>
			</tr>
			</td>
			</tr>
			</table>

			<br><br>
			</div>
			<div class='tab_content' id='tabcontent3'>

			<table id='idTable' border='5' cellpadding='8' cellspacing='6'>
				<tr> 

					<th> <label> Date </label> </th> 
					<th> <label> Description </label> </th> 
					<th> <label> Date de soumission </label> </th> 
					<th> <label> Date de réponse </label> </th> 
					<th> <label> Accepté  </label> </th>
				</tr>
				";
				
				
				$rqSql = "SELECT IdVieProjet,Date_vie_Projet,Description_Date_Projet,Date_de_soumission,Date_de_reponse,Acceptation from tVie_projet where RefProjet = $IdProjet ORDER BY Date_vie_Projet ASC";
							// Exécution de la requête
							
							 $output = '';


							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							
							 $Acceptation = $row["Acceptation"];
							
							 echo "<tr> <td> <input type='hidden' name='IdVieProjet' value='".$row['IdVieProjet']."' /> <input type='Date' name='date_vie' value='".$row['Date_vie_Projet']."'> </td> <td> <textarea class='text' name='description_date'>".$row['Description_Date_Projet']."</textarea> </td> <td> <input type='Date' name='date_soumission' value='".$row['Date_de_soumission']."'> </td> <td> <input type='Date' name='date_reponse' value='".$row['Date_de_reponse']."'> </td> ";		
								
							
							echo "<td>";
								
									if ($Acceptation == NULL) {
										echo "	<input type='checkbox' name='acceptation_projet' value='Accepté' /> <label> Oui </label> <br /> 
										<input type='checkbox' name='acceptation_projet' value='Pas accepté' /> <label> Non </label> ";
									}	
										if ($Acceptation == 'Accepté') {
					
										echo "	<input type='checkbox' name='acceptation_projet' value='Accepté' checked='checked'/> <label> Oui </label> <br /> 
											<input type='checkbox' name='acceptation_projet' value='Pas accepté' /> <label> Non </label> ";
										}
					
										if ($Acceptation == 'Pas accepté') {
											echo "	<input type='checkbox' name='acceptation_projet' value='Accepté' /> <label> Oui </label> <br /> 
											<input type='checkbox' name='acceptation_projet' value='Pas accepté' checked='checked'/> <label> Non </label>"; 
										}
										echo "</td>";
										echo "</tr>";
									}
									
									

							
							
							
					 
					
				
	echo 	" </table>
			<i class='far fa-plus-square' onclick='insererLigne_Fin()'> </i>
			<br><br>
			</div>
			<div class='tab_content' id='tabcontent4'>
			<table id='idTable1' border='5' cellpadding='8' cellspacing='6'>
				<tr> <td> <label> Description du document </label> </td> </tr>
				";
				$rqSql = "SELECT * from tDescription_projet where RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '
							 	<tr>  <td> <textarea class=" text" name="Description_doc">'.$row["Description_Document"].'</textarea> </td> <td> <a href="'.$row['Url_Fichier'].'">'.$row['Nom_Fichier'].' </a> </td> </tr>'  ; 
							}
							echo $output;
							
				echo "	 

			</table>
			<i class='far fa-plus-square' onclick='insererLigne_Fin1()'> </i>
			<br><br> 
			</div>
			</div>
			<tr> 
				<td> <a href='display_form.php?id=".$IdProjet."'>  <i class='fas fa-arrow-circle-left' title='retour'> </i>  </a> </td>
				<td> <input type='submit' class='button' value='Valider' title='valider la modification'> </td>
			</tr>
		</div>	
			

	</center>
</form>";
?>
</body>
</html>