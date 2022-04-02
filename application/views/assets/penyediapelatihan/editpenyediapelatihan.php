<!-- Main Content -->
      <div class="main-content">
        <?php 
        $q=$this->db->query("select * from user where id_user='$id'");
        $row=$q->row();
        ?>
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-primary text-light">
                Edit Data Penyedia Pelatihan
                 </div>
                <div class="card-body">
                   <form action="admin/updatepenyediapelatihan/<?php echo $id ?>" method="post" enctype="multipart/form-data" >
                       <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->nama_user ?>" name=nmuser></td>
                            </tr>
                             <tr>
                                <td>Foto</td>
                                <td>
                                <img src="image/<?php echo $row->foto_user?>" class="img img-thumbnail mb-3" width="100" alt="">    
                                <input type="file" class="form-control" name=fotouser></td>
                            </tr>
                             <tr>
                                <td>Alamat</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->alamat_user ?>" name=alamatuser></td>
                            </tr>
                             <tr>
                                <td>No HP</td>
                                <td><input type="number" class="form-control" value="<?php echo $row->nohp_user ?>" name=nohpuser></td>
                            </tr>
                             <tr>
                                <td>Email</td>
                                <td><input type="email" class="form-control" value="<?php echo $row->email_user ?>" name=emailuser></td>
                            </tr>
                             <tr>
                                <td>Username</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->username ?>" name=username></td>
                            </tr>
                             <tr>
                                <td>Password</td>
                                <td><input type="text" class="form-control" name=password></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                                    <a href="admin/penyediapelatihan" class="btn btn-danger mr-2"><i class="fa fa-sync-alt"></i> Kembali</a>
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