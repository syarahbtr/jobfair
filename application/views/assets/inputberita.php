
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
           
            <div class="card">
  <div class="card-header bg-primary text-light">
    Form Artikel
  </div>
  <div class="card-body table-responsive">
  <form action="admin/saveberita" id="save" method="post" enctype="multipart/form-data">
                      <table class="table">
                          <tr>
                              <td>Judul <span class="text-danger">*</span></td></td>
                              <td>
                                  <div class="form-group">
                                    <input type="text" required class="form-control bersih" name="judul" autocomplete="off" required  placeholder="Judul Berita">
                                  </div>
                              </td>
                          </tr>
                          <tr>
                              <td>Kategori<span class="text-danger">*</span></td></td>
                              <td>
                                  <div class="form-group">
                                  <select required class="form-control select2" required name="kat" id="">
                    <option>Pilih</option>
                    <?php $db = $this->db->get('kategori');
                    foreach($db->result() as $row){
                     ?>
                    <option value="<?php echo $row->id_kategori ?>"><?php echo $row->kategori ?></option>
                <?php } ?>  
                </select></div>
                              </td>
                          </tr>
                          <tr>
                              <td>Foto<span class="text-danger">*</span></td></td>
                              <td>
                              <center>             <img id="blah" class='img-responsive' width='280' src="assets/nofoto.jpg" alt="your image" /></center>
                              <input type="file"  required  accept="image/*" capture name="gambar" class="form-control mb-3"  onchange="readURL(this);"  aria-describedby="inputGroupFileAddon01">
                              <span class="badge badge-warning mb-3"><strong>Informasi</strong> Input Gambar Hanya Bisa Bertype JPG,JPEG,PNG Dan Maksimal 2mb !</span> 
                            </td>
                          </tr>
                          </tr>
                          <tr>
                              <td>Deskripsi<span class="text-danger">*</span></td></td>
                              <td>
                                    <textarea required class="summernote"  name="desc"  rows="3"></textarea>
                             </td>
                          </tr>
                          <tr>
                              <td></td>
                              <td><input name="" id="" class="btn btn-primary text-light " type="submit" value="Simpan"> <input name="" id="" class="btn btn-warning text-light" type="reset" value="Reset"></td>
                          </tr>
                      </table>
                 
             </form>

  </div>
</div>
          </div>
        </section>
        
      </div>

      <script>
                $("#save").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function (response) {
                Swal.fire({
                    title: "Informasi",
                    text: "berita baru Berhasil Ditambahkan!",
                    icon: "success",
                    showCancelButton: false,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        window.location.reload();
                    })
            },
            error : function (e){
                alert("ada kesalahan sistem")
            }
        });
    });
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>
