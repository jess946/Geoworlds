
<?php 


require_once "inc/connect-db.php";
require_once 'header.php';

?>


<p>conecter-vous svp</p>

<br>
<?php 
//texte afficher si rconection
if(isset($_GET["rconnect"])){
  $rconn=$_GET["rconnect"];
  if($rconn=='true'){
    echo "<p class='infoAlert'> les informations saisies sont incorect</p>";
  }
  else
  {
    echo "<p class='infoAlert'> veiller saisir tous les champs</p>";
  }
}
?>

<body>
<div class="connection">
<form action="inc/session.php" method="get">
<table>  
  <tr>
    <td> Votre login :</td>
    <td> <input type="text" name="login"><br /> </td>
  </tr><tr>
    <td>Votre mot d passe :</td> 
    <td><input type="password" name="pass"><br/> </td>
  </tr>
</table><br>
<input type="submit" >
</form>



<p><br><br> Bonjour si vous voulez vous inscrire clicker sur <a href="form_inscri.php"> inscription</a>.</p>
</div>

</body>