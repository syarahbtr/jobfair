<main id="main">

  <!-- ======= Breadcrumbs ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <ol>
        <li><a href="home">Home</a></li>
        <li>Pelatihan Disabilitas</li>
      </ol>
      <h2>Pelatihan</h2>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Blog Section ======= -->
  <section id="values" class="values">
    <div class="container" data-aos="fade-up">
      <div class="row">
        <?php
        // $today = date("Y-m-d");
        // $q = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
        //                 user.foto_user,pencari_kerja.id_pencaker from pelatihan
        //                 left join user on user.id_user=pelatihan.id_user
        //                 left join pencari_kerja on pencari_kerja.id_user = user.id_user
        //                 left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
        //                 where pelatihan.tanggal>='$today'
        //                 and pelatihan.status='ACC' and pelatihan.kategori='Disabilitas'
        //                 order by pelatihan.id_pelatihan desc");
        foreach ($q->result() as $row) {
          $peserta = $this->db->query("select * from daftar_pelatihan WHERE id_pelatihan= $row->id_pelatihan ")->num_rows();
        ?>
          <?php if ($peserta >= $row->jumlah_peserta) { ?>
          <?php } else { ?>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
              <form action="pencaker/daftarpelatihan" method="post">
                <div class="box">
                  <h3 style="color: #051361;">Pelatihan <?php echo $row->nama_pelatihan ?></h3>
                  <?php if ($row->foto_user == "") { ?>
                    <img src="assets/nofoto.jpg" class="img-fluid" alt="...">
                  <?php } else { ?>
                    <img src="image/<?php echo $row->foto_user ?>" class="img-fluid" alt="...">
                  <?php } ?>
                  <h5 style="color: #051361;"><?php echo $row->nama_user ?></h5>
                  <p><?php echo $row->deskripsi_pelatihan ?></p>
                  <p> <?php $originalDate = $row->tanggal_mulai;
                      echo date("d F Y", strtotime($originalDate)); ?></p>
                      <p>s/d</p>
                  <p> <?php $originalDate = $row->tanggal_selesai;
                      echo date("d F Y", strtotime($originalDate)); ?></p>
                  <p><?php echo $row->jam ?></p>
                  <p><?php echo $row->alamat ?></p>
                  <p>
                    <input type="hidden" name="id_pelatihan" value="<?php echo $row->id_pelatihan ?>">
                    <?php
                    $id_user = $this->session->userdata('id');

                    $detail_user = $this->db->query("SELECT * from user WHERE id_user = '$id_user' ")->row();
                    $pencaker = $this->db->query("SELECT * from pencari_kerja WHERE id_user = '$detail_user->id_user' ")->row();
                    ?>
                    <input type="hidden" name="id_pencaker" value="<?php echo $row->id_pencaker ?>">
                    <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id') ?>">
                    <button type="submit" class="btn btn-outline-primary" >Daftar</button>
                  </p>
                </div>
              </form>
            </div>
          <?php } ?>
        <?php } ?>
        <nav>
              <?php error_reporting(0); echo $page;?>
            </nav>
      </div>
    </div>
  </section>

</main>