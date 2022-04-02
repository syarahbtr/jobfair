<?php
defined('BASEPATH') or exit('No direct script access allowed');
$setting = $this->db->get('setting');
$rowk = $setting->row();
?>
<!DOCTYPE html>
<html lang="en">


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

<head>
  <base href="<?php echo base_url() ?>">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="<?php echo $rowk->web; ?>">
  <meta name="author" content="<?php echo $rowk->web; ?>">
  <meta name="generator" content="<?php echo $rowk->web; ?>">
  <title><?php echo $rowk->web ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="apple-touch-icon" href="image/<?php echo $rowk->logo ?>" sizes="180x180">
  <link rel="icon" href="image/<?php echo $rowk->logo ?>" sizes="32x32" type="image/png">
  <link rel="icon" href="image/<?php echo $rowk->logo ?>" sizes="16x16" type="image/png">
  <link rel="mask-icon" href="image/<?php echo $rowk->logo ?>" color="#563d7c">
  <link rel="icon" href="image/<?php echo $rowk->logo ?>">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
  <script src="assets/bundles/summernote/summernote-bs4.js"></script>
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>

          </ul>
        </div>
        <ul class="navbar-nav navbar-right">

          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
              <span class="badge headerBadge1">
                <?php
                $id = $this->session->userdata('id');
                $q = $this->db->query("select lamar.*,lowongan.judul_lowongan,lowongan.id_lowongan,
                lowongan.id_user,user.nama_user,user.foto_user from lamar
                inner join user on user.id_user=lamar.id_user
                inner join lowongan on lowongan.id_lowongan=lamar.id_lowongan
                where lowongan.id_user='$id'")->num_rows();
                ?>
                <?php echo $q ?></span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifikasi Lowongan

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
                  <a class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $row->foto_user ?>" class="rounded-circle">
                    </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $row->nama_user ?></span>
                      <span class="time messege-text">Telah Mendaftar <?php echo $row->judul_lowongan ?></span>
                      <span class="time"><?php echo $row->date ?> </span>

                  </a>
                <?php } ?>
              </div>

            </div>
          </li>
          <?php
          $id = $this->session->userdata('id');
          $q = $this->db->query("select perusahaan.*,user.nama_user,user.username,user.password,
        user.foto_user,user.email_user,user.nohp_user,user.alamat_user,sektor.nama_sektor,
        jenis_badan_usaha.nama_jbu from perusahaan 
        left join user on user.id_user=perusahaan.id_user 
        left join sektor on sektor.id_sektor=perusahaan.id_sektor
        left join jenis_badan_usaha on jenis_badan_usaha.id_jbu=perusahaan.id_jbu
        where perusahaan.id_user='$id'");
          $rowx = $q->row();
          ?>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="<?php echo base_url('image/') . $rowx->foto_user ?>" class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $this->session->userdata('nama') ?></div>
              <a href="login/logout" class="dropdown-item has-icon text-danger tombol-logout"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="user/index"> <img alt="image" src="image/<?php echo $rowk->logo ?>" class="header-logo" /> <span class="logo-name"><?php echo $rowk->web ?></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="perusahaan/chart" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="perusahaan/index" class="nav-link"><i data-feather="user"></i><span>Profil</span></a>
            </li>
            <li class="dropdown <?php if ($this->uri->segment(2) == 'tambahloker' or $this->uri->segment(2) == 'lokerdn' or $this->uri->segment(2) == 'lokerln') echo 'active' ?>">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="book"></i><span>Lowongan Kerja</span></a>
              <ul class="dropdown-menu">
                <li class="<?php if ($this->uri->segment(2) == 'tambahloker') echo 'active' ?>"><a class="nav-link" href="perusahaan/tambahloker">Tambah Lowongan Kerja</a></li>
                <li class="<?php if ($this->uri->segment(2) == 'lokerdn') echo 'active' ?>"><a class="nav-link" href="perusahaan/lokerdn">Dalam Negeri</a></li>
                <li class="<?php if ($this->uri->segment(2) == 'lokerln') echo 'active' ?>"><a class="nav-link" href="perusahaan/lokerln">Luar Negeri</a></li>
              </ul>
            </li>
            <li class="dropdown <?php if ($this->uri->segment(2) == 'historidn' or $this->uri->segment(2) == 'historiln') echo 'active' ?>">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="book-open"></i><span>Riwayat Lowongan Kerja</span></a>
              <ul class="dropdown-menu">
                <li class="<?php if ($this->uri->segment(2) == 'historidn') echo 'active' ?>"><a class="nav-link" href="perusahaan/historidn">Dalam Negeri</a></li>
                <li class="<?php if ($this->uri->segment(2) == 'historiln') echo 'active' ?>"><a class="nav-link" href="perusahaan/historiln">Luar Negeri</a></li>
              </ul>
            </li>
          </ul>
        </aside>
      </div>