<main id="main">
    <?php 
                $today= date("Y-m-d"); 
                $q=$this->db->query("select lowongan.*,user.nama_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' and lowongan.id_lowongan='$id'
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas'
                        ");
                $row=$q->row();
                ?>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="pencaker">Home</a></li>
          <li>Lamar Lowongan Dalam Negeri Umum</li>
        </ol>
        <h2>Lamar Lowongan Dalam Negeri Umum</h2>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Blog Section ======= -->
    <section id="values" class="values">
    <div class="container" data-aos="fade-up">   
    <div class="card">
    <div class="card-body">
        <form action="pencaker/updatelamarlokerdndisabilitas" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Upload Berkas Tambahan (Jika tidak ada, boleh kosong)</td>
                    <td>*lihat deskripsi lowongan pekerjaan</td>
                    <td>:</td>
                      <td><input type="file" accept=".pdf" class="form-control" name=gambar></td>
					           <input type="hidden" class="form-control" name="id_lowongan" value="<?php echo $id ?>">
                     <input type="hidden" class="form-control" name="id_status_lamar" value="2">
                     <?php
                        $id_user = $this->session->userdata('id');
                        
                        $detail_user = $this->db->query("SELECT * from user WHERE id_user = $id_user ")->row();
                        $pencaker = $this->db->query("SELECT * from pencari_kerja WHERE id_user = $detail_user->id_user ")->row();
                     ?>
                     <input type="hidden" class="form-control" name="id_pencaker" value="<?php echo $pencaker->id_pencaker ?>">
                </tr>
                <tr>
                    <td><button type="sumbit" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin Melamar?')">Lamar</button></td>
                </tr>
                
            </table>
        </form>
    </div>
    </div>
    
</div>
</section>

</main>