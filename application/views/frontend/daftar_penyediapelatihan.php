<br>
<br>
<main id="main">
  <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <p>Biodata Penyedia Pelatihan</p>
        </header>
        <div class="card">
         <div class="card-header bg-primary text-light">
           
        </div>
        <div class="card-body">
          <form action="register/savedaftarpenyediapelatihan" method="post" enctype="multipart/form-data">
              <div ng-controller="studentCtrl">
              <table class="table">
                    <tr>
                        <td>
                            Username <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="password" name="password">
                            <div class="form-text">Password minimal 8 karakter</div>
                            <?php echo form_error('password','<small class="text-danger">','</small>')?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Konfirmasi Password <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="password" name="password2">
                            <div class="form-text">Password minimal 8 karakter</div>
                            <?php echo form_error('password2','<small class="text-danger">','</small>')?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nama Penyedia Pelatihan <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Logo Penyedia Pelatihan <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="file" name="gambar1" value="<?php echo set_value('gambar1'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Provinsi <span class="text-danger">*</span>
                        </td>
                        <td>
                            <select id="selector" name="provinsi" class="form-control select2"  ng-model="idkelas" ng-change="getStudent(idkelas)">
                            <option value="">-- Pilih Provinsi --</option>
                            <option ng-repeat="provinsi in provinsi" ng-value="provinsi.id_provinsi">{{provinsi.provinsi}}</option>
							</select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kabupaten <span class="text-danger">*</span>
                        </td>
                        <td>
                            <select name="kabupaten" class="form-control select2" ng-model="idkec" ng-change="getLurah(idkec)">
	                        <option value="">-- Pilih Kabupaten --</option>
	                        <option ng-repeat="kabupaten in kabupaten" ng-selected="kabupaten.index == kabupaten.id_kabupaten" value="{{kabupaten.id_kabupaten}}">{{kabupaten.kabupaten}}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Kecamatan <span class="text-danger">*</span>
                        </td>
                        <td>
                            <select name="kecamatan" class="form-control select2" ng-model="idkel" ng-change="getRtRw(idkel)">
							<option value="">-- Pilih Kecamatan --</option>
							<option ng-repeat="kecamatan in kecamatan" ng-selected="kecamatan.index == kecamatan.id_kecamatan" value="{{kecamatan.id_kecamatan}}">{{kecamatan.kecamatan}}</option>
							</select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Alamat Lengkap RT/RW <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="text" name="alamat" value="<?php echo set_value('alamat'); ?>">
                        </td>
                    </tr>
                     <tr>
                        <td>
                            Kode Pos <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="number" name="kodepos" value="<?php echo set_value('kodepos'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            No Telepon Penyedia Pelatihan <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="number" name="notelepon" value="<?php echo set_value('notelepon'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email Penyedia Pelatihan <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="email" name="email" value="<?php echo set_value('email'); ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nama Penanggung Jawab Akun <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="text" name="namapj" value="<?php echo set_value('namapj'); ?>">
                        </td>
                    </tr>
                     <tr>
                        <td>
                           No Telepon Penanggung Jawab Akun <span class="text-danger">*</span>
                        </td>
                        <td>
                            <input required class="form-control" type="number" name="noteleponpj" value="<?php echo set_value('noteleponpj'); ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan=4>    
                        <input required class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        Dengan ini saya menyatakan bahwa data yang saya isikan ini adalah benar dan bisa dipertanggungjawabkan. Jika dikemudian hari ditemukan hal-hal yg tidak benar, saya bersedia mempertanggung jawabkan secara hukum.
                        </td>
                    </tr>
                    <tr>
                   
                        <td>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </td>
                    </tr>
              </table>
            </div>
          </form>
        </div>
        </div>
       <a href="home/login">Sudah Punya Akun?</a>
    </div>
      </div>

    </section><!-- End Testimonials Section -->


   
 <!-- ======= Hero Section ======= -->
 
  </main><!-- End #main -->

  <script>
      var studentApp = angular.module("studentApp", []);
	var SITEURL = "<?php echo site_url() ?>";

	studentApp.controller('studentCtrl', function($scope, $http) {
		$scope.provinsi = [];
		$scope.kabupaten = [];
		$scope.kecamatan = [];
		


		$scope.getClass = function() {

			var url = SITEURL + 'alamat/provinsi/';
			$http.get(url).then(function(response) {
				$scope.provinsi = response.data;
			});
		};
		$scope.getStudent = function(id) {
			var url = SITEURL + 'alamat/kabupaten/' +id;
			$http.get(url).then(function(response) {
				$scope.kabupaten = response.data;
			});

		};
		angular.element(document).ready(function() {
			$scope.getClass();
		});

    //get lurah
		$scope.getLurah = function(id) {

			var url = SITEURL + 'alamat/kabupaten/' +id;
			$http.get(url).then(function(response) {
				$scope.kabupaten = response.data;
			});
		};
		$scope.getLurah = function(id) {
			var url = SITEURL + 'alamat/kecamatan/' +id;
			$http.get(url).then(function(response) {
				$scope.kecamatan = response.data;
			});

		};
		angular.element(document).ready(function() {
			$scope.getLurah();
		});

	});
  </script>

 