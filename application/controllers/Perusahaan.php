<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            $this->session->set_flashdata('msg', 'logindulu');

            redirect('home/login', 'refresh');
        }

        if (!$this->session->userdata('status')) {
            $this->session->set_flashdata('msg', 'status');

            redirect('home/login', 'refresh');
        }
        $this->load->model('Model_lowongan');
        $this->load->model('Model_perusahaan');
        $this->load->library('fpdf');
    }

    public function index()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/perusahaan');
        $this->load->view('perusahaan/footer');
    }

    public function updateprofile()
    {
        $id = $this->session->userdata('id');

        $config['upload_path']      = './image/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if (!empty($_FILES['fotouser']['name'])) {
            if (!$this->upload->do_upload('fotouser')) {

                $this->session->set_flashdata('msg', 'gagal');

                redirect('perusahaan/index', 'refresh');
            } else {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr['file_name'];
                $config['create_thumb']     = FALSE;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '50%';
                $config['width']            = 710;
                $config['height']           = 460;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $nmuser     =   $_POST['nmuser'];
                $alamatuser =   $_POST['alamatuser'];
                $nohpuser   =   $_POST['nohpuser'];
                $emailuser  =   $_POST['emailuser'];
                $username   =   $_POST['username'];
                $password   =   $_POST['password'];
                $deskripsi_perusahaan = $_POST['deskripsi_perusahaan'];
                $id_jbu     =   $_POST['jbu'];
                $nib        =   $_POST['nib'];
                $id_sektor  =   $_POST['id_sektor'];
                $kode_pos   =   $_POST['kode_pos'];
                $nama_pj    =   $_POST['nama_pj'];
                $nohp_pj    =   $_POST['nohp_pj'];
                $jabatan_pj =   $_POST['jabatan_pj'];

                $gambar     = $gbr['file_name'];
                $q          = $this->db->query("select * from user where id_user='$id'");
                $row        = $q->row();


                unlink('./image/' . $row->foto_user);
                $data1 = array(
                    'nama_user' => $nmuser,
                    'alamat_user' => $alamatuser,
                    'nohp_user' => $nohpuser,
                    'email_user' => $emailuser,
                    'foto_user' => $gambar
                );
                $where = array(
                    'id_user' => $id
                );
                $data2 = array(
                    'deskripsi_perusahaan' => $deskripsi_perusahaan,
                    'id_jbu' => $id_jbu,
                    'nib' => $nib,
                    'id_sektor' => $id_sektor,
                    'kode_pos' => $kode_pos,
                    'nama_pj' => $nama_pj,
                    'nohp_pj' => $nohp_pj,
                    'jabatan_pj' => $jabatan_pj
                );
                $where2 = array(
                    'id_user' => $id
                );
                if ($password == null) {

                    $this->Model_perusahaan->update_profil($where, 'user', $data1);
                    $this->Model_perusahaan->update_profil($where2, 'perusahaan', $data2);

                    $this->session->set_flashdata('msg', 'edit');

                    redirect('perusahaan/index', 'refresh');
                } else {
                    $this->Model_perusahaan->update_profil($where, 'user', $data1);
                    $this->Model_perusahaan->update_profil($where2, 'perusahaan', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('perusahaan/index', 'refresh');
                }
            }
        } else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];
            $deskripsi_perusahaan = $_POST['deskripsi_perusahaan'];
            $id_jbu     =   $_POST['jbu'];
            $nib        =   $_POST['nib'];
            $id_sektor  =   $_POST['id_sektor'];
            $kode_pos   =   $_POST['kode_pos'];
            $nama_pj    =   $_POST['nama_pj'];
            $nohp_pj    =   $_POST['nohp_pj'];
            $jabatan_pj =   $_POST['jabatan_pj'];

            $data1 = array(
                'nama_user' => $nmuser,
                'alamat_user' => $alamatuser,
                'nohp_user' => $nohpuser,
                'email_user' => $emailuser
            );
            $where = array(
                'id_user' => $id
            );
            $data2 = array(
                'deskripsi_perusahaan' => $deskripsi_perusahaan,
                'id_jbu' => $id_jbu,
                'nib' => $nib,
                'id_sektor' => $id_sektor,
                'kode_pos' => $kode_pos,
                'nama_pj' => $nama_pj,
                'nohp_pj' => $nohp_pj,
                'jabatan_pj' => $jabatan_pj
            );
            $where2 = array(
                'id_user' => $id
            );
            if ($password == null) {

                $this->Model_perusahaan->update_profil($where, 'user', $data1);
                $this->Model_perusahaan->update_profil($where2, 'perusahaan', $data2);

                $this->session->set_flashdata('msg', 'edit');

                redirect('perusahaan/index', 'refresh');
            } else {
                $this->Model_perusahaan->update_profil($where, 'user', $data1);
                $this->Model_perusahaan->update_profil($where2, 'perusahaan', $data2);

                $this->session->set_flashdata('msg', 'edit');

                redirect('perusahaan/index', 'refresh');
            }
        }
    }

    public function chart()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/chart');
        $this->load->view('perusahaan/footer');
    }
    public function lokerdn()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/lokerdn');
        $this->load->view('perusahaan/footer');
    }
    public function tambahloker()
    {

        $this->form_validation->set_rules('tgl_buka_loker', 'tgl buka loker', 'required');
        $this->form_validation->set_rules('tgl_tutup_loker', 'tgl utup loker', 'required');

        if ($this->form_validation->run() == true) {
            $tgl_buka_loker = $_POST['tgl_buka_loker'];
            $tgl_tutup_loker = $_POST['tgl_tutup_loker'];
            $tgl_seleksi_administrasi = $_POST['tgl_seleksi_administrasi'];
            $tgl_seleksi_wawancara = $_POST['tgl_seleksi_wawancara'];
            if ($tgl_tutup_loker > $tgl_buka_loker) {

                if ($tgl_seleksi_administrasi > $tgl_tutup_loker) {

                    if ($tgl_seleksi_wawancara > $tgl_seleksi_administrasi) {

                        $disediakanuntuk = $_POST['disediakanuntuk'];
                        $jabatan = $_POST['jabatan'];
                        $judullowongan = $_POST['judullowongan'];
                        $deskripsi_lowongan = $_POST['deskripsi_lowongan'];
                        $id_sektor = $_POST['id_sektor'];
                        $tgl_buka_loker = $_POST['tgl_buka_loker'];
                        $tgl_tutup_loker = $_POST['tgl_tutup_loker'];
                        $nama_user = $this->session->userdata('id');
                        $lokasi_lowongan = $_POST['lokasi_lowongan'];
                        $jurusan = $_POST['jurusan'];
                        $id_pendidikan = $_POST['id_pendidikan'];
                        $nama_pj = $_POST['nama_pj'];
                        $jenis_lowongan = $_POST['jenis_lowongan'];
                        $tgl_seleksi_administrasi = $_POST['tgl_seleksi_administrasi'];
                        $tgl_seleksi_wawancara = $_POST['tgl_seleksi_wawancara'];
                        $lokasi_wawancara = $_POST['lokasi_wawancara'];

                        $data = array(
                            'disediakanuntuk'   => $disediakanuntuk,
                            'jabatan'           => $jabatan,
                            'judul_lowongan'     => $judullowongan,
                            'deskripsi_lowongan' => $deskripsi_lowongan,
                            'id_sektor'         => $id_sektor,
                            'tgl_buka_loker'    => $tgl_buka_loker,
                            'tgl_tutup_loker'   => $tgl_tutup_loker,
                            'id_user'         => $nama_user,
                            'lokasi_lowongan'   => $lokasi_lowongan,
                            'jurusan'           => $jurusan,
                            'id_pendidikan'     => $id_pendidikan,
                            'nama_pj'           => $nama_pj,
                            'jenis_lowongan'    => $jenis_lowongan,
                            'tgl_seleksi_administrasi' => $tgl_seleksi_administrasi,
                            'tgl_seleksi_wawancara'    => $tgl_seleksi_wawancara,
                            'lokasi_wawancara'  => $lokasi_wawancara,
                            'status' => 'Aktif',
                            'date' => date('Y-m-d H:i:s')
                        );
                        $this->Model_lowongan->tambahloker($data);
                        if ($jenis_lowongan == "Dalam Negeri") {
                            redirect('perusahaan/lokerdn', 'refresh');
                        } else {
                            redirect('perusahaan/lokerln', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('msg', 'gagaltglwawancara');

                        $this->load->view('perusahaan/header');
                        $this->load->view('perusahaan/tambahloker');
                        $this->load->view('perusahaan/footer');
                    }
                } else {
                    $this->session->set_flashdata('msg', 'gagaltgladministrasi');

                    $this->load->view('perusahaan/header');
                    $this->load->view('perusahaan/tambahloker');
                    $this->load->view('perusahaan/footer');
                }
            } else {
                $this->session->set_flashdata('msg', 'gagaltgltutup');

                $this->load->view('perusahaan/header');
                $this->load->view('perusahaan/tambahloker');
                $this->load->view('perusahaan/footer');
            }
        } else {
            $this->load->view('perusahaan/header');
            $this->load->view('perusahaan/tambahloker');
            $this->load->view('perusahaan/footer');
        }
    }

    public function savelokerdn()
    {

        $tgl_buka_loker = new DateTime($_POST['tgl_buka_loker']);
        $tgl_tutup_loker = new DateTime($_POST['tgl_tutup_loker']);
        if ($tgl_tutup_loker > $tgl_buka_loker) {

            $disediakanuntuk = $_POST['disediakanuntuk'];
            $jabatan = $_POST['jabatan'];
            $judullowongan = $_POST['judullowongan'];
            $deskripsi_lowongan = $_POST['deskripsi_lowongan'];
            $id_sektor = $_POST['id_sektor'];
            $tgl_buka_loker = $_POST['tgl_buka_loker'];
            $tgl_tutup_loker = $_POST['tgl_tutup_loker'];
            $nama_user = $this->session->userdata('id');
            $lokasi_lowongan = $_POST['lokasi_lowongan'];
            $jurusan = $_POST['jurusan'];
            $id_pendidikan = $_POST['id_pendidikan'];
            $nama_pj = $_POST['nama_pj'];
            $jenis_lowongan = $_POST['jenis_lowongan'];
            $tgl_seleksi_administrasi = $_POST['tgl_seleksi_administrasi'];
            $tgl_seleksi_wawancara = $_POST['tgl_seleksi_wawancara'];
            $lokasi_wawancara = $_POST['lokasi_wawancara'];



            $data = array(
                'disediakanuntuk'   => $disediakanuntuk,
                'jabatan'           => $jabatan,
                'judul_lowongan'     => $judullowongan,
                'deskripsi_lowongan' => $deskripsi_lowongan,
                'id_sektor'         => $id_sektor,
                'tgl_buka_loker'    => $tgl_buka_loker,
                'tgl_tutup_loker'   => $tgl_tutup_loker,
                'id_user'         => $nama_user,
                'lokasi_lowongan'   => $lokasi_lowongan,
                'jurusan'           => $jurusan,
                'id_pendidikan'     => $id_pendidikan,
                'nama_pj'           => $nama_pj,
                'jenis_lowongan'    => $jenis_lowongan,
                'tgl_seleksi_administrasi' => $tgl_seleksi_administrasi,
                'tgl_seleksi_wawancara'    => $tgl_seleksi_wawancara,
                'lokasi_wawancara'  => $lokasi_wawancara,
                'status' => 'Aktif',
                'date' => date('Y-m-d H:i:s')
            );
            $this->Model_lowongan->tambahloker($data);

            if ($jenis_lowongan == "Dalam Negeri") {
                redirect('perusahaan/lokerdn', 'refresh');
            } else {
                redirect('perusahaan/lokerln', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg', 'gagalsubmit');
            redirect('perusahaan/tambahloker', 'refresh');
        }
    }

    public function hapuslokerdn($id = null)
    {
        $q = $this->db->query("select * from lowongan where id_lowongan='$id'");
        $row  = $q->row();
        $this->db->query("delete from lowongan where id_lowongan='$id'");
        $this->session->set_flashdata('msg', 'hapus');

        redirect('perusahaan/lokerdn', 'refresh');
    }

    public function editlokerdn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/editlokerdn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function updatelokerdn($id = null)
    { #simpan data setelah diedit

        $disediakanuntuk = $_POST['disediakanuntuk'];
        $jabatan = $_POST['jabatan'];
        $judullowongan = $_POST['judullowongan'];
        $deskripsi_lowongan = $_POST['deskripsi_lowongan'];
        $id_sektor = $_POST['id_sektor'];
        $tgl_buka_loker = $_POST['buka_loker'];
        $tgl_tutup_loker = $_POST['tgl_tutup_loker'];
        $tgl_seleksi_administrasi = $_POST['tgl_seleksi_administrasi'];
        $tgl_seleksi_wawancara = $_POST['tgl_seleksi_wawancara'];
        $nama_user = $this->session->userdata('id');
        $lokasi_lowongan = $_POST['lokasi_lowongan'];
        $jurusan = $_POST['jurusan'];
        $id_pendidikan = $_POST['id_pendidikan'];
        $nama_pj = $_POST['nama_pj'];
        $lokasi_wawancara = $_POST['lokasi_wawancara'];
        $status = $_POST['status'];

        $data = array(
            'disediakanuntuk'   => $disediakanuntuk,
            'jabatan'           => $jabatan,
            'judul_lowongan'     => $judullowongan,
            'deskripsi_lowongan' => $deskripsi_lowongan,
            'id_sektor'         => $id_sektor,
            'tgl_buka_loker'    => $tgl_buka_loker,
            'tgl_tutup_loker'   => $tgl_tutup_loker,
            'id_user'           => $nama_user,
            'lokasi_lowongan'   => $lokasi_lowongan,
            'jurusan'           => $jurusan,
            'id_pendidikan'     => $id_pendidikan,
            'nama_pj'           => $nama_pj,
            'tgl_seleksi_administrasi' => $tgl_seleksi_administrasi,
            'tgl_seleksi_wawancara'    => $tgl_seleksi_wawancara,
            'lokasi_wawancara'  => $lokasi_wawancara,
            'status' => $status,
            'date' => date('Y-m-d H:i:s')
        );
        $where = array(
            'id_lowongan' => $id
        );

        $this->Model_lowongan->update_loker('lowongan', $data, $where);
        $this->session->set_flashdata('msg', 'edit');

        redirect('perusahaan/lokerdn', 'refresh');
    }

    public function detaillokerdn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detaillokerdn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function detailhistorilokerdn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detailhistorilokerdn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function detailhistorilokerln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detailhistorilokerln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function lokerln()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/lokerln');
        $this->load->view('perusahaan/footer');
    }
    public function savelokerln()
    {

        $disediakanuntuk = $_POST['disediakanuntuk'];
        $jabatan = $_POST['jabatan'];
        $judullowongan = $_POST['judullowongan'];
        $deskripsi_lowongan = $_POST['deskripsi_lowongan'];
        $id_sektor = $_POST['id_sektor'];
        $tgl_buka_loker = $_POST['tgl_buka_loker'];
        $tgl_tutup_loker = $_POST['tgl_tutup_loker'];
        $nama_user = $this->session->userdata('id');
        $lokasi_lowongan = $_POST['lokasi_lowongan'];
        $jurusan = $_POST['jurusan'];
        $id_pendidikan = $_POST['id_pendidikan'];
        $jumlah = $_POST['jumlah'];
        $nama_pj = $_POST['nama_pj'];
        $jenis_lowongan = $_POST['jenis_lowongan'];
        $tgl_seleksi_administrasi = $_POST['tgl_seleksi_administrasi'];
        $tgl_seleksi_wawancara = $_POST['tgl_seleksi_wawancara'];
        $lokasi_wawancara = $_POST['lokasi_wawancara'];

        $data = array(
            'disediakanuntuk'   => $disediakanuntuk,
            'jabatan'           => $jabatan,
            'judul_lowongan'     => $judullowongan,
            'deskripsi_lowongan' => $deskripsi_lowongan,
            'id_sektor'         => $id_sektor,
            'tgl_buka_loker'    => $tgl_buka_loker,
            'tgl_tutup_loker'   => $tgl_tutup_loker,
            'id_user'         => $nama_user,
            'lokasi_lowongan'   => $lokasi_lowongan,
            'jurusan'           => $jurusan,
            'id_pendidikan'     => $id_pendidikan,
            'nama_pj'           => $nama_pj,
            'jenis_lowongan'    => $jenis_lowongan,
            'tgl_seleksi_administrasi' => $tgl_seleksi_administrasi,
            'tgl_seleksi_wawancara'    => $tgl_seleksi_wawancara,
            'lokasi_wawancara'  => $lokasi_wawancara,
            'status' => 'Aktif',
            'date' => date('Y-m-d H:i:s')
        );
        $this->Model_lowongan->tambahloker($data);
        $this->session->set_flashdata('msg', 'simpan');

        redirect('perusahaan/lokerln', 'refresh');
    }

    public function hapuslokerln($id = null)
    {
        $q = $this->db->query("select * from lowongan where id_lowongan='$id'");
        $row  = $q->row();
        $this->db->query("delete from lowongan where id_lowongan='$id'");
        $this->session->set_flashdata('msg', 'hapus');

        redirect('perusahaan/lokerln', 'refresh');
    }

    public function editlokerln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/editlokerln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function updatelokerln($id = null)
    { #simpan data setelah diedit

        $disediakanuntuk = $_POST['disediakanuntuk'];
        $jabatan = $_POST['jabatan'];
        $judullowongan = $_POST['judullowongan'];
        $deskripsi_lowongan = $_POST['deskripsi_lowongan'];
        $id_sektor = $_POST['id_sektor'];
        $tgl_buka_loker = $_POST['tgl_buka_loker'];
        $tgl_tutup_loker = $_POST['tgl_tutup_loker'];
        $tgl_seleksi_administrasi = $_POST['tgl_seleksi_administrasi'];
        $tgl_seleksi_wawancara = $_POST['tgl_seleksi_wawancara'];
        $nama_user = $this->session->userdata('id');
        $lokasi_lowongan = $_POST['lokasi_lowongan'];
        $jurusan = $_POST['jurusan'];
        $id_pendidikan = $_POST['id_pendidikan'];
        $nama_pj = $_POST['nama_pj'];
        $lokasi_wawancara = $_POST['lokasi_wawancara'];
        $status = $_POST['status'];


        $data = array(
            'disediakanuntuk'   => $disediakanuntuk,
            'jabatan'           => $jabatan,
            'judul_lowongan'     => $judullowongan,
            'deskripsi_lowongan' => $deskripsi_lowongan,
            'id_sektor'         => $id_sektor,
            'tgl_buka_loker'    => $tgl_buka_loker,
            'tgl_tutup_loker'   => $tgl_tutup_loker,
            'id_user'           => $nama_user,
            'lokasi_lowongan'   => $lokasi_lowongan,
            'jurusan'           => $jurusan,
            'id_pendidikan'     => $id_pendidikan,
            'nama_pj'           => $nama_pj,
            'tgl_seleksi_administrasi' => $tgl_seleksi_administrasi,
            'tgl_seleksi_wawancara'    => $tgl_seleksi_wawancara,
            'lokasi_wawancara'  => $lokasi_wawancara,
            'status' => $status,
            'date' => date('Y-m-d H:i:s')
        );
        $where = array(
            'id_lowongan' => $id
        );

        $this->Model_lowongan->update_loker('lowongan', $data, $where);
        $this->session->set_flashdata('msg', 'edit');


        redirect('perusahaan/lokerln', 'refresh');
    }
    public function detaillokerln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detaillokerln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function riwayatdn()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/riwayatdn');
        $this->load->view('perusahaan/footer');
    }
    public function riwayatln()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/riwayatln');
        $this->load->view('perusahaan/footer');
    }
    public function historidn()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/historidn');
        $this->load->view('perusahaan/footer');
    }
    public function historiln()
    {
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/historiln');
        $this->load->view('perusahaan/footer');
    }

    public function pelamardn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/pelamardn', $data, FALSE);
        $this->load->view('perusahaan/footer');
    }
    public function lihatpelamardn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/lihatpelamardn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function pelamarln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/pelamarln', $data, FALSE);
        $this->load->view('perusahaan/footer');
    }

    public function historipelamarln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/historipelamarln', $data, FALSE);
        $this->load->view('perusahaan/footer');
    }

    public function historipelamardn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header');
        $this->load->view('perusahaan/historipelamardn', $data, FALSE);
        $this->load->view('perusahaan/footer');
    }

    public function lihatpelamarln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/lihatpelamarln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }
    public function updatestatuspelamardn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/updatestatuspelamardn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function ubahstatuspelamardn($id)
    {
        $status_pelamar = $_POST['status_pelamar']; //name
        $id_lamar = $_POST['id_lamar'];
        $this->db->query("update lamar set id_status_lamar='$status_pelamar' where id_lamar='$id_lamar'");
        $this->session->set_flashdata('msg', 'simpan');

        redirect('perusahaan/pelamardn/' . $id, 'refresh');
    }

    public function updatestatuspelamarln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/updatestatuspelamarln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function ubahstatuspelamarln($id)
    {
        $status_pelamar = $_POST['status_pelamar']; //name
        $id_lamar = $_POST['id_lamar'];
        $this->db->query("update lamar set id_status_lamar='$status_pelamar' where id_lamar='$id_lamar'");
        $this->session->set_flashdata('msg', 'simpan');

        redirect('perusahaan/pelamarln/' . $id, 'refresh');
    }

    public function detailpelamardn($lowongan, $id = null)
    {
        $data['id'] = $id;
        $data['lowongan'] = $lowongan;

        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detailpelamardn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function detailpelamarln($lowongan, $id = null)
    {
        $data['id'] = $id;
        $data['lowongan'] = $lowongan;

        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detailpelamarln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function detailhistoripelamardn($id_lowongan, $id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detailhistoripelamardn', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }

    public function detailhistoripelamarln($id_lowongan, $id = null)
    {
        $data['id'] = $id;
        $this->load->view('perusahaan/header', $data, FALSE);
        $this->load->view('perusahaan/detailhistoripelamarln', $data, FALSE);
        $this->load->view('perusahaan/footer', $data, FALSE);
    }


    public function eksportpdflokerdn()
    {
        $this->load->library('FPDF');

        $this->load->view('perusahaan/eksportpdflokerdn');
    }

    public function eksportpdflokerln()
    {
        $this->load->library('FPDF');

        $this->load->view('perusahaan/eksportpdflokerln');
    }

    public function eksportpdfriwayatlokerdn()
    {
        $this->load->library('FPDF');

        $this->load->view('perusahaan/eksportpdfriwayatlokerdn');
    }

    public function eksportpdfriwayatlokerln()
    {
        $this->load->library('FPDF');

        $this->load->view('perusahaan/eksportpdfriwayatlokerln');
    }

    public function eksportpdfpelamardn($id = null)
    {
        $data["id"] = $id;
        $this->load->library('FPDF');

        $this->load->view('perusahaan/eksportpdfpelamardn', $data, FALSE);
    }

    public function eksportpdfpelamarln($id = null)
    {
        $data["id"] = $id;
        $this->load->library('FPDF');

        $this->load->view('perusahaan/eksportpdfpelamarln', $data, FALSE);
    }
}

/* End of file user.php */