<!DOCTYPE html>
<html lang="en">
  <title>Dashboard Admin</title>
  <head>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?php echo $iweb['katakunci'];?>">
    <meta name="description" content="<?php echo $iweb['deskripsi'];?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/cssadmin.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div id="wrapper">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span class="fa fa-laptop"></span> Ruang Admin</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <li class="message-preview">
        <a href="#"><span class="label ">Selamat Datang <?php echo $_SESSION['username']; ?></span></a>
      </li>
      <li class="message-preview">
        <a href="<?php echo base_url(); ?>profile"><span class="label ">Profile</a>
      </li>
      <li class="message-preview"><a href="<?php echo base_url(); ?>auth/logout"><span class="label label-default">Logout</span></a></li>
    </ul>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav side-nav">
        <li class="<?php echo (segment_uri(1) == 'dashboard' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>dashboard">Dashboard</a>
        </li>
        <li class="<?php echo (segment_uri(1) == 'absensi' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>absensi">Absen</a>
        </li>
        <li class="<?php echo (segment_uri(1) == 'pengumuman' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>pengumuman">Pengumuman</a>
        </li>
        <li class="<?php echo (segment_uri(1) == 'jadwal' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>jadwal">Jadwal</a>
        </li>
        <?php if ($_SESSION['role'] == 1) : ?>
        <li class="<?php echo (segment_uri(1) == 'user' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>user">User</a>
        </li>
        <li class="<?php echo (segment_uri(1) == 'kelas' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>kelas">Kelas</a>
        </li>
        <?php endif; ?>
        <li class="<?php echo (segment_uri(1) == 'siswa' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>siswa">Data Siswa</a>
        </li>
        <?php if ($_SESSION['role'] == 1) : ?>
        <li class="<?php echo (segment_uri(1) == 'guru' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>guru">Data Guru</a>
        </li>
        <?php endif; ?>
        <li class="<?php echo (segment_uri(1) == 'rapor' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>rapor">Data Rapor Siswa</a>
        </li>
        <?php if($_SESSION['role'] == 1) : ?>
        <li class="<?php echo (segment_uri(1) == 'pembayaran' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>pembayaran">Pembayaran Masuk</a>
        </li>
        <li class="<?php echo (segment_uri(1) == 'cbt' ? 'active' : '' ); ?>">
          <a href="<?php echo base_url(); ?>cbt">CBT</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>