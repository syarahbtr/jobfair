<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Lupapassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->model('model_footer');
        $this->load->model('model_lupapassword');
    } 

    public function cek_email_username(){
        $username=$_POST['username'];
        $email=$_POST['email'];

        $q=$this->model_lupapassword->get_username_email($username,$email);
        if($q->num_rows() > 0){
            echo 'lupapassword/gantipassword';
        }else{
            echo false;
        }
    }

    public function lupapassword(){
        $this->load->view('frontend/header');    
        $this->load->view('frontend/lupapassword');
        $this->load->view('frontend/footer');
    }


     public function gantipassword()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]',array(
            'matches' => '%s tidak sama!'
        ));

         if ($this->form_validation->run() == FALSE)
                {
                    $this->load->view('frontend/header');    
                    $this->load->view('frontend/gantipassword');
                    $this->load->view('frontend/footer');

                }
        else

                {
                $username=$_POST['username'];
                $q=$this->db->query("select * from user where username='$username'");

                    if ($q->num_rows()>0){
                        $row=$q->row();    
                        $password=$_POST['password'];
                        $this->db->query("update user set password=md5('$password') where username='$username'");  
                        $this->session->set_flashdata('msg', 'berhasilupdatepassword');
                        redirect('home/login','refresh');

                    }else{
                    $this->session->set_flashdata('msg', 'cekusername');
                        redirect('lupapassword/gantipassword','refresh');
            
        }       
                }

    }


}

/* End of file Lupapassword.php */
