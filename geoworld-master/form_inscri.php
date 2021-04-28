

<p> insription</p>

<?php 
session_start ();
require_once "inc/connect-db.php";
require_once "inc/manager-db.php";
require_once "header.php";
$salarie= getInfoPerso();

?>

	<form method="post" action="inc/fiche.php">

	<table border=2>
 <tr> <td>        Nom : </td>  	  <td> <input type="text" name="nom"> <br> <td> </tr>
 <tr> <td>     Prenom : </td>  	  <td> <input type="text" name="prenom"><br> <td> </tr>
 <tr> <td>  Naissance : </td>  	  <td> <input type="text" id="date_naissance" ><br> <td> </tr>
 <tr> <td>    salaire : </td>  	  <td> <input type="text" name="salaire"><br> <td> </tr>
 <tr> <td>    service : </td>  	  <td> <input type="text" name="service"><br> <td> </tr>
 <tr> <td>      login : </td>  	  <td> <input type="text" name="login" ><br>  <td> </tr>
 <tr> <td>mot de pass : </td>  	  <td> <input type="text" name="password"><br> <td> </tr>

 <?php if(isset($_SESSION['role']) && "admin"!=($_SESSION['role'])):?>
 <tr> <td>      role : </td>  	  <td> <input type="text" name="role" ><br>  <td> </tr>
 <?php endif;?>
 
	</table>

	<input type="submit" name="update" value="Insérer"><br>

<!-- Date Embauche : <input type="text"  id="date_embauche" value="12-06-2020"><br> -->
	