  <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Dispernaker Kabupaten Sukoharjo</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  
</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
<script>
    $('.tombol-logout').on('click', function(e) {
		const href = $(this).attr('href');
		e.preventDefault();
			Swal.fire({
				title: 'Informasi',
				text: "Apa anda yakin ingin logout ?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Logout !',
        cancelButtonText: 'Batal'
				}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			})
		});

    $('.aktif').on('click', function(e) {
		const href = $(this).attr('href');
		e.preventDefault();
			Swal.fire({
				title: 'Informasi',
				text: "Apa Anda Yakin Mengaktifkan Akun ini ?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Aktifkan !',
        cancelButtonText: 'Batal'
				}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			})
		});

    $('.tidakaktif').on('click', function(e) {
		const href = $(this).attr('href');
		e.preventDefault();
			Swal.fire({
				title: 'Informasi',
				text: "Apa Anda Yakin Menon-aktifkan Akun ini ?",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, Non-Aktifkan !',
        cancelButtonText: 'Batal'
				}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			})
		});
</script>

<?php if($this->session->flashdata('msg') == 'simpan'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Data berhasil ditambahkan!",
      "success"
    );
  </script>
  <?php }elseif($this->session->flashdata('msg') == 'edit'){ ?>
    <script>
    Swal.fire(
      "Informasi",
      "Data berhasil diubah!",
      "success"
    );
  </script>
    <?php }elseif($this->session->userdata('msg') == 'hapus'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Data berhasil dihapus!",
      "success"
    );
  </script>
    <?php }elseif($this->session->userdata('msg') == 'gagal'){ ?>
      <script>
    Swal.fire(
      "Error",
      "Gagal Simpan Data",
      "error"
    );
  </script>
    <?php }elseif($this->session->userdata('msg') == 'sukses'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Berhasil minning!",
      "success"
    );
  </script>
  <?php }elseif($this->session->userdata('msg') == 'aktif'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Berhasil Mengaktifkan Akun!",
      "success"
    );
  </script>
  <?php }elseif($this->session->userdata('msg') == 'tidakaktif'){ ?>
      <script>
    Swal.fire(
      "Informasi",
      "Berhasil Menon-aktifkan Akun!",
      "success"
    );
  </script>
      <?php } ?>
      <?php if($this->session->flashdata('msg') == 'berhasilupdatepassword'){ ?>
  <script>
    Swal.fire(
      "Informasi",
      "Password Anda Berhasil Diubah!",
      "success"
    );
  </script>
  <?php } ?>