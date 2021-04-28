<?php

/**
 * Fragment Header HTML page
 *
 * PHP version 7
 *
 * @category  Page_Fragment
 * @package   Application
 * @author    SIO-SLAM <sio@ldv-melun.org>
 * @copyright 2019-2021 SIO-SLAM
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link      https://github.com/sio-melun/geoworld
 */
?><!doctype html>
<html lang="fr" class="h-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Homepage : GeoWorld</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/bootstrap-4.4.1-dist/css/bootstrap.min.css" rel="stylesheet">  
  <link href="css/cuisto.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="css/custom.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
    <?php require_once 'inc/manager-db.php';
    $desContinents=getContinents();?>
<header>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php">GeoWorld</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="http://guyonst.free.fr">Link</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?">Disabled</a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Continents</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="?country=monde"> monde</a>
          <?php foreach( $desContinents as $conti ):   ?>
            <a class='dropdown-item' <?php echo "href='?country=$conti->Continent'"  ?> ><?php echo $conti->Continent;?> </a>
          <?php endforeach;?>

        </div>

      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['role'])): ?> 
         <li class="nav-item active">    
           <a class=nav-link href='profile.php'><?php echo $_SESSION['nom'];?></a>
         </li>  
         <li class="nav-item active">
           <a class="nav-link" href="inc/logout.php">Deconnexion</a>
         </li> 
      <?php endif; ?>
      <?php if(!isset($_SESSION['role'])): ?>
         <li class="nav-item active">  
           <a class=nav-link href=login.php>Login</a>
         </li>
      <?php endif;?>
      <li class="nav-item">
        <a class="nav-link disabled" href="todo-projet.php">
          Présentation-Atelier-de-Prof-SLAM
        </a>
      </li>
    </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>
</header>
