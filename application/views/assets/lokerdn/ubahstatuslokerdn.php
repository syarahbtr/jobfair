<!-- Main Content -->
      <div class="main-content">
        <?php 
        $q=$this->db->query("select lowongan.*,user.id_user,user.nama_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.id_lowongan='$id'
                        ");
        $row=$q->row(); #row untuk manggil 1 data, kalo banyak data pake result
        ?>
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-primary text-light">
                Detail Loker
                 </div>
                <div class="card-body">
                  <table class="table table-striped">
                    <tr>
                      <td>Disediakan Untuk</td>
                      <td><?php echo $row->disediakanuntuk?></td>
                    </tr>
                    <tr>
                      <td>Posisi yang Dibutuhkan</td>
                      <td><?php echo $row->jabatan?></td>
                    </tr>
                    <tr>
                      <td>Judul Lowongan</td>
                      <td><?php echo $row->judul_lowongan?></td>
                    </tr>
                    <tr>
                      <td>Deskripsi Lowongan</td>
                      <td><?php echo $row->deskripsi_lowongan?></td>
                    </tr>
                    <tr>
                      <td>Sektor</td>
                      <td><?php echo $row->nama_sektor?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Mulai</td>
                      <td><?php echo $row->tgl_buka_loker?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Selesai</td>
                      <td><?php echo $row->tgl_tutup_loker?></td>
                    </tr>
                     <tr>
              <td>Tanggal Seleksi Administrasi</td>
              <td><?php echo $row->tgl_seleksi_administrasi ?></td>
            </tr>
            <tr>
              <td>Tanggal Seleksi Wawancara</td>
              <td><?php echo $row->tgl_seleksi_wawancara ?></td>
            </tr>
            <tr>
              <td>Lokasi Wawancara</td>
              <td><?php echo $row->lokasi_wawancara ?></td>
            </tr>
                    <tr>
                      <td>Nama Perusahaan</td>
                      <td><?php echo $row->nama_user?></td>
                    </tr>
                    <tr>
                      <td>Lokasi Lowongan</td>
                      <td><?php echo $row->lokasi_lowongan?></td>
                    </tr>
                    <tr>
                      <td>Jurusan</td>
                      <td><?php echo $row->jurusan?></td>
                    </tr>
                    <tr>
                      <td>Pendidikan</td>
                      <td><?php echo $row->nama_pendidikan?></td>
                    </tr>
                    <tr>
                      <td>Nama Penanggungjawab</td>
                      <td><?php echo $row->nama_pj?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Pelamar</td>
                      <td><?php echo $row->jumlah?></td>
                    </tr>
                    <tr>
                      <td>Status Lowongan</td>
                      <td><?php echo $row->status?></td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <a href="admin/lokerdn" class="btn btn-warning">Kembali</a>
                        </td>
                    </tr>
                    </form>
                  </table>
                  
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
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
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
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
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