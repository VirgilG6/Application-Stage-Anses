# Présentation de l'application de suivi de projets
![alt text](https://github.com/VirgilG6/Application-Stage-Anses/blob/master/assets/accueil.png)

## Installation
1. Créer un espace de stockage sur votre ordinateur (exemple: suivi_de_projets):
```
cd suivi_de_projets
```

2. Cloner le projet en utilisant la commande suivante: 
```
git clone https://github.com/VirgilG6/Application-Stage-Anses.git
```

## Objectif
### Contexte
Pour le suivi des projets, l’entreprise utilisait un tableau Excel. Toute les cases du tableau n’était pas remplies car les chefs de projets ne prenaient pas le temps de tout remplir ou ils ne savaient pas comment en remplir certaines.

### Objet de la mission
La mission était de remplacer le tableau Excel par une application web qui serait disponible sur l’Intranet de l’entreprise.


## Étapes
### Étape 1
La première étape, était d’analyser le tableau Excel qu’on nous avait fourni pour faire le Modèle Entité Association (MEA) et le Modèle Relationnel (MR).

![alt text](https://github.com/VirgilG6/Application-Stage-Anses/blob/master/assets/MEA.png)

![alt text](https://github.com/VirgilG6/Application-Stage-Anses/blob/master/assets/MR.png)

### Étape 2
Après avoir fait le Modèle Entité Association et le Modèle Relationnel, nous avons pu créer la base de données.

### Étape 3
Ensuite, nous avons créer l’interface de l’application ainsi que la création d’un nouveau projet et la visualisation des formulaires de suivi de projets.

#### Création d'un nouveau projet
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

### Étape 4
1. Solutions envisageables
2. Solution choisie
3. Comment c’est fait le choix ?
### Étape 5
1. Solutions envisageables
2. Solution choisie
3. Comment c’est fait le choix ?
### Étape 6
1. Solutions envisageables
2. Solution choisie
3. Comment c’est fait le choix ?
### Étape 7
1. Solutions envisageables
2. Solution choisie
3. Comment c’est fait le choix ?

## Compétences
### Quelles compétences ont été validé ?
### Justification

## Conclusion
### Difficultés rencontrées
### Comment l'application pourrait être amélioré ?
