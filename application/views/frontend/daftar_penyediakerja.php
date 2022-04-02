<br>
<br>
<main id="main">
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>Biodata Penyedia Kerja</p>
            </header>
            <div class="card">
                <div class="card-header bg-primary text-light">

                </div>
                <div class="card-body">
                    <form action="register/daftar_penyediakerja" method="post" enctype="multipart/form-data">
                        <div ng-controller="studentCtrl">
                            <table class="table">
                                <tr>
                                    <td>
                                        Username <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="username" value="<?php echo set_value('username'); ?>">
                                        <?php echo form_error('username', '<small class="text-danger">', '</small>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Password <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="password" name="password">
                                        <div class="form-text">Password minimal 8 karakter</div>
                                        <?php echo form_error('password', '<small class="text-danger">', '</small>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Konfirmasi Password <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="password" name="password2">
                                        <div class="form-text">Password minimal 8 karakter</div>
                                        <?php echo form_error('password2', '<small class="text-danger">', '</small>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Penyedia Kerja <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Logo Penyedia Kerja <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="file" name="gambar" value="<?php echo set_value('gambar'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Deskripsi Penyedia Kerja
                                    </td>
                                    <td>
                                        <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10" value="<?php echo set_value('deskripsi'); ?>"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jenis Badan Usaha <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <select name="jbu" required class="form-control select2" id="" value="<?php echo set_value('jbu'); ?>">
                                            <option value="">Pilih Jenis Badan Usaha</option>
                                            <?php
                                            $q = $this->db->query('select * from jenis_badan_usaha');
                                            foreach ($q->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->id_jbu ?>"><?php echo $row->nama_jbu ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nomor Induk Berusaha <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="number" name="nib" value="<?php echo set_value('nib'); ?>">
                                        <?php echo form_error('nib', '<small class="text-danger">', '</small>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sektor <span class="text-danger">*</span> </td>
                                    <td>
                                        <select name="sektor" required class="form-control select2" id="" value="<?php echo set_value('sektor'); ?>">
                                            <option value="">Pilih Sektor</option>
                                            <?php
                                            $q = $this->db->query('select * from sektor');
                                            foreach ($q->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->id_sektor ?>"><?php echo $row->nama_sektor ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Provinsi <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <select id="selector" name="provinsi" class="form-control select2" ng-model="idkelas" ng-change="getStudent(idkelas)">
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
                                        No Telepon Penyedia Kerja <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="number" name="notelp_perusahaan" value="<?php echo set_value('notelp_perusahaan'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email Penyedia Kerja <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="email" name="email_perusahaan" value="<?php echo set_value('email_perusahaan'); ?>">
                                        <?php echo form_error('email_perusahaan', '<small class="text-danger">', '</small>') ?>
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
                                        <input required class="form-control" type="number" name="notelp_pj" value="<?php echo set_value('notelp_pj'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jabatan Penanggung Jawab Akun <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="jabatan_pj" value="<?php echo set_value('jabatan_pj'); ?>">
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
            var url = SITEURL + 'alamat/kabupaten/' + id;
            $http.get(url).then(function(response) {
                $scope.kabupaten = response.data;
            });

        };
        angular.element(document).ready(function() {
            $scope.getClass();
        });

        //get lurah
        $scope.getLurah = function(id) {

            var url = SITEURL + 'alamat/kabupaten/' + id;
            $http.get(url).then(function(response) {
                $scope.kabupaten = response.data;
            });
        };
        $scope.getLurah = function(id) {
            var url = SITEURL + 'alamat/kecamatan/' + id;
            $http.get(url).then(function(response) {
                $scope.kecamatan = response.data;
            });

        };
        angular.element(document).ready(function() {
            $scope.getLurah();
        });

    });
</script>