<br>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="home">Home</a></li>
          <li>Lowongan Dalam Negeri Umum</li>
        </ol>
        <h2>Lowongan Dalam Negeri</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="values" class="values">
    <div class="container" data-aos="fade-up">   
    <div class="row">
      <?php 
                // $today= date("Y-m-d"); 
                // $q=$this->db->query("select lowongan.*,user.id_user,user.foto_user,jabatan.nama_jabatan,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                //         left join user on user.id_user=lowongan.id_user
                //         left join jabatan on jabatan.id_jabatan=lowongan.id_jabatan
                //         left join sektor on sektor.id_sektor=lowongan.id_sektor
                //         left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                //         where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                //         and lowongan.status='ACC' and lowongan.disediakanuntuk='Umum'
                //         ");
                foreach ($q->result() as $row){
                ?>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <?php if($row->foto_user==""){?>
                        <img src="assets/nofoto.jpg" class="img-fluid" alt="...">
                <?php }else { ?>
                    <img src="image/<?php echo $row->foto_user ?>" class="img-fluid" alt="...">
                <?php } ?>
              <h3><?php echo $row->judul_lowongan?></h3>
              <p><?php echo $row->deskripsi_lowongan?></p>
              <p>
                <a href="home/lihatlokerdnumum/<?php echo $row->id_lowongan ?>" class="btn btn-warning">Lihat</a>
                <a href="home/lamarlokerdnumum/<?php echo $row->id_lowongan ?>" class="btn btn-danger">Lamar</a>
              </p>
            </div>
          </div>
          <?php } ?>
            <nav>
              <?php error_reporting(0); echo $page;?>
            </nav>
        </div>
</div>
</section>

</main>