<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    
  public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id')){
            $this->session->set_flashdata('msg', 'logindulu');
            
            redirect('login/index','refresh');
        }

        $this->load->model('main_model');
        $this->load->model('model_web_profil');
        $this->load->model('model_artikel');
        $this->load->library('fpdf');
    } 
    
    public function index()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/index');
        $this->load->view('assets/footer');
    }

    public function mofficer(){
        $this->load->view('assets/header');
        $this->load->view('assets/mofficer/mofficer');
        $this->load->view('assets/footer');
    }

    public function tambahmofficer(){
        $this->load->view('assets/header');
        $this->load->view('assets/mofficer/tambahmofficer');
        $this->load->view('assets/footer');
    }

    public function savemofficer(){
        $config['upload_path']      = './image/'; #lokasi folder untuk menyimpan file
        $config['allowed_types']    = 'jpg|png|jpeg'; #tipe files
        $config['max_size']         = '2000'; #maksimal size dalam kb 
        $config['encrypt_name']     = TRUE; #nama enkripsi 
        $this->load->library('upload', $config); #panggil library upload 
        if($this->upload->do_upload("fotouser")){ //upload file
            $gbr = $this->upload->data();

            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
            $config['create_thumb']     = FALSE; #Watermark
            $config['maintain_ratio']   = TRUE;
            $config['quality']          = '60%'; 
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

            $gambar = $gbr['file_name'];

            $this->db->query("insert into user values(null,'$nmuser','$username',md5('$password'),'1','$gambar','$emailuser','$nohpuser','$alamatuser','',now())");
            $this->session->set_flashdata('msg', 'simpan');
            
            
            redirect('admin/mofficer/mofficer','refresh');
            
            
            
        }else{
           $this->session->set_flashdata('msg', 'gagal');
            
            redirect('admin/mofficer/mofficer','refresh'); 
        }
    }

    public function hapusmofficer($id=null){
        $q      = $this->db->query("select * from user where id_user='$id'");
        $row    =$q->row();
        unlink('./image/'.$row->foto_user);
        $this->db->query("delete from user where id_user='$id'");
      
        
        redirect('admin/mofficer/mofficer','refresh');
    }

    public function editmofficer($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/mofficer/editmofficer', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatemofficer($id=null){
        $config['upload_path']      = './image/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['fotouser']['name'])){
        if ( ! $this->upload->do_upload('fotouser')){

             $this->session->set_flashdata('msg', 'gagal');
             
             redirect('admin/mofficer/mofficer','refresh');
             
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
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

            $gambar     = $gbr['file_name'];
            $q          = $this->db->query("select * from user where id_user='$id'");
            $row        = $q->row();
            
            unlink('./image/'.$row->foto_user);
            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/mofficer/mofficer','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/mofficer/mofficer','refresh');
            }
            
            
            
        }} else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];


            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/mofficer/mofficer','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/mofficer/mofficer','refresh');
            }
        }
    }

    public function lihatmofficer($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/mofficer/lihatmofficer', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function pencarikerja(){
        $this->load->view('assets/header');
        $this->load->view('assets/pencarikerja/pencarikerja');
        $this->load->view('assets/footer');
    }

    public function hapuspencarikerja($id=null){
        $q      = $this->db->query("select * from user where id_user='$id'");
        $row    =$q->row();
        unlink('./image/'.$row->foto_user);
        $this->db->query("delete from user where id_user='$id'");
        
        redirect('admin/pencarikerja','refresh');
    }

    public function detailpenempatanpencarikerja($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/detailpenempatanpencarikerja', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function lihatpencarikerja($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/pencarikerja/lihatpencarikerja', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function editpencarikerja($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/pencarikerja/editpencarikerja', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatepencarikerja($id=null){
        $config['upload_path']      = './image/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['fotouser']['name'])){
        if ( ! $this->upload->do_upload('fotouser')){

             $this->session->set_flashdata('msg', 'gagal');
             
             redirect('admin/pencarikerja','refresh');
             
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
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

            $gambar     = $gbr['file_name'];
            $q          = $this->db->query("select * from user where id_user='$id'");
            $row        = $q->row();
            
            unlink('./image/'.$row->foto_user);
            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/pencarikerja','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/pencarikerja','refresh');
            }
            
            
            
        }} else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];


            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/pencarikerja','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/pencarikerja','refresh');
            }
        }
    }

    public function editpenyediakerja($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/perusahaan/editpenyediakerja', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatepenyediakerja($id=null){
        $config['upload_path']      = './image/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['fotouser']['name'])){
        if ( ! $this->upload->do_upload('fotouser')){

             $this->session->set_flashdata('msg', 'gagal');
             
             redirect('admin/perusahaan','refresh');
             
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
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

            $gambar     = $gbr['file_name'];
            $q          = $this->db->query("select * from user where id_user='$id'");
            $row        = $q->row();
            
            unlink('./image/'.$row->foto_user);
            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/perusahaan','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/perusahaan','refresh');
            }
            
            
            
        }} else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];


            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/perusahaan','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/perusahaan','refresh');
            }
        }
    }

    public function editpenyediapelatihan($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/penyediapelatihan/editpenyediapelatihan', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatepenyediapelatihan($id=null){
        $config['upload_path']      = './image/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['fotouser']['name'])){
        if ( ! $this->upload->do_upload('fotouser')){

             $this->session->set_flashdata('msg', 'gagal');
             
             redirect('admin/penyediapelatihan','refresh');
             
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
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

            $gambar     = $gbr['file_name'];
            $q          = $this->db->query("select * from user where id_user='$id'");
            $row        = $q->row();
            
            unlink('./image/'.$row->foto_user);
            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/penyediapelatihan','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),foto_user='$gambar',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/penyediapelatihan','refresh');
            }
            
            
            
        }} else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];


            if ($password==null){
                $this->db->query("update user set nama_user='$nmuser',username='$username',email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/penyediapelatihan','refresh');
                
            }
            else {
                $this->db->query("update user set nama_user='$nmuser',username='$username',password=md5('$password'),email_user='$emailuser',nohp_user='$nohpuser',alamat_user='$alamatuser' WHERE id_user='$id' ");
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/penyediapelatihan','refresh');
            }
        }
    }

    public function jumlahlokerpencaker($id_lamar){
        $n=str_replace('%20','',$id_lamar);
        $data['id_lamar']=$n;
        $this->load->view('assets/header');
        $this->load->view('assets/pencarikerja/jumlahlokerpencaker', $data);
        $this->load->view('assets/footer');
    }

    public function jumlahpelatihanpencaker($id_daftarpelatihan){
        
        $data['id_daftarpelatihan']=$id_daftarpelatihan;
        $this->load->view('assets/header');
        $this->load->view('assets/pencarikerja/jumlahpelatihanpencaker', $data);
        $this->load->view('assets/footer');
    }

    public function perusahaan(){
        $this->load->view('assets/header');
        $this->load->view('assets/perusahaan/perusahaan');
        $this->load->view('assets/footer');
    }

    public function jumlahloker($id_lowongan){
        $n=str_replace('%20','',$id_lowongan);
        $data['id_lowongan']=$n;
        $this->load->view('assets/header');
        $this->load->view('assets/perusahaan/jumlahloker', $data);
        $this->load->view('assets/footer');
    }


    public function lihatperusahaan($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/perusahaan/lihatperusahaan', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function hapusperusahaan($id=null){
        $q      = $this->db->query("select * from user where id_user='$id'");
        $row    =$q->row();
        unlink('./image/'.$row->foto_user);
        $this->db->query("delete from user where id_user='$id'");
        
        redirect('admin/perusahaan','refresh');
    }

    public function penyediapelatihan(){
        $this->load->view('assets/header');
        $this->load->view('assets/penyediapelatihan/penyediapelatihan');
        $this->load->view('assets/footer');
    }

    public function lihatpp($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/penyediapelatihan/lihatpenyediapelatihan', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function hapuspp($id=null){
        $q      = $this->db->query("select * from user where id_user='$id'");
        $row    =$q->row();
        unlink('./image/'.$row->foto_user);
        $this->db->query("delete from user where id_user='$id'");
        
        redirect('admin/penyediapelatihan','refresh');
    }

    public function jumlahpelatihan($id_pelatihan){
        $p=str_replace('%20','',$id_pelatihan);
        $data['id_pelatihan']=$p;
        $this->load->view('assets/header');
        $this->load->view('assets/penyediapelatihan/jumlahpelatihan', $data);
        $this->load->view('assets/footer');
    }

    public function lokerdn(){
        $this->load->view('assets/header');
        $this->load->view('assets/lokerdn/lokerdn');
        $this->load->view('assets/footer');
    }

    public function tesloker(){
        $q=$this->db->get('lowongan')->result();
        
    }

    public function ubahlokerdn($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerdn/ubahstatuslokerdn', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatestatuslokerdn($id=null){
        $status = $_POST['status'];

        $this->db->query("update lowongan set status='$status' where id_lowongan='$id'");
        $this->session->set_flashdata('msg', 'edit');
                
        redirect('admin/lokerdn','refresh');
    }

    public function historilokerdn(){
        $this->load->view('assets/header');
        $this->load->view('assets/lokerdn/historilokerdn');
        $this->load->view('assets/footer');
    }

    public function hapuslokerdn($id=null){
        $this->db->query("delete from lowongan where id_lowongan='$id'");
        
        echo true;
    }

    public function lihatlokerdn($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerdn/lihatlokerdn', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function lokerln(){
        $this->load->view('assets/header');
        $this->load->view('assets/lokerln/lokerln');
        $this->load->view('assets/footer');
    }

    public function savelokerln(){
        
            $disediakanuntuk=$_POST['disediakanuntuk'];
            $jabatan=$_POST['jabatan'];
            $judullowongan=$_POST['judullowongan'];
            $deskripsi_lowongan=$_POST['deskripsi_lowongan'];
            $id_sektor=$_POST['id_sektor'];
            $tgl_buka_loker=$_POST['tgl_buka_loker'];
            $tgl_tutup_loker=$_POST['tgl_tutup_loker'];
            $id_user= $this->session->userdata('id_user');
            $lokasi_lowongan=$_POST['lokasi_lowongan'];
            $jurusan=$_POST['jurusan'];
            $id_pendidikan=$_POST['id_pendidikan'];
            $jumlah=$_POST['jumlah'];
            $id_status_lowongan=$_POST['id_status_lowongan'];
            $nama_pj=$_POST['nama_pj'];
            $status=$_POST['status'];
            $jenis_lowongan=$_POST['jenis_lowongan'];

            $this->db->query("insert into lowongan values('','$disediakanuntuk','$jabatan','$judullowongan','$deskripsi_lowongan','$id_sektor','$tgl_buka_loker',
            '$tgl_tutup_loker','$lokasi_lowongan','$jurusan','$id_pendidikan','','','$nama_pj','$status','$jenis_lowongan','$id_user'
            )");
            $this->session->set_flashdata('msg', 'simpan');

            redirect('admin/lokerln','refresh');
    }

    public function hapuslokerln($id=null){
        $this->db->query("delete from lowongan where id_lowongan='$id'");
        
        redirect('admin/lokerln','refresh');
    }

    public function ubahlokerln($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerln/ubahstatuslokerln', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatestatuslokerln($id=null){
        $status = $_POST['status'];

        $this->db->query("update lowongan set status='$status' where id_lowongan='$id'");
        $this->session->set_flashdata('msg', 'edit');
                
        redirect('admin/lokerln','refresh');
    }

     public function historilokerln(){
        $this->load->view('assets/header');
        $this->load->view('assets/lokerln/historilokerln');
        $this->load->view('assets/footer');
    }

    public function lihatlokerln($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerln/lihatlokerln', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function pelatihan(){
        $this->load->view('assets/header');
        $this->load->view('assets/pelatihan/kegiatan');
        $this->load->view('assets/footer');
    }

    public function ubahpelatihan($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/pelatihan/ubahstatuspelatihan', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function updatestatuspelatihan($id=null){
        $status = $_POST['status'];

        $this->db->query("update pelatihan set status='$status' where id_pelatihan='$id'");
        $this->session->set_flashdata('msg', 'edit');
                
        redirect('admin/pelatihan','refresh');
    }

    public function historipelatihan(){
        $this->load->view('assets/header');
        $this->load->view('assets/pelatihan/historipelatihan');
        $this->load->view('assets/footer');
    }

    public function hapuspelatihan($id=null){
        $this->db->query("delete from pelatihan where id_pelatihan='$id'");
        
        redirect('admin/pelatihan','refresh');
    }

    public function lihatpelatihan($id=null){
        $data['id']=$id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/pelatihan/lihatpelatihan', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function lihatpelatihanhistori($id=null){
        $data['id']=$id;
        $this->load->view('assets/header',$data, FALSE);
        $this->load->view('assets/pelatihan/lihatpelatihanhistori', $data, FALSE);
        $this->load->view('assets/footer',$data, FALSE);
    }

    public function kategori()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/kategori');
        $this->load->view('assets/footer');
    }

        
    public function loadkategori()
    { ?>
             <table width='100%' class='table table-sm table-hover table-bordered dttable'>
                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php 
                            $no = 1;
                            $q = $this->db->query("select * from kategori ");
                            foreach($q->result() as $row){              
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row->kategori; ?></td>
                            <td >
                                <a href="admin/hapuskategori/<?php echo $row->id_kategori ?>" class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
                  </table>
                  <script>
                        $(".hapus").click(function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus Data ?',
                        text: "Data yang sudah dihapus tidak bisa kembali !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yaa, hapus data !'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                            url:  $(this).attr('href'),
                            type: 'post',
                            data: $(this).serialize(),
                            dataType: "html",
                            success: function(dt){
                                Swal.fire(
                                    'Informasi',
                                    'Data berhasil dihapus !',
                                    'success'
                                );
                               $("#get").load("admin/loadkategori");
                                $("#entri").load("admin/entrikategori");
                            },
                            error: function(dt){
                                alert("Ada Kesalahan Sistem")
                            },
                        });
                    } else return false;
                    })
                        
            }); 
            $('.dttable').DataTable();
            </script>
            <?php    }
    
    public function entrikategori()
    { ?>
     <form method="post" action="admin/savekategori" id="save">
                        
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Kat</label>
                            <div class="col-sm-8 col-md-10">
                                <input class="form-control" required name="a"autocomplete='off' placeholder="Nama Kategori" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                <button class="btn btn-primary w-100" type="submit" id="simpan">Simpan</button>
                         </div>
                    </form>
                    <script>
        $("#save").on("submit",function(e){
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function (response) {
                $("#simpan").html("<i class='fas fa-spinner'></i> Berhasil Simpan");
                Swal.fire(
                    "Informasi",
                    "Data kategori berhasil disimpan!",
                    "info"
                );
              $("#get").load("admin/loadkategori");
                $("#entri").load("admin/entrikategori");
            },
            error : function (e){
                alert("Ada kesalahan sistem")
            }
        });
    });
   
    </script>
        <?php }
 
     public function savekategori()
     {
         $a = $_POST['a'];
         $this->db->query("insert into kategori values('','$a')");
         echo true;
     }
 
     public function hapuskategori($id='')
     {
         $this->db->query("delete from kategori where id_kategori='$id'");
         echo true;
     }

     public function artikel()
     {
        $this->load->library('pagination');
        $jum = $this->db->query("select artikel.*,user.nama_user,kategori.kategori from artikel
        inner join user on user.id_user=artikel.id_user
        inner join kategori on kategori.id_kategori=artikel.id_kategori");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=3;
        $config['base_url'] = base_url() . 'admin/artikel/';
        $config['total_rows'] = $jum->num_rows();
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
        //end style
        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->model_artikel->artikel_perpage($offset,$limit);

        $this->load->view('assets/header',$data); 
        $this->load->view('assets/berita',$data);
        $this->load->view('assets/footer',$data);
     }


     public function saveberita()
     {
         $config['upload_path'] = './image/';
         $config['allowed_types'] = 'jpg|jpeg|png';
         $config['max_size']  = '2000';
         $config['encrypt_name'] = TRUE;
         $this->load->library('upload', $config);
         if($this->upload->do_upload("gambar")){ //upload file
             $gbr = $this->upload->data();
 
             $config['image_library']    ='gd2';
             $config['source_image']     ='./image/'.$gbr['file_name'];
             $config['create_thumb']     = FALSE;
             $config['maintain_ratio']   = TRUE;
             $config['quality']          = '80%';
             $config['width']            = 980;
             $config['height']           = 560;
             $this->load->library('image_lib', $config);
             $this->image_lib->resize();
             $judul = $_POST['judul'];
             $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $judul);
             $trim     = trim($string);
             $slug     = strtolower(str_replace(" ", "-", $trim));
             $ket = $_POST['desc'];
             $kat = $_POST['kat'];
             $gambar = $gbr['file_name'];
             $iduser = $this->session->userdata('id');
             $result =  $this->db->query("insert into artikel values('','$slug','$judul','$iduser','$kat','$ket',now(),'0','$gambar')");
             echo json_encode($result);
         }else{
             echo false;
         }
     }

     public function inputartikel()
     {
         $this->load->view('assets/header');
         $this->load->view('assets/inputberita');
         $this->load->view('assets/footer');
     }

     public function editberita($id='')
     {
         $data['id'] = $id;
         $this->load->view('assets/header');
         $this->load->view('assets/editberita',$data);
         $this->load->view('assets/footer');
     }

     public function hapusartikel($id='')
     {
         $q = $this->db->query("select * from artikel where id_artikel='$id'");
         $row  =$q->row();
         unlink('./image/'.$row->gambar);
         $this->db->query("delete from artikel where id_artikel='$id'");
         echo true;
     }
     

     public function updateberita($id='')
     {
        $config['upload_path'] = './image/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']  = '3000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['gambar']['name'])){
        if ( ! $this->upload->do_upload('gambar')){
               echo false;
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
            $config['new_image']        = './getfile/thumb/'.$gbr['file_name'];
            $config['create_thumb']     = TRUE;
            $config['maintain_ratio']   = TRUE;
            $config['quality']          = '50%';
            $config['width']            = 1024;
             $config['height']           = 768;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $judul = $_POST['judul'];
             $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $judul);
             $trim     = trim($string);
             $slug     = strtolower(str_replace(" ", "-", $trim));
             $ket = $_POST['desc'];
             $kat = $_POST['kat'];
             $gambar = $gbr['file_name'];
             $iduser = $this->session->userdata('id');
            $q  = $this->db->query("select * from artikel where id_artikel='$id'");
            $row = $q->row();
            unlink('./image/'.$row->gambar);
            $result = $this->db->query("update artikel set slug='$slug',judul='$judul',id_user='$iduser',id_kategori='$kat',keterangan='$ket',gambar='$gambar' where id_artikel='$id'");
           
            echo json_encode($result);

        }} else {
            $judul = $_POST['judul'];
             $string   = preg_replace('/[^a-zA-Z0-9 \&%|{.}=,?!*()"-_+$@;<>\']/', '', $judul);
             $trim     = trim($string);
             $slug     = strtolower(str_replace(" ", "-", $trim));
             $ket = $_POST['desc'];
             $kat = $_POST['kat'];
             $iduser = $this->session->userdata('id');
            $result = $this->db->query("update artikel set slug='$slug',judul='$judul',id_user='$iduser',id_kategori='$kat',keterangan='$ket' where id_artikel='$id'");
            echo json_encode($result);
        }

     }

    public function pelamarlokerdn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header');
        $this->load->view('assets/lokerdn/pelamarlokerdn', $data, FALSE);
        $this->load->view('assets/footer');
    }

    public function pelamarlokerln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header');
        $this->load->view('assets/lokerln/pelamarlokerln', $data, FALSE);
        $this->load->view('assets/footer');
    }

    public function pelamarhistorilokerdn($id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header');
        $this->load->view('assets/lokerdn/pelamarhistorilokerdn', $data, FALSE);
        $this->load->view('assets/footer');
    }

     public function pelamarhistorilokerln($id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header');
        $this->load->view('assets/lokerln/pelamarhistorilokerln', $data, FALSE);
        $this->load->view('assets/footer');
    }
    
    public function komentarartikel($id='')
     {
         $data['id'] = $id;
         $this->load->view('assets/header');
         $this->load->view('assets/komentarartikel',$data);
         $this->load->view('assets/footer');
     }

     public function hapuskomentar($id='')
     {
         $this->db->query("delete from komentar_artikel where id='$id'");
         echo true;
     }

     public function penempatan(){
        $this->load->view('assets/header');
        $this->load->view('assets/penempatan');
        $this->load->view('assets/footer');
    }

    public function pendaftarpelatihan($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('assets/header');
        $this->load->view('assets/pelatihan/pendaftarpelatihan',$data);
        $this->load->view('assets/footer');
    }

    public function historipendaftarpelatihan($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('assets/header');
        $this->load->view('assets/pelatihan/historipendaftarpelatihan',$data);
        $this->load->view('assets/footer');
    }


    public function detailpendaftar($id_pelatihan, $id=NULL){   
        $data["id"]=$id;   
        $this->load->view('assets/header');
        $this->load->view('assets/pelatihan/detailpendaftar',$data,FALSE);
        $this->load->view('assets/footer');
    }

     public function historidetailpendaftar($id_pelatihan, $id=NULL){   
        $data["id"]=$id;   
        $this->load->view('assets/header');
        $this->load->view('assets/pelatihan/historidetailpendaftar',$data,FALSE);
        $this->load->view('assets/footer');
    }

     public function detailpelamardn($id_lowongan, $id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerdn/detailpelamardn', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function detailpelamarln($id_lowongan, $id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerln/detailpelamarln', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

     public function detailhistoripelamardn($id_lowongan, $id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerdn/detailhistoripelamardn', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function detailhistoripelamarln($id_lowongan, $id = null)
    {
        $data['id'] = $id;
        $this->load->view('assets/header', $data, FALSE);
        $this->load->view('assets/lokerln/detailhistoripelamarln', $data, FALSE);
        $this->load->view('assets/footer', $data, FALSE);
    }

    public function settingweb()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/setting');
        $this->load->view('assets/footer');
    }

    public function setlogo()
    {
        $config['upload_path'] = './image/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']  = '2000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['gambar']['name'])){
        if ( ! $this->upload->do_upload('gambar')){
               echo false;
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
            $config['create_thumb']     = false;
            $config['maintain_ratio']   = TRUE;
            $config['quality']          = '80%';
            $config['width']            = 1024;
            $config['height']           = 768;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $gambar = $gbr['file_name'];
            $q  = $this->db->query("select * from setting");
            $row = $q->row();
            unlink('./image/'.$row->logo);
            $result =  $this->db->query("update setting set logo='$gambar'");
            echo json_encode($result);
        }}
    }

    public function updatesetting()
    {
        $nama_website = $_POST['nama_website'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
        $youtube = $_POST['youtube'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $alamat = $_POST['alamat'];
        $data = array(
            'web' => $nama_website,
            'telp' => $no_telp,
            'email' => $email,
            'yt'    => $youtube,
            'fb'    => $facebook,
            'ig'    => $instagram,
            'alamat' => $alamat
        );
        $this->model_web_profil->get_setting_website($data);
        echo true;
    }

    public function backup()
	{ 
		$idtoko=$this->session->userdata('id');
		$nama=$idtoko.'_'.date('Y-m-d_H-i').'.sql';
		$prefs = array(
			'ignore'     => array(),
			'format'     => 'txt',
			'filename'   => "$nama",
			'add_drop'   => TRUE, 
			'add_insert' => TRUE,
			'newline'    => "\n"
		);
		$this->load->dbutil();
		$backup =$this->dbutil->backup($prefs); 
		$this->load->helper('file');
		write_file("backup/$nama", $backup);
		//$this->load->helper('download');
		//force_download("$nama", $backup);
		echo true;
	}

    public function import()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/import');
        $this->load->view('assets/footer');
    }

    public function restoredb($data='')
	{
	  $isi_file = file_get_contents("./backup/$data");
	  $string_query = rtrim( $isi_file, "\n;" );
	  $array_query = explode(";", $string_query);
	  foreach($array_query as $query)
	  {
		$this->db->query($query);
	  }
	  echo true;

	}

    public function eksportpdflokerdn()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerdn/eksportpdflokerdn');
       
    }

    public function eksportpdflokerln()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerln/eksportpdflokerln');
       
    }

    public function eksportpdfhistorilokerdn()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerdn/eksportpdfhistorilokerdn');
       
    }

    public function eksportpdfhistorilokerln()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerln/eksportpdfhistorilokerln');
       
    }

    public function eksportpdfpelatihan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/pelatihan/eksportpdfpelatihan');
       
    }

    public function eksportpdfhistoripelatihan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/pelatihan/eksportpdfhistoripelatihan');
       
    }

    public function eksportpdfmofficer()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/mofficer/eksportpdfmofficer');
       
    }

     public function eksportpdfpenempatan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/eksportpdfpenempatan');
       
    }

    public function eksportpdfpencaker()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/pencarikerja/eksportpdfpencaker');
       
    }

    public function eksportpdfpenyediapelatihan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/penyediapelatihan/eksportpdfpenyediapelatihan');
       
    }

    public function eksportpdfperusahaan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('assets/perusahaan/eksportpdfperusahaan');
       
    }

    public function eksportpdfpelamardn($id=null)
    {
        $data['id']=$id;
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerdn/eksportpdfpelamardn',$data);
       
    }

    public function eksportpdfhistoripelamardn($id=null)
    {
        $data['id']=$id;
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerdn/eksportpdfhistoripelamardn',$data);
       
    }


     public function eksportpdfpelamarln($id=null)
    {
        $data['id']=$id;
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerln/eksportpdfpelamarln',$data);
       
    }

    public function eksportpdfhistoripelamarln($id=null)
    {
        $data['id']=$id;
       $this->load->library('FPDF');
       
        $this->load->view('assets/lokerln/eksportpdfhistoripelamarln',$data);
       
    }

    public function eksportpdfpendaftar($id=null)
    {
        $data['id']=$id;
       $this->load->library('FPDF');
       
        $this->load->view('assets/pelatihan/eksportpdfpendaftar',$data);
       
    }

    public function eksportpdfhistoripendaftar($id=null)
    {
        $data['id']=$id;
       $this->load->library('FPDF');
       
        $this->load->view('assets/pelatihan/eksportpdfhistoripendaftar',$data);
       
    }


    public function aktif($id=null,$level=null){
        $this->db->query("update user set status='1' where id_user='$id'");

        $this->session->set_flashdata('msg', 'aktif');
        
        if ($level == "2") {
            redirect('admin/perusahaan','refresh');
        } else {
            redirect('admin/penyediapelatihan','refresh');
        }
    }

     public function tidakaktif($id=null,$level=null){
        $this->db->query("update user set status='0' where id_user='$id'");

        $this->session->set_flashdata('msg', 'tidakaktif');
        
       if ($level == "2") {
            redirect('admin/perusahaan','refresh');
        } else {
            redirect('admin/penyediapelatihan','refresh');
        }
    }

    public function ubahpassword(){
        $this->load->view('assets/header');
        $this->load->view('assets/ubahpassword');
        $this->load->view('assets/footer');
    }

    public function ubahpasswordbaru(){
        
       
            $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',array(
            'matches' => '%s tidak sama!'
            ));

                    if ($this->form_validation->run() == FALSE)
                        {
                            $this->load->view('assets/header');
                            $this->load->view('assets/ubahpassword');
                            $this->load->view('assets/footer');
                        }
                    else
                        {
                            
                            $password = md5($_POST['password']);
                            $password1 = $_POST['password1'];
                            $password2 = $_POST['password2'];

                            $q = $this->db->query("select * from user where password=md5('$password')");
                            $row = $q->row();
                            if(isset($password) == md5($row->password)){
                            
                            $id = $this->session->userdata('id');
                            $this->db->query("update user set password=md5('$password2') where id_user='$id' ");
                            $this->session->set_flashdata('msg', 'berhasilupdatepassword');
                            redirect('admin/ubahpasswordbaru','refresh');
                        }
        
            
                    }
    }

     public function profil()
    {
        $this->load->view('assets/header');
        $this->load->view('assets/profil');
        $this->load->view('assets/footer');
    }

     public function updateprofile(){
        $id=$this->session->userdata('id');

        $config['upload_path']      = './image/';
        $config['allowed_types']    = 'jpg|png|jpeg';
        $config['max_size']         = '3000';
        $config['encrypt_name']     = TRUE;
        $this->load->library('upload', $config);
        if(!empty($_FILES['fotouser']['name'])){
        if ( ! $this->upload->do_upload('fotouser')){

             $this->session->set_flashdata('msg', 'gagal');
             
             redirect('admin/profil','refresh');
             
            } else {
            $gbr = $this->upload->data();
            //Compress Image
            $config['image_library']    ='gd2';
            $config['source_image']     ='./image/'.$gbr['file_name'];
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
            $kode_pos   =   $_POST['kode_pos'];

            $gambar     = $gbr['file_name'];
            $q          = $this->db->query("select * from user where id_user='$id'");
            $row        = $q->row();
            
            unlink('./image/'.$row->foto_user);

            $data1     = array(
            'nama_user' =>$nmuser,
            'username'  =>$username,
            'level'     =>'1',
            'foto_user' => $gambar,
            'email_user'=> $emailuser,
            'nohp_user' =>$nohpuser,
            'alamat_user'=>$alamatuser,
            'status'    =>'1',
            'date'      => date('Y-m-d')
            );

            $where = array(
                'id_user' => $id
            );

            
            $this->main_model->update_profile($where, 'user', $data1);
            $this->session->set_flashdata('msg', 'edit');
                
            redirect('admin/profil','refresh');
            
            
        }} else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];

              $data1     = array(
            'nama_user' =>$nmuser,
            'username'  =>$username,
            'level'     =>'1',
            'email_user'=> $emailuser,
            'nohp_user' =>$nohpuser,
            'alamat_user'=>$alamatuser,
            'status'    =>'1',
            'date'      => date('Y-m-d')
            );

            $where = array(
                'id_user' => $id
            );
                $this->main_model->update_profile($where,'user',$data1);
             
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('admin/profil','refresh');
        }
    }
}


/* End of file Admin.php */
