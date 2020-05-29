<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Nouveau_Projet</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
        <link rel="stylesheet" type="text/css" href="../css/demo.css" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/animate-custom.css" />
        <link rel="stylesheet" type="text/css" href="../css/nav.css">
        <script>
            function insererLigne_Fin1() {
	    	var cell, ligne;
	 
	    	// on récupère l'identifiant (id) de la table qui sera modifiée
	    	var tableau = document.getElementById("MaTable1");
	    	// nombre de lignes dans la table (avant ajout de la ligne)
	    	var nbLignes = tableau.rows.length;
	 
	    	ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
	                                   	// le paramètre est dans ce cas (-1)
	 
	    	// création et insertion des cellules dans la nouvelle ligne créée
	    	cell = ligne.insertCell(0);
	    	cell.innerHTML = "<input type='text' name='Ajouter_domaine_technique[]' placeholder='Ajouter un domaine technique'>";
            }


            function insererLigne_Fin2() {
	    	var cell, ligne;
	 
	    	// on récupère l'identifiant (id) de la table qui sera modifiée
	    	var tableau = document.getElementById("MaTable2");
	    	// nombre de lignes dans la table (avant ajout de la ligne)
	    	var nbLignes = tableau.rows.length;
	 
	    	ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
	                                   	// le paramètre est dans ce cas (-1)
	 
	    	// création et insertion des cellules dans la nouvelle ligne créée
	    	cell = ligne.insertCell(0);
	    	cell.innerHTML = "<input type='text' name='Ajouter_substance[]' placeholder='Ajouter un type de substance'>";
            }

            function insererLigne_Fin3() {
	    	var cell, ligne;
	 
	    	// on récupère l'identifiant (id) de la table qui sera modifiée
	    	var tableau = document.getElementById("MaTable3");
	    	// nombre de lignes dans la table (avant ajout de la ligne)
	    	var nbLignes = tableau.rows.length;
	 
	    	ligne = tableau.insertRow(-1); // création d'une ligne pour ajout en fin de table
	                                   	// le paramètre est dans ce cas (-1)
	 
	    	// création et insertion des cellules dans la nouvelle ligne créée
	    	cell = ligne.insertCell(0);
	    	cell.innerHTML = "<input type='text' name='Ajouter_methode[]' placeholder='Ajouter un type de méthode'>";
            }
        
        </script>
		<style>
.table {
  border:solid 1px;
  border-collapse: collapse;
  text-align:center;
}
.table td {
  padding: 5px;
  border:solid 1px;
  border-collapse: collapse;
  text-align:center;
  bottom:0;
	top:100;
	position:relative;
}
.table th {
  text-align: center;
  border:solid 1px;
  border-collapse: collapse;
  text-align:center;
}
</style>
</head>

    <body>
<?php
        session_start();

        $connect = mysqli_connect("localhost", "root", "root", "bdprojet");
                                            
        $connect->set_charset("utf8") ;

        if (isset($_SESSION['username'])) {
            if (isset($_SESSION['mdp']))
            {
    echo "      <div id='cssmenu'>  
					<ul>
						<li><a href='../index.php'>Accueil</a></li>
						<li><a href='new_project.php'>Ajouter un projet</a></li>
						<li><a href='../my_project'>Mes projets</a></li>";
						if ($_SESSION['user_role'] == 'ROLE_ADMIN') {

echo "					<li><a href='Admin/Administration.php'>Administration</a></li>";
                            
                        }
                        
echo "					<li class='session submit'><a href='form_connection/disconnection.php'>Deconnexion</a></li>
						<li class='session'><a href='#'>".$_SESSION['user_name']." ".$_SESSION['user_lastname']."</a></li>
					</ul>
 				</div>  ";
            } else {
                header('Location:form_connection/disconnection.php');
            }
        } else {
            header('form_connection/disconnection.php');
        }
    ?> 

    

            <section>				
                <div id='container'>
                    <div id='wrapper'>
                        <div id='login' class='animate form'>
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
                            </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>