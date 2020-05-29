<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Formulaire</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
	<link rel="stylesheet" type="text/css" href="../css/Formulaire.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<script src="../js/jquery-3.4.1.js"> </script>
	<script>
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

$connect = mysqli_connect("localhost", "root", "root", "bdprojet") ;

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


echo "<form action='validate/validate_remove.php' enctype='multipart/form-data'>
	<center>
	<div class='tab_content_container'>
	<div class='tab_content tab_content_active' id='tabcontent1'>
		<br><br><br><br>

			
			<table border='5' cellpadding='8' cellspacing='6'>
				<tr>";

				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
						
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Code"].'  </label> </td> ';

				}
				echo $output; 


							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Acronyme"].'  </label> </td> ';

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
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label > '.$row["Intitule"].'  </label> </td>';

				}
				echo $output;
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label > '.$row["Statut_dossier"].'  </label> </td>';

				}
				echo $output;
			echo	"	</tr>
				<tr> ";

					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["UniteL"].' / ' .$row["UniteAssocier"].'  </label> </td> ';

				}
				echo $output; 
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Domaine"].'  </label> </td> ';

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

				$rqSql = "SELECT DATE_FORMAT(Date_de_debut, '%d/%m/%Y') as Date_de_debut from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
						

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label> Date de début : ' .$row["Date_de_debut"].'  </label> </td> ';

				}
				echo $output; 
				$rqSql = "SELECT DATE_FORMAT(Date_de_fin_prevue, '%d/%m/%Y') as Date_de_fin_prevue from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label> Date de fin prévue : ' .$row["Date_de_fin_prevue"].'  </label> </td> ';
							 }
				echo $output; 
					$rqSql = "SELECT DATE_FORMAT(Date_de_fin, '%d/%m/%Y') as Date_de_fin from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label> Date de fin : ' .$row["Date_de_fin"].'  </label> </td> ';
							 }
				echo $output; 

				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Statut_projet"].'  </label> </td> ';

				}
				echo $output; 

			echo		"
				 
				</tr>
			</table>	

			<br><br>
		
			<table border='5' cellpadding='8' cellspacing='6'>
				<tr>
					<td> <label> Description </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Description_Projet"].'  </label> </td> ';

							 $Domaine = $row['Domaine'];

				}
				echo $output; 
			echo "	</tr>
				<tr>
					<td> <label> Programme de travail </label> </td>";
					
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Programme_de_travail"].'  </label> </td> ';

							}
							echo $output;
				echo "</tr>
				<tr>
					<td> <label> Leader </label> </td>";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Leader"].' '.$row['Nom_Leader'] . ' </label> </td> ';

				}
				echo $output; 
				echo "
				</tr>";
				if ($Domaine == 'R&D') {
					echo " <tr> <td> <label> Budget demandé </label> </td> ";
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
								// Exécution de la requête
								
								$output = '';
								
								

								$result = mysqli_query($connect, $rqSql);
								
								while($row = mysqli_fetch_array($result)) {
									
								$output .= '<td> <label>' .$row["Budget_demande"].'   </label> </td> ';

					}
					echo $output; 

					echo "</tr>";
					echo "<td> <label> Budget reçu </label> </td> ";
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
								// Exécution de la requête
								
								$output = '';
								
								

								$result = mysqli_query($connect, $rqSql);
								
								while($row = mysqli_fetch_array($result)) {
									
								$output .= '<td> <label>' .$row["budget_recu"].'   </label> </td> ';

					}
					echo $output; 
					echo "</tr>
					<tr> <td> <label> Code laboratoire </label> </td> 
					<td> <label> 201023295G </label> </td>
					</tr>";
				}

				echo "<td> <label> Source de financement </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["source_financement"].' '.$row["Nom_financement"].'</label> </td> ';

				}
				echo $output; 

			echo "	<tr> 
					<td> <label> N° de convention interne </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["NumConvention_interne"].'  </label> </td> ';

				}
				echo $output; 
			echo 	"</tr>
				<tr> 
					<td> <label> N° de convention externe </label> </td> ";
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["NumConvention_externe"].'  </label> </td> ';

				}
				echo $output; 
			echo 	"</tr>
			</table>

			<br><br>
			</div>
			<div class='tab_content' id='tabcontent2'>

			<table border='5' cellpadding='8' cellspacing='6'>
				<tr>

				<td> <label> Porteur du projet </label> </td> ";
				?>
					<?php
						
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
						// Exécution de la requête
						
						 $output = '';
						
						
						echo "<td>";
						 $result = mysqli_query($connect, $rqSql);
						
						while($row = mysqli_fetch_array($result)) {
							
						 $output .= ' <label> ' .$row["NomPorteur"].' ' .$row["PrenomPorteur"].' </label> ';
						 }
			echo $output; 
							
						?>
			<?php
				echo "</form>";
				echo 	"</td> <td rowspan='3' class='supprimer'> <input type='submit' value='Supprimer' class='button'> </td>
				</tr>
				<tr> 	
						<td> <label> Membre de l'équipe projet (interne) </label> </td>
						<td> 
						";
						?>
							<?php
							echo 	"


							<div style='overflow-y:scroll;height:80px;background-color:white;width:210px;'> ";
							$rqSql = "SELECT * FROM tpersonne  WHERE RefProjet = $IdProjet  ORDER BY NomP ASC";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							

							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '
							 	<input type="checkbox" name="Personne[]" id="$c" value="'.$row["IdPersonne"] .' - '.$row["RefProjet"].'" />   
							<label for="$c" name="personne[]">' .$row["NomP"] .' ' .$row["PrenomP"] .'</label><br>' ; 


							 $c = $c + 1;
							}
							echo $output;

							
						echo 	"</div>
						

						</td>
			
				</tr>
				<tr>
					<td> <label>Membre de l'équipe projet (interne recruté) </label> </td>  
					<td> <div style='overflow-y:scroll;height:80px;background-color:white;width:210px;'> ";
							$rqSql = "SELECT * FROM tpersonne_recruter  WHERE RefProjet = $IdProjet  ORDER BY Nom_recruter ASC";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							

							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '
							 	<input type="checkbox" name="Personne_recruter[]" id="$c" value="'.$row["IdPersonne_recruter"] .' - '.$row["RefProjet"].'" />   
							<label for="$c" name="Personne_recruter[]">' .$row["Nom_recruter"] .' ' .$row["Prenom_recruter"] .'</label><br>' ; 


							 $c = $c + 1;
							}
							echo $output;

							
						echo 	"</div> </td>
				</tr>";
						?>

				<?php
			echo "	 </td>
			
				</tr>
				<tr>
					<td> <label>Membre de l'équipe projet (externe) </label> </td>  
					<td> <div style='overflow-y:scroll;height:80px;background-color:white;width:210px;'> ";
							$rqSql = "SELECT * FROM tpersonne_externe  WHERE RefProjet = $IdProjet  ORDER BY NomExt ASC";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							

							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '
							 	<input type="checkbox" name="Personne_externe[]" id="$c" value="'.$row["IdPersonneExt"] .' - '.$row["RefProjet"].'" />   
							<label for="$c" name="Personne_externe[]">' .$row["NomExt"] .' ' .$row["PrenomExt"] .'</label><br>' ; 


							 $c = $c + 1;
							}
							echo $output;

							
						echo 	"</div> </td>
				</tr>
			</table>

			<br><br>
			</div>
			<div class='tab_content' id='tabcontent3'>

			<table id='idTable' border='5' cellpadding='8' cellspacing='6'>
				<tr> 
					<td> <label> Date </label> </td> 
					<td> <label> Description </label> </td> 
					<td> <label> Date de soumission </label> </td> 
					<td> <label> Date de réponse </label> </td> 
					<td> <label> Accepté / Pas accepté </label> </td>
				</tr>
				 ";
				$rqSql = "SELECT DATE_FORMAT(Date_vie_Projet, '%d/%m/%Y') as Date_vie_Projet,Description_Date_Projet, IdVieProjet,RefProjet from tVie_projet where RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= ' <tr> <td> <label>' .$row["Date_vie_Projet"].'  </label> </td> <td> <label>' .$row["Description_Date_Projet"].'  </label> </td>';

				}
				echo $output; 

				$rqSql = "SELECT DATE_FORMAT(Date_de_soumission, '%d/%m/%Y') as Date_de_soumission from tVie_projet where RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Date_de_soumission"].'  </label> </td>';

				}
				echo $output;
				
				$rqSql = "SELECT DATE_FORMAT(Date_de_reponse, '%d/%m/%Y') as Date_de_reponse,Acceptation,IdVieProjet,RefProjet from tVie_projet where RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Date_de_reponse"].'  </label> </td> <td> <label>' .$row["Acceptation"].'  </label> </td> <td class="supprimer"> <a href="validate/validate_remove.php?IdVieProjet=' .$row["IdVieProjet"].'&IdProjet='.$row['RefProjet'].'"> <i class="far fa-minus-square"></i> </a>  </td> </tr>';

				}
				echo $output; 
				
			echo"	
			</table>
			<br><br>
			</div>
			<div class='tab_content' id='tabcontent4'>
			<table id='idTable1' border='5' cellpadding='8' cellspacing='6'>
				<tr> <td> <label> Description du document </label> </td> </tr>";
				
				$rqSql = "SELECT * FROM `tprojet` JOIN tdescription_projet ON tprojet.IdProjet = tdescription_projet.RefProjet WHERE RefProjet = $IdProjet";
				// Exécution de la requête
				
				 $output = '';
				

				 $result = mysqli_query($connect, $rqSql);
				
				while($row = mysqli_fetch_array($result)) {
					
				 $output .= '
					 <tr>  <td> <textarea class=" text" name="Description_Document">'.$row["Description_Document"].'</textarea> </td> <td> <a href="'.$row['Url_Fichier'].'" >'.$row['Nom_Fichier'].' </a> <td class="supprimer"> <a href=validate/validate_remove.php?IdDescriptionProjet='.$row["IdDescriptionProjet"].'&IdProjet='.$row['RefProjet'].'&NomFichier='.$row["Nom_Fichier"].'&Acronyme='.$row['Acronyme'].'> <i class="far fa-minus-square"></i> </A>  </td>
					</td> </tr>'  ; 
				}
				echo $output;
							
				echo "	
			
			</table>
		
			<br><br>
			</div>
			</div>
			<tr> 
				<td> <a href='display_form.php?id=".$IdProjet."' title='retour'> <i class='fas fa-arrow-circle-left'> </i> </a> </td>
			</tr>
			</div>
	</center>
</form>";
?>




</body>
</html>