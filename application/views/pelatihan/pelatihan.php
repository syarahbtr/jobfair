 <?php 
        $id=$this->session->userdata('id');
        $q=$this->db->query("select penyedia_pelatihan.*,user.id_user,user.nama_user,user.username,user.password,
        user.foto_user,user.email_user,user.nohp_user,user.alamat_user from penyedia_pelatihan 
        left join user on user.id_user=penyedia_pelatihan.id_user 
        where penyedia_pelatihan.id_user='$id'");
        $row=$q->row();
?>
<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="<?php echo base_url('image/'). $row->foto_user ?>"
                       class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <a href="#"><?php echo $row->nama_user ?></a>
                      </div>
                      <div class="author-box-job"><?php echo $row->email_user ?></div>
                    </div>
                    <div class="text-center">
                      <div class="author-box-description">
                        <p>
                         <?php echo $row->alamat_user ?>
                        </p>
                      </div>
                      <div class="w-100 d-sm-none"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#about" role="tab"
                          aria-selected="true">Profile</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                          aria-selected="false">Edit Profil</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="home-tab2">
                        <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td><input type="text" class="form-control" readonly value="<?php echo $row->nama_user ?>" name="nmuser"></td>
                            </tr>
                             <tr>
                                <td>Alamat</td>
                                <td><input type="text" class="form-control" readonly value="<?php echo $row->alamat_user ?>" name="alamatuser"></td>
                            </tr>
                            <tr>
                                <td>Kode Pos</td>
                                <td><input type="text" class="form-control" readonly value="<?php echo $row->kode_pos ?>" name="kode_pos"></td>
                            </tr>
                             <tr>
                                <td>No HP</td>
                                <td><input type="number" class="form-control" readonly value="<?php echo $row->nohp_user ?>" name="nohpuser"></td>
                            </tr>
                             <tr>
                                <td>Email</td>
                                <td><input type="email" class="form-control" readonly value="<?php echo $row->email_user ?>" name="emailuser"></td>
                            </tr>
                             <tr>
                                <td>Username</td>
                                <td><input type="text" class="form-control" readonly value="<?php echo $row->username ?>" name="username"></td>
                            </tr>
                            <tr>
                                <td>Nama Penanggung Jawab</td>
                                <td><input type="text" class="form-control" readonly value="<?php echo $row->nama_pjpp ?>" name="nama_pjpp"></td>
                            </tr>
                            <tr>
                                <td>No Telepon Penanggung Jawab</td>
                                <td><input type="text" class="form-control" readonly value="<?php echo $row->notelp_pjpp ?>" name="notelp_pjpp"></td>
                            </tr>
                       </table>
                      </div>
                      <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                        
                          <div class="card-header">
                            <h4>Edit Profil</h4>
                          </div>
                          <div class="card-body">
                            <form action="penyedia_pelatihan/updateprofile" method="post" enctype="multipart/form-data" >
                            <table class="table">
                            <tr>
                                <td>Nama</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->nama_user ?>" name="nmuser"></td>
                            </tr>
                             <tr>
                                <td>Foto</td>
                                <td>
                                <img src="image/<?php echo $row->foto_user?>" class="img img-thumbnail mb-3" width="100" alt="">    
                                <input type="file" class="form-control" name=fotouser></td>
                            </tr>
                             <tr>
                                <td>Alamat</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->alamat_user ?>" name="alamatuser"></td>
                            </tr>
                             <tr>
                                <td>Kode Pos</td>
                                <td><input type="number" class="form-control" value="<?php echo $row->kode_pos ?>" name="kode_pos"></td>
                            </tr>
                             <tr>
                                <td>No HP</td>
                                <td><input type="number" class="form-control" value="<?php echo $row->nohp_user ?>" name="nohpuser"></td>
                            </tr>
                             <tr>
                                <td>Email</td>
                                <td><input type="email" class="form-control" value="<?php echo $row->email_user ?>" name="emailuser"></td>
                            </tr>
                             <tr>
                                <td>Username</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->username ?>" name="username"></td>
                            </tr>
                             <tr>
                                <td>Password</td>
                                <td><input type="text" class="form-control" name=password></td>
                            </tr>
                             <tr>
                                <td>Nama Penanggung Jawab</td>
                                <td><input type="text" class="form-control" value="<?php echo $row->nama_pjpp ?>" name="nama_pjpp"></td>
                            </tr>
                             <tr>
                                <td>No Telepon Penanggung Jawab</td>
                                <td><input type="number" class="form-control" value="<?php echo $row->notelp_pjpp ?>" name="notelppjpp"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Simpan</button>
                                </td>
                            </tr>
                       </table>
                   </form>
                          </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
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