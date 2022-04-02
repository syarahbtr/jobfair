<br>
<br>
<main id="main">
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <?php
        $id = $this->session->userdata('id');
        $q = $this->db->query("select pencari_kerja.*,user.nama_user,user.foto_user,user.username,user.alamat_user,
        user.email_user,user.nohp_user,agama.nama_agama,pendidikan.nama_pendidikan,provinsi.provinsi,kabupaten.kabupaten,kecamatan.kecamatan,
        status_perkawinan.nama_status_perkawinan
        from pencari_kerja
        left join user on user.id_user=pencari_kerja.id_user
        left join agama on agama.id_agama=pencari_kerja.id_agama
        left join pendidikan on pendidikan.id_pendidikan=pencari_kerja.id_pendidikan
        left join provinsi on provinsi.id_provinsi=pencari_kerja.id_provinsi
        left join kabupaten on kabupaten.id_kabupaten=pencari_kerja.id_kabupaten
        left join kecamatan on kecamatan.id_kecamatan=pencari_kerja.id_kecamatan
        left join status_perkawinan on status_perkawinan.id_status_perkawinan=pencari_kerja.id_status_perkawinan
        
        where pencari_kerja.id_user='$id'");
        $row = $q->row();

        ?>
        <div class="container" data-aos="fade-up">

            <header class="section-header">
                <p>Edit Profil</p>
            </header>
            <div class="card">
                <div class="card-header bg-primary text-light">
                </div>
                <div class="card-body">
                    <form action="pencaker/updateprofilpencaker" method="post" enctype="multipart/form-data">
                        <div ng-controller="studentCtrl">
                            <table class="table">
                                <tr>
                                    <td>
                                        Nama Lengkap
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->nama_user; ?>' name=nmuser>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        NIK (Nomor Induk Kependudukan)
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" value='<?php echo $row->nik_pencaker; ?>' name=nik_pencaker>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Surat Domisili
                                    </td>
                                    <td>
                                        <input class="form-control" type="file" accept=".pdf" name="gambar4">
                                        <a href="image/<?php echo $row->berkas_domisili ?>" target="_blank"> lihat berkas</a>
                                        <!-- <embed type="application/pdf" src="image/<?php echo $row->berkas_domisili ?>" width="600" height="400"></embed> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tempat Lahir
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->tempat_lahir; ?>' name=tempat_lahir>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal Lahir
                                    </td>
                                    <td>
                                        <input type="date" id="datepickerfrom" class="form-control" value='<?php echo $row->tanggal_lahir ?>' name=tanggal_lahir>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Agama
                                    </td>
                                    <td>
                                        <select name="agama" class=form-control id="">
                                            <option value="<?php echo $row->id_agama ?>"><?php echo $row->nama_agama ?></option>
                                            <?php
                                            $q = $this->db->query('select * from agama');
                                            foreach ($q->result() as $rowagama) {

                                            ?>
                                                <option value="<?php echo $rowagama->id_agama ?>"><?php echo $rowagama->nama_agama ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->email_user; ?>' name=emailuser>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        No HP
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" value='<?php echo $row->nohp_user; ?>' name=nohpuser>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Foto
                                    </td>
                                    <td>
                                        <input class="form-control" type="file" name="gambar1">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jenis Kelamin
                                    </td>

                                    <td>
                                        <select name="jenis_kelamin" class=form-control id="">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" <?php if ($row->jenis_kelamin == 'Laki-laki') echo 'selected' ?>>Laki-laki</option>
                                            <option value="Perempuan" <?php if ($row->jenis_kelamin == 'Perempuan') echo 'selected' ?>>Perempuan</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tinggi Badan
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->tinggi_badan; ?>' name=tinggi_badan>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Berat Badan
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->berat_badan; ?>' name=berat_badan>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Status Perkawinan
                                    </td>
                                    <td>
                                        <select name="status_perkawinan" class="form-control select2" id="">
                                            <option value="<?php echo $row->id_status_perkawinan ?>"><?php echo $row->nama_status_perkawinan ?></option>
                                            <?php
                                            $q = $this->db->query('select * from status_perkawinan');
                                            foreach ($q->result() as $rowstatusperkawinan) {
                                            ?>
                                                <option value="<?php echo $rowstatusperkawinan->id_status_perkawinan ?>"><?php echo $rowstatusperkawinan->nama_status_perkawinan ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Provinsi
                                    </td>
                                    <td>
                                        <select name="provinsi" class="form-control select2" id="">
                                            <option value="<?php echo $row->id_provinsi ?>"><?php echo $row->provinsi ?></option>
                                            <?php
                                            $q = $this->db->query('select * from provinsi');
                                            foreach ($q->result() as $rowprovinsi) {
                                            ?>
                                                <option value="<?php echo $rowprovinsi->id_provinsi ?>"><?php echo $rowprovinsi->provinsi ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Kabupaten
                                    </td>
                                    <td>
                                        <select name="kabupaten" class="form-control select2" id="">
                                            <option value="<?php echo $row->id_kabupaten ?>"><?php echo $row->kabupaten ?></option>
                                            <?php
                                            $q = $this->db->query('select * from kabupaten');
                                            foreach ($q->result() as $rowkabupaten) {
                                            ?>
                                                <option value="<?php echo $rowkabupaten->id_kabupaten ?>"><?php echo $rowkabupaten->kabupaten ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Kecamatan
                                    </td>
                                    <td>
                                        <select name="kecamatan" class=form-control id="">
                                            <option value="<?php echo $row->id_kecamatan ?>"><?php echo $row->kecamatan ?></option>
                                            <?php
                                            $q = $this->db->query('select * from kecamatan');
                                            foreach ($q->result() as $rowkecamatan) {
                                            ?>
                                                <option value="<?php echo $rowkecamatan->id_kecamatan ?>"><?php echo $rowkecamatan->kecamatan ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Alamat Lengkap
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->alamat_user; ?>' name=alamatuser>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Kode Pos
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" value='<?php echo $row->kodepos; ?>' name=kodepos>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Pendidikan Terakhir
                                    </td>
                                    <td>
                                        <select name="pendidikan" class=form-control id="">
                                            <option value="<?php echo $row->id_pendidikan ?>"><?php echo $row->nama_pendidikan ?></option>
                                            <?php
                                            $q = $this->db->query('select * from pendidikan');
                                            foreach ($q->result() as $rowpendidikan) {
                                            ?>
                                                <option value="<?php echo $rowpendidikan->id_pendidikan ?>"><?php echo $rowpendidikan->nama_pendidikan ?></option>
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
                                        <input type="text" class="form-control select2" value='<?php echo $row->jurusan; ?>' name=jurusan>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tahun Lulus
                                    </td>
                                    <td>
                                        <input type="number" class="form-control select2" value='<?php echo $row->tahun_lulus; ?>' name=tahun_lulus>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jabatan Harapan
                                    </td>
                                    <td>
                                        <input type="text" class="form-control select2" value='<?php echo $row->jabatan; ?>' name=jabatan>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Username
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value='<?php echo $row->username; ?>' name=username>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Password
                                    </td>
                                    <td>
                                        <input type="password" class="form-control" value='' name=password>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Upload CV
                                    </td>
                                    <td>
                                        <input class="form-control" type="file" accept=".pdf" name="gambar2">
                                        <a href="image/<?php echo $row->upload_cv ?>" target="_blank"> lihat berkas</a>
                                        <!-- <embed type="application/pdf" src="image/<?php echo $row->upload_cv ?>" width="600" height="400"></embed> -->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Upload Sertifikat
                                    </td>
                                    <td>
                                        <input class="form-control" type="file" accept=".pdf" name="gambar3">
                                        <a href="image/<?php echo $row->upload_sertifikat ?>" target="_blank"> lihat berkas</a>
                                        <!-- <embed type="application/pdf" src="image/<?php echo $row->upload_sertifikat ?>" width="600" height="400"></embed> -->
                                    </td>
                                </tr>
                                <td>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

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

            var url = SITEURL + 'api/provinsi/';
            $http.get(url).then(function(response) {
                $scope.provinsi = response.data;
            });
        };
        $scope.getStudent = function(id) {
            var url = SITEURL + 'api/kabupaten/' + id;
            $http.get(url).then(function(response) {
                $scope.kabupaten = response.data;
            });

        };
        angular.element(document).ready(function() {
            $scope.getClass();
        });

        //get lurah
        $scope.getLurah = function(id) {

            var url = SITEURL + 'api/kabupaten/' + id;
            $http.get(url).then(function(response) {
                $scope.kabupaten = response.data;
            });
        };
        $scope.getLurah = function(id) {
            var url = SITEURL + 'api/kecamatan/' + id;
            $http.get(url).then(function(response) {
                $scope.kecamatan = response.data;
            });

        };
        angular.element(document).ready(function() {
            $scope.getLurah();
        });

    });
</script>