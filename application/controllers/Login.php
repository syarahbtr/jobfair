<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->load->view('login');
        
    }

    public function cekuser()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query = $this->db->query("select * from user where  username='$username' and password=('$password') ");
        if($query->num_rows() > 0){
            $row = $query->row();
            $data = array(
                'id'    => $row->id_user,
                'nama'  => $row->nama_user,
                'level'=>$row->level,
                'gambar'=>$row->foto_user,
                'status' =>$row->status,
            );
            $this->session->set_userdata($data);
            
            if($this->session->userdata('level')=='1'){
               redirect('admin/index','refresh');
            }
            elseif($this->session->userdata('level')=='2'){
                redirect('perusahaan/index','refresh');
            }
            elseif($this->session->userdata('level')=='3'){
                redirect('pelatihan/index','refresh');
            }
            else{
                redirect('pencaker/index','refresh');
            }
            
            
        }else{
           $this->session->set_flashdata('msg', 'gagal');
           
           redirect('login/index','refresh');
           
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        //redirect('login');
        redirect('home/index','refresh');
    }
    
    

}

/* End of file Login.php */