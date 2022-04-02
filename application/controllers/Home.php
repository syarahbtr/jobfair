<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('model_register');
        $this->load->model('model_artikel');
        $this->load->model('model_footer');
        $this->load->model('model_lupapassword');
    } 

    public function index()
    {
        $this->load->view('frontend/header');
        $this->load->view('frontend/index');
        $this->load->view('frontend/footer');
    }

    //  public function daftar()
    // {
    //     $data['ngapp']      =   'ng-app="studentApp"';
    //     $data['provinsi']   =   $this->model_register->get_provinsi(); 
    //     $data['kabupaten']  =   $this->model_register->get_kabupaten();
    //     $data['kecamatan']  =   $this->model_register->get_kecamatan();
    //     $this->load->view('frontend/header',$data);
    //     $this->load->view('frontend/daftar',$data);
    //     $this->load->view('frontend/footer',$data);
    // }

     public function login()
    {
        $vals = [
    	// 'word' -> nantinya akan digunakan sebagai random teks yang akan keluar di captchanya
        'word'          => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5),
        'img_path'      => './captcha/',
        'img_url'       => base_url('captcha/'),
        'img_width'     => 210,
        'img_height'    => 90,
        'expiration'    => 7200,
        'font_path'     => FCPATH. 'captcha/font/verdana.ttf', #load font jika mau ganti fontnya
        'font_size'     => 40,
        'word_length'   => 200,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', #tipe captcha (angka/huruf, atau kombinasi dari keduanya)
        'colors'        => [
                'background'=> [255, 255, 255],
                'border'    => [255, 255, 255],
                'text'      => [0, 0, 0],
                'grid'      => [255, 40, 40]
        ]
    ];
    
    $captcha = create_captcha($vals);
   
        $this->session->set_userdata('captcha', $captcha['word']);
        $this->load->view('frontend/header');
        $this->load->view('frontend/login', ['captcha' => $captcha['image']]);
        $this->load->view('frontend/footer');
    }


    public function cekuser()
    {
        $post_code  = $this->input->post('captcha');
        $captcha    = $this->session->userdata('captcha');
        
        if ($post_code && ($post_code == $captcha)) 
            {
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        $query      = $this->model_register->login($username,$password);

        if($query->num_rows() > 0){
            $row    = $query->row();
            $data   = array(
                'id'        =>  $row->id_user,
                'nama'      =>  $row->nama_user,
                'level'     =>  $row->level,
                'gambar'    =>  $row->foto_user,
                'status'    =>  $row->status
            );
            $this->session->set_userdata($data);
            
            if($this->session->userdata('level')=='1'){
               redirect('admin/index','refresh');
            }
            elseif($this->session->userdata('level')=='2'){
                redirect('perusahaan/chart','refresh');
            }
            elseif($this->session->userdata('level')=='3'){
                redirect('pelatihan/dashboard','refresh');
            }
            else{
                redirect('pencaker/index','refresh');
            }
            
            
        }else{
           $this->session->set_flashdata('msg', 'gagalpassword');
           redirect('home/login','refresh');
           
        }
            }
        else
          $this->session->set_flashdata('msg', 'wrongcaptcha');
          redirect('home/login','refresh');
    }
     
public function lowongandnumum(){
     $this->load->library('pagination');
     
        $today= date("Y-m-d"); 
        $lokerdn = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,
                        pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Umum'");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=3;
        $config['base_url'] = base_url() . 'home/lowongandnumum/';
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

        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->main_model->lokerdn_perpage($offset,$limit);

        $this->load->view('frontend/header');
        $this->load->view('frontend/lowongandnumum',$data);
        $this->load->view('frontend/footer');
}

public function lowongandndisabilitas(){
        $this->load->library('pagination');

        $today= date("Y-m-d"); 
        $lokerdndisabilitas = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,
                        pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas'");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=3;
        $config['base_url'] = base_url() . 'home/lowongandndisabilitas/';
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
        
        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->main_model->lokerdndisabilitas_perpage($offset,$limit);

        $this->load->view('frontend/header');
        $this->load->view('frontend/lowongandndisabilitas',$data);
        $this->load->view('frontend/footer');
}

