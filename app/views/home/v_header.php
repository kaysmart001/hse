<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png" />
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
  </head>
  <body id="page-top">
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/header.png"></a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <?php if (isset($_SESSION['login'])) { ?>
          <ul class="navbar-nav">
            <?php if ($_SESSION['role'] != 1) { ?>
              <?php if ($_SESSION['role'] == 3) { ?>
              <li class="nav-item">
                <a href="pembayaran_spp.php" class="nav-link text-green"> Pembayaran</a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>profile" class="nav-link text-green"> Profile</a>
              </li>
            <?php } else if ($_SESSION['role'] == 1) { ?>
              <li class="nav-item">
                <a href="<?php echo base_url(); ?>dashboard" class="nav-link text-green"> Dashboard</a>
              </li>
            <?php } ?>
          </ul>
          <?php } ?>
          <ul class="navbar-nav ml-auto">
            <li>
              <a href="#" class="navbar" style="pointer-events: none;"> Selamat datang, <?php echo (isset($_SESSION['username']) ? $_SESSION['username'] : 'world'); ?>!</a>
            </li>
            <?php if (isset($_SESSION['login'])) { ?>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>auth/logout"><input type="button" value="Logout" class="btn btn-primary"></a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>auth/login"><input type="button" value="Login" class="btn btn-primary"></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>