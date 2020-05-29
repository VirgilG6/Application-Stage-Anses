
<!DOCTYPE>
<html>



<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" /> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="../../css/demo.css" />
<link rel="stylesheet" type="text/css" href="../../css/style2.css" />
<link rel="stylesheet" type="text/css" href="../../css/animate-custom.css" />.
    <title> Inscription </title>
    <style>
        section {
            padding-top:100px;
        }
        .alert {
            position:relative
            width:350px;
            right:0;
            left:0;
        }
    </style>
</head>
<body>

<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=bdprojet;charset=utf8', 'root', 'root');

if(isset($_POST['forminscription'])) {
   $succes = "";
   $lastname = $_POST['nom'];
   $name = $_POST['prenom'];
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM tuser WHERE user_email = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO tuser (user_lastname,user_name,user_login, user_email, user_password, user_role) VALUES(?, ?, ?, ?, ?, ?)");
                     $insertmbr->execute(array($lastname,$name,$pseudo, $mail, $mdp, "ROLE_USER"));
                     $succes = header('Location:connection.php');
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>

<div class='container'>       
     <div class='codrops-top'>
        <div class='clr'></div>
    </div>
    <section>				
        <div id='container_demo'>
            <div id='wrapper'>
                <div id='login' class='animate form'>
                    <form method="POST" action="">
                        <h1> Inscription </h1> 
                        <main role="main" class="container">
                        <div class='inline-flex'>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></i></span>
                                    </div>
                                    <input name="nom" type="text" id="nom" class="form-control flex" placeholder="nom" aria-label="nom" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></i></span>
                                    </div>
                                    <input name="prenom" type="text" id="prenom" class="form-control flex" placeholder="prenom" aria-label="mail" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class='inline-flex'>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input name="pseudo" id="pseudo" type="text" class="form-control flex" placeholder="nom d'utilisateur" aria-label="pseudo" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class='inline-flex'>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input name="mail" type="email" id="mail" class="form-control flex" placeholder="mail" aria-label="mail" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input name="mail2" type="email" id="mail2"  class="form-control flex" placeholder="vérification de l'email" aria-label="mail2" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <div class='inline-flex'>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                                    </div>
                                    <input name="mdp" type="password" id="password" class="form-control flex" placeholder="mot de passe" aria-label="mdp" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
                                    </div>
                                    <input name="mdp2" type="password" id="password2" class="form-control flex" placeholder="Vérification du mot de passe" aria-label="mdp2" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                            <?php
                             if(isset($_POST['forminscription'])) {
                                 if (!empty($erreur)) {
    echo "                          <div class='alert alert-danger collapse show' role='alert'>
                                        <strong> Erreur ! </strong> $erreur
                                    </div>";
                                }
                            }
                            ?>  
                            <p class='button'> 
                                <input type='submit' name='forminscription' value="Je m'inscris" /> 
							</p>
                            <p>Vous êtes déjà inscrit ? <a class="href" href="connection.php"> Je me connecte </a> </p>
                        </main>
                    </form>
                </div>
            </div>
        </div>  
    </section>
</div>";


</body>
</html>