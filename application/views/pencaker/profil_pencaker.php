<main id="main">
    <?php
    $id = $this->session->userdata('id');
    $pencaker = $this->db->query("select * from pencari_kerja where id_user='$id'")->row();
    $user = $this->db->query("select * from user where id_user='$id'")->row();

    // $q = $this->db->query("select pencari_kerja.*,user.nama_user,user.foto_user,user.username,user.alamat_user,
    // user.email_user,user.nohp_user,agama.najurusan.nama_pendjurusanusan.nama_jurusajurusannama_jabatan
    // from pencari_kerja
    // inner join user on user.id_user=pencari_kerja.id_user
    // inner join agama on agama.id_agama=pencari_kerja.id_agama
    // inner join pendidikan on pendidikan.id_pendidikan=pencari_kerja.id_pendidikan
    // inner join jurusan on jurusan.id_jurusan=pencari_kerja.id_jurusan
    // inner join jabatan on jabatan.id_jabatan=pencari_kerja.id_jabatan
    // where pencari_kerja.id_user='$id'");
    // $row = $q->row();
    ?>
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="pencaker">Home</a></li>
                <li>Profil Pencari Kerja</li>
            </ol>
            <h2>Profil Pencari Kerja</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="values" class="values">
        <div class="container" data-aos="fade-up">
            <table class="table table-striped">
                <tr>
                    <td>Foto User</td>
                    <td>:</td>
                    <td>
                        <img src="image/<?php echo $user->foto_user ?>" alt="" class="img img-fluid" width=120>
                    </td>
                </tr>
                <tr>
                    <td>Nama User</td>
                    <td>:</td>
                    <td><?php echo $user->nama_user ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?php echo $pencaker->nik_pencaker ?></td>
                </tr>
                <tr>
                    <td>Berkas Domisili</td>
                    <td>:</td>
                    <!-- <td><embed type="application/pdf" src="image/<?php echo $pencaker->berkas_domisili ?>" width="600" height="400"></embed></td> -->
                    <td> <a href="image/<?php echo $pencaker->berkas_domisili ?>" target="_blank"> lihat berkas</a></td>
                </tr>
                <tr>
                    <td>Tempat lahir</td>
                    <td>:</td>
                    <td><?php echo $pencaker->tempat_lahir ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><?php echo $pencaker->tanggal_lahir ?></td>
                </tr>
                <tr>
                    <td>Alamat Lengkap</td>
                    <td>:</td>
                    <td><?php echo $user->alamat_user ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <?php
                    $agama = $this->db->query("select * from agama where id_agama='$pencaker->id_agama'")->row();
                    ?>

                    <td><?php echo $agama->nama_agama ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?php echo $pencaker->jenis_kelamin ?></td>
                </tr>
                <tr>
                    <td>Tinggi Badan</td>
                    <td>:</td>
                    <td><?php echo $pencaker->tinggi_badan ?></td>
                </tr>
                <tr>
                    <td>Berat Badan</td>
                    <td>:</td>
                    <td><?php echo $pencaker->berat_badan ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $user->email_user ?></td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:</td>
                    <td><?php echo $user->nohp_user ?></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td>:</td>
                    <?php
                    $pendidikan = $this->db->query("select * from pendidikan where id_pendidikan='$pencaker->id_pendidikan'")->row();
                    ?>
                    <td><?php echo $pendidikan->nama_pendidikan ?></td>
                </tr>
                <tr>
                    <td>Jurusan</td>
                    <td>:</td>
                    <td><?php echo $pencaker->jurusan ?></td>
                </tr>
                <tr>
                    <td>Tahun Lulus</td>
                    <td>:</td>
                    <td><?php echo $pencaker->tahun_lulus ?></td>
                </tr>
                <tr>
                    <td>Curriculum Vitae</td>
                    <td>:</td>
                    <td> <a href="image/<?php echo $pencaker->upload_cv ?>" target="_blank"> lihat berkas</a></td>
                    <!-- <td><embed type="application/pdf" src="image/<?php echo $pencaker->upload_cv ?>" width="600" height="400"></embed></td> -->
                </tr>
                <tr>
                    <td>Sertifikat</td>
                    <td>:</td>
                    <td> <a href="image/<?php echo $pencaker->upload_sertifikat ?>" target="_blank"> lihat berkas</a></td>
                    <!-- <td><embed type="application/pdf" src="image/<?php echo $pencaker->upload_sertifikat ?>" width="600" height="400"></embed></td> -->
                </tr>
                <tr>
                    <td colspan="3"><a href="pencaker/editprofilpencaker" class="btn btn-danger">Edit Profil</a></td>
                </tr>
            </table>
        </div>
    </section>

</main>