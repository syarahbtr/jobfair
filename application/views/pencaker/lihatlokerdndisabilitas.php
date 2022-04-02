<main id="main">
    <?php 
                $today= date("Y-m-d"); 
                $q=$this->db->query("select lowongan.*,user.nama_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' and lowongan.id_lowongan='$id'
                        and lowongan.disediakanuntuk='Disabilitas'
                        ");
                $row=$q->row();
                ?>

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="Pencaker">Home</a></li>
          <li>Deatil Lowongan Dalam Negeri Disabilitas</li>
        </ol>
        <h2>Detail Lowongan Dalam Negeri Disabilitas</h2>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Blog Section ======= -->
    <section id="values" class="values">
    <div class="container" data-aos="fade-up">     
    <div class="card">
    <div class="card-header">
        <p><?php echo $row->judul_lowongan?></p>
    </div>
    <div class="card-body">
        <table>
           <tr>
                    <td>Disediakan Untuk</td>
                    <td>:</td>
                      <td><?php echo $row->disediakanuntuk?></td>
                    </tr>
                    <tr>
                      <td>Posisi yang Dibutuhkan</td>
                      <td>:</td>
                      <td><?php echo $row->jabatan?></td>
                    </tr>
                    <tr>
                      <td>Judul Lowongan</td>
                      <td>:</td>
                      <td><?php echo $row->judul_lowongan?></td>
                    </tr>
                    <tr>
                      <td>Deskripsi Lowongan</td>
                      <td>:</td>
                      <td><?php echo $row->deskripsi_lowongan?></td>
                    </tr>
                    <tr>
                      <td>Sektor</td>
                      <td>:</td>
                      <td><?php echo $row->nama_sektor?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Mulai</td>
                      <td>:</td>
                      <td><?php echo $row->tgl_buka_loker?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Selesai</td>
                      <td>:</td>
                      <td><?php echo $row->tgl_tutup_loker?></td>
                    </tr>
                    <tr>
                      <td>Nama Perusahaan</td>
                      <td>:</td>
                      <td><?php echo $row->nama_user?></td>
                    </tr>
                    <tr>
                      <td>Lokasi Lowongan</td>
                      <td>:</td>
                      <td><?php echo $row->lokasi_lowongan?></td>
                    </tr>
                    <tr>
                      <td>Jurusan</td>
                      <td>:</td>
                      <td><?php echo $row->jurusan?></td>
                    </tr>
                    <tr>
                      <td>Pendidikan</td>
                      <td>:</td>
                      <td><?php echo $row->nama_pendidikan?></td>
                    </tr> 
        </table>
        <br>
        <a href="pencaker/lamarlokerdndisabilitas/<?php echo $row->id_lowongan ?>" class="btn btn-danger">Lamar</a>
    </div>
    </div>
    
</div>
</section>

</main>