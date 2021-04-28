<?php
require_once "manager-db.php";
require_once "connect-db.php";
$profile=$_POST;
print_r( $profile);
$fich="";
$updel=$profile['update'];
echo $updel;


array_pop($profile);
if(isset($profile['role'])){
    $le_role=$profile['role'];
    array_pop($profile);
}
else
    $le_role="user";

if($updel!='valider'){
    foreach($profile as $fil){
        if ($fil=='')
            echo"YESSS";
        else
            $fich="$fich '$fil', ";
    }

    addProfile($fich,$le_role);
        $profile1=$profile['login'];
        $profile2=$profile['password'];
        $profile1="location: session.php?login=$profile1&pass=$profile2";
}
else
{
session_start();
    
    if($_SESSION['role']=="admin")
     {
        $nom_profile=$_SESSION['var'];
        $_SESSION['var']=$_SESSION['nom'];
    }
    else
        $nom_profile=$_SESSION['nom'];
    print_r($profile);
    foreach($profile as $mk => $fil) //   echo $oui;
        { 
            $oui=setProfile($fil,$mk,$nom_profile);
        }
    $profile1="location: ../";    
}   
//header ($profile1);

?>