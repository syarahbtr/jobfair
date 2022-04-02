<!-- ======= Hero Section ======= -->
<section id="contact" class="contact">

  <div class="container">
    <br>
    <br>
    <br>
    <div class="row">
      <div class="col-lg-6 table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr align="center">
              <th colspan="6" class="table-info">Daftar Lamaran Yang Aktif</th>
            </tr>
            <tr>
              <th>No</th>
              <th>Judul Lowongan</th>
              <th>Nama Perusahaan</th>
              <th>Posisi</th>
              <th>Status Lamaran</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $id = $this->session->userdata('id');
            $q = $this->db->query("select lamar.*,lowongan.id_user,lowongan.id_lowongan,lowongan.judul_lowongan,user.nama_user,perusahaan.id_user,status_pelamar.nama_status_lamar,lowongan.jabatan from lamar
            left join lowongan on lowongan.id_lowongan=lamar.id_lowongan
            left join perusahaan on perusahaan.id_user=lowongan.id_user 
            left join user on user.id_user=perusahaan.id_user 
            left join status_pelamar on status_pelamar.id_status_lamar=lamar.id_status_lamar 
            where lamar.id_user='$id' and lowongan.status='Aktif' and lamar.id_status_lamar in (2,3,4)");
            foreach ($q->result() as $row) {
            ?>
              <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $row->judul_lowongan ?></td>
                <td><?php echo $row->nama_user ?></td>
                <td><?php echo $row->jabatan ?></td>
                <td><?php echo $row->nama_status_lamar ?></td>
              </tr>
            <?php $no++;
            } ?>
          </tbody>

        </table>
      </div>
      <div class="col-lg-6 table-responsive">
        <table class="table table-striped table-bordered">
          <thead>
            <tr align="center">
              <th colspan="6" class="table-info">Daftar Lamaran Yang Pernah Diikuti</th>
            </tr>
            <tr>
              <th>No</th>
              <th>Judul Lowongan</th>
              <th>Nama Perusahaan</th>
              <th>Posisi</th>
              <th>Status Lamaran</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $id = $this->session->userdata('id');
            $b = $this->db->query("select lamar.*,lowongan.id_user,lowongan.id_lowongan,lowongan.judul_lowongan,user.nama_user,perusahaan.id_user,status_pelamar.nama_status_lamar,lowongan.jabatan from lamar
            left join lowongan on lowongan.id_lowongan=lamar.id_lowongan
            left join perusahaan on perusahaan.id_user=lowongan.id_user 
            left join user on user.id_user=perusahaan.id_user 
            left join status_pelamar on status_pelamar.id_status_lamar=lamar.id_status_lamar 
            where lamar.id_user='$id' and lamar.id_status_lamar in (1,5,6)");
            foreach ($b->result() as $xrow) {
            ?>
              <tr>
                <td><?php echo $no ?></td>
                <td><?php echo $xrow->judul_lowongan ?></td>
                <td><?php echo $xrow->nama_user ?></td>
                <td><?php echo $xrow->jabatan ?></td>
                <td><?php echo $xrow->nama_status_lamar ?></td>
              </tr>
            <?php $no++;
            } ?>
          </tbody>

        </table>
      </div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr align="center">
            <th colspan="8" class="table-info">Daftar Pelatihan Yang Diikuti</th>
          </tr>
          <tr>
            <th>No</th>
            <th>Penyelenggara Pelatihan</th>
            <th>Nama Pelatihan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Alamat</th>
            <th>Link Sertifikat</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $today = date("Y-m-d");
          $id = $this->session->userdata('id');
          $q = $this->db->query("select daftar_pelatihan.*,user.id_user,user.nama_user,pelatihan.id_user,pelatihan.sertifikat,pelatihan.nama_pelatihan,pelatihan.tanggal_mulai,pelatihan.tanggal_selesai,pelatihan.alamat,penyedia_pelatihan.id_user from daftar_pelatihan
          left join pelatihan on pelatihan.id_pelatihan=daftar_pelatihan.id_pelatihan
          left join penyedia_pelatihan on penyedia_pelatihan.id_user=pelatihan.id_user
          left join user on user.id_user=penyedia_pelatihan.id_user
          where daftar_pelatihan.id_user='$id' ");
          foreach ($q->result() as $rowx) {
          ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $rowx->nama_pelatihan ?></td>
              <td><?php echo $rowx->nama_user ?></td>
              <td><?php echo $rowx->tanggal_mulai ?></td>
              <td><?php echo $rowx->tanggal_selesai ?></td>
              <td><?php echo $rowx->alamat ?></td>
              <?php
              if ($today >= $rowx->tanggal_selesai) {
              ?>
                <td>
                  <a href="<?php echo $rowx->sertifikat ?>" class="btn btn-primary">Unduh Sertifikat</a>
                </td>
              <?php } else { ?>
                <td>Link Sertifikat Belum Ada</td>
              <?php } ?>
            </tr>
          <?php $no++;
          } ?>
        </tbody>

      </table>
    </div>
  </div>

  </div>

</section><!-- End Hero -->