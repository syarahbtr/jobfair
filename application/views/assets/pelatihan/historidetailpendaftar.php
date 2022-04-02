<!-- Main Content -->
      <div class="main-content">
        <?php 
        //  $q=$this->db->query("select daftar_pelatihan.*,user.*,pencari_kerja.*,pendidikan.nama_pendidikan,
        //                     agama.nama_agama,status_perkawinan.nama_status_perkawinan,jabatan.nama_jabatan 
        //                     from daftar_pelatihan
        //                     left join user on user.id_user=daftar_pelatihan.id_user
        //                     left join pencari_kerja on pencari_kerja.id_pencaker=daftar_pelatihan.id_pencaker
        //                     left join pendidikan on pendidikan.id_pendidikan=pencari_kerja.id_pendidikan
        //                     left join agama on agama.id_agama=pencari_kerja.id_agama
        //                     left join status_perkawinan on status_perkawinan.id_status_perkawinan=pencari_kerja.id_status_perkawinan                            
        //                     left join jabatan on jabatan.id_jabatan=pencari_kerja.id_jabatan
        //                     where daftar_pelatihan.id_pencaker='$id' ");
        // $row=$q->row();
        $pencari_kerja =$this->db->query("SELECT * FROM pencari_kerja WHERE id_user='$id' ")->row();
        $user =$this->db->query("SELECT * FROM user WHERE id_user='$id' ")->row();
        ?>
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-info text-dark">
                Detail Pencari Kerja
                 </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <tr>
                        <td class="table-info" align="center">Foto</td>
                        <td colspan="2">
                          <img src="image/<?php echo $user->foto_user ?>" width="100" class="img img-thumbnail img-fluid" alt="">
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-info" align="center">Nama</td>
                        <td><?php echo $user->nama_user?></td>
                    </tr>
                    <tr>
                        <td class="table-info" align="center">Nomor Induk Kependudukan (NIK)</td>
                        <td><?php echo $pencari_kerja->nik_pencaker?></td>
                    </tr>
                     <tr>
              <td class="table-info" align="center">Berkas Domisili</td>
              <td>
                <?php
                if ($pencari_kerja->berkas_domisili == "" || $pencari_kerja->berkas_domisili == NULL) {
                ?>
                  -
                <?php
                } else {
                ?>
                  <a href="image/<?php echo $pencari_kerja->berkas_domisili ?>" target="_blank"> lihat berkas</a>
                <?php
                }
                ?>
              </td>
            </tr>
                     <tr>
                      <td class="table-info" align="center">Tempat Lahir</td>
                        <td><?php echo $pencari_kerja->tempat_lahir?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Tanggal Lahir</td>
                        <td><?php echo $pencari_kerja->tanggal_lahir?></td>
                    </tr>
                     <tr>
                       <?php 
                        $agama=$this->db->query("SELECT * FROM agama WHERE id_agama='$pencari_kerja->id_agama' ")->row();
                      ?>
                      <td class="table-info" align="center">Agama</td>
                        <td><?php echo $agama->nama_agama?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Jenis Kelamin</td>
                        <td><?php echo $pencari_kerja->jenis_kelamin?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Tinggi Badan</td>
                        <td><?php echo $pencari_kerja->tinggi_badan?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Berat Badan</td>
                        <td><?php echo $pencari_kerja->berat_badan?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Status Perkawinan</td>
                      <?php 
                        $status_perkawinan=$this->db->query("SELECT * FROM status_perkawinan WHERE id_status_perkawinan='$pencari_kerja->id_status_perkawinan' ")->row();
                      ?>
                        <td><?php echo $status_perkawinan->nama_status_perkawinan?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Alamat</td>
                        <td><?php echo $user->alamat_user?></td>
                    </tr>
                    <tr>
                        <td class="table-info" align="center">Kode Pos</td>
                        <td><?php echo $pencari_kerja->kodepos?></td>
                    </tr>
                    <tr>
                        <td class="table-info" align="center">No HP</td>
                        <td><?php echo $user->nohp_user?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Email</td>
                        <td><?php echo $user->email_user?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Pendidikan Terakhir</td>
                      <?php 
                        $pendidikan=$this->db->query("SELECT * FROM pendidikan WHERE id_pendidikan='$pencari_kerja->id_pendidikan' ")->row();
                      ?>
                        <td><?php echo $pendidikan->nama_pendidikan?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Jurusan</td>
                        <td><?php echo $pencari_kerja->jurusan?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Jabatan Harapan</td>
                       
                        <td><?php echo $pencari_kerja->jabatan?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Pengalaman Kerja</td>
                        <td><?php echo $pencari_kerja->pengalaman_kerja?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Nama Tempat Kerja Terakhir</td>
                        <td><?php echo $pencari_kerja->nama_tempat_kerja_terakhir?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Posisi Terakhir</td>
                        <td><?php echo $pencari_kerja->posisi_terakhir?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Tahun Masuk</td>
                        <td><?php echo $pencari_kerja->tahun_masuk?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Tahun Keluar</td>
                        <td><?php echo $pencari_kerja->tahun_keluar?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Username</td>
                        <td><?php echo $user->username?></td>
                    </tr>
                     <tr>
              <td class="table-info" align="center">Curiculum Vitae</td>
              <td>
                <?php
                if ($pencari_kerja->upload_cv == "" || $pencari_kerja->upload_cv == NULL) {
                ?>
                  -
                <?php
                } else {
                ?>
                  <a href="image/<?php echo $pencari_kerja->upload_cv ?>" target="_blank"> lihat berkas</a>
                <?php
                }
                ?>
              </td>
            </tr>
            <tr>
              <td class="table-info" align="center">Sertifikat</td>
              <td>
                <?php
                if ($pencari_kerja->upload_sertifikat == "") {
                ?>
                  -
                <?php
                } else {
                ?>
                  <a href="image/<?php echo $pencari_kerja->upload_sertifikat ?>" target="_blank"> lihat berkas</a>
                <?php
                }
                ?>
              </td>
            </tr>
                  </table>
                   <a href="admin/pendaftarpelatihan/<?php echo $this->uri->segment(3)?>" class="btn btn-primary">Kembali</a>
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