public function lowonganlnumum(){
        $this->load->library('pagination');

        $today= date("Y-m-d"); 
        $lokerln = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Umum'");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=3;
        $config['base_url'] = base_url() . 'home/lowonganlnumum/';
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
        
        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->main_model->lokerln_perpage($offset,$limit);

        $this->load->view('frontend/header');
        $this->load->view('frontend/lowonganlnumum',$data);
        $this->load->view('frontend/footer');
}

public function lowonganlndisabilitas(){
        $this->load->library('pagination');

        $today= date("Y-m-d"); 
        $lokerlndisabilitas = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas'");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=3;
        $config['base_url'] = base_url() . 'home/lowonganlndisabilitas/';
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
        
        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->main_model->lokerlndisabilitas_perpage($offset,$limit);

        $this->load->view('frontend/header');
        $this->load->view('frontend/lowonganlndisabilitas',$data);
        $this->load->view('frontend/footer');
}


public function lamarlokerdnumum(){
    if (!$this->session->userdata('id')){
        
        redirect('home/login','refresh');
        
    }else{
       $config['upload_path']      = './image/';
        $config['allowed_types']    = 'pdf';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {

                $this->session->set_flashdata('msg', 'gagal');

                redirect('home/lowongandnumum', 'refresh');
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


                $this->db->query("insert into lamar values('','$id_lowongan','$id_user','$gambar','$id_status_lamar','$id_pencaker',now())");
                $this->session->set_flashdata('msg', 'lamar');
                redirect('home/lowongandnumum', 'refresh');
            }
        } else {
            $id_user    = $this->session->userdata('id');
            $id_lowongan = $_POST['id_lowongan'];
            $id_status_lamar = $_POST['id_status_lamar'];
            $id_pencaker = $_POST['id_pencaker'];

            $this->db->query("insert into lamar values('','$id_lowongan','$id_user','','2','$id_pencaker',now())");
            $this->session->set_flashdata('msg', 'lamar');
            redirect('home/lowongandnumum', 'refresh');
        }
    }
}

public function lihatlokerdnumum($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('frontend/header');
        $this->load->view('frontend/lihatlokerdnumum',$data);
        $this->load->view('frontend/footer');
}

public function lamarlokerdndisabilitas(){
    if (!$this->session->userdata('id')){
        
        redirect('home/login','refresh');
        
    }else{
       $config['upload_path']      = './image/';
        $config['allowed_types']    = 'pdf';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {

                $this->session->set_flashdata('msg', 'gagal');

                redirect('home/lowongandndisabilitas', 'refresh');
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


                $this->db->query("insert into lamar values('','$id_lowongan','$id_user','$gambar','$id_status_lamar','$id_pencaker',now())");
                $this->session->set_flashdata('msg', 'lamar');
                redirect('home/lowongandndisabilitas', 'refresh');
            }
        } else {
            $id_user    = $this->session->userdata('id');
            $id_lowongan = $_POST['id_lowongan'];
            $id_status_lamar = $_POST['id_status_lamar'];
            $id_pencaker = $_POST['id_pencaker'];

            $this->db->query("insert into lamar values('','$id_lowongan','$id_user','','2','$id_pencaker',now())");
            $this->session->set_flashdata('msg', 'lamar');
            redirect('home/lowongandndisabilitas', 'refresh');
        }
    }
}

public function lihatlokerdndisabilitas($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('frontend/header');
        $this->load->view('frontend/lihatlokerdndisabilitas',$data);
        $this->load->view('frontend/footer');
}

public function lihatlokerlnumum($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('frontend/header');
        $this->load->view('frontend/lihatlokerlnumum',$data);
        $this->load->view('frontend/footer');
}

