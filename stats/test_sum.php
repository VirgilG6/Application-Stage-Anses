<?php

$connect = mysqli_connect("localhost", "root", "root", "bdprojet") ;

$connect->set_charset("utf8") ;

$sql = "SELECT SUM(budget_recu) As `somme` FROM tprojet";
$query = mysqli_query($connect, $sql); 
while($row = mysqli_fetch_array($query)) 
{
 echo "<p>PRIX TOTAL DU PRELEVEMENT : ".$row['somme']."</p>";
}

?>