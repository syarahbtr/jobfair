<!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
            <div class="card">
                <div class="card-header bg-primary text-light">
                Pelatihan
                 </div>
                <div class="card-body table-responsive">
                    <a href="pelatihan/eksportpdfpelatihan" class="btn btn-primary mb-3"><i class="fa fa-download"></i> Eksport PDF</a>
                    <br>            
                    <table class="table table-hover dttable">
                    <thead>
                        <tr align=center>
                            <th>No</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Nama Pelatihan</th>
                            <th>Kategori</th>
                            <th>Alamat</th>
                            <th>Jam</th>
                            <th>Jumlah Peserta</th>
                            <th>Aksi</th>
                        </tr>
                        <tbody>
                            <?php
                            $id=$this->session->userdata('id'); #ambil user nama login
                            $no=1;
                            $today= date("Y-m-d");
                            $q=$this->db->query("select pelatihan.*,user.id_user from pelatihan
                            left join user on user.id_user=pelatihan.id_user
                            where pelatihan.tanggal_selesai>='$today' and 
                            pelatihan.id_user='$id' order by pelatihan.id_pelatihan desc ");
                            foreach($q->result() as $row){
                            ?>
                                <tr align=center>
                                     <td><?php echo $no; ?></td>
                                    <td> <?php  $originalDate = $row->tanggal_mulai;
                                      echo $newDate = date("d F Y", strtotime($originalDate)); ?></td>
                                       <td> <?php  $originalDate = $row->tanggal_selesai;
                                      echo $newDate = date("d F Y", strtotime($originalDate)); ?></td>
                                    <td><?php echo $row->nama_pelatihan; ?></td>
                                    <td><?php echo $row->kategori; ?></td>
                                    <td><?php echo $row->alamat; ?></td>
                                    <td><?php echo $row->jam; ?></td>
                                    <td width=25%>
                                    <a href="pelatihan/pendaftarpelatihan/<?php echo $row->id_pelatihan?>" class="btn btn-primary">
                                    Peserta <span class="badge badge-light"><?php echo $row->jumlah_peserta?></span>
                                    </a>
                                    </td>
                                    <td >
                                         <a href="pelatihan/hapuspelatihan/<?php echo $row->id_pelatihan ?>" class="btn btn-danger hapus"><i class="fa fa-trash"></i></a>
                                         <a href="pelatihan/editpelatihan/<?php echo $row->id_pelatihan ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                         <a href="pelatihan/lihatpelatihan/<?php echo $row->id_pelatihan ?>" class="btn btn-warning"><i class="fa fa-eye"></i></a>
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