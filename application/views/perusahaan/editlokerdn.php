<!-- Main Content -->
<div class="main-content">
  <?php
  $q = $this->db->query("select lowongan.*,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                      
                        inner join sektor on sektor.id_sektor=lowongan.id_sektor
                        inner join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.id_lowongan='$id' and lowongan.jenis_lowongan='Dalam Negeri'
                        ");
  $row = $q->row();
  ?>
  <section class="section">
    <div class="section-body">
      <!-- add content here -->
      <div class="card">
        <div class="card-header bg-primary text-light">
          Edit Lowongan Kerja Dalam Negeri
        </div>
        <div class="card-body">
          <form action="perusahaan/updatelokerdn/<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <table class="table">
              <tr>
                <td>Disediakan Untuk</td>
                <td>
                  <select name="disediakanuntuk" required class=form-control id="">
                    <option value="">Pilih Kategori</option>
                    <option value="Umum" <?php if ($row->disediakanuntuk == 'Umum') echo 'selected' ?>>Umum</option>
                    <option value="Disabilitas" <?php if ($row->disediakanuntuk == 'Disabilitas') echo 'selected' ?>>Disabilitas</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Posisi yang dibutuhkan</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->jabatan; ?>' name="jabatan">
                </td>
              </tr>
              <tr>
                <td>Judul Lowongan</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->judul_lowongan; ?>' name="judullowongan">
                </td>
              </tr>
              <tr>
                <td>Deskripsi Lowongan</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->deskripsi_lowongan ?>' name="deskripsi_lowongan">
                </td>
              </tr>
              <tr>
                <td>Sektor</td>
                <td>
                  <select name="id_sektor" required class="form-control select2" id="">
                    <option value="<?php echo $row->id_sektor ?>"><?php echo $row->nama_sektor ?></option>
                    <?php
                    $q = $this->db->query('select * from sektor');
                    foreach ($q->result() as $rowsektor) {
                    ?>
                      <option value="<?php echo $rowsektor->id_sektor ?>"><?php echo $rowsektor->nama_sektor ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Tanggal Mulai</td>
                <td>
                  <input type="date" required class="form-control" value='<?php echo $row->tgl_buka_loker ?>' name="buka_loker">
                </td>
              </tr>
              <tr>
                <td>Tanggal Selesai</td>
                <td>
                  <input type="date" required class="form-control" value='<?php echo $row->tgl_tutup_loker ?>' name="tgl_tutup_loker">
                </td>
              </tr>
              <tr>
                <td>Tanggal Seleksi Administrasi</td>
                <td>
                  <input type="date" required class="form-control" value='<?php echo $row->tgl_seleksi_administrasi ?>' name="tgl_seleksi_administrasi">
                </td>
              </tr>
              <tr>
                <td>Tanggal Seleksi Wawanacara</td>
                <td>
                  <input type="datetime-local" required class="form-control" value='<?php echo $row->tgl_seleksi_wawancara ?>' name="tgl_seleksi_wawancara">
                </td>
              </tr>
              <tr>
                <td>Lokasi Wawancara</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->lokasi_wawancara ?>' name="lokasi_wawancara">
                </td>
              </tr>
              <tr>
                <td>Lokasi Penempatan</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->lokasi_lowongan ?>' name="lokasi_lowongan">
                </td>
              </tr>
              <tr>
                <td>Jurusan</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->jurusan ?>' name="jurusan">
                </td>
              </tr>
              <tr>
                <td>Pendidikan</td>
                <td>
                  <select name="id_pendidikan" required class="form-control select2" id="">
                    <option value="<?php echo $row->id_pendidikan ?>"><?php echo $row->nama_pendidikan ?></option>
                    <?php
                    $q = $this->db->query('select * from pendidikan');
                    foreach ($q->result() as $rowpendidikan) {
                    ?>
                      <option value="<?php echo $rowpendidikan->id_pendidikan ?>"><?php echo $rowpendidikan->nama_pendidikan ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Nama Penaggungjawab</td>
                <td>
                  <input type="text" required class="form-control" value='<?php echo $row->nama_pj ?>' name="nama_pj">
                </td>
              </tr>
              <tr>
                <td>Status</td>
                <td>
                  <select name="status" required class=form-control id="">
                    <option value="">Pilih Status</option>
                    <option value="Aktif" <?php if ($row->status == 'Aktif') echo 'selected' ?>>Aktif</option>
                    <option value="Tutup Lowongan" <?php if ($row->status == 'Tutup Lowongan') echo 'selected' ?>>Tutup Lowongan</option>
                  </select>
                </td>
              </tr>
              <tr>
              <tr>
                <td></td>
                <td>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                  <a href="perusahaan/lokerdn" class="btn btn-danger mr-2"><i class="fa fa-sync-alt"></i> Kembali</a>
                </td>
              </tr>
            </table>
          </form>
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
<script>
  $('#datepickerfrom').datepicker({
    uiLibrary: 'bootstrap4'
  });
</script>