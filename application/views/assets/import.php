

<div class="main-content">
        <section class="section">
        <div class="row">
       <div class="card col-lg-12">
  <div class="card-header">
  <h6 class="border-bottom border-gray pb-2 mb-0">Import Database</h6>
  </div>
  <div class="card-body">
  <div class="media text-muted pt-3">
	  <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"/><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
	  <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
		<strong class="d-block text-gray-dark">@importdatabase</strong>
		Pilih Database Yang Akan Di Restore Ulang, Kemudian Lanjutkan Untuk Proses.
	  </p>
	</div>
    <?php
$idtoko=$this->session->userdata('id');
if ($handle = opendir('./backup/')) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			//echo "$entry\n";
			$kt=explode("_",$entry);
if($idtoko==$kt[0]){
?>

	<div class="media text-muted pt-3">
        <i class="fa fa-database mr-3" aria-hidden="true"></i>
	  <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
	  <a href="admin/restoredb/<?php echo $entry; ?>" class='restoredb'>
		<strong class="d-block text-gray-dark"><?php echo $entry; ?></strong>
		Pilih Database.
		</a>
	  </p>
	</div>
<?php
		}}
	}
	closedir($handle);
}
?>
	
	
  </div>
<script type="text/javascript">
	//<![CDATA[
        $(".restoredb").on('click',function(e){
		e.preventDefault();
    Swal.fire({
  title: 'Informasi',
  text: "Import Database ?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, import!'
}).then((result) => {
  if (result.isConfirmed) {
   
    $.ajax({
			  url:$(this).attr('href'),
			  type: 'post',
			  data: $(this).serialize(),
			  dataType: "html",
				 success: function(dt){
					Swal.fire(
					  'Informasi',
					  'Berhasil Restore!',
					  'success'
					)
					
				 }
		});
  }
})
		
	}); 
	
	//]]>
</script>

  </div>
</div>
          </div>   <!-- /.row -->
       
            <!-- /.card -->
          </div>
        </section>
     
      </div>
