<?php
defined('BASEPATH') or exit('No direct script Aktifess allowed');
$setting = $this->db->get('setting');
$row = $setting->row();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="<?php echo base_url() ?>">
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
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

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

      <a href="pencaker/index" class="logo d-flex align-items-center">
        <img src="image/<?php echo $row->logo ?>" alt="">
        <span><?php echo $row->web ?></span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i style="font-size:19px" class="bi bi-bell"></i>
              <span style="background-color:#013289" class="badge headerBadge1">
                <?php
                $id = $this->session->userdata('id');
                $q = $this->db->query("select lamar.*,lowongan.id_user,lowongan.id_lowongan,lowongan.judul_lowongan,user.nama_user,perusahaan.id_user,status_pelamar.nama_status_lamar from lamar
                left join lowongan on lowongan.id_lowongan=lamar.id_lowongan
                left join perusahaan on perusahaan.id_user=lowongan.id_user
                left join user on user.id_user=perusahaan.id_user
                left join status_pelamar on status_pelamar.id_status_lamar=lamar.id_status_lamar
                where lamar.id_user='$id' and lowongan.status='Aktif'")->num_rows(); //buat ngitung baris/mirip count
                ?>
                <?php echo $q
                ?>
              </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header table-responsive">
                Notifikasi Lowongan
                <?php
                $no = 1;
                $id = $this->session->userdata('id');
                $q = $this->db->query("select lamar.*,lowongan.id_user,lowongan.id_lowongan,lowongan.judul_lowongan,lowongan.tgl_seleksi_wawancara,lowongan.lokasi_wawancara,user.nama_user,perusahaan.id_user,status_pelamar.nama_status_lamar from lamar
                left join lowongan on lowongan.id_lowongan=lamar.id_lowongan
                left join perusahaan on perusahaan.id_user=lowongan.id_user
                left join user on user.id_user=perusahaan.id_user
                left join status_pelamar on status_pelamar.id_status_lamar=lamar.id_status_lamar
                where lamar.id_user='$id' and lowongan.status='Aktif' limit 10");
                foreach ($q->result() as $row) {
                ?>
                  <table class="table">
                    <tr>
                      <?php
                      if ($row->nama_status_lamar == "Seleksi wawancara") {
                      ?>
                        <td>
                          <?php echo $row->date ?>
                          <br>
                          <?php echo $row->judul_lowongan ?> di <?php echo $row->nama_user ?> di tahap <?php echo $row->nama_status_lamar ?>
                          <?php echo $row->lokasi_wawancara . " pada tanggal " . $row->tgl_seleksi_wawancara ?>

                        </td>
                      <?php } else {
                      ?>
                        <td>
                          <?php echo $row->date ?>
                          <br>
                          Status lowongan <?php echo $row->judul_lowongan ?> di <?php echo $row->nama_user ?> diperbarui ke tahap <?php echo $row->nama_status_lamar ?>

                        </td>
                      <?php } ?>
                    </tr>
                  </table>
                <?php $no++;
                } ?>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <?php
                $id = $this->session->userdata('id');
                $q = $this->db->query("select lamar.*,lowongan.judul_lowongan,lowongan.id_lowongan,
                lowongan.id_user,user.nama_user,user.foto_user from lamar
                inner join user on user.id_user=lamar.id_user
                inner join lowongan on lowongan.id_lowongan=lamar.id_lowongan
                where lowongan.id_user='$id'");
                foreach ($q->result() as $row) {
                ?>
                  <a href="perusahaan/pelamardn" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $row->foto_user ?>" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $row->nama_user ?></span>
                      <span class="time messege-text">Telah Mendaftar <?php echo $row->nama_lowongan ?></span>
                      <span class="time"><?php echo $row->date ?> </span>

                  </a>
                <?php } ?>
              </div>

            </div>
          </li>
          <li><a class="nav-link scrollto active" href="pencaker/index">Beranda</a></li>
          <li class="dropdown"><a><span>Lowongan Kerja</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="pencaker/lowongandnumum"><span>Dalam Negeri</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="pencaker/lowongandnumum">Umum</a></li>
                  <li><a href="pencaker/lowongandndisabilitas">Disabilitas</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="pencaker/lowonganlnumum"><span>Luar Negeri</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="pencaker/lowonganlnumum">Umum</a></li>
                  <li><a href="pencaker/lowonganlndisabilitas">Disabilitas</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown"><a><span>Pelatihan</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li class="dropdown"><a href="pencaker/pelatihanumum"><span>Umum</span></a>
              </li>
              <li class="dropdown"><a href="pencaker/pelatihandisabilitas"><span>Disabilitas</span> </a>
              </li>
            </ul>

          <li class="dropdown"><a><span>Hai, <?php echo $this->session->userdata('nama') ?></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="pencaker/profil_pencaker"><span>Profil</span></a></li>
              <li><a class="nav-link scrollto" href="pencaker/logout">Log Out</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </li>





      </nav><!-- .navbar -->



    </div>

  </header><!-- End Header -->
  <br>
  <br>
  <br>