<?php




/**
 * Ce script est composé de fonctions d'exploitation des données
 * détenues pas le SGBDR MySQL utilisées par la logique de l'application.
 *
 * C'est le seul endroit dans l'application où a lieu la communication entre
 * la logique métier de l'application et les données en base de données, que
 * ce soit en lecture ou en écriture.
 *
 * PHP version 7
 *
 * @category  Database_Access_Function
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */

require_once 'connect-db.php';
/**
 *  Les fonctions dépendent d'une connection à la base de données,
 *  cette fonction est déportée dans un autre script.
 */


/**
 * Obtenir la liste de tous les pays référencés d'un continent donné
 * 
 * @param string $continent le nom d'un continent
 * 
 * @return array tableau d'objets (des pays)
 */
function getCountriesByContinent($continent){
    // pour utiliser la variable globale dans  la fonction
    global $pdo;
    $query = 'SELECT country.Name, country.Population, SurfaceArea, city.Name as "Capital" FROM `country`, city WHERE city.id=country.Capital and Continent = :cont;';
    $prep = $pdo->prepare($query);
    // on associe ici (bind) le paramètre (:cont) de la req SQL,
    // avec la valeur reçue en paramètre de la fonction ($continent)
    // on prend soin de spécifier le type de la valeur (String) afin
    // de se prémunir d'injections SQL (des filtres seront appliqués)
    $prep->bindValue(':cont', $continent, PDO::PARAM_STR);
    $prep->execute();
    //  var_dump($prep);  pour du debug
    // var_dump($continent);

    // on retourne un tableau d'objets (car spécifié dans connect-db.php)
    return $prep->fetchAll();
}

/**
 * Obtenir la liste des pays
 *
 * @return liste d'objets
 */
function getAllOfCountries($pays=1)
{
    global $pdo;
    $query = "SELECT * from country ";
    if($pays!=1)
        $query="SELECT country.`Name`, `Code`,  `Continent`, `Region`, `SurfaceArea`, country.`Population`, `LifeExpectancy` , city.Name as 'CapitalP'
         FROM `country` , city WHERE city.id=country.Capital and country.Name='$pays'";

    return $pdo->query($query)->fetchAll();
}


function setInfoContries($pays,$id,$valeur)
{
    global $pdo;
    if($id=="CapitalP")
        $query="";
    else
    $query="UPDATE country SET $id=$valeur WHERE Name='$pays'";
    return $pdo->query($query)->fetchAll();
}



/**
 * donne la liste les login et mdp
 * 
 * @return liste d'objets
 */
function getConnextion()
{
    global $pdo;
    $query = "SELECT login,password ,role FROM salaries";
    return $pdo->query($query)->fetchAll();
}

/**
 * c la liste des continant
 * 
 * @return liste d'objets
 */
function getContinents()
{
    global $pdo;
    $query = "SELECT DISTINCT Continent FROM country";
    return $pdo->query($query)->fetchAll();
}

/**
 * retourn les information personnele du salarier ($reff)
 * 
 * 
 * @return liste d'objets
 */
function getInfoPerso($reff='totoF5')
{
    global $pdo;
    $query = "SELECT DISTINCT * FROM salaries WHERE login='$reff'";
    if($reff=='all')
        $query = "SELECT * FROM salaries";
    return $pdo->query($query)->fetchAll();
}


/**
 * joute un profile avec le pdo
 * @return liste d'objets
 */
function addProfile($profile="totoF5",$role="user")
{

    global $pdo;
    $BaseI="`salaries`( `nom`, `prenom`, `salaire`, `service`, `login`, `password`, `role`)";
    $query = "INSERT INTO $BaseI VALUES ($profile "."'$role ')";
    echo $query;
    return $pdo->query($query)->fetchAll();
}




/**
 *  envoie une requette pdo qui modifie un profile
 * @return array d'objets
 */
function setProfile($file,$key,$lo)
{
    global $pdo;
    $query = "UPDATE salaries SET $key ='$file' WHERE login='$lo'";
    echo $query,"<br>";
   return $pdo->query($query)->fetchAll();
}
