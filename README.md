# Presentation of the project tracking application
![alt text](https://github.com/VirgilG6/Application-Stage-Anses/blob/master/assets/accueil.png)

## Installation
1. Create storage space on your computer:
```
cd suivi_de_projets
```

2. Clone the project using the following command:
```
git clone https://github.com/VirgilG6/Application-Stage-Anses.git
```


## Objective
### Background
For project tracking, the company used an Excel spreadsheet. Not all the boxes in the table were filled in because project managers did not take the time to fill in everything or did not know how to fill in some of them.

### Object of the mission
The mission was to replace the Excel table with a web application that would be available on the company's Intranet.


## Steps
### Step 1
The first step was to analyze the Excel spreadsheet we were provided to do the Association Entity Model (AEM) and the Relationship Model (RM).

![alt text](https://github.com/VirgilG6/Application-Stage-Anses/blob/master/assets/MEA.png)

![alt text](https://github.com/VirgilG6/Application-Stage-Anses/blob/master/assets/MR.png)

### Step 2
After doing the Association Entity Model and the Relational Model, we were able to create the database.
```
DROP DATABASE IF EXISTS BDPROJET ;

#-------------------------------------------------------------------------------
#  Cr�er la BD
#

CREATE DATABASE BDPROJET ;

#-------------------------------------------------------------------------------
#  Utiliser la BD
#

USE BDPROJET ;

#-------------------------------------------------------------------------------
#  Cr�er la Table
#


CREATE TABLE tuser
(
	IdUser INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	user_login 	varchar(60) NOT NULL,
	user_password   varchar(64) NOT NULL,
	user_email	varchar(100)NOT NULL,
	user_role       varchar(60) NOT NULL,
	user_lastname	varchar(60) NOT NULL,
	user_name 	varchar(60) NOT NULL
) ;

CREATE TABLE tprojet
(	IdProjet			INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Code 				CHAR( 10 )	,
	Acronyme  			CHAR( 50 )	,
	Intitule			TEXT( 2000 )	,
	Statut_projet	CHAR( 10 ),
	Statut_dossier	CHAR( 20 ),	
	UniteL CHAR( 50 )	,
	UniteAssocier CHAR( 50 )	,
	Domaine CHAR( 50 )	,
	Domaine_technique CHAR( 50 )	,
	Type_substance CHAR( 50 )	,
	Type_methode CHAR( 50 )	,
	PrenomPorteur CHAR( 50 ),
	NomPorteur CHAR( 50 ),
	Date_de_debut CHAR(10) ,
	Date_de_fin_prevue CHAR(10) ,
	Date_de_fin CHAR(10) ,
	Description_Projet CHAR(255) ,
	Programme_de_travail CHAR(5) ,
	Leader CHAR(5) ,
	Nom_Leader CHAR(255),
	Budget_demande INT(30) ,
	budget_recu INT(11),
	source_financement CHAR(255),
	Nom_financement CHAR(255),
	NumConvention_interne CHAR(50),
	NumConvention_externe CHAR(50),
	RefUser INT,

	FOREIGN KEY (RefUser) REFERENCES tuser(IdUser) ON DELETE CASCADE

) ;

CREATE TABLE tVie_projet
(	IdVieProjet INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Date_vie_Projet CHAR(10)  ,
	Description_Date_Projet CHAR(255)  , 
	Date_de_soumission CHAR(10)  ,
	Date_de_reponse CHAR(10)  ,
	Acceptation CHAR(50)  ,
	RefProjet INT NOT NULL,  
	
	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
);

CREATE TABLE tDescription_projet
(	IdDescriptionProjet INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Description_Document CHAR(255), 
	Url_Fichier VARCHAR(255),
	Nom_Fichier VARCHAR(255),
	RefProjet INT ,  
	
	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
);


CREATE TABLE tpersonne
(	IdPersonne INT		NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	NomP	CHAR ( 50 ) ,
	PrenomP  CHAR ( 30  )  ,
	EmailP   CHAR ( 100 ) ,	
	RefProjet INT,
	RefUser INT,

	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE,
	FOREIGN KEY (RefUser) REFERENCES tuser(IdUser) ON DELETE CASCADE
) ;


CREATE TABLE tpersonne_recruter
(	IdPersonne_recruter INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Nom_recruter	CHAR ( 50 ) ,
	Prenom_recruter  CHAR ( 30  )  ,
	Email_recruter   CHAR ( 100 ) ,
	Categorie CHAR ( 255 ) , 
	Date_de_debut_recruter CHAR(10) ,
	Date_de_fin_recruter CHAR(10) ,
	RefProjet INT,
	
	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
) ;


CREATE TABLE tpersonne_externe
(	IdPersonneExt INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	NomExt	CHAR ( 50 ) ,
	PrenomExt  CHAR ( 30  )  ,
	Organisme CHAR ( 255 ) , 
	EmailExt CHAR ( 100 ) , 
	Telephone CHAR (10) ,
	Statut CHAR ( 255 ) , 
	Date_de_debut_externe CHAR(10) ,
	Date_de_fin_externe CHAR(10) ,
	RefProjet INT,

	FOREIGN KEY (RefProjet) REFERENCES tprojet(IdProjet) ON DELETE CASCADE
) ;


CREATE TABLE tdomtech
(
	IdDomTech INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Domainetechnique CHAR( 50 )
);


CREATE TABLE ttypesubstance
(
	IdTypeSubstance INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Typesubstance CHAR( 50 )
);


CREATE TABLE ttypemethode
(
	IdTypeMethode INT	NOT NULL 	PRIMARY KEY	AUTO_INCREMENT,
	Typemethode CHAR( 50 )
);


INSERT INTO tuser(user_login,user_password,user_email,user_role,user_lastname,user_name)
VALUES
("admin","9cf95dacd226dcf43da376cdb6cbba7035218921","intranetfougeres@anses.fr","ROLE_ADMIN","admin","admin");


INSERT INTO tdomtech(Domainetechnique)		
VALUES	
("Analytique"),
("Pharmacocinétique"),
("Pharmacodynamie"),
("Toxicocinétique"),
("Toxicodynamie"),
("Bactériologie"),
("Expérimentation animale"),
("Biologie moléculaire"),
("Statistiques"),
("Modèle mathématique");

INSERT INTO ttypesubstance(Typesubstance)		
VALUES	
("Antibiotiques"),
("Biocides désinfectants"),
("Toxines"),
("Nano-matériaux");

INSERT INTO ttypemethode(Typemethode)		
VALUES	
("LC-MSMS"),
("QPCR"),
("HCS"),
("LC-UV/FLUO"),
("WGS"),
("Microscopie"),
("Métagénomique");
```

### Step 3
Then we created the interface of the application as well as the creation of a new project and the visualization of the project tracking forms.

#### Create a new project
```
<form  action='validate/validate_new_project.php' >
    <h1> creation d'un nouveau projet </h1> 
        <p> 
            <label for='Code' class='uname' > Votre Code </label> <br/> <br/>
            <input id='username' name='Code' required type='text' value='<?php
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
                                                                            echo $motcomplet;
                                                                                                        

            

                                                                                                        
                                                                        ?>' />
        </p>
        <p>
            <label for='UniteL' class='uname'> Choisisser l'unité du porteur de projet </label>
                                    
            <table class="table" style='width:100%'>
                <tr>
                    <th> ARC </th> <th> TC </th> <th> AB2R </th> <th> EMAD </th> <th> Direction </th>
                </tr> 
                <tr>
                    <td> <input type='radio' name='UniteL' value='ARC'> </td> <td> <input type='radio' name='UniteL' value='TC'> </td> <td> <input type='radio' name='UniteL' value='AB2R'> </td> <td> <input type='radio' name='UniteL' value='EMAD' > </td> <td> <input type='radio' name='UniteL' value='Direction' > </td>
                </tr>
            </table>
        </p>
        <p>
            <label for='UniteAssocier' class='uname'> Choisisser le/les unité(s) associée(s) </label>
                                    
            <table class="table" style='width:100%'>
                <tr>
                    <th> ARC </th> <th> TC </th> <th> AB2R </th> <th> EMAD </th> <th> Direction </th>
                </tr> 
                <tr>
                    <td> <input type='checkbox' name='UniteAssocier[]' value='ARC'> </td> <td> <input type='checkbox' name='UniteAssocier[]' value='TC'> </td> <td> <input type='checkbox' name='UniteAssocier[]' value='AB2R'> </td> <td> <input type='checkbox' name='UniteAssocier[]' value='EMAD' > </td> <td> <input type='checkbox' name='UniteAssocier[]' value='Direction' > </td>
                </tr>
            </table>
        </p>
        <p>
            <label for='Domaine' class='uname'> Choisisser votre domaine </label>
                                    
            <table class="table" style='width:100%'>
                <tr>
                    <th> R&D </th> <th> Référence </th> <th> Laboratoire </th>
                </tr> 
                <tr>
                    <td> <input type='radio' name='Domaine' value='R&D'> </td> <td> <input type='radio' name='Domaine' value='Référence'> </td> <td> <input type='radio' name='Domaine' value='Laboratoire'> </td> 
                </tr>
            </table>
        </p>
        <p>
            <label for='Domainetechnique' class='uname'> Choisisser votre/vos domaine(s) technique(s) </label>
                                        
            <div style='overflow-y:scroll;height:103px;background-color:white;width:300px;'>   
                <table id='MaTable1'>
                    <tr>
                        <?php 
                            $rqSql = "SELECT * from tdomtech ";
                            // Exécution de la requête
                                                            
                            $output = '';
                                                            
                            $result = mysqli_query($connect, $rqSql);
                                                            
                            while($row = mysqli_fetch_array($result)) {
                                                                
                            $output .= '<input name="Domaine_technique[]" type="checkbox" value="'.$row['Domainetechnique'].'">  <label name="Domaine_technique[]"> '.$row['Domainetechnique'].' </label><br />';

                            }
                            echo $output; 
                        ?>
                    </tr>
                </table>
                                            
                <i title="Ajouter un domaine technique" class='far fa-plus-square' onclick='insererLigne_Fin1()'> </i>
            </div>
        </p>
        <p>
            <label for='Typesubstance' class='uname'> Choisisser votre/vos type(s) de substance(s) </label>
            <div style='overflow-y:scroll;height:103px;background-color:white;width:300px;'>
                <table id='MaTable2'>
                    <tr>
                        <?php
                            $rqSql = "SELECT * from ttypesubstance ";
                            // Exécution de la requête
                                                            
                            $output = '';
                                                            
                            $result = mysqli_query($connect, $rqSql);
                                                            
                            while($row = mysqli_fetch_array($result)) {
                                                                
                            $output .= '<input name="Type_substance[]" type="checkbox" value="'.$row['Typesubstance'].'"> <label name="Type_substance[]"> '.$row['Typesubstance'].' </label><br>';

                            }
                            echo $output; 
                        ?>
                    </tr>
                </table>
                <i title="Ajouter un type de substance" class='far fa-plus-square' onclick='insererLigne_Fin2()'> </i>
            </div>
        </p>
        <p>
            <label for='Typemethode' class='uname'> Choisisser votre/vos type(s) de méthode(s) </label>
            <div style='overflow-y:scroll;height:103px;background-color:white;width:300px;'>
                <table id='MaTable3'>
                    <tr>
                        <?php 
                            $rqSql = "SELECT * from ttypemethode ";
                            // Exécution de la requête
                                            
                            $output = '';
                                            
                            $result = mysqli_query($connect, $rqSql);
                                            
                            while($row = mysqli_fetch_array($result)) {
                                                
                            $output .= '<input name="Type_methode[]" type="checkbox" value="'.$row['Typemethode'].'"> <label name="Type_methode[]"> '.$row['Typemethode'].' </label><br>';

                            }
                            echo $output; 
                        ?>
                    </tr>
                </table>
                <i title="Ajouter un type de méthode" class='far fa-plus-square' onclick='insererLigne_Fin3()'> </i>
            </div>
        </p> 
        <p> 
            <label for='Acronyme' class='uname' >  Entrer votre Acronyme </label> 
            <input id='username' name='Acronyme' required type='text' placeholder='Entrez votre Acronyme'/>
        </p>
        <p> 
            <label for='Intitulé' class='uname'>  Entrer votre Intitulé </label> 
            <input id='username' name='Intitule' required type='text' placeholder='Entrez votre Intitulé'/>
        </p>
        <p class='login button'> 
            <a href='../index.php'>  <i class='fas fa-arrow-circle-left' title='retour'> </i>  <input type='submit' value='Valider' /> 
        </p>
</form>
```

#### Viewing forms
```
echo "<form enctype='multipart/form-data'>
	<center>
		<img src='../images/Anses_logo.jpg'/> <br /> <br /> <br /> <br /> <br /> <br />  <h1 id='title'> Suivi de projet </h1>
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

			echo	"</tr>
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
					...
			echo "</tr>
			<tr>
				<td> <label> Leader </label> </td>";
                    ...
			echo "</tr>";
			if ($Domaine == 'R&D') {
			echo " <tr> <td> <label> Budget demandé </label> </td> ";
                    ...
            echo "</tr>
			<tr> <td> <label> Budget reçu </label> </td> ";
                    ...
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
					
            echo "	<tr> <td> <label> N° de convention interne </label> </td> ";
				$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
				// Exécution de la requête
							
				$output = '';
							
			    $result = mysqli_query($connect, $rqSql);
							
				while($row = mysqli_fetch_array($result)) {							    
				    $output .= '<td> <label>' .$row["NumConvention_interne"].'  </label> </td> ';
				}
				echo $output; 
			echo 	"</tr>
				<tr> <td> <label> N° de convention externe </label> </td> ";
                        ...
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
			echo "	 </td> </tr>
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
			echo "	 </td> </tr>
				<tr> <td> <label>Membre de l'équipe projet (externe) </label> </td> ";
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
				...
                ...
		echo"</table>
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
		echo "	</table>
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
```

### Step 4
1. Potential solutions
2. Solution chosen
3. How did you choose ?
### Step 5
1. Potential solutions
2. Solution chosen
3. How did you choose ?
### Step 6
1. Potential solutions
2. Solution chosen
3. How did you choose ?
### Step 7
1. Potential solutions
2. Solution chosen
3. How did you choose ?


## Skills
### Which skills have been validated ?
The skills that have been validated are participation in an IS evolution project (application and infrastructure solution focusing on the candidate's area of specialisation), handling incidents and requests for assistance related to the candidate's area of specialisation, drawing up documents relating to production and supply, proposing an application solution, designing or adapting the user interface of an application solution and designing or adapting a database.

### Justification
You can find my project, my documentation (use and administration) and the project database (assets folder) on my GitHub (https://github.com/VirgilG6/Application-Stage-Anses).


## Conclusion
### Difficulties encountered
The difficulties encountered are the automatic generation of a new project code, comprising two letters and two numbers, for each project created and being able to generate a PDF thanks to a button used for this purpose.

### How could the application be improved ?
The application could be improved with statistics such as the number of projects per unit, the number of inter-unit projects, ...
