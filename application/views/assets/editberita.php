<?php 
$jum = $this->db->query("select artikel.*,user.nama_user,kategori.kategori from artikel 
inner join user on user.id_user = artikel.id_user 
inner join kategori on kategori.id_kategori = artikel.id_kategori 
where artikel.id_artikel='$id'");
$row = $jum->row();
?>


<div class="main-content">
        <section class="section">
          <div class="section-body">
            <!-- add content here -->
           
            <div class="card">
  <div class="card-header">
    Form Artikel <?php echo $row->judul ?>
  </div>
  <div class="card-body table-responsive">
  <form action="admin/updateberita/<?php echo $id ?>" id="save" method="post" enctype="multipart/form-data">
                      <table class="table">
                          <tr>
                              <td>Judul</td>
                              <td>
                                  <div class="form-group">
                                    <input type="text" value="<?php echo $row->judul ?>" class="form-control bersih" name="judul" autocomplete="off"   placeholder="Judul Berita">
                                  </div>
                              </td>
                          </tr>
                          <tr>
                              <td>Kategori</td>
                              <td>
                                  <div class="form-group">
                                  <select class="form-control select2"  name="kat" id="">
                    <option value="<?php echo $row->id_kategori ?>"><?php echo $row->kategori ?></option>
                    <?php $db = $this->db->get('kategori');
                    foreach($db->result() as $x){
                     ?>
                    <option value="<?php echo $x->id_kategori ?>"><?php echo $x->kategori ?></option>
                <?php } ?>  
                </select></div>
                              </td>
                          </tr>
                          <tr>
                              <td>Foto</td>
                              <td>
                              <center>             <img id="blah" class='img-fluid mb-3' width='280' src="image/<?php echo $row->gambar ?>" alt="your image" /></center>
                              <input type="file"    accept="image/*" capture name="gambar" class="form-control mb-3"  onchange="readURL(this);"  aria-describedby="inputGroupFileAddon01">
                              <span class="badge badge-warning mb-3"><strong>Informasi</strong> Input Gambar Hanya Bisa Bertype JPG,JPEG,PNG Dan Maksimal 2mb !</span> 
                            </td>
                          </tr>
                          </tr>
                          <tr>
                              <td>Deskripsi</td>
                              <td>
                                    <textarea class="summernote"  name="desc"  rows="3"><?php echo $row->keterangan ?></textarea>
                             </td>
                          </tr>
                          <tr>
                              <td></td>
                              <td><input name="" id="" class="btn btn-primary text-light " type="submit" value="Simpan"> 
                              <a href="admin/artikel" class="btn btn-danger mr-2"><i class="fa fa-sync-alt"></i>Kembali</a> </td>
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
                    text: "Data berita <?php echo $row->judul ?> berhasil diedit!",
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