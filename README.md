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

### Step 3
Then we created the interface of the application as well as the creation of a new project and the visualization of the project tracking forms.

#### Creating a new project code
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

#### Viewing forms
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

### Step 4
The fourth step was to create the connection interface. The solutions we had were either to take back the usernames and passwords used for the sessions and for the Intranet or that at the first connection the users register. We have chosen that users register when they first log in. This choice was made because the passwords being encrypted by Wordpress we could not make sure that they were decrypted by our code when connecting.

### Step 5
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

#### Deletion
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

### Step 6
1. Potential solutions
2. Solution chosen
3. How did you choose ?

### Step 7
The last step was to make an administration area accessible only by administrators, for this we have created an administrator account that is directly inserted in the database.
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
### Difficulties encountered
The difficulties we encountered were the passwords encrypted by Wordpress that we couldn't get our code to decrypt when we logged in, the automatic generation of a new project code, consisting of two letters and two numbers, for each project created and being able to generate a PDF thanks to a button used for that.

### Skills
#### Mandatory situations
Participation in an IS evolution project (application and infrastructure solution focusing on the candidate's area of expertise).
Handling of incidents and requests for assistance related to the candidate's area of specialty.
Development of production and supply documents.

#### Skills implemented
A1.4.1, Project participation.
A4.1.1, Proposal of an application solution.
A4.1.2, Design or adaptation of the user interface of an application solution.
A4.1.3, Database design or adaptation.
A4.1.10, Writing of user documentation.

### How could the application be improved ?
The application could be improved with statistics such as the number of projects per unit, the number of inter-unit projects, ...
