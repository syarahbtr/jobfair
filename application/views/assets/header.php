<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$setting = $this->db->get('setting');
$row = $setting->row();
?>
<!DOCTYPE html>
<html lang="en">


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
<head>
    <base href="<?php echo base_url()?>">
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="<?php echo $row->web; ?>">
	<meta name="author" content="<?php echo $row->web; ?>">
	<meta name="generator" content="<?php echo $row->web; ?>">
  <title><?php echo $row->web ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel="apple-touch-icon" href="image/<?php echo $row->logo ?>" sizes="180x180">
	<link rel="icon" href="image/<?php echo $row->logo ?>" sizes="32x32" type="image/png">
	<link rel="icon" href="image/<?php echo $row->logo ?>" sizes="16x16" type="image/png">
	<link rel="mask-icon" href="image/<?php echo $row->logo ?>" color="#563d7c">
	<link rel="icon" href="image/<?php echo $row->logo ?>">
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <script src="assets/js/app.min.js"></script>
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="assets/bundles/summernote/summernote-bs4.css">
  <script src="assets/bundles/summernote/summernote-bs4.js"></script>
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">
  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>
   <script src="assets/bundles/chartjs/chart.min.js"></script>
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
            <li><a  class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
           <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
              <span class="badge headerBadge1">
                <?php
                $q=$this->db->query("select lowongan.*,user.id_user,user.foto_user,user.nama_user from lowongan
                left join user on user.id_user=lowongan.id_user 
                where lowongan.status='Menunggu Verifikasi' ")->num_rows();
                ?>
                <?php echo $q ?></span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifikasi Lowongan Kerja
               
              </div>
              <div class="dropdown-list-content dropdown-list-message">
              <?php 
                $q=$this->db->query("select lowongan.*,user.id_user,user.foto_user,user.nama_user from lowongan
                left join user on user.id_user=lowongan.id_user 
                where lowongan.status='Menunggu Verifikasi' ");
                foreach ($q->result() as $xrow) {
              ?>
                <a href="admin/lokerdn" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $xrow->foto_user?>" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $xrow->nama_user?></span>
                  <span class="time messege-text"><?php echo $xrow->jenis_lowongan=('Dalam Negeri')?></span> 
                  <span class="time messege-text"><?php echo $xrow->judul_lowongan?></span>
                    <span class="time"><?php echo $xrow->date ?> </span>
                  
                </a> 
                <a href="admin/lokerln" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $xrow->foto_user?>" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $xrow->nama_user?></span>
                  <span class="time messege-text"><?php echo $xrow->jenis_lowongan=('Luar Negeri')?></span> 
                  <span class="time messege-text"><?php echo $xrow->judul_lowongan?></span>
                    <span class="time"><?php echo $xrow->date ?> </span>
                  
                </a> 
              <?php } ?>
              </div>
              
            </div>
          </li>
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
              <span class="badge headerBadge1">
               <?php 
                $q=$this->db->query("select pelatihan.*,user.id_user,user.foto_user,user.nama_user from pelatihan 
                left join user on user.id_user=pelatihan.id_user ")->num_rows();
                ?>
                <?php echo $q ?></span> </a>
              <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifikasi Pelatihan
               
              </div>
              <div class="dropdown-list-content dropdown-list-message">
              <?php 
                $q=$this->db->query("select pelatihan.*,user.id_user,user.nama_user,user.foto_user from pelatihan 
                left join user on user.id_user=pelatihan.id_user");
                foreach ($q->result() as $xrow) {
                ?>
                <a href="admin/pelatihan" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $xrow->foto_user?>" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $xrow->nama_user?></span>
                    <span class="time messege-text"><?php echo $xrow->nama_pelatihan?></span>
                    <span class="time"><?php echo $xrow->date ?></span>
                  
                </a> 
              <?php } ?>
              </div>
            </div>
          </li> -->
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="bell"></i>
              <span class="badge headerBadge1">
                <?php
                $q=$this->db->query("select * from user where status='0' limit 5")->num_rows();
                ?>
                <?php echo $q ?></span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Notifikasi User
               
              </div>
              <div class="dropdown-list-content dropdown-list-message">
              <?php 
                $q=$this->db->query("select * from user where status='0' limit 5");
                foreach ($q->result() as $xrow) {
              ?>
              <?php if($xrow->level=="2"){?>
                <a href="admin/perusahaan" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $xrow->foto_user?>" class="rounded-circle img-fluid">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $xrow->nama_user?></span>
                  <span class="time messege-text">Menunggu Verifikasi</span>
                  <span class="time"><?php echo $xrow->date ?> </span>
                </a> 
              <?php }elseif($xrow->level=="3"){?>
                 <a href="admin/penyediapelatihan" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="image/<?php echo $xrow->foto_user?>" class="rounded-circle img-fluid">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?php echo $xrow->nama_user?></span>
                  <span class="time messege-text">Menunggu Verifikasi</span>
                    <span class="time"><?php echo $xrow->date ?> </span>
                </a> 
              <?php } ?>
              <?php } ?>
              </div>
              
            </div>
          </li>
          
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
              <img alt="image" src="<?php echo base_url('image/').$this->session->userdata('gambar')?>"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?php echo $this->session->userdata('nama')?></div>
              <a href="admin/profil" class="dropdown-item has-icon"> <i class="fas fa-user"></i>
                Profil
              </a> 
              <a href="admin/ubahpasswordbaru" class="dropdown-item has-icon"> <i class="fas fa-key"></i>
                Ubah Password
              </a>
              <a href="login/logout" class="dropdown-item has-icon text-danger tombol-logout"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="admin/index"> <img alt="image" src="image/<?php echo $row->logo ?>" class="header-logo" /> <span
                class="logo-name"><?php echo $row->web ?></span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown">
              <a href="admin/index" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown <?php if($this->uri->segment(2)=='tambahmofficer' OR $this->uri->segment(2)=='mofficer') echo 'active' ?> ">
							<a href="#" class="menu-toggle nav-link has-dropdown"><i
									data-feather="user"></i><span>Management Officer</span></a>
							<ul class="dropdown-menu">
								<li class="<?php if($this->uri->segment(2)=='tambahmofficer')echo 'active'?>"><a class="nav-link" href="admin/tambahmofficer">Tambah Management Officer</a></li>
								<li class="<?php if($this->uri->segment(2)=='mofficer')echo 'active'?>"><a class="nav-link" href="admin/mofficer">Management Officer</a></li>
							</ul>
		      	</li>
            <li class="dropdown <?php if($this->uri->segment(2)=='pencarikerja' OR $this->uri->segment(2)=='perusahaan' OR $this->uri->segment(2)=='penyediapelatihan') echo 'active' ?> ">
							<a href="#" class="menu-toggle nav-link has-dropdown"><i
									data-feather="users"></i><span>Management Users</span></a>
							<ul class="dropdown-menu">
								<li class="<?php if($this->uri->segment(2)=='pencarikerja')echo 'active'?>"><a class="nav-link" href="admin/pencarikerja">Pencari Kerja</a></li>
								<li class="<?php if($this->uri->segment(2)=='perusahaan')echo 'active'?>"><a class="nav-link" href="admin/perusahaan">Penyedia Kerja</a></li>
                <li class="<?php if($this->uri->segment(2)=='penyediapelatihan')echo 'active'?>"><a class="nav-link" href="admin/penyediapelatihan">Penyedia Pelatihan</a></li>
							</ul>
		      	</li>
            <li class="dropdown <?php if($this->uri->segment(2)=='lokerdn' OR $this->uri->segment(2)=='lokerln') echo 'active' ?> ">
							<a href="#" class="menu-toggle nav-link has-dropdown"><i
									data-feather="layers"></i><span>Lowongan Kerja</span></a>
							<ul class="dropdown-menu">
							  <li class="<?php if($this->uri->segment(2)=='lokerdn')echo 'active'?>"><a class="nav-link" href="admin/lokerdn">Loker Dalam Negeri</a></li>
								<li class="<?php if($this->uri->segment(2)=='lokerln')echo 'active'?>"><a class="nav-link" href="admin/lokerln">Loker Luar Negeri</a></li>
							</ul>
		      	</li>
            <li class="dropdown <?php if($this->uri->segment(2)=='historilokerdn' OR $this->uri->segment(2)=='historilokerln') echo 'active' ?> ">
							<a href="#" class="menu-toggle nav-link has-dropdown"><i
									data-feather="book-open"></i><span>Riwayat Loker</span></a>
							<ul class="dropdown-menu">
								<li class="<?php if($this->uri->segment(2)=='historilokerdn')echo 'active'?>"><a class="nav-link" href="admin/historilokerdn">Riwayat Loker Dalam Negeri</a></li>
								<li class="<?php if($this->uri->segment(2)=='historilokerln')echo 'active'?>"><a class="nav-link" href="admin/historilokerln">Riwayat Loker Luar Negeri</a></li>
							</ul>
		      	</li>
            <li class="dropdown <?php if($this->uri->segment(2)=='pelatihan' OR $this->uri->segment(2)=='historipelatihan') echo 'active' ?> ">
							<a href="#" class="menu-toggle nav-link has-dropdown"><i
									data-feather="briefcase"></i><span>Pelatihan</span></a>
							<ul class="dropdown-menu">
								<li class="<?php if($this->uri->segment(2)=='pelatihan')echo 'active'?>"><a class="nav-link" href="admin/pelatihan">Pelatihan</a></li>
								<li class="<?php if($this->uri->segment(2)=='historipelatihan')echo 'active'?>"><a class="nav-link" href="admin/historipelatihan">Riwayat Pelatihan</a></li>
							</ul>
		      	</li>
            <li class="dropdown">
              <a href="admin/penempatan" class="nav-link"><i data-feather="radio"></i><span>Penempatan</span></a>
            </li>
            <li class="dropdown <?php if( $this->uri->segment(2)=='kategori' OR $this->uri->segment(2)=='inputartikel' OR $this->uri->segment(2)=='artikel' OR $this->uri->segment(2)=='komentarartikel') echo 'active' ?> ">
							<a href="#" class="menu-toggle nav-link has-dropdown"><i
									data-feather="image"></i><span>Data Artikel</span></a>
							<ul class="dropdown-menu">
								<li class="<?php if($this->uri->segment(2)=='kategori')echo 'active'?>"><a class="nav-link" href="admin/kategori">Kategori</a></li>
                <li class="<?php if($this->uri->segment(2)=='inputartikel')echo 'active'?>"><a class="nav-link" href="admin/inputartikel">Input Artikel</a></li>
								<li class="<?php if($this->uri->segment(2)=='artikel')echo 'active'?>"><a class="nav-link" href="admin/artikel">Artikel</a></li>
                <li class="<?php if($this->uri->segment(2)=='komentarartikel')echo 'active'?>"><a class="nav-link" href="admin/komentarartikel">Komentar Artikel</a></li>
							</ul>
		      	</li>
           <li class="dropdown <?php if($this->uri->segment(2)=='settingweb') echo 'active' ?>">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="settings"></i><span>Setting Website</span></a>
              <ul class="dropdown-menu">
            <li class="<?php if($this->uri->segment(2) == 'settingweb') echo 'active' ?>">
              <a href="admin/settingweb" class="nav-link"><span>Setting Website</span></a>
            </li>
            <li>
              <a href="admin/backup" class="nav-link backup"><span>Backup Database</span></a>
            </li>
            <!-- <li class="">
              <a href="admin/import" class="nav-link"><span>Import Database</span></a>
            </li> -->
              </ul>
            </li>
            <!-- <li class="dropdown">
              <a href="admin/index" class="nav-link"><i data-feather="trash"></i><span>Bersihkan Data Pencaker</span></a>
            </li> -->
          </ul>
        </aside>
      </div>
 <script>
   $(".backup").on('click',function(e){
		e.preventDefault();
    Swal.fire({
  title: 'Informasi',
  text: "Backup Database ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, backup!',
  cancelButtonText: 'Batal'
}).then((result) => {
  if (result.isConfirmed) {
    
			$.ajax({
			  url:$(this).attr('href'),
			  type: 'post',
			  data: $(this).serialize(),
			  dataType: "html",
				 success: function(dt){
					 if(dt){
					Swal.fire(
					  'Informasi',
					  'Berhasil Backup Database!',
					  'success'
					);
					 }else{

						Swal.fire(
					  'Informasi',
					  'Gagal Backup!',
					  'warning'
					);

					 }

				 }
		});
  }
})
	}); 
 </script>

<!-- . = class , # = id -->
    