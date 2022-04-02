<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$setting = $this->db->get('setting');
$row = $setting->row();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo base_url()?>">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="description" content="<?php echo $row->web; ?>">
	<meta name="author" content="<?php echo $row->web; ?>">
	<meta name="generator" content="<?php echo $row->web; ?>">
  <title><?php echo $row->web ?></title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="image/<?php echo $row->logo ?>" sizes="180x180">
	<link rel="icon" href="image/<?php echo $row->logo ?>" sizes="32x32" type="image/png">
	<link rel="icon" href="image/<?php echo $row->logo ?>" sizes="16x16" type="image/png">
	<link rel="mask-icon" href="image/<?php echo $row->logo ?>" color="#563d7c">
	<link rel="icon" href="image/<?php echo $row->logo ?>">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="frontend/vendor/aos/aos.css" rel="stylesheet">
  <link href="frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="frontend/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="frontend/css/style.css" rel="stylesheet">
 
  <script src="assets/js/app.min.js"></script>
  <script src="assets/angular.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <!-- <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f964082dcc7c50019f9d475&product=sop' async='async'></script> -->
  <!-- =======================================================
  * Template Name: FlexStart - v1.9.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
</head>

<body <?php echo isset($ngapp) ? $ngapp : null; ?>>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="home/index" class="logo d-flex align-items-center">
        <img src="image/<?php echo $row->logo ?>" alt="">
        <span><?php echo $row->web ?></span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="#hero">Beranda</a></li>
          <li class="dropdown"><a><span>Lowongan Kerja</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a><span>Dalam Negeri</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                  <li><a href="home/lowongandnumum">Umum</a></li>
                  <li><a href="home/lowongandndisabilitas">Disabilitas</a></li>
                </ul>
            </li>
            <li class="dropdown"><a><span>Luar Negeri</span> <i class="bi bi-chevron-right"></i></a>
              <ul>
                  <li><a href="home/lowonganlnumum">Umum</a></li>
                  <li><a href="home/lowonganlndisabilitas">Disabilitas</a></li>
                </ul>
            </li>
            </ul>
          </li>
          <li class="dropdown"><a><span>Pelatihan</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
            <a href="home/pelatihanumum"><span>Umum</span> <i></i></a>
            <a href="home/pelatihandisabilitas"><span>Disabilitas</span> <i></i></a>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="artikel/artikel">Artikel</a></li>
          <li><a class="getstarted scrollto" href="home/login">Daftar/Masuk</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>

  </header><!-- End Header -->