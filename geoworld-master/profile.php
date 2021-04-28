

<p> mon profil</p>
<?php if(isset($_GET['nom_md'])):  ?>
<strong> ce compt est modifier par un admin</strong>
<?php endif; ?>

<?php 
session_start ();
require_once "inc/connect-db.php";
require_once "header.php";
require_once "inc/manager-db.php";

if(isset($_GET['table']) and  $_GET['table']!='true')
	{
			$tableGet='true';
  }
else
$tableGet='false';

if(isset($_GET['nom_mg']))
  $nom_par_tableaux=$_GET['nom_mg'];
else
  $nom_par_tableaux="";

if(isset($_POST['nom_md'])){
  $_SESSION['var']=$_POST['nom_md'];
  $salarie= getInfoPerso($_SESSION['var']);
  $modif_comt=$_SESSION['var'];
  echo"vous modifier le compte de $modif_comt";
}
else
  $salarie= getInfoPerso($_SESSION['nom']);
$sal=$salarie[0];

?>
<div class="sur_droite">
<form method="post" action="inc/fiche.php">
  	Nom : <input type="text" name="nom" value="<?php echo $sal->nom;?>"><br>   	
	Prenom : <input type="text" name="prenom" value="<?php echo $sal->prenom;?>"><br>
	Date Naissance : <input type="text" id="date_naiss" name="date_Naissance" value="<?php echo $sal->date_naissance;?>" ><br>
		Date Embauche : <input type="text"  id="date_embauche" name="date_Embauche" value="<?php echo $sal->date_embauche;?>"><br>
		login : <input type="text" name="login" value="<?php echo $sal->login;?>"><br>
	mot de pass : <input type="password" name="password" value="<?php echo $sal->password;?>"><br>
  
<?php if($_SESSION['role']=="admin"):?>
  role : <input type="text" name="role" value="<?php echo $sal->role;?>"><br>
  salaire : <input type="text" name="salaire" value="<?php echo $sal->salaire;?>"><br>
  service : <input type="text" name="service" value="<?php echo $sal->service;?>"><br>
<?php endif;?>
	<input type="submit" name="update" value="valider">

  </form>
  </div><br>
<?php if($_SESSION['role']=="admin"):?>
  <div>
<a href="form_inscri.php">ajouter</a> un user, ou alors
modifier via un nom ou
<a href="?table=<?php echo $tableGet;?>">
 la table des salariers </a>
<form method="post" action="profile.php">
  	login : <input type="text" name="nom_md" value=<?php echo $nom_par_tableaux;?>>  
<input type="submit" value="validé" ><br>
</from>
  </div>


<?php endif;?>
<div id="tab_des_salariers">
<?php if($tableGet=='true'): ?>
<table class=tab border="2">

  <th>id</th>
  <th>nom</th>
  <th>prenom</th>
  <th>date-naissance</th>
  <th>date-embauche</th>
  <th>salaire</th>
  <th>service</th>
  <th>login</th>
  <th>delete</th>

 <?php   $lesSalaries=getInfoPerso('all'); ?> 
 <?php foreach($lesSalaries as $leSalarie): ?>
    <tr> 
      <td><?php echo $leSalarie->idsalaries ?></td> 
      <td><?php echo $leSalarie->nom ?></td> 
      <td><?php echo $leSalarie->prenom ?></td>
      <td><?php echo $leSalarie->date_naissance ?></td>
      <td><?php echo $leSalarie->date_embauche ?></td>
      <td><?php echo $leSalarie->salaire ?></td>
      <td><?php echo $leSalarie->service ?></td>
      <td><?php $lin=$leSalarie->login; echo "<a href=?nom_mg=$lin>$lin</a>" ?></td>
 <?php endforeach; endif; ?>
</div>
