<br>
<br>
<main id="main">
  <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <p>Ganti Password</p>
        </header>
            <div class="card">
         <div class="card-header bg-primary text-light">
        </div>
        <div class="card-body">
          <form action="lupapassword/gantipassword" method="post">
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
                        Password Baru
                        </td>
                        <td>
                            <input name="password" class="form-control" type="password">
                            <div class="form-text">Password minimal 8 karakter</div>
                            <?php echo form_error('password','<small class="text-danger">','</small>')?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                        Konfirmasi Password
                        </td>
                        <td>
                            <input name="password2" class="form-control" type="password">
                            <div class="form-text">Password minimal 8 karakter</div>
                            <?php echo form_error('password2','<small class="text-danger">','</small>')?>
                        </td>
                    </tr>
                    <tr>
                   
                        <td>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </td>
                    </tr>
              </table>
          </form>
        </div>
        </div>
       <a href="home/login">Sudah Punya Akun?</a>
    </div>
      </div>

    </section><!-- End Testimonials Section -->


   
 <!-- ======= Hero Section ======= -->
 
  </main><!-- End #main -->

 <?php if($this->session->flashdata('msg') == 'cekusername'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Username Tidak Valid",
      "error"
    );
  </script>
  <?php } ?>