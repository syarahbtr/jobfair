<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-primary text-light">
                Data Penyedia Pelatihan
                 </div>
                <div class="card-body table-responsive">
                  <a href="admin/eksportpdfpenyediapelatihan" class="btn btn-primary mb-3"><i class="fa fa-download"></i> Eksport PDF</a>
                    <br>            
                    <table class="table table-hover dttable">
                    <thead>
                        <tr align=center>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Status</th>>
                            <th>Jumlah Pelatihan</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                            <?php
                            $no=1;
                            $q=$this->db->query("select penyedia_pelatihan.*,user.*,user.status as status_user,user.level,
                            provinsi.provinsi,kabupaten.kabupaten,kecamatan.kecamatan from penyedia_pelatihan
                             inner join user on user.id_user=penyedia_pelatihan.id_user
                             inner join provinsi on provinsi.id_provinsi=penyedia_pelatihan.id_provinsi
                             inner join kabupaten on kabupaten.id_kabupaten=penyedia_pelatihan.id_kabupaten
                             inner join kecamatan on kecamatan.id_kecamatan=penyedia_pelatihan.id_kecamatan
                             ");
                            foreach($q->result() as $row){
                            ?>
                                <tr align=center>
                                    <td><?php echo $no; ?></td>
                                     <td><?php echo $row->nama_user; ?></td>
                                     <td>
                                         <img src="image/<?php echo $row->foto_user; ?>" class="img roended-cyrcle" alt="" width="100">
                                     </td>
                                     <td><?php echo $row->alamat_user.','.$row->kecamatan.','.$row->kabupaten.','.$row->provinsi; ?></td>
                                     <td><?php echo $row->nohp_user; ?></td>
                                     <td><?php echo $row->email_user; ?></td>
                                     <td><?php echo $row->username; ?></td>
                                     <td>
                                       <?php if($row->status_user=='0'){?>
                                      <span class="badge badge-danger">Menunggu Verifikasi</span>
                                      <?php }else{ ?>
                                        <span class="badge badge-primary">Verifikasi</span>
                                      <?php } ?>
                                    </td>
                                    <td width=25%>
                                       <?php 
                                        $jumlahpelatihan=$this->db->query("SELECT count(*) as jumlah FROM pelatihan WHERE id_user='$row->id_user'")->row();
                                        ?>
                                      <a class="btn btn-primary" href="admin/jumlahpelatihan/<?php echo $row->id_user?>" role="button">Pelatihan
                                      <span class="badge badge-light"><?php echo $jumlahpelatihan->jumlah?></span></a>
                                     </td>
                                     <td>
                                       <?php if($row->status_user=='0'){?>
                                      <a href="admin/aktif/<?php echo $row->id_user ?>/<?php echo $row->level ?>" class="btn btn-info aktif"><i class="fa fa-sync-alt"></i></a>
                                      <?php }else{ ?>
                                        <a href="admin/tidakaktif/<?php echo $row->id_user ?>/<?php echo $row->level ?>" class="btn btn-primary tidakaktif"><i class="fa fa-power-off"></i></a>
                                      <?php } ?>
                                         <a href="admin/hapuspp/<?php echo $row->id_user ?>" class="btn btn-danger hapus"><i class="fa fa-trash"></i></a>
                                          <a href="admin/editpenyediapelatihan/<?php echo $row->id_user ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                         <a href="admin/lihatpp/<?php echo $row->id_user ?>" class="btn btn-warning"><i class="fa fa-eye"></i></a>
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

        $(".hapus").click(function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus Data ?',
                        text: "Data yang sudah dihapus tidak bisa kembali !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yaa, hapus data !',
                        cancelButtonText: 'Batal'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
							url:  $(this).attr('href'),
							type: 'post',
							data: $(this).serialize(),
							dataType: "html",
							success: function(dt){
                            Swal.fire({
                                title: "Success",
                                text: "Data Berhasil Dihapus !",
                                icon: "success",
                                showCancelButton: false,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                                allowOutsideClick: () => !Swal.isLoading()
                                }).then((result) => {
                                    window.location.reload();
                    })

							},
							error: function(dt){
								alert("Ada Kesalahan Sistem");
							},
						});
                    } else return false;
                    })
						
			}); 
      </script>