public function lamarlokerlnumum(){
    if (!$this->session->userdata('id')){
        
        redirect('home/login','refresh');
        
    }else{
       $config['upload_path']      = './image/';
        $config['allowed_types']    = 'pdf';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {

                $this->session->set_flashdata('msg', 'gagal');

                redirect('home/lowonganlnumum', 'refresh');
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


                $this->db->query("insert into lamar values('','$id_lowongan','$id_user','$gambar','$id_status_lamar','$id_pencaker',now())");
                $this->session->set_flashdata('msg', 'lamar');
                redirect('home/lowonganlnumum', 'refresh');
            }
        } else {
            $id_user    = $this->session->userdata('id');
            $id_lowongan = $_POST['id_lowongan'];
            $id_status_lamar = $_POST['id_status_lamar'];
            $id_pencaker = $_POST['id_pencaker'];

            $this->db->query("insert into lamar values('','$id_lowongan','$id_user','','2','$id_pencaker',now())");
            $this->session->set_flashdata('msg', 'lamar');
            redirect('home/lowonganlnumum', 'refresh');
        }
    }
}

public function lihatlokerlndisabilitas($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('frontend/header');
        $this->load->view('frontend/lihatlokerlndisabilitas',$data);
        $this->load->view('frontend/footer');
}

public function lamarlokerlndisabilitas(){
    if (!$this->session->userdata('id')){
        
        redirect('home/login','refresh');
        
    }else{
       $config['upload_path']      = './image/';
        $config['allowed_types']    = 'pdf';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if (!empty($_FILES['gambar']['name'])) {
            if (!$this->upload->do_upload('gambar')) {

                $this->session->set_flashdata('msg', 'gagal');

                redirect('home/lowonganlndisabilitas', 'refresh');
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


                $this->db->query("insert into lamar values('','$id_lowongan','$id_user','$gambar','$id_status_lamar','$id_pencaker',now())");
                $this->session->set_flashdata('msg', 'lamar');
                redirect('home/lowonganlndisabilitas', 'refresh');
            }
        } else {
            $id_user    = $this->session->userdata('id');
            $id_lowongan = $_POST['id_lowongan'];
            $id_status_lamar = $_POST['id_status_lamar'];
            $id_pencaker = $_POST['id_pencaker'];

            $this->db->query("insert into lamar values('','$id_lowongan','$id_user','','2','$id_pencaker',now())");
            $this->session->set_flashdata('msg', 'lamar');
            redirect('home/lowonganlndisabilitas', 'refresh');
        }
    }
}

public function pelatihanumum(){ 
        $this->load->library('pagination');

        $today= date("Y-m-d"); 
        $pelatihanumum = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
                        user.foto_user,pencari_kerja.id_pencaker from pelatihan
                        left join user on user.id_user=pelatihan.id_user
                        left join pencari_kerja on pencari_kerja.id_user = user.id_user
                        left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
                        where pelatihan.tanggal_selesai>='$today' and pelatihan.kategori='Umum'
                        order by pelatihan.id_pelatihan desc");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=4;
        $config['base_url'] = base_url() . 'home/pelatihanumum/';
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
        
        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->main_model->pelatihanumum_perpage($offset,$limit);

        $this->load->view('frontend/header');
        $this->load->view('frontend/pelatihanumum',$data);
        $this->load->view('frontend/footer'); 
}

public function daftarpelatihan(){
    if (!$this->session->userdata('id')){
        
        redirect('home/login','refresh');
        
    }else{
        $id_pelatihan=$_POST['id_pelatihan'];
        $id_user=$_POST['id_user'];

        $this->db->query("insert into daftar_pelatihan values('','$id_pelatihan','$id_user',now())");
        $this->session->set_flashdata('msg', 'simpan');
        
        redirect('pencaker/pelatihanumum','refresh');
        
    }
}

public function pelatihandisabilitas(){
        $this->load->library('pagination');

        $today= date("Y-m-d"); 
        $pelatihandisabilitas = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
                        user.foto_user,pencari_kerja.id_pencaker from pelatihan
                        left join user on user.id_user=pelatihan.id_user
                        left join pencari_kerja on pencari_kerja.id_user = user.id_user
                        left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
                        where pelatihan.tanggal_selesai>='$today' and pelatihan.kategori='Disabilitas'
                        order by pelatihan.id_pelatihan desc");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=4;
        $config['base_url'] = base_url() . 'home/pelatihandisabilitas/';
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
        
        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->main_model->pelatihandisabilitas_perpage($offset,$limit);

        $this->load->view('frontend/header');
        $this->load->view('frontend/pelatihandisabilitas',$data);
        $this->load->view('frontend/footer');
}


}