<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=bdprojet;charset=utf8', 'root', 'root');
     
    if (isset($_COOKIE['username'],$_COOKIE['password'])) {
        if (!empty($_COOKIE['username'])) {
        
            if (!empty($_COOKIE['password'])) {
               
                $requser = $bdd->prepare("SELECT * FROM tuser WHERE user_login = ? AND user_password = ?");
                $requser->execute(array($_COOKIE['username'],$_COOKIE['password']));
                $userexist = $requser->rowCount();
                if($userexist == 1) {
                    $userinfo = $requser->fetch();
                    $_SESSION['IdUser'] = $userinfo['IdUser'];
                    $_SESSION['user_role'] = $userinfo['user_role']; 
                    $_SESSION['user_lastname'] = $userinfo['user_lastname'];
                    $_SESSION['user_name'] = $userinfo['user_name'];
                    $_SESSION['username'] = $_COOKIE['username'];
                    $_SESSION['password'] = $_COOKIE['password'];

                    header("Location:../../index.php");
                }
            }
        }
    }

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
    <title> Connexion </title>
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
                    <form method="POST" action="">
                        <h1> Se connecter ! </h1> 
                        <main role="main" class="container">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input name="username" type="text" class="form-control" placeholder="nom d'utilisateur" aria-label="username" aria-describedby="basic-addon1" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                                </div>
                                <input name="password" type="password" class="form-control" placeholder="mot de passe" aria-label="password" aria-describedby="basic-addon1" required>
                            </div>
                            <?php
                                if(isset($_POST['formconnexion'])) {
                                    if (!empty($erreur)) {
        echo "                          <div class='alert alert-danger collapse show' role='alert'>
                                            <strong> Erreur </strong> $erreur
                                        </div>";
                                    }
                                }
                            ?> 
                            <p> 
                                <input type='checkbox' name='rememberme' id='remembercheckbox' /> <label for="remembercheckbox"> Se souvenir de moi </label>
							</p> 
                            <p class='button'> 
                                <input type='submit' name='formconnexion' value='Se connecter' /> 
                            <p>
                            <a class="href" href="mdp.php"> Mot de passe oublié ? </a>
                            </p>
							</p>
                            <p>Vous n'êtes pas inscrit ? <a class="href" href="registration.php"> Je m'inscris </a>   </p>
                        </main>
                    </form>
                </div>
            </div>
        </div>  
    </section>
</div>";
</body>
</html>