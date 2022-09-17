<?php require_once('helper/define.php'); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>  <?php echo TITLE; ?></title>
  </head>
  <body>
  <div class="container-fluid">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <img src="<?php echo ROOT.'img/logo.png' ?>" class="bi me-2" width="164" height="62" />
        <span class="fs-4">- Admin</span>
        
      </a>
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo ROOT.'dashboard/' ?>" class="nav-link <?php if(TITLE=='Lenskart-Dashboard'){echo 'active';}; ?>">Dashboard</a></li>  
        
        <?php if(!isset($_SESSION['is_login'])){ ?>
          <li class="nav-item"><a href="<?php echo ROOT.'dashboard/login.php' ?>" class="nav-link <?php if(TITLE=="Lenskart-login"){echo 'active';} ?>" >Login</a></li>
        <?php } ?>
        <?php if(isset($_SESSION['is_login'])){ ?>
          <li class="nav-item"><a href="<?php echo ROOT.'dashboard/changePassword.php'?>" class="nav-link <?php if(TITLE=='Lenskart-changePassword'){echo 'active';} ?>">Change-Password</a></li>
          <li class="nav-item"><a href="<?php echo ROOT.'dashboard/newAdmin.php' ?>" class="nav-link <?php if(TITLE=='Lenskart-NewAdmin'){echo 'active';} ?>">New Admin</a></li>
          <li class="nav-item"><a href="<?php echo ROOT.'dashboard/adminList.php' ?>" class="nav-link <?php if(TITLE=='Lenskart-AdminList'){echo 'active';} ?>">Admin List</a></li>
          <li class="nav-item"><a href="<?php echo ROOT.'dashboard/logout.php' ?>" class="nav-link "> <button class="btn btn-outline-info">Logout</button> </a></li>

        <?php } ?>
      </ul>
    </header>
  </div>