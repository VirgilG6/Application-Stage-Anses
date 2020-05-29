<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bdprojet;charset=utf8', 'root', 'root');
     
 

if(isset($_POST['formconnexion'])) {

   $username = htmlspecialchars($_POST['username']);
   $password = sha1($_POST['password']);
   if(!empty($username) AND !empty($password)) {
      $requser = $bdd->prepare("SELECT * FROM tuser WHERE user_login = ? AND user_password = ?");
      $requser->execute(array($username, $password));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
          if (isset($_POST['rememberme'])) {
              setcookie('username',$username,time()+365*24*3600,null,null,false,true);
              setcookie('password',$password,time()+365*24*3600,null,null,false,true);
          }
         $userinfo = $requser->fetch();
         $_SESSION['IdUser'] = $userinfo['IdUser'];
         $_SESSION['user_role'] = $userinfo['user_role']; 
         $_SESSION['user_lastname'] = $userinfo['user_lastname'];
         $_SESSION['user_name'] = $userinfo['user_name'];
         $_SESSION['username'] = $_POST['username'];
         $_SESSION['mdp'] = $_POST['password'];
         
         header("Location:../../index.php");
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
<!DOCTYPE>
<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../../css/demo.css" />
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
<link rel="stylesheet" type="text/css" href="../../css/animate-custom.css" />
    <title> mdp </title>
    <style>
        section {
            padding-top:100px;
        }
    </style>
</head>
<body>
<div class='container'>       
     <div class='codrops-top'>
        <div class='clr'></div>
    </div>
    <section>				
        <div id='container_demo'>
            <div id='wrapper'>
                <div id='login' class='animate form'>
                    
                        <h1> Changer votre mot de passe  </h1> 

                        <?php if(!isset($_POST['formgetemail']) && !isset($_POST['formchangemdp'])) // page d'accueil si aucune adresse mail a été envoyé
                        {
    echo "                  <form method='POST' action=''>
                                <main role='main' class='container'>
                                    <div class='input-group mb-3'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='basic-addon1'><i class='fas fa-envelope'></i></span>
                                        </div>
                                        <input name='mail' type='email' class='form-control' placeholder='mail' aria-label='mail' aria-describedby='basic-addon1' required>
                                    </div>
                                    <p class='button'> 
                                        <input type='submit' name='formgetemail' value='Valider'/> 
                                    <p>
                                </main>
                            </form>";
                        

                        } elseif(isset($_POST['formgetemail']) && !empty($_POST['mail']))  //  si une adresse mail a été envoyé et qu'eelle n'est pas vide
                        {
                            $mail = $_POST['mail'];
                            $reqmail = $bdd->prepare("SELECT * FROM tuser WHERE user_email = ?");
                            $reqmail->execute(array($_POST['mail']));
                            $mailexist = $reqmail->rowCount();
                            if($mailexist == 1)  //  si l'adresse mail envoyé est dans la BD
                            {

echo                        "<form method='POST' action=''>             
                                <main role='main' class='container'>
                                    <div class='input-group mb-3'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='basic-addon1'><i class='fas fa-unlock-alt'></i></span>
                                        </div>
                                        <input name='mdp' type='password' class='form-control' placeholder='Nouveau mot de passe' aria-label='mdp' aria-describedby='basic-addon1' required>
                                    </div>
                                    <div class='input-group mb-3'>
                                        <div class='input-group-prepend'>
                                            <span class='input-group-text' id='basic-addon1'><i class='fas fa-unlock-alt'></i></span>
                                        </div>
                                        <input name='mdp2' type='password' class='form-control' placeholder='Vérification mot de passe' aria-label='mdp2' aria-describedby='basic-addon1' required>
                                    </div>
                                    <p class='button'> 
                                        <input type='submit' name='formchangemdp' value='Valider' /> 
                                    </p>
                                    <input name='mail' type='hidden' value='$mail'>
                                </main>
                            </form>";

                            } elseif($mailexist == 0) // sinon erreur et on affiche la page d'accueil
                            {
                                $erreur = "Email inexistante";

        echo "                  <form method='POST' action=''>
                                    <main role='main' class='container'>
                                        <div class='input-group mb-3'>
                                            <div class='input-group-prepend'>
                                                <span class='input-group-text' id='basic-addon1'><i class='fas fa-envelope'></i></span>
                                            </div>
                                            <input name='mail' type='email' class='form-control' placeholder='mail' aria-label='mail' aria-describedby='basic-addon1' required>
                                        </div>";

                                        if(isset($_POST['formgetemail']) && !empty($_POST['formgetemail'])) {
                                            if (!empty($erreur)) {
               echo "                          <div class='alert alert-danger collapse show' role='alert'>
                                                   <strong> Erreur ! </strong> $erreur
                                               </div>";
                                           }
                                       }
echo     "                             <p class='button'> 
                                       <input type='submit' name='formgetemail' value='Valider'/> 
                                        </p>
                                    </main>
                                </form>";
                            }
                        } 

                        if(isset($_POST['formchangemdp'])) 
                        {
                            if (isset($_POST['mdp'],$_POST['mdp2'])) 
                            {
                                if(!empty($_POST['mdp']) && !empty($_POST['mdp2'])) 
                                {  
                                    $mail = $_POST['mail'];
                                    $mdp = sha1($_POST['mdp']);
                                    $mdp2 = sha1($_POST['mdp2']);

                                    if($mdp == $mdp2) 
                                    {
                                        
                                        $insertmbr = $bdd->prepare("UPDATE tuser SET user_password = ? WHERE user_email = ?");
                                        $insertmbr->execute(array($mdp,$mail)); 
                                        header('Location:connection.php');
                                    } else 
                                    {
                                        $erreur = "Les mots de passe ne correspondent";

echo                                    "<form method='POST' action=''>             
                                            <main role='main' class='container'>
                                                <div class='input-group mb-3'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text' id='basic-addon1'><i class='fas fa-unlock-alt'></i></span>
                                                    </div>
                                                    <input name='mdp' type='password' class='form-control' placeholder='Nouveau mot de passe' aria-label='mdp' aria-describedby='basic-addon1' required>
                                                </div>
                                                <div class='input-group mb-3'>
                                                    <div class='input-group-prepend'>
                                                        <span class='input-group-text' id='basic-addon1'><i class='fas fa-unlock-alt'></i></span>
                                                    </div>
                                                    <input name='mdp2' type='password' class='form-control' placeholder='Vérification mot de passe' aria-label='mdp2' aria-describedby='basic-addon1' required>
                                                </div>";

                                                if(isset($_POST['formchangemdp']) && !empty($_POST['formchangemdp'])) {
                                                    if (!empty($erreur)) {
                    echo "                          <div class='alert alert-danger collapse show' role='alert'>
                                                        <strong> Erreur ! </strong> $erreur
                                                    </div>";
                                                }
                                            }
    echo "                                      <p class='button'> 
                                                    <input type='submit' name='formchangemdp' value='Valider' /> 
                                                </p>
                                                <input name='mail' type='hidden' value='$mail'>
                                            </main>
                                        </form>";
                                    }
                                }
                            }

                        
                        }
                    
?>
                        
                    </form>
                </div>
            </div>
        </div>  
    </section>
</div>";
</body>
</html>