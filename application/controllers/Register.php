<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('model_register');
        $this->load->model('model_footer');
    }

    public function daftar_pencarikerja()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[user.username]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );

        $this->form_validation->set_rules(
            'nik',
            'NIK',
            'required|is_unique[pencari_kerja.nik_pencaker]|min_length[16]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => '%s Sudah Terdaftar, Silahkan Buat Baru.',
                'min_length'    => 'NIK Minimal 16 Karakter'
            )
        );

        $this->form_validation->set_rules(
            'email', //name
            'Email Penyedia Kerja', //tulisan yang ditampilkan
            'required|is_unique[user.email_user]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.',
            )
        );


        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', array(
            'matches' => '%s tidak sama!'
        ));
        if ($this->form_validation->run() == FALSE) {
            // $this->session->set_flashdata('msg', 'usernamegagal');
            $data['ngapp'] = 'ng-app="studentApp"';
            $data['provinsi']   =   $this->model_register->get_provinsi();
            $data['kabupaten']  =   $this->model_register->get_kabupaten();
            $data['kecamatan']  =   $this->model_register->get_kecamatan();
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/daftar_pencarikerja', $data);
            $this->load->view('frontend/footer');
            //redirect('home/daftar_pencarikerja','refresh');

        } else {

            $today = new DateTime(date("Y-m-d"));
            $bday = new DateTime($_POST['tanggal_lahir']);
            $interval = $today->diff($bday);
            if (intval($interval->y) > 18) {

                $config['upload_path'] = './image/';
                $config['allowed_types'] = 'jpg|jpeg|png|pdf';
                $config['max_size']  = '2000';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload("gambar1")) { //upload file
                    $gbr = $this->upload->data();
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './image/' . $gbr['file_name'];
                    $config['create_thumb']     = false;
                    $config['maintain_ratio']   = TRUE;
                    $config['quality']          = '80%';

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar1 = $gbr['file_name'];
                }

                if ($this->upload->do_upload("gambar2")) {
                    $gbr2 = $this->upload->data();
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './image/' . $gbr2['file_name'];
                    $config['create_thumb']     = false;
                    $config['maintain_ratio']   = TRUE;
                    $config['quality']          = '80%';
                    $config['width']            = 710;
                    $config['height']           = 460;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar2 = $gbr2['file_name'];
                }

                if ($this->upload->do_upload("gambar3")) {
                    $gbr3 = $this->upload->data();
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './image/' . $gbr3['file_name'];
                    $config['create_thumb']     = false;
                    $config['maintain_ratio']   = TRUE;
                    $config['quality']          = '80%';
                    $config['width']            = 710;
                    $config['height']           = 460;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar3 = $gbr3['file_name'];
                }

                if ($this->upload->do_upload("gambar4")) {
                    $gbr4 = $this->upload->data();
                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './image/' . $gbr4['file_name'];
                    $config['create_thumb']     = false;
                    $config['maintain_ratio']   = TRUE;
                    $config['quality']          = '80%';
                    $config['width']            = 710;
                    $config['height']           = 460;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    $gambar4 = $gbr4['file_name'];
                }

                $nama                           = $_POST['nama'];
                $nik                            = $_POST['nik'];
                $tempat_lahir                   = $_POST['tempat_lahir'];
                $tanggal_lahir                  = $_POST['tanggal_lahir'];
                $agama                          = $_POST['agama'];
                $email                          = $_POST['email'];
                $nohp                           = $_POST['nohp'];
                $jenis_kelamin                  = $_POST['jenis_kelamin'];
                $tinggi_badan                   = $_POST['tinggi_badan'];
                $berat_badan                    = $_POST['berat_badan'];
                $status_perkawinan              = $_POST['status_perkawinan'];
                $provinsi                       = $_POST['provinsi'];
                $kabupaten                      = $_POST['kabupaten'];
                $kecamatan                      = $_POST['kecamatan'];
                $alamat                         = $_POST['alamat'];
                $kodepos                        = $_POST['kodepos'];
                $pendidikan                     = $_POST['pendidikan'];
                $jurusan                        = $_POST['jurusan'];
                $tahun_lulus                    = $_POST['tahun_lulus'];
                $jabatan                        = $_POST['jabatan'];
                $upload_sertifikat              = $gambar3;
                $berkas_domisili                = $gambar4;
                if ($_POST['pengalaman_kerja'] == "-" || $_POST['pengalaman_kerja'] == "") {
                    $pengalaman_kerja               = "-";
                    $nama_tempat_kerja_terakhir     = "-";
                    $posisi_terakhir                = "-";
                    $tahun_masuk                    = "-";
                    $tahun_keluar                   = "-";
                } else {
                    $pengalaman_kerja               = $_POST['pengalaman_kerja'];
                    $nama_tempat_kerja_terakhir     = $_POST['nama_tempat_kerja_terakhir'];
                    $posisi_terakhir                = $_POST['posisi_terakhir'];
                    $tahun_masuk                    = $_POST['tahun_masuk'];
                    $tahun_keluar                   = $_POST['tahun_keluar'];
                }
                $username                       = $_POST['username'];
                $password                       = $_POST['password'];


                $data1 = array(
                    'id_user' => '',
                    'nama_user' => $nama,
                    'username' => $username,
                    'password' => md5($_POST['password']),
                    'level' => '4',
                    'foto_user' => $gambar1,
                    'email_user' => $email,
                    'nohp_user' => $nohp,
                    'alamat_user' => $alamat,
                    'status'    => '1',
                    'date'      => date('Y-m-d H:i:s')
                ); //tabel admin

                $this->model_register->register('user', $data1);
                $id_user = $this->db->insert_id();

                $data = array(
                    'nik_pencaker' => $nik,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'id_agama' => $agama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tinggi_badan' => $tinggi_badan,
                    'berat_badan' => $berat_badan,
                    'id_status_perkawinan' => $status_perkawinan,
                    'id_provinsi' => $provinsi,
                    'id_kabupaten' => $kabupaten,
                    'id_kecamatan' => $kecamatan,
                    'kodepos' => $kodepos,
                    'id_pendidikan' => $pendidikan,
                    'jurusan' => $jurusan,
                    'tahun_lulus' => $tahun_lulus,
                    'jabatan' => $jabatan,
                    'pengalaman_kerja' => $pengalaman_kerja,
                    'nama_tempat_kerja_terakhir' => $nama_tempat_kerja_terakhir,
                    'posisi_terakhir' => $posisi_terakhir,
                    'tahun_masuk' => $tahun_masuk,
                    'tahun_keluar' => $tahun_keluar,
                    'upload_cv' => $gambar2,
                    'upload_sertifikat' => $upload_sertifikat,
                    'id_user' => $id_user,
                    'berkas_domisili' => $berkas_domisili,
                    'date' => date("Y-m-d H:i:s")
                ); //tabel pencari kerja

                $this->model_register->register('pencari_kerja', $data);
                $this->session->set_flashdata('msg', 'simpan');
                redirect('register/daftar_pencarikerja', 'refresh');
            } else {
                $this->session->set_flashdata('msg', 'gagaldaftar');
                redirect('register/daftar_pencarikerja', 'refresh');
            }
        }
    }


    public function daftar_penyediapelatihan()
    {
        $data['ngapp']      =   'ng-app="studentApp"';
        $data['provinsi']   =   $this->model_register->get_provinsi();
        $data['kabupaten']  =   $this->model_register->get_kabupaten();
        $data['kecamatan']  =   $this->model_register->get_kecamatan();
        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/daftar_penyediapelatihan', $data);
        $this->load->view('frontend/footer');
    }

    public function savedaftarpenyediapelatihan()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[user.username]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', array(
            'matches' => '%s tidak sama!'
        ));
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', 'usernamegagal');
            $data['ngapp']      =   'ng-app="studentApp"';
            $data['provinsi']   =   $this->db->query('select * from provinsi');
            $data['kabupaten']  =   $this->db->query("select kabupaten.*,provinsi.* from kabupaten inner join provinsi on provinsi.id_provinsi = kabupaten.id_provinsi")->result();
            $data['kecamatan']  =   $this->db->query("select kecamatan.*,kabupaten.* from kecamatan inner join kabupaten on kabupaten.id_kabupaten = kecamatan.id_kabupaten")->result();
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/daftar_penyediapelatihan', $data);
            $this->load->view('frontend/footer');
            //redirect('home/daftar_penyediapelatihan','refresh');
        } else {
            $config['upload_path']      = './image/'; #lokasi folder untuk menyimpan file
            $config['allowed_types']    = 'jpg|png|jpeg'; #tipe files
            $config['max_size']         = '2000'; #maksimal size dalam kb 
            $config['encrypt_name']     = TRUE; #nama enkripsi 
            $this->load->library('upload', $config); #panggil library upload 
            if ($this->upload->do_upload("gambar1")) { //upload file
                $gbr = $this->upload->data();

                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr['file_name'];
                $config['create_thumb']     = FALSE; #Watermark
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '60%';
                $config['width']            = 710;
                $config['height']           = 460;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $nama           = $_POST['nama'];
                $provinsi       = $_POST['provinsi'];
                $kabupaten      = $_POST['kabupaten'];
                $kecamatan      = $_POST['kecamatan'];
                $alamat         = $_POST['alamat'];
                $kodepos        = $_POST['kodepos'];
                $notelepon      = $_POST['notelepon'];
                $email          = $_POST['email'];
                $username       = $_POST['username'];
                $password       = $_POST['password'];
                $namapj         = $_POST['namapj'];
                $noteleponpj    = $_POST['noteleponpj'];

                //$id_user        = $this->db->insert_id();

                $gambar = $gbr['file_name'];

                $id = null;

                $data1     = array(
                    'id_user'   => '',
                    'nama_user' => $nama,
                    'username'  => $username,
                    'password'  => md5($_POST['password']),
                    'level'     => '3',
                    'foto_user' => $gambar,
                    'email_user' => $email,
                    'nohp_user' => $notelepon,
                    'alamat_user' => $alamat,
                    'status'    => '0',
                    'date'      => date('Y-m-d')
                );

                $this->model_register->register('user', $data1);
                $id_user = $this->db->insert_id();

                $data = array(
                    'id_provinsi'   => $provinsi,
                    'id_kabupaten'  => $kabupaten,
                    'id_kecamatan'  => $kecamatan,
                    'kode_pos'      => $kodepos,
                    'nama_pjpp'     => $namapj,
                    'notelp_pjpp'   => $noteleponpj,
                    'id_user'       => $id_user
                );

                $this->model_register->register('penyedia_pelatihan', $data);
                $this->session->set_flashdata('msg', 'simpan');

                redirect('register/daftar_penyediapelatihan', 'refresh');
            } else {

                $nama           = $_POST['nama'];
                $provinsi       = $_POST['provinsi'];
                $kabupaten      = $_POST['kabupaten'];
                $kecamatan      = $_POST['kecamatan'];
                $alamat         = $_POST['alamat'];
                $kodepos        = $_POST['kodepos'];
                $notelepon      = $_POST['notelepon'];
                $email          = $_POST['email'];
                $username       = $_POST['username'];
                $password       = $_POST['password'];
                $namapj         = $_POST['namapj'];
                $noteleponpj    = $_POST['noteleponpj'];
                //$id_user        = $this->db->insert_id();

                $id = null;

                $data1 = array(
                    'id_user'   => '',
                    'nama_user' => $nama,
                    'username'  => $username,
                    'password'  => md5($_POST['password']),
                    'level'     => '3',
                    'email_user' => $email,
                    'nohp_user' => $notelepon,
                    'alamat_user' => $alamat,
                    'status'    => '0',
                    'date'      => date('Y-m-d')
                );

                $this->model_register->register('user', $data1);
                $id_user = $this->db->insert_id();

                $data = array(
                    'id_provinsi' => $provinsi,
                    'id_kabupaten' => $kabupaten,
                    'id_kecamatan' => $kecamatan,
                    'kode_pos' => $kodepos,
                    'nama_pjpp' => $namapj,
                    'notelp_pjpp' => $noteleponpj,
                    'id_user' => $id_user
                );

                $this->model_register->register('penyedia_pelatihan', $data);
                $this->session->set_flashdata('msg', 'simpan');


                redirect('register/daftar_penyediapelatihan', 'refresh');
            }
        }
    }

    public function daftar_penyediakerja()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|is_unique[user.username]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.'
            )
        );
        $this->form_validation->set_rules(
            'nib', //nama di database
            'Nomer Induk Berusaha', //tulisan yang ditampilkan
            'required|is_unique[perusahaan.nib]|min_length[13]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => '%s Sudah Terdaftar, Silahkan Buat Baru.',
                'min_length'    => 'NIB Minimal 13 Karakter.'
            )
        );
        $this->form_validation->set_rules(
            'email_perusahaan', //nama di database
            'Email Penyedia Kerja', //tulisan yang ditampilkan
            'required|is_unique[user.email_user]',
            array(
                'required'      => 'You have not provided %s.',
                'is_unique'     => 'This %s already exists.',
            )
        );

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', array(
            'matches' => '%s tidak sama!'
        ));
        if ($this->form_validation->run() == FALSE) {
            // $this->session->set_flashdata('msg', 'usernamegagal');
            $data['ngapp'] = 'ng-app="studentApp"';
            $data['provinsi']   =   $this->model_register->get_provinsi();
            $data['kabupaten']  =   $this->model_register->get_kabupaten();
            $data['kecamatan']  =   $this->model_register->get_kecamatan();
            $this->load->view('frontend/header', $data);
            $this->load->view('frontend/daftar_penyediakerja', $data);
            $this->load->view('frontend/footer');
            //redirect('home/daftar_penyediakerja','refresh');
        } else {
            $config['upload_path'] = './image/'; #lokasi folder untuk menyimpan file
            $config['allowed_types'] = 'jpg|png|jpeg'; #tipe files
            $config['max_size']  = '2000'; #maksimal size dalam kb 
            $config['encrypt_name'] = TRUE; #nama enkripsi 
            $this->load->library('upload', $config); #panggil library upload 
            if ($this->upload->do_upload("gambar")) { //upload file
                $gbr = $this->upload->data();

                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr['file_name'];
                $config['create_thumb']     = FALSE; #Watermark
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '60%';
                $config['width']            = 710;
                $config['height']           = 460;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $nama                           = $_POST['nama'];
                $deskripsi                      = $_POST['deskripsi'];
                $jbu                            = $_POST['jbu'];
                $nib                            = $_POST['nib'];
                $sektor                         = $_POST['sektor'];
                $provinsi                       = $_POST['provinsi'];
                $kabupaten                      = $_POST['kabupaten'];
                $kecamatan                      = $_POST['kecamatan'];
                $alamat                         = $_POST['alamat'];
                $kodepos                        = $_POST['kodepos'];
                $notelp_perusahaan              = $_POST['notelp_perusahaan'];
                $email_perusahaan               = $_POST['email_perusahaan'];
                $username                       = $_POST['username'];
                $password                       = $_POST['password'];
                $namapj                         = $_POST['namapj'];
                $notelp_pj                      = $_POST['notelp_pj'];
                $jabatan_pj                     = $_POST['jabatan_pj'];
                //$id_user        = $this->db->insert_id();

                $gambar = $gbr['file_name'];

                $id = null;

                $data1 = array(
                    'id_user' => '',
                    'nama_user' => $nama,
                    'username' => $username,
                    'password' => md5($_POST['password']),
                    'level' => '2',
                    'foto_user' => $gambar,
                    'email_user' => $email_perusahaan,
                    'nohp_user' => $notelp_perusahaan,
                    'alamat_user' => $alamat,
                    'status'    => '0',
                    'date'      => date('Y-m-d H:i:s')
                );

                $this->model_register->register('user', $data1);
                $id_user = $this->db->insert_id();

                $data = array(
                    'deskripsi_perusahaan' => $deskripsi,
                    'id_jbu' => $jbu,
                    'nib' => $nib,
                    'id_sektor' => $sektor,
                    'id_provinsi' => $provinsi,
                    'id_kabupaten' => $kabupaten,
                    'id_kecamatan' => $kecamatan,
                    'kode_pos' => $kodepos,
                    'nama_pj' => $namapj,
                    'nohp_pj' => $notelp_pj,
                    'jabatan_pj' => $jabatan_pj,
                    'id_user' => $id_user
                );

                $this->model_register->register('perusahaan', $data);
                $this->session->set_flashdata('msg', 'simpan');

                redirect('register/daftar_penyediakerja', 'refresh');
            } else {

                $nama                           = $_POST['nama'];
                $deskripsi                      = $_POST['deskripsi'];
                $jbu                            = $_POST['jbu'];
                $nib                            = $_POST['nib'];
                $sektor                         = $_POST['sektor'];
                $provinsi                       = $_POST['provinsi'];
                $kabupaten                      = $_POST['kabupaten'];
                $kecamatan                      = $_POST['kecamatan'];
                $alamat                         = $_POST['alamat'];
                $kodepos                        = $_POST['kodepos'];
                $notelp_perusahaan              = $_POST['notelp_perusahaan'];
                $email_perusahaan               = $_POST['email_perusahaan'];
                $username                       = $_POST['username'];
                $password                       = $_POST['password'];
                $namapj                         = $_POST['namapj'];
                $notelp_pj                      = $_POST['notelp_pj'];
                $jabatan_pj                     = $_POST['jabatan_pj'];
                //$id_user        = $this->db->insert_id();
                //tabel keseluruhan di registrasi

                $id = null;

                $data1 = array(
                    'id_user' => '',
                    'nama_user' => $nama,
                    'username' => $username,
                    'password' => md5($_POST['password']),
                    'level' => '2',
                    'foto_user' => '',
                    'email_user' => $email_perusahaan,
                    'nohp_user' => $notelp_perusahaan,
                    'alamat_user' => $alamat,
                    'status'    => '0',
                    'date'      => date('Y-m-d')
                ); //tabel admin

                $this->model_register->register('user', $data1);
                $id_user = $this->db->insert_id();

                $data = array(
                    'deskripsi_perusahaan' => $deskripsi,
                    'id_jbu' => $jbu,
                    'nib' => $nib,
                    'id_sektor' => $sektor,
                    'id_provinsi' => $provinsi,
                    'id_kabupaten' => $kabupaten,
                    'id_kecamatan' => $kecamatan,
                    'kode_pos' => $kodepos,
                    'nama_pj' => $namapj,
                    'nohp_pj' => $notelp_pj,
                    'jabatan_pj' => $jabatan_pj,
                    'id_user' => $id_user
                ); //tabel pencari kerja

                $this->model_register->register('perusahaan', $data);
                $this->session->set_flashdata('msg', 'simpan');


                redirect('register/daftar_penyediakerja', 'refresh');
            }
        }
    }
}

/* End of file Register.php */
