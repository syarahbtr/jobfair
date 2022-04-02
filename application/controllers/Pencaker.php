<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pencaker extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id')) {
            $this->session->set_flashdata('msg', 'logindulu');

            redirect('login/index', 'refresh');
        }

        $this->load->model('main_model');
        $this->load->model('Model_lamar');
        $this->load->model('Model_pencarikerja');
        $this->load->model('model_footer');
    }
    public function index()
    {
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/index');
        $this->load->view('pencaker/footer');
    }
    public function profil_pencaker()
    {
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/profil_pencaker');
        $this->load->view('pencaker/footer');
    }
    public function lowongandnumum()
    {
        $this->load->library('pagination');

        $today = date("Y-m-d");
        $lokerdn = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,
                        pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Umum'");
        $page = $this->uri->segment(3);
        if (!$page) :
            $offset = 0;
        else :
            $offset = $page;
        endif;
        $limit = 3;
        $config['base_url'] = base_url() . 'pencaker/lowongandnumum/';
        $config['total_rows'] = $lokerdn->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['q'] = $this->main_model->lokerdn_perpage($offset, $limit);

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lowongandnumum', $data);
        $this->load->view('pencaker/footer');
    }
    public function lowongandndisabilitas()
    {
        $this->load->library('pagination');

        $today = date("Y-m-d");
        $lokerdndisabilitas = $this->db->query("select lowongan.*,user.nama_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas'");
        $page = $this->uri->segment(3);
        if (!$page) :
            $offset = 0;
        else :
            $offset = $page;
        endif;
        $limit = 3;
        $config['base_url'] = base_url() . 'pencaker/lowongandndisabilitas/';
        $config['total_rows'] = $lokerdndisabilitas->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['q'] = $this->main_model->lokerdndisabilitas_perpage($offset, $limit);

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lowongandndisabilitas', $data);
        $this->load->view('pencaker/footer');
    }
    public function lowonganlnumum()
    {
        $this->load->library('pagination');

        $today = date("Y-m-d");
        $lokerln = $this->db->query("select lowongan.*,user.nama_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Umum'");
        $page = $this->uri->segment(3);
        if (!$page) :
            $offset = 0;
        else :
            $offset = $page;
        endif;
        $limit = 3;
        $config['base_url'] = base_url() . 'pencaker/lowonganlnumum/';
        $config['total_rows'] = $lokerln->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['q'] = $this->main_model->lokerln_perpage($offset, $limit);

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lowonganlnumum', $data);
        $this->load->view('pencaker/footer');
    }
    public function lowonganlndisabilitas()
    {
        $this->load->library('pagination');

        $today = date("Y-m-d");
        $lokerlndisabilitas = $this->db->query("select lowongan.*,user.nama_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas'");
        $page = $this->uri->segment(3);
        if (!$page) :
            $offset = 0;
        else :
            $offset = $page;
        endif;
        $limit = 3;
        $config['base_url'] = base_url() . 'pencaker/lowonganlndisabilitas/';
        $config['total_rows'] = $lokerlndisabilitas->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['q'] = $this->main_model->lokerlndisabilitas_perpage($offset, $limit);

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lowonganlndisabilitas', $data);
        $this->load->view('pencaker/footer');
    }
    public function lihatlokerdnumum($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lihatlokerdnumum', $data);
        $this->load->view('pencaker/footer');
    }
    public function lihatlokerdndisabilitas($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lihatlokerdndisabilitas', $data);
        $this->load->view('pencaker/footer');
    }
    public function lihatlokerlnumum($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lihatlokerlnumum', $data);
        $this->load->view('pencaker/footer');
    }
    public function lihatlokerlndisabilitas($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lihatlokerlndisabilitas', $data);
        $this->load->view('pencaker/footer');
    }

    public function lamarlokerdnumum($id = NULL)
    {
        $data["id"] = $id;

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lamarlokerdnumum', $data);
        $this->load->view('pencaker/footer');
    }
    public function updatelamarlokerdnumum()
    {
        $lowongan = $_POST['id_lowongan'];
        $user = $this->session->userdata('id');
        $jumlah = $this->db->query("SELECT count(*) as jumlah FROM `lamar` WHERE id_lowongan='$lowongan' and id_user='$user';")->row();
        if ($jumlah->jumlah < 1) {
            $config['upload_path']      = './image/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '3000';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if (!$this->upload->do_upload('gambar')) {

                    $this->session->set_flashdata('msg', 'gagal');

                    redirect('pencaker/lowongandnumum', 'refresh');
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

                    $id_user    = $this->session->userdata('id');
                    $id_lowongan = $_POST['id_lowongan'];
                    $gambar     = $gbr['file_name'];
                    $id_status_lamar = $_POST['id_status_lamar'];
                    $id_pencaker = $_POST['id_pencaker'];

                    $data = array(
                        'id_lowongan' => $id_lowongan,
                        'id_user' => $id_user,
                        'berkas_tambahan' => $gambar,
                        'id_status_lamar' => $id_status_lamar,
                        'id_pencaker' => $id_pencaker,
                        'date' => date('Y-m-d H:i:s')
                    );
                    $this->Model_lamar->lamarloker($data);
                    $this->session->set_flashdata('msg', 'lamar');
                    redirect('pencaker/lowongandnumum', 'refresh');
                }
            } else {
                $id_user    = $this->session->userdata('id');
                $id_lowongan = $_POST['id_lowongan'];
                $id_status_lamar = $_POST['id_status_lamar'];
                $id_pencaker = $_POST['id_pencaker'];

                $data = array(
                    'id_lowongan' => $id_lowongan,
                    'id_user' => $id_user,
                    'id_status_lamar' => $id_status_lamar,
                    'id_pencaker' => $id_pencaker,
                    'date' => date('Y-m-d H:i:s')
                );
                $this->Model_lamar->lamarloker($data);
                $this->session->set_flashdata('msg', 'lamar');
                redirect('pencaker/lowongandnumum', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg', 'sudahlamar');
            redirect('pencaker/lowongandnumum', 'refresh');
        }
    }

    public function lamarlokerdndisabilitas($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lamarlokerdndisabilitas', $data);
        $this->load->view('pencaker/footer');
    }


    public function updatelamarlokerdndisabilitas()
    {
        $lowongan = $_POST['id_lowongan'];;
        $user = $this->session->userdata('id');
        $jumlah = $this->db->query("SELECT count(*) as jumlah FROM `lamar` WHERE id_lowongan='$lowongan' and id_user='$user';")->row();
        if ($jumlah->jumlah < 1) {
            $config['upload_path']      = './image/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '3000';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if (!$this->upload->do_upload('gambar')) {

                    $this->session->set_flashdata('msg', 'gagal');

                    redirect('pencaker/lowongandndisabilitas', 'refresh');
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

                    $id_user    = $this->session->userdata('id');
                    $id_lowongan = $_POST['id_lowongan'];
                    $gambar     = $gbr['file_name'];
                    $id_status_lamar = $_POST['id_status_lamar'];
                    $id_pencaker = $_POST['id_pencaker'];


                    $data = array(
                        'id_lowongan' => $id_lowongan,
                        'id_user' => $id_user,
                        'berkas_tambahan' => $gambar,
                        'id_status_lamar' => $id_status_lamar,
                        'id_pencaker' => $id_pencaker,
                        'date' => date('Y-m-d H:i:s')
                    );
                    $this->Model_lamar->lamarloker($data);
                    $this->session->set_flashdata('msg', 'lamar');
                    redirect('pencaker/lowongandndisabilitas', 'refresh');
                }
            } else {
                $id_user    = $this->session->userdata('id');
                $id_lowongan = $_POST['id_lowongan'];
                $id_status_lamar = $_POST['id_status_lamar'];
                $id_pencaker = $_POST['id_pencaker'];

                $data = array(
                    'id_lowongan' => $id_lowongan,
                    'id_user' => $id_user,
                    'id_status_lamar' => $id_status_lamar,
                    'id_pencaker' => $id_pencaker,
                    'date' => date('Y-m-d H:i:s')
                );
                $this->Model_lamar->lamarloker($data);
                $this->session->set_flashdata('msg', 'lamar');
                redirect('pencaker/lowongandndisabilitas', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg', 'sudahlamar');
            redirect('pencaker/lowongandnumum', 'refresh');
        }
    }

    public function lamarlokerlnumum($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lamarlokerlnumum', $data);
        $this->load->view('pencaker/footer');
    }
    public function updatelamarlokerlnumum()
    {
        $lowongan = $_POST['id_lowongan'];;
        $user = $this->session->userdata('id');
        $jumlah = $this->db->query("SELECT count(*) as jumlah FROM `lamar` WHERE id_lowongan='$lowongan' and id_user='$user';")->row();
        if ($jumlah->jumlah < 1) {
            $config['upload_path']      = './image/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '3000';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if (!$this->upload->do_upload('gambar')) {

                    $this->session->set_flashdata('msg', 'gagal');

                    redirect('pencaker/lowonganlnumum', 'refresh');
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

                    $id_user    = $this->session->userdata('id');
                    $id_lowongan = $_POST['id_lowongan'];
                    $gambar     = $gbr['file_name'];
                    $id_status_lamar = $_POST['id_status_lamar'];
                    $id_pencaker = $_POST['id_pencaker'];


                    $data = array(
                        'id_lowongan' => $id_lowongan,
                        'id_user' => $id_user,
                        'berkas_tambahan' => $gambar,
                        'id_status_lamar' => $id_status_lamar,
                        'id_pencaker' => $id_pencaker,
                        'date' => date('Y-m-d H:i:s')
                    );
                    $this->Model_lamar->lamarloker($data);
                    $this->session->set_flashdata('msg', 'lamar');
                    redirect('pencaker/lowonganlnumum', 'refresh');
                }
            } else {
                $id_user    = $this->session->userdata('id');
                $id_lowongan = $_POST['id_lowongan'];
                $id_status_lamar = $_POST['id_status_lamar'];
                $id_pencaker = $_POST['id_pencaker'];

                $data = array(
                    'id_lowongan' => $id_lowongan,
                    'id_user' => $id_user,
                    'id_status_lamar' => $id_status_lamar,
                    'id_pencaker' => $id_pencaker,
                    'date' => date('Y-m-d H:i:s')
                );
                $this->Model_lamar->lamarloker($data);
                $this->session->set_flashdata('msg', 'lamar');
                redirect('pencaker/lowonganlnumum', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg', 'sudahlamar');
            redirect('pencaker/lowonganlnumum', 'refresh');
        }
    }

    public function lamarlokerlndisabilitas($id = NULL)
    {
        $data["id"] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/lamarlokerlndisabilitas', $data);
        $this->load->view('pencaker/footer');
    }
    public function updatelamarlokerlndisabilitas()
    {
        $lowongan = $_POST['id_lowongan'];;
        $user = $this->session->userdata('id');
        $jumlah = $this->db->query("SELECT count(*) as jumlah FROM `lamar` WHERE id_lowongan='$lowongan' and id_user='$user';")->row();
        if ($jumlah->jumlah < 1) {
            $config['upload_path']      = './image/';
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '3000';
            $config['encrypt_name']     = TRUE;
            $this->load->library('upload', $config);
            if (!empty($_FILES['gambar']['name'])) {
                if (!$this->upload->do_upload('gambar')) {

                    $this->session->set_flashdata('msg', 'gagal');

                    redirect('pencaker/lowonganlndisabilitas', 'refresh');
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

                    $id_user    = $this->session->userdata('id');
                    $id_lowongan = $_POST['id_lowongan'];
                    $gambar     = $gbr['file_name'];
                    $id_status_lamar = $_POST['id_status_lamar'];
                    $id_pencaker = $_POST['id_pencaker'];


                    $data = array(
                        'id_lowongan' => $id_lowongan,
                        'id_user' => $id_user,
                        'berkas_tambahan' => $gambar,
                        'id_status_lamar' => $id_status_lamar,
                        'id_pencaker' => $id_pencaker,
                        'date' => date('Y-m-d H:i:s')
                    );
                    $this->Model_lamar->lamarloker($data);
                    $this->session->set_flashdata('msg', 'lamar');
                    redirect('pencaker/lowonganlndisabilitas', 'refresh');
                }
            } else {
                $id_user    = $this->session->userdata('id');
                $id_lowongan = $_POST['id_lowongan'];
                $id_status_lamar = $_POST['id_status_lamar'];
                $id_pencaker = $_POST['id_pencaker'];

                $data = array(
                    'id_lowongan' => $id_lowongan,
                    'id_user' => $id_user,
                    'id_status_lamar' => $id_status_lamar,
                    'id_pencaker' => $id_pencaker,
                    'date' => date('Y-m-d H:i:s')
                );
                $this->Model_lamar->lamarloker($data);
                $this->session->set_flashdata('msg', 'lamar');
                redirect('pencaker/lowonganlndisabilitas', 'refresh');
            }
        } else {
            $this->session->set_flashdata('msg', 'sudahlamar');
            redirect('pencaker/lowonganlndisabilitas', 'refresh');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('home');
    }
    public function pelatihanumum()
    {
        $this->load->library('pagination');

        $today = date("Y-m-d");
        $pelatihanumum = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
                        user.foto_user,pencari_kerja.id_pencaker from pelatihan
                        left join user on user.id_user=pelatihan.id_user
                        left join pencari_kerja on pencari_kerja.id_user = user.id_user
                        left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
                        where pelatihan.tanggal_selesai>='$today' and pelatihan.kategori='Umum'
                        order by pelatihan.id_pelatihan desc");
        $page = $this->uri->segment(3);
        if (!$page) :
            $offset = 0;
        else :
            $offset = $page;
        endif;
        $limit = 4;
        $config['base_url'] = base_url() . 'pencaker/pelatihanumum/';
        $config['total_rows'] = $pelatihanumum->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['q'] = $this->main_model->pelatihanumum_perpage($offset, $limit);

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/pelatihanumum', $data);
        $this->load->view('pencaker/footer');
    }

    public function daftarpelatihan()
    {

        if (!$this->session->userdata('id')) {

            redirect('home/login', 'refresh');
        } else {

            $id_pelatihan = $_POST['id_pelatihan'];
            $id_user = $this->session->userdata('id');
            $jumlah = $this->db->query("SELECT count(*) as jumlah FROM daftar_pelatihan WHERE id_pelatihan='$id_pelatihan' and id_user='$id_user'")->row();
            $q = $this->db->query("select * from pelatihan where id_pelatihan='$id_pelatihan'");
            $row = $q->row();
            $kategori = $row->kategori;

            if ($jumlah->jumlah < 1) {

                $id_pelatihan = $_POST['id_pelatihan'];
                $id_user = $this->session->userdata('id');
                $data = array(
                    'id_pelatihan' => $id_pelatihan,
                    'id_user' => $id_user,
                    'date' => date('Y:m:d H:i:s')
                );
                $this->Model_lamar->lamarpelatihan($data);
                $this->session->set_flashdata('msg', 'simpan');
                if ($kategori == "umum") {
                    redirect('pencaker/pelatihanumum', 'refresh');
                } else {
                    redirect('pencaker/pelatihandisabilitas', 'refresh');
                }
            } else {
                $this->session->set_flashdata('msg', 'sudahlamarpelatihan');
                if ($kategori == "umum") {
                    redirect('pencaker/pelatihanumum', 'refresh');
                } else {
                    redirect('pencaker/pelatihandisabilitas', 'refresh');
                }
            }
        }
    }

    public function pelatihandisabilitas()
    {
        $this->load->library('pagination');

        $today = date("Y-m-d");
        $pelatihandisabilitas = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
                        user.foto_user,pencari_kerja.id_pencaker from pelatihan
                        left join user on user.id_user=pelatihan.id_user
                        left join pencari_kerja on pencari_kerja.id_user = user.id_user
                        left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
                        where pelatihan.tanggal_selesai>='$today' and pelatihan.kategori='Disabilitas'
                        order by pelatihan.id_pelatihan desc");
        $page = $this->uri->segment(3);
        if (!$page) :
            $offset = 0;
        else :
            $offset = $page;
        endif;
        $limit = 4;
        $config['base_url'] = base_url() . 'pencaker/pelatihandisabilitas/';
        $config['total_rows'] = $pelatihandisabilitas->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);

        $data['page'] = $this->pagination->create_links();
        $data['q'] = $this->main_model->pelatihandisabilitas_perpage($offset, $limit);

        $this->load->view('pencaker/header');
        $this->load->view('pencaker/pelatihandisabilitas', $data);
        $this->load->view('pencaker/footer');
    }

    public function editprofilpencaker($id = null)
    {
        $data['id'] = $id;
        $this->load->view('pencaker/header');
        $this->load->view('pencaker/editprofilpencaker', $data, FALSE);
        $this->load->view('pencaker/footer');
    }
    public function updateprofilpencaker()
    {
        $id = $this->session->userdata('id');
        $config['upload_path'] = './image/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['max_size']  = '2000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!empty($_FILES['gambar1']['name'])) {
            if (!$this->upload->do_upload('gambar1')) {
                echo false;
            } else {
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr['file_name'];
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '80%';
                $config['width']            = 1024;
                $config['height']           = 768;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $nmuser     =   $_POST['nmuser'];
                $alamatuser =   $_POST['alamatuser'];
                $nohpuser   =   $_POST['nohpuser'];
                $emailuser  =   $_POST['emailuser'];
                $username   =   $_POST['username'];
                $password   =   $_POST['password'];
                $nik_pencaker = $_POST['nik_pencaker'];
                $tempat_lahir = $_POST['tempat_lahir'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $id_agama = $_POST['agama'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $tinggi_badan = $_POST['tinggi_badan'];
                $berat_badan = $_POST['berat_badan'];
                $status_perkawinan = $_POST['status_perkawinan'];
                $id_provinsi  = $_POST['provinsi'];
                $id_kabupaten = $_POST['kabupaten'];
                $id_kecamatan = $_POST['kecamatan'];
                $kodepos = $_POST['kodepos'];
                $id_pendidikan = $_POST['pendidikan'];
                $jurusan = $_POST['jurusan'];
                $tahun_lulus = $_POST['tahun_lulus'];
                $jabatan = $_POST['jabatan'];

                $id         = $this->session->userdata('id');
                $gambar     = $gbr['file_name'];
                $q          = $this->db->query("select * from user where id_user='$id'");
                $row        = $q->row();

                unlink('image/' . $row->foto_user);
                $data1 = array(
                    'nama_user' => $nmuser,
                    'alamat_user' => $alamatuser,
                    'nohp_user' => $nohpuser,
                    'email_user' => $emailuser,
                    'foto_user' => $gambar,
                    'username'   =>   $username,
                    'password'   =>   $password
                );
                $where = array(
                    'id_user' => $id
                );
                $data2 = array(
                    'nik_pencaker' => $nik_pencaker,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'id_agama' => $id_agama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tinggi_badan' => $tinggi_badan,
                    'berat_badan' => $berat_badan,
                    'id_status_perkawinan' => $status_perkawinan,
                    'id_provinsi'  => $id_provinsi,
                    'id_kabupaten' => $id_kabupaten,
                    'id_kecamatan' => $id_kecamatan,
                    'kodepos' => $kodepos,
                    'id_pendidikan' => $id_pendidikan,
                    'jurusan' => $jurusan,
                    'tahun_lulus' => $tahun_lulus,
                    'jabatan' => $jabatan
                );
                $where2 = array(
                    'id_user' => $id
                );

                if ($password == null) {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                } else {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                }
            }
        } elseif (!empty($_FILES['gambar2']['name'])) {
            if (!$this->upload->do_upload('gambar2')) {
                echo false;
            } else {
                $gbr2 = $this->upload->data();
                //Compress Image
                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr2['file_name'];
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '80%';
                $config['width']            = 1024;
                $config['height']           = 768;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $nmuser     =   $_POST['nmuser'];
                $alamatuser =   $_POST['alamatuser'];
                $nohpuser   =   $_POST['nohpuser'];
                $emailuser  =   $_POST['emailuser'];
                $username   =   $_POST['username'];
                $password   =   $_POST['password'];
                $nik_pencaker = $_POST['nik_pencaker'];
                $tempat_lahir = $_POST['tempat_lahir'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $id_agama = $_POST['agama'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $tinggi_badan = $_POST['tinggi_badan'];
                $berat_badan = $_POST['berat_badan'];
                $status_perkawinan = $_POST['status_perkawinan'];
                $id_provinsi  = $_POST['provinsi'];
                $id_kabupaten = $_POST['kabupaten'];
                $id_kecamatan = $_POST['kecamatan'];
                $kodepos = $_POST['kodepos'];
                $id_pendidikan = $_POST['pendidikan'];
                $jurusan = $_POST['jurusan'];
                $tahun_lulus = $_POST['tahun_lulus'];
                $jabatan = $_POST['jabatan'];

                $id         = $this->session->userdata('id');
                $gambar2     = $gbr2['file_name'];
                $q          = $this->db->query("select * from pencari_kerja where id_user='$id'");
                $row        = $q->row();

                unlink('image/' . $row->upload_cv);
                $data1 = array(
                    'nama_user' => $nmuser,
                    'alamat_user' => $alamatuser,
                    'nohp_user' => $nohpuser,
                    'email_user' => $emailuser,
                    'username'   =>   $username,
                    'password'   =>   $password
                );
                $where = array(
                    'id_user' => $id
                );
                $data2 = array(
                    'nik_pencaker' => $nik_pencaker,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'id_agama' => $id_agama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tinggi_badan' => $tinggi_badan,
                    'berat_badan' => $berat_badan,
                    'id_status_perkawinan' => $status_perkawinan,
                    'id_provinsi'  => $id_provinsi,
                    'id_kabupaten' => $id_kabupaten,
                    'id_kecamatan' => $id_kecamatan,
                    'kodepos' => $kodepos,
                    'id_pendidikan' => $id_pendidikan,
                    'jurusan' => $jurusan,
                    'tahun_lulus' => $tahun_lulus,
                    'jabatan' => $jabatan,
                    'upload_cv' => $gambar2
                );
                $where2 = array(
                    'id_user' => $id
                );
                if ($password == null) {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                } else {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                }
            }
        } elseif (!empty($_FILES['gambar3']['name'])) {
            if (!$this->upload->do_upload('gambar3')) {
                echo false;
            } else {
                $gbr3 = $this->upload->data();
                //Compress Image
                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr3['file_name'];
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '80%';
                $config['width']            = 1024;
                $config['height']           = 768;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $nmuser     =   $_POST['nmuser'];
                $alamatuser =   $_POST['alamatuser'];
                $nohpuser   =   $_POST['nohpuser'];
                $emailuser  =   $_POST['emailuser'];
                $username   =   $_POST['username'];
                $password   =   $_POST['password'];
                $nik_pencaker = $_POST['nik_pencaker'];
                $tempat_lahir = $_POST['tempat_lahir'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $id_agama = $_POST['agama'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $tinggi_badan = $_POST['tinggi_badan'];
                $berat_badan = $_POST['berat_badan'];
                $status_perkawinan = $_POST['status_perkawinan'];
                $id_provinsi  = $_POST['provinsi'];
                $id_kabupaten = $_POST['kabupaten'];
                $id_kecamatan = $_POST['kecamatan'];
                $kodepos = $_POST['kodepos'];
                $id_pendidikan = $_POST['pendidikan'];
                $jurusan = $_POST['jurusan'];
                $tahun_lulus = $_POST['tahun_lulus'];
                $jabatan = $_POST['jabatan'];

                $id         = $this->session->userdata('id');
                $gambar3     = $gbr3['file_name'];
                $q          = $this->db->query("select * from pencari_kerja where id_user='$id'");
                $row        = $q->row();

                unlink('image/' . $row->upload_sertifikat);
                $data1 = array(
                    'nama_user' => $nmuser,
                    'alamat_user' => $alamatuser,
                    'nohp_user' => $nohpuser,
                    'email_user' => $emailuser,
                    'username'   =>   $username,
                    'password'   =>   $password
                );
                $where = array(
                    'id_user' => $id
                );
                $data2 = array(
                    'nik_pencaker' => $nik_pencaker,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'id_agama' => $id_agama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tinggi_badan' => $tinggi_badan,
                    'berat_badan' => $berat_badan,
                    'id_status_perkawinan' => $status_perkawinan,
                    'id_provinsi'  => $id_provinsi,
                    'id_kabupaten' => $id_kabupaten,
                    'id_kecamatan' => $id_kecamatan,
                    'kodepos' => $kodepos,
                    'id_pendidikan' => $id_pendidikan,
                    'jurusan' => $jurusan,
                    'tahun_lulus' => $tahun_lulus,
                    'jabatan' => $jabatan,
                    'upload_sertifikat' => $gambar3
                );
                $where2 = array(
                    'id_user' => $id
                );
                if ($password == null) {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                } else {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                }
            }
        } elseif (!empty($_FILES['gambar4']['name'])) {
            if (!$this->upload->do_upload('gambar4')) {
                echo false;
            } else {
                $gbr4 = $this->upload->data();
                //Compress Image
                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr4['file_name'];
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '80%';
                $config['width']            = 1024;
                $config['height']           = 768;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gbr4 = $this->upload->data();
                //Compress Image
                $config['image_library']    = 'gd2';
                $config['source_image']     = './image/' . $gbr4['file_name'];
                $config['create_thumb']     = false;
                $config['maintain_ratio']   = TRUE;
                $config['quality']          = '80%';
                $config['width']            = 1024;
                $config['height']           = 768;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $nmuser     =   $_POST['nmuser'];
                $alamatuser =   $_POST['alamatuser'];
                $nohpuser   =   $_POST['nohpuser'];
                $emailuser  =   $_POST['emailuser'];
                $username   =   $_POST['username'];
                $password   =   $_POST['password'];
                $nik_pencaker = $_POST['nik_pencaker'];
                $tempat_lahir = $_POST['tempat_lahir'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $id_agama = $_POST['agama'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $tinggi_badan = $_POST['tinggi_badan'];
                $berat_badan = $_POST['berat_badan'];
                $status_perkawinan = $_POST['status_perkawinan'];
                $id_provinsi  = $_POST['provinsi'];
                $id_kabupaten = $_POST['kabupaten'];
                $id_kecamatan = $_POST['kecamatan'];
                $kodepos = $_POST['kodepos'];
                $id_pendidikan = $_POST['pendidikan'];
                $jurusan = $_POST['jurusan'];
                $tahun_lulus = $_POST['tahun_lulus'];
                $jabatan = $_POST['jabatan'];

                $id         = $this->session->userdata('id');
                $gambar4     = $gbr4['file_name'];
                $q          = $this->db->query("select * from pencari_kerja where id_user='$id'");
                $row        = $q->row();

                unlink('image/' . $row->berkas_domisili);
                $data1 = array(
                    'nama_user' => $nmuser,
                    'alamat_user' => $alamatuser,
                    'nohp_user' => $nohpuser,
                    'email_user' => $emailuser,
                    'username'   =>   $username,
                    'password'   =>   $password
                );
                $where = array(
                    'id_user' => $id
                );
                $data2 = array(
                    'nik_pencaker' => $nik_pencaker,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'id_agama' => $id_agama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'tinggi_badan' => $tinggi_badan,
                    'berat_badan' => $berat_badan,
                    'id_status_perkawinan' => $status_perkawinan,
                    'id_provinsi'  => $id_provinsi,
                    'id_kabupaten' => $id_kabupaten,
                    'id_kecamatan' => $id_kecamatan,
                    'kodepos' => $kodepos,
                    'id_pendidikan' => $id_pendidikan,
                    'jurusan' => $jurusan,
                    'tahun_lulus' => $tahun_lulus,
                    'jabatan' => $jabatan,
                    'berkas_domisili' => $gambar4
                );
                $where2 = array(
                    'id_user' => $id
                );
                if ($password == null) {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                } else {
                    $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                    $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                    $this->session->set_flashdata('msg', 'edit');

                    redirect('pencaker/profil_pencaker', 'refresh');
                }
            }
        } else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];
            $nik_pencaker = $_POST['nik_pencaker'];
            $tempat_lahir = $_POST['tempat_lahir'];
            $tanggal_lahir = $_POST['tanggal_lahir'];
            $id_agama = $_POST['agama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $tinggi_badan = $_POST['tinggi_badan'];
            $berat_badan = $_POST['berat_badan'];
            $status_perkawinan = $_POST['status_perkawinan'];
            $id_provinsi  = $_POST['provinsi'];
            $id_kabupaten = $_POST['kabupaten'];
            $id_kecamatan = $_POST['kecamatan'];
            $kodepos = $_POST['kodepos'];
            $id_pendidikan = $_POST['pendidikan'];
            $jurusan = $_POST['jurusan'];
            $tahun_lulus = $_POST['tahun_lulus'];
            $jabatan = $_POST['jabatan'];

            $data1 = array(
                'nama_user' => $nmuser,
                'alamat_user' => $alamatuser,
                'nohp_user' => $nohpuser,
                'email_user' => $emailuser,
                'username'   =>   $username,
                'password'   =>   $password
            );
            $where = array(
                'id_user' => $id
            );
            $data2 = array(
                'nik_pencaker' => $nik_pencaker,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'id_agama' => $id_agama,
                'jenis_kelamin' => $jenis_kelamin,
                'tinggi_badan' => $tinggi_badan,
                'berat_badan' => $berat_badan,
                'id_status_perkawinan' => $status_perkawinan,
                'id_provinsi'  => $id_provinsi,
                'id_kabupaten' => $id_kabupaten,
                'id_kecamatan' => $id_kecamatan,
                'kodepos' => $kodepos,
                'id_pendidikan' => $id_pendidikan,
                'jurusan' => $jurusan,
                'tahun_lulus' => $tahun_lulus,
                'jabatan' => $jabatan
            );
            $where2 = array(
                'id_user' => $id
            );

            if ($password == null) {
                $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                $this->session->set_flashdata('msg', 'edit');

                redirect('pencaker/profil_pencaker', 'refresh');
            } else {
                $this->Model_pencarikerja->update_profil($where, 'user', $data1);
                $this->Model_pencarikerja->update_profil($where2, 'pencari_kerja', $data2);
                $this->session->set_flashdata('msg', 'edit');

                redirect('pencaker/profil_pencaker', 'refresh');
            }
        }
    }
}
