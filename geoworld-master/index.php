
<?php
/**
 * Home Page
 *
 * PHP version 7
 *
 * @category  Page
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

?>
                <!-- // $desPays est un tableau dont les éléments sont des objets représentant
                       // des caractéristiques d'un pays (en relation avec les colonnes de la table Country) -->
<?php 
session_start ();

require_once "inc/connect-db.php";
require_once 'header.php';
require_once 'inc/manager-db.php'; 
if(isset($_GET['country']))
  $continent = $_GET["country"];
else
  $continent="asia";
  if(isset($_SESSION['role']))
  $my_role=$_SESSION['role'];
else
  $my_role="passager";

?>

<div>
<?php if(isset($_GET['pays'])): ?><!--mod et ajoute  -->

  <?php
      if($_GET['pays']!=null)
        $nom_pays=$_GET['pays'];
      else
        $nom_pays='Australia';
      $infoPays=getAllOfCountries($nom_pays);
      
      if(isset($_POST['modif_valeur1']) && isset($_POST['modif_valeur2']))
          setInfoContries($nom_pays,$_POST['modif_valeur2'],$_POST['modif_valeur1']);
      $recut=null;
  ?>


<br><br>
<h2 class="conte">info du pays</h2>
<table class="conte" id="tab1" border=2>
  <th>Nom</th>
  <th>code</th>
  <th>continant</th>
  <th>Region</th>
  <th>Surface</th>
  <th>Population</th>
  <th>esperance de vie </th>
  <th>capital</th>
<tr>

<form method="post" action="?pays=<?php echo $infoPays[0]->Name;//si prof?>">
<?php foreach ($infoPays[0] as $titreinfo => $valueinfo):?>
<?php if($my_role=="prof "):?>
  <td><input type="submit" name="<?php echo $titreinfo;?>" value="<?php echo $valueinfo;?>"></td>
<?php if(isset($_POST[$titreinfo]) ) echo $_POST[$titreinfo]," avec ", $recut=$titreinfo;endif;
      if($my_role!="prof ") echo "<th>$valueinfo</td>";endforeach;
?>
</tr>
<?php if($recut!=null && $my_role=="prof " && $recut!="Name"):?>
<div id="modification_valeur">
<strong>modif la valeur de "<?php echo $recut;?>"</strong>
<input type="text" name="modif_valeur1">
<input type="hidden" name="modif_valeur2" value=<?php echo $recut;?>>
</div><?php endif;?></from></table>
<?php $continent=$infoPays[0]->Continent; endif;
        $desPays = getCountriesByContinent($continent);
    ?>


</div>
<br><br>

<main role="main" class="flex-shrink-0">
<div class="container">
<?php if($continent!="monde") :?>
    <h1>Les pays en <?php echo $continent," en tant que ",$my_role,"."; ?></h1>
    <div>
     <table class="table">
         <tr>
           <th>Nom</th>
           <th>Population</th>
           <th>Capital</th>       
           <th>détail</th>";
         </tr>
       <?php foreach ($desPays as $country_pays) :?> 
          <tr>
            <td><?php $pys=$country_pays->Name; echo "<a href='?pays=$pys'>$pys</a>"; ?></td>
            <td><?php echo $country_pays->Population ?></td>
            <td><?php echo $country_pays->Capital ?></td>
            <td> <a href="#"> détail</a> </td>
          </tr>
       <?php endforeach;?> 
     </table>
     <?php endif;?>     

     <?php if($continent=="monde"):?>
         <img usemap="#dacc" src="images/Carte_du_monde.png" height=300px  width =600px> 
         <map name="dacc">
              <area href="?country=North%20America" shape="rect" coords="0,0,170,130">
              <area href="?South%20America" shape="rect" coords="80,130,180,280">
              <area href="?Asia" shape="rect" coords="300,10,500,135">
         </map>

         <a href="./map_monde.php"> carte pays</a>
     <?php endif;?>
     </div>
    <p>
        <code>
      <?php
       // var_dump($desPays[0]);
        ?>
        </code>
    </p>




  </div>
</main>



<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>
