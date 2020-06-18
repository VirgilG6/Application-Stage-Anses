<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Formulaire</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
	<link rel="stylesheet" type="text/css" href="../css/Formulaire.css">
	<link rel="stylesheet" media="print" href="../css/impression.css">
	<script>
		function edition() { window.print(); }
	</script>
</head>
<body>


<?php

session_start();

$IdProjet = $_GET['id'];

$connect = mysqli_connect("localhost", "root", "root", "bdprojet") ;

$connect->set_charset("utf8") ;


echo "<form enctype='multipart/form-data'>
	<center>
		
		<img src='../images/logo.png'/> <br /> <br /> <br /> <br /> <br /> <br />  <h1 id='title'> Suivi de projet </h1>
		

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
							
							$result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
								
							$output .= '<td> <label> ' .$row["Type_substance"].' </label> </td>';
							}
				echo $output;


							$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							$output = '';
							
							$result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
								
							$output .= '<td> <label> ' .$row["Type_methode"].' </label> </td>';
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
							    
							 $output .= '<td> <label>' .$row["UniteL"].' / ' .$row["UniteAssocier"].' </label> </td> ';

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
							
							$result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
								
							$output .= '<td> <label> ' .$row["Domaine_technique"].' </label> </td>';
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

						echo "</tr>
						<tr> <td> <label> Budget reçu </label> </td> ";
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
						</tr>
						
						<tr> <td> <label> Source de financement </label> </td> ";
						$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
									
							$output = '';

							$result = mysqli_query($connect, $rqSql);
									
							while($row = mysqli_fetch_array($result)) {
										
							$output .= '<td> <label>' .$row["source_financement"].' '.$row["Nom_financement"].'</label> </td> ';

						}
						echo $output; 
						echo "</tr>";
					} 
					

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


			<table border='5' cellpadding='8' cellspacing='6'>
				<tr> <thead> <h2> EQUIPE </h2> </thead> </tr>
				<tr>
					<td> <label> Porteur du projet </label> </td>"; 
					$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							
							echo "<td>";
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= ' <label> ' .$row["NomPorteur"].' ' .$row["PrenomPorteur"].' </label> ';
							 }
				echo $output; 
					
			echo " </td> </tr>
				<tr> 
						<td> <label> Membre de l'équipe projet (interne) </label> </td> ";
						$rqSql = "SELECT * FROM tpersonne  WHERE RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							
							echo "<td>";
							
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= ' <label> ' .$row["NomP"].' ' .$row["PrenomP"].' |  </label> ';
							 }
				echo $output; 
						
			echo "	 </td> 
			 </tr>
				<tr> 
						<td> <label> Membre de l'équipe projet (interne recruté) </label> </td> ";
						$rqSql = "SELECT * FROM tpersonne_recruter  WHERE RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							
							echo "<td>";
							
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= ' <label> ' .$row["Nom_recruter"].' ' .$row["Prenom_recruter"].' |  </label> ';
							 }
				echo $output; 
						
			echo "	 </td> 
				</tr>
				<tr>
					<td> <label>Membre de l'équipe projet (externe) </label> </td> ";
					$rqSql = "SELECT * FROM tpersonne_externe WHERE RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							
							echo "<td>";
							
							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= ' <label> ' .$row["NomExt"].' ' .$row["PrenomExt"].' |  </label> ';
							 }
				echo $output; 

					
			echo " </td>	</tr>
			</table>

			<br><br>


			<table id='idTable' border='5' cellpadding='8' cellspacing='6'>
				<tr> <thead> <h2> VIE DU PROJET </h2> </thead> </tr>
				<tr> 
					<td> <label> Date </label> </td> 
					<td> <label> Description </label> </td> 
					<td> <label> Date de soumission </label> </td> 
					<td> <label> Date de réponse </label> </td> 
					<td> <label> Accepté/Pas accepté </label> </td>
				</tr>
				 ";
				$rqSql = "SELECT DATE_FORMAT(Date_vie_Projet, '%d/%m/%Y') as Date_vie_Projet,Description_Date_Projet from tVie_projet where RefProjet = $IdProjet";
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
				
				$rqSql = "SELECT DATE_FORMAT(Date_de_reponse, '%d/%m/%Y') as Date_de_reponse,Acceptation from tVie_projet where RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							
							$c = 1;

							 $result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '<td> <label>' .$row["Date_de_reponse"].'  </label> </td> <td> <label>' .$row["Acceptation"].'  </label> </td> </tr>';

				}
				echo $output; 
				
			echo"	
			</table>
			<br><br>


			<table id='idTable1' border='5' cellpadding='8' cellspacing='6'>
				<tr> <thead> <h2> DOCUMENTS ASSOCIES (Lettre d'intention, mip, réponse) </h2> </thead> </tr>
				<tr> <td> <label> Description du document </label> </td> </tr>";
				
					$rqSql = "SELECT * from tDescription_projet where RefProjet = $IdProjet";
							// Exécution de la requête
							
							 $output = '';
							

							$result = mysqli_query($connect, $rqSql);
							
							while($row = mysqli_fetch_array($result)) {
							    
							 $output .= '
							 	<tr>  <td> <label> '.$row["Description_Document"].'</label> </td> <td> <a href="'.$row['Url_Fichier'].'">'.$row['Nom_Fichier'].' </a> </td> </tr>'  ; 
							}
							echo $output;
				echo "	
			
			</table>
			<br><br>";
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";

				$result = mysqli_query($connect, $rqSql);
							
				while($row = mysqli_fetch_array($result)) 
				{

					$Statut_dossier = $row["Statut_dossier"];
					$Statut_projet =  $row["Statut_projet"];
					$PrenomPorteur = $row["PrenomPorteur"];
					$NomPorteur = $row["NomPorteur"];

					echo "<table id='table_fa'>
								<tr> 
								<td> <a href='../index.php' title='retour'> <i class='fas fa-arrow-circle-left'> </i> </a> </td>";
					if ($Statut_dossier != 'Non retenu')
					{
						if ($Statut_projet != 'Cloturé') 
						{
							if($PrenomPorteur = $_SESSION['user_name'] && $PrenomPorteur != '')
							 {
								if($NomPorteur = $_SESSION['user_lastname'] && $PrenomPorteur != '') 
								{
							
									echo "	<td> <a href='display_form.php?id=".$IdProjet."' onclick='edition();' title='Imprimer'><i class='fas fa-file-pdf'></i></a> </td>
									<td> <a href='edit_form.php?id=".$IdProjet."' title='Modifier'> <i class='fas fa-edit'></i> </a> </td>	
											<td> <a href='remove_form.php?id=".$IdProjet."' title='Supprimer'> <i class='fas fa-calendar-times'></i> </a> </td> 			
										</tr>
									</table>";
								} elseif($_SESSION['user_role'] == 'ROLE_ADMIN') 
								{
									echo "	<td> <a href='display_form.php?id=".$IdProjet."' onclick='edition();' title='Imprimer'><i class='fas fa-file-pdf'></i></a> </td>
									<td> <a href='edit_form.php?id=".$IdProjet."' title='Modifier'> <i class='fas fa-edit'></i> </a> </td>	
											<td> <a href='remove_form.php?id=".$IdProjet."' title='Supprimer'> <i class='fas fa-calendar-times'></i> </a> </td> 			
										</tr>
									</table>";
								}
							} elseif($_SESSION['user_role'] == 'ROLE_ADMIN') 
							{
								echo "	<td> <a href='display_form.php?id=".$IdProjet."' onclick='edition();' title='Imprimer'><i class='fas fa-file-pdf'></i></a> </td>
								<td> <a href='edit_form.php?id=".$IdProjet."' title='Modifier'> <i class='fas fa-edit'></i> </a> </td>	
										<td> <a href='remove_form.php?id=".$IdProjet."' title='Supprimer'> <i class='fas fa-calendar-times'></i> </a> </td> 			
									</tr>
								</table>";
							}
						} 
					} 
				}
				
echo "	</center>
</form>";
?>




</body>
</html>