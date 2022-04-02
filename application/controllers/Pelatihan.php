<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelatihan extends CI_Controller {

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

         $this->load->model('model_pelatihan');
          $this->load->library('fpdf');
    }
    
    public function dashboard()
    {
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/dashboard');
        $this->load->view('pelatihan/footer');
    }

    public function index()
    {
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/pelatihan');
        $this->load->view('pelatihan/footer');
    }

     public function kegiatan(){
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/kegiatan');
        $this->load->view('pelatihan/footer');
    }

     public function tambahpelatihan(){
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/tambahpelatihan');
        $this->load->view('pelatihan/footer');
    }

    public function savepelatihan(){

            $tanggal_mulai = new DateTime($_POST['tanggal_mulai']);
            $tanggal_selesai = new DateTime($_POST['tanggal_selesai']);
            if ($tanggal_selesai > $tanggal_mulai) {

                        $kategori=$_POST['kategori'];
                        $nama_pelatihan=$_POST['nama_pelatihan'];
                        $tanggal_mulai=$_POST['tanggal_mulai'];
                        $tanggal_selesai=$_POST['tanggal_selesai'];
                        $alamat=$_POST['alamat'];
                        $jam=$_POST['jam'];
                        $deskripsi_pelatihan=$_POST['deskripsi_pelatihan'];
                        $jumlah_peserta=$_POST['jumlah_peserta'];
                        $sertifikat_pelatihan=$_POST['sertifikat_pelatihan'];
                        $nama_user=$this->session->userdata('id');

                        $data = array(
                            'kategori' => $kategori,
                            'nama_pelatihan' => $nama_pelatihan,
                            'tanggal_mulai' => $tanggal_mulai,
                            'tanggal_selesai' => $tanggal_selesai,
                            'alamat' => $alamat,
                            'jam'   => $jam,
                            'deskripsi_pelatihan' => $deskripsi_pelatihan,
                            'jumlah_peserta' => $jumlah_peserta,
                            'sertifikat' => $sertifikat_pelatihan,
                            'date' => date('Y-m-d H:i:s'),
                            'id_user' => $nama_user
                        );
                        $this->model_pelatihan->get_pelatihan($data);
                        $this->session->set_flashdata('msg', 'simpan');

                        redirect('pelatihan/kegiatan','refresh');
            } else {
                        $this->session->set_flashdata('msg', 'gagalsubmit');
                        redirect('pelatihan/tambahpelatihan', 'refresh');
            }
    }

    public function hapuspelatihan($id=null){
        $q = $this->db->query("select * from pelatihan where id_pelatihan='$id'");
        $row  =$q->row();
        $this->db->query("delete from pelatihan where id_pelatihan='$id'");
        
        redirect('pelatihan/kegiatan','refresh');
    }

    public function editpelatihan($id=null){
        $data['id']=$id;
        $this->load->view('pelatihan/header', $data, FALSE);
        $this->load->view('pelatihan/editpelatihan', $data, FALSE);
        $this->load->view('pelatihan/footer', $data, FALSE);
    }

   public function lihatpelatihan($id=null){
        $data['id']=$id;
        $this->load->view('pelatihan/header', $data, FALSE);
        $this->load->view('pelatihan/lihatpelatihan', $data, FALSE);
        $this->load->view('pelatihan/footer', $data, FALSE);
    }

    public function updatepelatihan($id=null){
        
        $tanggal_mulai = new DateTime($_POST['tanggal_mulai']);
        $tanggal_selesai = new DateTime($_POST['tanggal_selesai']);
        
        if ($tanggal_selesai > $tanggal_mulai) {
            $kategori=$_POST['kategori'];
            $nama_pelatihan=$_POST['nama_pelatihan'];
            $tanggal_mulai=$_POST['tanggal_mulai'];
            $tanggal_selesai=$_POST['tanggal_selesai'];
            $alamat=$_POST['alamat'];
            $jam=$_POST['jam'];
            $deskripsi_pelatihan=$_POST['deskripsi_pelatihan'];
            $jumlah_peserta=$_POST['jumlah_peserta'];
            $sertifikat_pelatihan=$_POST['sertifikat_pelatihan'];

            $data = array(
                    'kategori' => $kategori,
                    'nama_pelatihan' => $nama_pelatihan,
                    'tanggal_mulai' => $tanggal_mulai,
                    'tanggal_selesai' => $tanggal_selesai,
                    'alamat' => $alamat,
                    'jam'   => $jam,
                    'deskripsi_pelatihan' => $deskripsi_pelatihan,
                    'jumlah_peserta' => $jumlah_peserta,
                    'sertifikat' => $sertifikat_pelatihan,
                    'date' => date('Y-m-d H:i:s')
            );
            
            $where = array(
                'id_pelatihan' => $id
            );

                $this->model_pelatihan->update_pelatihan($where, $data);
                $this->session->set_flashdata('msg', 'edit');

                redirect('pelatihan/kegiatan','refresh');
        } else {
                        $this->session->set_flashdata('msg', 'gagalsubmit');
                        redirect("pelatihan/editpelatihan/$id", 'refresh');
            }
    }

    public function histori(){
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/histori');
        $this->load->view('pelatihan/footer');
    }

    public function lihatpelatihanhistori($id=null){
        $data['id']=$id;
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/lihatpelatihanhistori', $data, FALSE);
        $this->load->view('pelatihan/footer');
    }

     public function deletepelatihan($id=null){
        $this->db->query("delete from pelatihan where id_pelatihan='$id'");
        
        redirect('pelatihan/histori','refresh');
    }

   

    public function pendaftarpelatihan($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/pendaftarpelatihan',$data);
        $this->load->view('pelatihan/footer');
    }

    public function detailpendaftar($id_pelatihan, $id=NULL){   
        $data["id"]=$id;   
        $this->load->view('pelatihan/header',$data, FALSE);
        $this->load->view('pelatihan/detailpendaftar',$data, FALSE);
        $this->load->view('pelatihan/footer',$data, FALSE);
    }

    public function historipendaftarpelatihan($id=NULL){   
        $data["id"]=$id;   
        $this->load->view('pelatihan/header');
        $this->load->view('pelatihan/historipendaftarpelatihan',$data);
        $this->load->view('pelatihan/footer');
    }

    public function historidetailpendaftar($id_pelatihan, $id=NULL){   
        $data["id"]=$id;   
        $this->load->view('pelatihan/header',$data, FALSE);
        $this->load->view('pelatihan/historidetailpendaftar',$data, FALSE);
        $this->load->view('pelatihan/footer',$data, FALSE);
    }

    public function eksportpdfpelatihan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('pelatihan/eksportpdfpelatihan');
       
    }

    public function eksportpdfhistoripelatihan()
    {
       $this->load->library('FPDF');
       
        $this->load->view('pelatihan/eksportpdfhistoripelatihan');
       
    }

    public function eksportpdfpendaftar($id=NULL)
    {
        $data["id"]=$id; 
        $this->load->library('FPDF');
       
        $this->load->view('pelatihan/eksportpdfpendaftar',$data,FALSE);
       
    }
}




/* End of file Pelatihan.php */