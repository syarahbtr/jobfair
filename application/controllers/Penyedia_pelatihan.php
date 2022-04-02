<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Penyedia_pelatihan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id')){
            $this->session->set_flashdata('msg', 'logindulu');
            
            redirect('home/login','refresh');
        }

        if (!$this->session->userdata('status')) {
            $this->session->set_flashdata('msg', 'status');

            redirect('home/login', 'refresh');
        }

        $this->load->model('model_penyediapelatihan');
         $this->load->library('fpdf');
        
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
             
             redirect('pelatihan/index','refresh');
             
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
            $kode_pos   =   $_POST['kode_pos'];
            $nama_pjpp   =   $_POST['nama_pjpp'];
            $notelppjpp        =   $_POST['notelppjpp'];

            $gambar     = $gbr['file_name'];
            $q          = $this->db->query("select * from user where id_user='$id'");
            $row        = $q->row();
            
            unlink('./image/'.$row->foto_user);

            $data1     = array(
            'nama_user' =>$nmuser,
            'username'  =>$username,
            'level'     =>'3',
            'foto_user' => $gambar,
            'email_user'=> $emailuser,
            'nohp_user' =>$nohpuser,
            'alamat_user'=>$alamatuser,
            'status'    =>'1',
            'date'      => date('Y-m-d')
            );

            $data2     = array(
            'nama_user' =>$nmuser,
            'username'  =>$username,
            'password'  =>md5($_POST['password']),
            'level'     =>'3',
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

             $data = array(
            'kode_pos'      =>$kode_pos,
            'nama_pjpp'     =>$nama_pjpp,
            'notelp_pjpp'   =>$notelppjpp
            );

             $where2 = array(
                'id_user' => $id
            );

            if ($password==null){
                $this->model_penyediapelatihan->update_profile($where, 'user', $data1);
                $this->model_penyediapelatihan->update_profile($where2, 'penyedia_pelatihan', $data);
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('pelatihan/index','refresh');
                
            }
            else {
               $this->model_penyediapelatihan->update_profile($where, 'user', $data2);
                $this->model_penyediapelatihan->update_profile($where2, 'penyedia_pelatihan', $data);
      
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('pelatihan/index','refresh');
            }
            
            
        }} else {
            $nmuser     =   $_POST['nmuser'];
            $alamatuser =   $_POST['alamatuser'];
            $nohpuser   =   $_POST['nohpuser'];
            $emailuser  =   $_POST['emailuser'];
            $username   =   $_POST['username'];
            $password   =   $_POST['password'];
            $kode_pos   =   $_POST['kode_pos'];
            $nama_pjpp   =   $_POST['nama_pjpp'];
            $notelppjpp        =   $_POST['notelppjpp'];

              $data1     = array(
            'nama_user' =>$nmuser,
            'username'  =>$username,
            'level'     =>'3',
            'email_user'=> $emailuser,
            'nohp_user' =>$nohpuser,
            'alamat_user'=>$alamatuser,
            'status'    =>'1',
            'date'      => date('Y-m-d')
            );

            $data2     = array(
            'nama_user' =>$nmuser,
            'username'  =>$username,
            'password'  =>md5($_POST['password']),
            'level'     =>'3',
            'email_user'=> $emailuser,
            'nohp_user' =>$nohpuser,
            'alamat_user'=>$alamatuser,
            'status'    =>'1',
            'date'      => date('Y-m-d')
            );

            $where = array(
                'id_user' => $id
            );

             $data = array(
            'kode_pos'      =>$kode_pos,
            'nama_pjpp'     =>$nama_pjpp,
            'notelp_pjpp'   =>$notelppjpp
            );

             $where2 = array(
                'id_user' => $id
            );

            if ($password==null){
                $this->model_penyediapelatihan->update_profile($where, 'user',$data1);
                $this->model_penyediapelatihan->update_profile($where2, 'penyedia_pelatihan', $data);
             
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('pelatihan/index','refresh');
                
            }
            else {
                $this->model_penyediapelatihan->update_profile($where,'user', $data2);
                $this->model_penyediapelatihan->update_profile($where2, 'penyedia_pelatihan', $data);
             
                $this->session->set_flashdata('msg', 'edit');
                
                redirect('pelatihan/index','refresh');
            }
        }
    }

}

/* End of file Penyedia_pelatihan.php */
