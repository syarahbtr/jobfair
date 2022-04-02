<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->
      <div class="card">
        <div class="card-header bg-primary text-light">
          Riwayat Dalam Negeri
        </div>
        <div class="card-body table-responsive">
          <a href="perusahaan/eksportpdfriwayatlokerdn" class="btn btn-primary mb-3"><i class="fa fa-download"></i> Eksport PDF</a>
          <Table class="table table-hover dttable">
            <thead>
              <tr align=center>
                <th>No</th>
                <th>Disediakan Untuk</th>
                <th>Nama Perusahaan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Judul Lowongan</th>
                <th>Jurusan</th>
                <th>Jumlah Pelamar</th>
                <th>Aksi</th>
              </tr>
            <tbody>
              <?php
              $id = $this->session->userdata('id');
              $no = 1;
              $today = date("Y-m-d");
              $q = $this->db->query("select lowongan.*,lamar.id_lamar,lamar.id_pencaker,user.id_user,user.nama_user from lowongan
              left join lamar on lamar.id_lowongan=lowongan.id_lowongan
              left join user on user.id_user=lowongan.id_user
              where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_seleksi_wawancara<='$today' and lowongan.jenis_lowongan='Dalam Negeri'");
              foreach ($q->result() as $row) {
                $lamar = $this->db->query("SELECT *, count(lamar.id_pencaker)as jml FROM lamar WHERE  lamar.id_lowongan='$row->id_lowongan' ")->row();
              ?>

                <!-- // $q = $this->db->query("select * from lowongan WHERE lowongan.id_user='$id' AND lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker<='$today' and lowongan.status='Tutup Lowongan'");
                        //     foreach ($q->result() as $row) {
                        //         $user = $this->db->query(" SELECT * FROM user WHERE user.id_user='$row->id_user'")->row();
                        //         $lamar = $this->db->query(" SELECT count(lamar.id_lowongan)as jml FROM lamar WHERE lamar.id_lowongan='$row->id_lowongan' ")->row(); -->


                <tr align=center>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $row->disediakanuntuk; ?></td>
                  <td><?php echo $row->nama_user; ?></td>
                  <td> <?php $originalDate = $row->tgl_buka_loker;
                        echo date("d F Y", strtotime($originalDate)); ?></td>
                  <td> <?php $originalDate = $row->tgl_tutup_loker;
                        echo date("d F Y", strtotime($originalDate)); ?></td>
                  <td><?php echo $row->judul_lowongan; ?></td>
                  <td><?php echo $row->jurusan; ?></td>
                  <td width=25%>
                    <a class=" btn btn-primary" href="perusahaan/historipelamardn/<?php echo $row->id_lowongan ?>" role="button">
                      Pelamar<span class="badge badge-light">
                        <?php echo $lamar->jml ?></span></a>
                  </td>
                  <td>
                    <a href="perusahaan/detailhistorilokerdn/<?php echo $row->id_lowongan ?>" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php $no++;
              } ?>
            </tbody>
            </thead>
          </Table>
        </div>
      </div>
    </div>
  </section>
  <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default">
      <div class=" fade show active">
        <div class="setting-panel-header">Setting Panel
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Select Layout</h6>
          <div class="selectgroup layout-color w-50">
            <label class="selectgroup-item">
              <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
              <span class="selectgroup-button">Light</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
              <span class="selectgroup-button">Dark</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Sidebar Color</h6>
          <div class="selectgroup selectgroup-pills sidebar-color">
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
              <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip" data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Color Theme</h6>
          <div class="theme-setting-options">
            <ul class="choose-theme list-unstyled mb-0">
              <li title="white" class="active">
                <div class="white"></div>
              </li>
              <li title="cyan">
                <div class="cyan"></div>
              </li>
              <li title="black">
                <div class="black"></div>
              </li>
              <li title="purple">
                <div class="purple"></div>
              </li>
              <li title="orange">
                <div class="orange"></div>
              </li>
              <li title="green">
                <div class="green"></div>
              </li>
              <li title="red">
                <div class="red"></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="mini_sidebar_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Mini Sidebar</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="sticky_header_setting">
              <span class="custom-switch-indicator"></span>
              <span class="control-label p-l-10">Sticky Header</span>
            </label>
          </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
          <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
            <i class="fas fa-undo"></i> Restore Default
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('.dttable').DataTable();
</script>