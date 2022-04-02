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
          <form action="lupapassword/cek_email_username" method="post" id="masuk" >
              <table class="table">
                   <tr>
                        <td>
                        Email
                        </td>
                        <td>
                            <input name="email" class="form-control" type="email">
                        </td>
                    </tr>
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </td>
                    </tr>
              </table>
          </form>
          <script type="text/javascript">
          $(document).ready(function()
          {
            $("#masuk").on('submit',function(e){
              e.preventDefault();
              $.ajax({
                url:$(this).attr('action'),
                type: 'post',
                data: $(this).serialize(),
                dataType: "html",
                success: function(dt){
                if(dt==0){
                  Swal.fire(
                    'Informasi',
                    'Maaf username atau email anda salah!',
                    'warning'
                  )
                }else{
                  window.location=dt
                }
                }
			});
		});
		});
	</script>
        </div>
        </div>
       <a href="home/login">Sudah Punya Akun?</a>
    </div>
      </div>

    </section><!-- End Testimonials Section -->


   
 <!-- ======= Hero Section ======= -->
 
  </main><!-- End #main -->

  

 

  