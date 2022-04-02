<div class="main-content">
  <section class="section">
    <div class="section-body">
      <!-- add content here -->
      <div class="card">
        <div class="card-header bg-primary text-light">
          Tambah Lowongan
        </div>
        <div class="card-body">
          <form action="perusahaan/tambahloker" method="post" enctype="multipart/form-data">
            <table class="table">
              <tr>
                <td>
                  Jenis Lowongan <span class="text-danger">*</span>
                </td>
                <td>
                  <select name="jenis_lowongan" class=form-control id="">
                    <option value="">Pilih Jenis Lowongan</option>
                    <option value="Dalam Negeri">Dalam Negeri</option>
                    <option value="Luar Negeri">Luar Negeri</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Disediakan Untuk <span class="text-danger">*</span>
                </td>
                <td>
                  <select name="disediakanuntuk" class=form-control id="">
                    <option value="">Pilih Kategori</option>
                    <option value="Umum">Umum</option>
                    <option value="Disabilitas">Disabilitas</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Posisi <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" class="form-control" name="jabatan" value="<?php echo set_value('jabatan') ?>">
                </td>
              </tr>
              <tr>
                <td>
                  Judul Lowongan <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" class="form-control" name="judullowongan" value="<?php echo set_value('judullowongan') ?>">
                </td>
              </tr>
              <tr>
                <td>
                  Deskripsi Lowongan <span class="text-danger">*</span>
                </td>
                <td>
                  <textarea class="form-control" name="deskripsi_lowongan" id="" cols="30" rows="10"></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  Sektor <span class="text-danger">*</span>
                </td>
                <td>
                  <select name="id_sektor" class="form-control select2" id="">
                    <option value="">Pilih Sektor</option>
                    <?php
                    $q = $this->db->query('select * from sektor');
                    foreach ($q->result() as $row) {
                    ?>
                      <option value="<?php echo $row->id_sektor ?>"><?php echo $row->nama_sektor ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Tanggal Mulai <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="date" class="form-control" name="tgl_buka_loker" value="<?php echo set_value('jabatan') ?> ">
                </td>
              </tr>
              <tr>
                <td>
                  Tanggal Selesai <span class=" text-danger">*</span>
                </td>
                <td>
                  <input type="date" class="form-control" name="tgl_tutup_loker" value="<?php echo set_value('jabatan') ?>">
                </td>
              </tr>
              <tr>
                <td>
                  Tanggal Seleksi Administrasi <span class=" text-danger">*</span>
                </td>
                <td>
                  <input type="date" class="form-control" name="tgl_seleksi_administrasi">
                </td>
              </tr>
              <tr>
                <td>
                  Tanggal Seleksi Wawancara <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="datetime-local" class="form-control" name=tgl_seleksi_wawancara>
                </td>
              </tr>
              <tr>
                <td>
                  Lokasi Wawancara <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" class="form-control" name="lokasi_wawancara">
                </td>
              </tr>
              <tr>
                <td>
                  Nama Perusahaan <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" value="<?php echo $this->session->userdata('nama') ?>" name='nama_user' class="form-control" readonly>
                </td>
              </tr>
              <tr>
                <td>
                  Lokasi Penempatan <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" class="form-control" name="lokasi_lowongan">
                </td>
              </tr>
              <tr>
                <td>
                  Jurusan <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" class="form-control" name=jurusan>
                </td>
              </tr>
              <tr>
                <td>
                  Pendidikan <span class="text-danger">*</span>
                </td>
                <td>
                  <select name="id_pendidikan" class="form-control select2" id="">
                    <option value="">Pilih Pendidikan</option>
                    <?php
                    $q = $this->db->query('select * from pendidikan');
                    foreach ($q->result() as $row) {
                    ?>
                      <option value="<?php echo $row->id_pendidikan ?>"><?php echo $row->nama_pendidikan ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  Nama Penanggungjawab <span class="text-danger">*</span>
                </td>
                <td>
                  <input type="text" class="form-control" name=nama_pj>
                </td>
              </tr>
              <?php
              if ($this->session->userdata('level') == '1') {
              ?>

              <?php
              } else {
              ?>
              <?php
              }
              ?>

              <tr>
                <td></td>
                <td>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                  <!-- <a href="perusahaan/pelamardn" class="btn btn-danger"><i class="fa fa-sync-alt"></i> Batal</a> -->
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