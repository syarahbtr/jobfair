<!-- Main Content -->
      <div class="main-content">
        <?php 
        $q=$this->db->query("select perusahaan.*,user.*,sektor.nama_sektor,
        jenis_badan_usaha.nama_jbu from perusahaan 
        left join user on user.id_user=perusahaan.id_user 
        left join sektor on sektor.id_sektor=perusahaan.id_sektor
        left join jenis_badan_usaha on jenis_badan_usaha.id_jbu=perusahaan.id_jbu
        where perusahaan.id_user='$id'");
        
        $row=$q->row();
        ?>
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-primary text-light">
                Detail Perusahaan
                 </div>
                <div class="card-body">
                  <table class="table table-bordered" >
                    <tr>
                        <td colspan="2">
                        <center>
                          <img src="image/<?php echo $row->foto_user ?>" width="100" class="img img-thumbnail img-fluid" alt="">
                        </center>
                        </td>
                    </tr>  
                    <tr>
                        <td class="table-info" align="center">Nama Perusahaan</td>
                        <td><?php echo $row->nama_user?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Jenis Badan Usaha</td>
                        <td><?php echo $row->nama_jbu?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Nomor Induk Berusaha</td>
                        <td><?php echo $row->nib?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Sektor</td>
                        <td><?php echo $row->nama_sektor?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Alamat</td>
                        <td><?php echo $row->alamat_user?></td>
                    </tr>
                    <tr>
                        <td class="table-info" align="center">Kode Pos</td>
                        <td><?php echo $row->kode_pos?></td>
                    </tr>
                    <tr>
                        <td class="table-info" align="center">No HP</td>
                        <td><?php echo $row->nohp_user?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Email</td>
                        <td><?php echo $row->email_user?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Username</td>
                        <td><?php echo $row->username?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Nama Penanggung Jawab</td>
                        <td><?php echo $row->nama_pj?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">No Telepon Penanggung Jawab</td>
                        <td><?php echo $row->nohp_pj?></td>
                    </tr>
                    <tr>
                      <td class="table-info" align="center">Jabatan Penanggung Jawab</td>
                        <td><?php echo $row->jabatan_pj?></td>
                    </tr>
                     <tr>
                      <td class="table-info" align="center">Deskripsi Perusahaan</td>
                        <td><?php echo $row->deskripsi_perusahaan?></td>
                    </tr>
                  
                  </table>
                   <a href="admin/perusahaan" class="btn btn-danger mr-2"><i class="fa fa-sync-alt"></i> Kembali</a>
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