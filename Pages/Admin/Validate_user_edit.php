
<?php


session_start();

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['mdp']))
    {  
      if ($_SESSION['user_role'] != 'ROLE_ADMIN') {
         header("Location:../form_connection/disconnection.php");
         exit;
      }
      
    } else {
      header("Location:../form_connection/disconnection.php");
      exit;
    }
} else {
    header("Location:../form_connection/disconnection.php");
    exit;
}

$DataBase = mysqli_connect("localhost", "root", "root", "bdprojet");


$DataBase->set_charset("utf8") ;


if (isset($_GET['id'])) {
    $id = $_GET['id'];   
}

if (isset($_GET['A'])) {
    $admin = $_GET['A'];

    $Rsql = "UPDATE tuser set user_role = '$admin' where IdUser = $id";

$Resultat = mysqli_query ( $DataBase, $Rsql )  or  die(mysqli_error($DataBase) ) ; 

}


mysqli_close ( $DataBase ) ;

header('Location:show_user.php?id='.$id);
exit();
?>