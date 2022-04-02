<br>
<br>
<main id="main">
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">

        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>Biodata Pencari Kerja</p>
            </header>
            <div class="card">
                <div class="card-header bg-primary text-light">
                </div>
                <div class="card-body">
                    <form action="register/daftar_pencarikerja" method="post" enctype="multipart/form-data">
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
                                        Nama Lengkap <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="nama" value="<?php echo set_value('nama'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="number" name="nik" value="<?php echo set_value('nik'); ?>">
                                        <?php echo form_error('nik', '<small class="text-danger">', '</small>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Surat Domisili
                                    </td>
                                    <td>
                                        <input class="form-control" type="file" accept=".pdf" name="gambar4">
                                        <span class="badge rounded-pill bg-warning text-dark">Jika Bukan NIK Warga Sukoharjo, Wajib menyertakan Surat Domisili</span>
                                        <div class="form-text">Password minimal 8 karakter</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tempat Lahir <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="tempat_lahir" value="<?php echo set_value('tempat_lahir'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal Lahir <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="date" name="tanggal_lahir" value="<?php echo set_value('tanggal_lahir'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Agama <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <select name="agama" required class="form-control select2" id="">
                                            <option value="">Pilih Agama</option>
                                            <?php
                                            $q = $this->db->query('select * from agama');
                                            foreach ($q->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->id_agama ?>" <?php if (set_value('agama') == $row->id_agama) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $row->nama_agama ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>">
                                        <?php echo form_error('email', '<small class="text-danger">', '</small>') ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        No HP <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="number" name="nohp" value="<?php echo set_value('nohp'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Foto <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="file" name="gambar1" value="<?php echo set_value('gambar1'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jenis Kelamin <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <select name="jenis_kelamin" required class="form-control" id="">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" <?php if (set_value('jenis_kelamin') == "Laki-laki") {
                                                                            echo 'selected';
                                                                        } ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php if (set_value('jenis_kelamin') == "Perempuan") {
                                                                            echo 'selected';
                                                                        } ?>>Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tinggi Badan <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="tinggi_badan" value="<?php echo set_value('tinggi_badan'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Berat Badan <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="berat_badan" value="<?php echo set_value('berat_badan'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Status Perkawinan <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <select name="status_perkawinan" required class="form-control select2" id="" value="<?php echo set_value('status_perkawinan'); ?>">
                                            <option value="">Pilih Status Perkawinan</option>
                                            <?php
                                            $q = $this->db->query('select * from status_perkawinan');
                                            foreach ($q->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->id_status_perkawinan ?>"><?php echo $row->nama_status_perkawinan ?></option>
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
                                        <select id="selector" name="provinsi" class="form-control select2" ng-model="idkelas" ng-change="getStudent(idkelas)" value="<?php echo set_value('provinsi'); ?>">
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
                                        <select name="kabupaten" class="form-control select2" ng-model="idkec" ng-change="getLurah(idkec)" value="<?php echo set_value('kebupaten'); ?>">
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
                                        <select name="kecamatan" class="form-control select2" ng-model="idkel" ng-change="getRtRw(idkel)" value="<?php echo set_value('kecamatan'); ?>">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            <option ng-repeat="kecamatan in kecamatan" ng-selected="kecamatan.index == kecamatan.id_kecamatan" value="{{kecamatan.id_kecamatan}}">{{kecamatan.kecamatan}}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Alamat Lengkap <span class="text-danger">*</span>
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
                                        Pendidikan Terakhir <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <select name="pendidikan" required class="form-control select2" id="" value="<?php echo set_value('pendidikan'); ?>">
                                            <option value="">Pilih Pendidikan</option>
                                            <?php
                                            $q = $this->db->query('select * from pendidikan');
                                            foreach ($q->result() as $row) {
                                            ?>
                                                <option value="<?php echo $row->id_pendidikan ?>"><?php echo $row->nama_pendidikan ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jurusan
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="jurusan" value="<?php echo set_value('jurusan'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tahun Lulus <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="number" name="tahun_lulus" value="<?php echo set_value('tahun_lulus'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jabatan Harapan <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="text" name="jabatan" value="<?php echo set_value('jabatan'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pengalaman Kerja
                                    </td>
                                    <td>

                                        <select class="form-control" id="pengalaman_kerja" name="pengalaman_kerja">
                                            <option value="no">Tidak Memiliki</option>
                                            <option value="yes">Memiliki</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="display:none;" id="nama_tempat_kerja_terakhir">
                                    <td>
                                        Nama Tempat Kerja Terakhir
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="nama_tempat_kerja_terakhir" value="<?php echo set_value('nama_tempat_kerja_terakhir'); ?>">
                                    </td>
                                </tr>
                                <tr style="display:none;" id="posisi_terakhir">
                                    <td>
                                        Posisi Terakhir
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="posisi_terakhir" value="<?php echo set_value('posisi_terakhir'); ?>">
                                    </td>
                                </tr>
                                <tr style="display:none;" id="tahun_masuk">
                                    <td>
                                        Tahun Masuk
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" name="tahun_masuk" value="<?php echo set_value('tahun_masuk'); ?>">
                                    </td>
                                </tr>
                                <tr style="display:none;" id="tahun_keluar">
                                    <td>
                                        Tahun Keluar
                                    </td>
                                    <td>
                                        <input class="form-control" type="number" name="tahun_keluar" value="<?php echo set_value('tahun_keluar'); ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Upload CV <span class="text-danger">*</span>
                                    </td>
                                    <td>
                                        <input required class="form-control" type="file" accept=".pdf" name="gambar2" value="<?php echo set_value('gambar2'); ?>">
                                        <span class="badge rounded-pill bg-warning text-dark">Format harus PDF</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Upload Sertifikat
                                    </td>
                                    <td>
                                        <input class="form-control" type="file" accept=".pdf" name="gambar3">
                                        <span class="badge rounded-pill bg-warning text-dark">Format harus PDF</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan=4>

                                        <h6> <input required class="form-check-input" type="checkbox" value="" id="flexCheckDefault">Dengan ini saya menyatakan bahwa data yang saya isikan ini adalah benar dan bisa dipertanggungjawabkan. Jika dikemudian hari ditemukan hal-hal yg tidak benar, saya bersedia mempertanggung jawabkan secara hukum.</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan=4>
                                        <h6><input required class="form-check-input" type="checkbox" value="" id="flexCheckDefault">Saya bersedia dihubungi oleh perusahaan yang berminat untuk merekrut saya (walaupun saya belum melamar di perusahaan tersebut)</h6>
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

<script>
    $(document).ready(function() {
        $('#pengalaman_kerja').on('change', function() {
            if (this.value == 'yes') {
                $("#nama_tempat_kerja_terakhir,#posisi_terakhir,#tahun_masuk,#tahun_keluar").show();
                $("#nama_tempat_kerja_terakhir,#posisi_terakhir,#tahun_masuk,#tahun_keluar").prop("required", true);
            } else {
                $("#nama_tempat_kerja_terakhir,#posisi_terakhir,#tahun_masuk,#tahun_keluar").hide();
                $("#nama_tempat_kerja_terakhir,#posisi_terakhir,#tahun_masuk,#tahun_keluar").prop("required", false);
            }
        });
    });
</script>