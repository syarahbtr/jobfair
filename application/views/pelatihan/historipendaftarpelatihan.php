<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-primary text-light">
                Data Pendaftar Pelatihan
                 </div>
                <div class="card-body table-responsive">
                  <?php
                   $q=$this->db->query("select daftar_pelatihan.*,user.*,pencari_kerja.*,pendidikan.nama_pendidikan 
                            from daftar_pelatihan
                            left join user on user.id_user=daftar_pelatihan.id_user
                            left join pencari_kerja on pencari_kerja.id_user=user.id_user
                            left join pendidikan on pendidikan.id_pendidikan=pencari_kerja.id_pendidikan
                            where daftar_pelatihan.id_pelatihan='$id' ")->row();
                  ?>
                  <a href="pelatihan/eksportpdfpendaftar/<?php echo $q->id_pelatihan ?>" class="btn btn-primary mb-3" target="_blank"><i class="fa fa-download"></i> Eksport PDF</a>
                    <br>            
                    <table class="table table-hover dttable">
                    <thead>
                        <tr align=center>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Pendidikan</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>Aksi</th>
          
                        </tr>
                        <tbody>
                            <?php
                            $no=1;
                            $q=$this->db->query("select daftar_pelatihan.*,user.*,pencari_kerja.*,pendidikan.nama_pendidikan 
                            from daftar_pelatihan
                            left join user on user.id_user=daftar_pelatihan.id_user
                            left join pencari_kerja on pencari_kerja.id_user=user.id_user
                            left join pendidikan on pendidikan.id_pendidikan=pencari_kerja.id_pendidikan
                            where daftar_pelatihan.id_pelatihan='$id' ");
                            // $r=$this->db->query("select pencari_kerja.*,lamar.* from pencari_kerja
                            // left join pencari_kerja.id_user=lamar.id_user
                            // ");
                            foreach($q->result() as $row){
                            ?>
                                <tr align=center>
                                     <td><?php echo $no; ?></td>
                                     <td><?php echo $row->nama_user; ?></td>
                                     <td><?php echo $row->nik_pencaker; ?></td>
                                     <td><?php echo $row->nama_pendidikan; ?></td>   
                                     <td><?php echo $row->alamat_user;?></td>
                                     <td><?php echo $row->email_user; ?></td>
                                     
                                    <td >
                                        <a href="pelatihan/historidetailpendaftar/<?php echo $this->uri->segment(3).'/'.$row->id_user ?>" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                    </td>
                                    
                                </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </thead>
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