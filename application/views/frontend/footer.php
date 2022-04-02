<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$setting = $this->db->get('setting');
$row = $setting->row();
?>
<!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="image/<?php echo $row->logo ?>" alt="">
              <span><?php echo $row->web ?></span>
            </a>
            <p>Dinas Perindustrian Dan Tenaga Kerja Kabupaten Sukoharjo menyediakan beragam pilihan Lowongan pekerjaan, raih kesempatan karir yang lebih besar dengan mendapatkan pekerjaan yang sesuai dengan spesialisasi, kriteria, dan kemampuanmu dengan banyak pilihan lowongan pekerjaan yang ada di website ini.</p>
            <div class="social-links mt-3">
              <a href="<?php echo $row->yt ?>" class="twitter"><i class="bi bi-youtube"></i></a>
              <a href="<?php echo $row->fb ?>" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="<?php echo $row->ig ?>" class="instagram"><i class="bi bi-instagram"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Pelatihan Terbaru</h4>
            <ul>
               <?php 
              $q = $this->model_footer->get_pelatihan_footer();
              foreach($q->result() as $xrowx){
              ?>
              <li><i class="bi bi-chevron-right"></i> <a target="_blank" href="home/pelatihanumum"><?php echo $xrowx->nama_pelatihan ?></a></li>
               <?php } ?>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Lowongan Terbaru</h4>
            <ul>
              <?php 
              $q = $this->model_footer->get_lowongan_footer();
              foreach($q->result() as $xrow){
              ?>
              <li><i class="bi bi-chevron-right"></i> <a href="home/lihatlokerdnumum/<?php echo $xrow->id_lowongan?>"><?php echo $xrow->judul_lowongan ?></a></li>
              <?php } ?>
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Kontak Kami</h4>
            <p>
              <?php echo $row->alamat ?><br>
              <strong>Telepon:</strong> <?php echo $row->telp ?><br>
              <strong>Email:</strong> <?php echo $row->email ?><br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Dinas Perindustrian Dan Tenaga Kerja Kabupaten Sukoharjo</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flexstart-bootstrap-startup-template/ -->
        Designed by <a href="https://bootstrapmade.com/">Diskominfo Kabupaten Sukoharjo</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="frontend/vendor/purecounter/purecounter.js"></script>
  <script src="frontend/vendor/aos/aos.js"></script>
  <script src="frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="frontend/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="frontend/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="frontend/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="frontend/js/main.js"></script>

  <script>
  $(document).ready(function(){
   $('.select2').select2();

    });
  </script>

</body>

</html>

<?php if($this->session->flashdata('msg') == 'simpan'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Data berhasil ditambahkan!",
      "success"
    );
  </script>
  <?php }elseif($this->session->flashdata('msg') == 'edit'){ ?>
    <script>
    Swal.fire(
      "Informasi",
      "Data berhasil diubah!",
      "success"
    );
  </script>
    <?php }elseif($this->session->userdata('msg') == 'hapus'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Data berhasil dihapus!",
      "success"
    );
  </script>
    <?php }elseif($this->session->userdata('msg') == 'gagal'){ ?>
      <script>
    Swal.fire(
      "Error",
      "Gagal Simpan Data",
      "error"
    );
  </script>
    <?php }elseif($this->session->userdata('msg') == 'sukses'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Berhasil minning!",
      "success"
    );
  </script>
  <?php }elseif($this->session->userdata('msg') == 'usernamegagal'){ ?>
      <script>
    Swal.fire(
      "Error",
      "Username Telah Digunakan, Silahkan Input Kembali dengan Username yang Berbeda!",
      "error"
    );
  </script>
  <?php }elseif($this->session->userdata('msg') == 'gagaldaftar'){ ?>
      <script>
    Swal.fire(
      "Error",
      "Umur Anda belum mencukupi untuk Daftar",
      "error"
    );
  </script>
  <?php }elseif($this->session->userdata('msg') == 'cekusername'){ ?>
      <script>
    Swal.fire(
      "Error",
      "Username Anda Tidak Terdaftar!",
      "error"
    );
  </script>
      <?php } ?>
    <?php if($this->session->flashdata('msg') == 'cekusername'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Username Tidak Valid",
      "error"
    );
  </script>
  <?php } ?>

  <?php if($this->session->flashdata('msg') == 'berhasilupdatepassword'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Password Anda Berhasil Diubah!",
      "success"
    );
  </script>
  <?php } ?>
