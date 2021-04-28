<p></p>
<?php

require_once "manager-db.php";

$desutilisateurs=getConnextion();
if(isset($_GET['login']) and isset($_GET['pass'])){
$logget=$_GET['login'];
$passget=$_GET['pass'];
if($passget!=null and $logget!=null){
$id = 0;
$location;
//capt/verif
session_start ();
foreach($desutilisateurs as $util){
  $id=$id++;
  $lo=$util->login;
  $pw=$util->password;
 if($lo==$logget and $pw==$passget){
   $_SESSION['nom']=$util->login;
   $_SESSION['role']=$util->role;
   if($_SESSION['role']=="admin")
      $_SESSION['var']=$_SESSION['nom'];
   $location="location: ../index.php";
  }  
}
if($location==null)
$location="location: ../login.php?rconnect=true";
}
else
$location="location: ../login.php?rconnect=false";
}
else
$location="location: ?";
header($location);






?>
