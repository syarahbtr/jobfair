<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_footer extends CI_Model {

    function get_lowongan_footer(){
        $today = date("Y-m-d");
        $q=$this->db->query("select * from lowongan where jenis_lowongan='Dalam Negeri' and disediakanuntuk='Umum' and tgl_tutup_loker>='$today' order by id_lowongan desc limit 5");
        return $q;
    }

     function get_pelatihan_footer(){
        $q=$this->db->query("select * from pelatihan where kategori='umum' order by id_pelatihan desc limit 5");
        return $q;
    }
}

/* End of file Model_footer.php */
