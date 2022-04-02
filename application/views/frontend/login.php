
<br>
<br>
<main id="main">
  <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <p>Masuk Ke Akun Anda</p>
        </header>
<div class="card">
         <div class="card-header bg-primary text-light">
           
        </div>
        <div class="card-body">
          <form action="home/cekuser" method="post">
              <table class="table">
                    <tr>
                        <td>
                            Username
                        </td>
                        <td>
                            <input name="username" class="form-control" type="text">
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Password
                        </td>
                        <td>
                            <input name="password" class="form-control" type="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Masukkan Captcha
                        </td>
                        <td>
                           <?php echo $captcha?>
                           <br>
                           <br>
                           <input name="captcha" class="form-control" type="text">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit" class="btn btn-primary">Masuk</button>
                        </td>
                    </tr>
              </table>
          </form>
          <a href="lupapassword/lupapassword"><i class="fa fa-key"></i> Lupa Password?</a>
        </div>
        </div>
        
        <br>
        <a href="register/daftar_pencarikerja"><i class="fa fa-user-tie"></i> Daftar Sebagai Pencari Kerja</a>
        <br>
        <a href="register/daftar_penyediakerja"><i class="fa fa-building"></i> Daftar Sebagai Penyedia Kerja</a>
        <br>
        <a href="register/daftar_penyediapelatihan"><i class="fa fa-portrait"></i> Daftar Sebagai Penyedia Pelatihan</a>
    </div>
      </div>

    </section><!-- End Testimonials Section -->

 <!-- ======= Hero Section ======= -->
 
  </main><!-- End #main -->

   <?php if($this->session->flashdata('msg') == 'wrongcaptcha'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Captcha yang Anda Masukkan Salah!",
      "error"
    );
  </script>
  <?php } ?>

  <?php if($this->session->flashdata('msg')){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Captcha yang Anda Masukkan Salah!",
      "error"
    );
  </script>
  <?php } ?>

   <?php if($this->session->flashdata('msg') == 'gagalpassword'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Password yang Anda Masukkan Salah!",
      "error"
    );
  </script>
  <?php }elseif($this->session->userdata('msg') == 'status'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Maaf Akun Anda belum diverifikasi oleh Admin, Silahkan Hubungi Admin!",
      "warning"
    );
  </script>
  <?php } ?>


 