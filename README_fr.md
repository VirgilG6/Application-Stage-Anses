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

#### Création d’un nouveau code projet
```
<label for='Code' class='uname' > Votre Code </label> <br/> <br/>
<input id='username' name='Code' required type='text' value='
<?php
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
```

#### Visualisation des formulaires
```
$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
// Exécution de la requête
							
$output = '';
							
$result = mysqli_query($connect, $rqSql);
							
while($row = mysqli_fetch_array($result)) {								
	$output .= '<td> <label> ' .$row["Type_methode"].' </label> </td>';
}
echo $output;
```

### Étape 4
La quatrième étape, a été de créer l’interface de connexions. Les solutions que nous avions était soit de reprendre les identifiants et les mots de passe utilisé pour les sessions et pour l’Intranet ou qu’à la première connexion les utilisateurs s’inscrivent. Nous avons choisi que les utilisateurs s’inscrivent lors de leur première connexion. Ce choix a été fait car les mots de passe étant crypté par Wordpress on n’arrivait pas à faire en sorte qu’ils soient décryptés par notre code lors de la connexion.

### Étape 5
La cinquième étape, a été de pouvoir modifier et supprimer dans les formulaires.

#### Modification
```
$rqSql = "SELECT * from tprojet where IdProjet = $IdProjet";
// Exécution de la requête
							
$output = '';
							
$c = 1;

$result = mysqli_query($connect, $rqSql);
							
while($row = mysqli_fetch_array($result)) 
{					    
	$output .= '<input type="hidden" name="Acronyme" value="'.$row['Acronyme'].'"/> <td> <label>' .$row["Acronyme"].'  </label> </td> ';
}
echo $output;
```

#### Suppression
```
$rqSql = "SELECT * FROM tpersonne  WHERE RefProjet = $IdProjet  ORDER BY NomP ASC";
// Exécution de la requête
							
$output = '';
							
$c = 1;

$result = mysqli_query($connect, $rqSql);
							
while($row = mysqli_fetch_array($result))
{
	$output .= ' <input type="checkbox" name="Personne[]" id="$c" value="'.$row["IdPersonne"] .' - '.$row["RefProjet"].'" />   
				<label for="$c" name="personne[]">' .$row["NomP"] .' ' .$row["PrenomP"] .'</label><br>' ; 

    $c = $c + 1;
}
echo $output;
```

### Étape 6
1. Solutions envisageables
2. Solution choisie
3. Comment c’est fait le choix ?

### Étape 7
La dernière étape a été de faire un espace d’administration accessible seulement par les administrateurs, pour cela nous avons créé un compte administrateur qui est directement inséré dans la base de données.
```
<?php
    session_start();

    if (isset($_SESSION['username'])) {
        if (isset($_SESSION['mdp']))
        {
            echo " <div id='cssmenu'>  
                <ul>
                    <li><a href='index.php'>Accueil</a></li>
                    <li><a href='Pages/new_project.php'>Ajouter un projet</a></li>
                    <li><a href='my_project.php'>Mes projets</a></li>";
                    if ($_SESSION['user_role'] == 'ROLE_ADMIN') {

                        echo "	<li><a href='Pages/Admin/Administration.php'>Administration</a></li>";                   
                    }

                    echo " <li class='session'><a href='Pages/form_connection/disconnection.php'>Deconnexion</a></li>
                    <li class='session'><a href='#'>".$_SESSION['user_name']." ".$_SESSION['user_lastname']."</a></li>
                </ul>
 			</div>  ";
        } else {
            header('Location:form_connection/connection.php');
        }
    } else {
        header('Location:form_connection/connection.php');
    }
?> 
```


## Conclusion
### Difficultés rencontrées
Les difficultés qu’on a rencontrées sont les mots de passe crypté par Wordpress qu’on n’arrivait pas à faire en sorte qu’ils soient décryptés par notre code lors de la connexion, la génération automatique d’un nouveau code projet, comprenant deux lettres et deux chiffres, pour chaque projet créé et pouvoir générer un PDF grâce à un bouton servant à cela.

### Compétences
#### Situations obligatoires
Participation à un projet d’évolution d’un SI (solution applicative et d’infrastructure portant prioritairement sur le domaine de spécialité du candidat).
Prise en charge d’incidents et de demandes d’assistance liés au domaine de spécialité du candidat.
Élaboration de documents relatifs à la production et à la fourniture.

#### Compétences mises en œuvre
A1.4.1, Participation à un projet.
A4.1.1, Proposition d'une solution applicative.
A4.1.2, Conception ou adaptation de l'interface utilisateur d'une solution applicative.
A4.1.3, Conception ou adaptation d'une base de données.
A4.1.10, Rédaction d'une documentation d'utilisation.

### Comment l'application pourrait être amélioré ?
L’application pourrait être amélioré par des statistiques par exemple sur le nombre de projet par unité, le nombre de projet inter-unité, …
