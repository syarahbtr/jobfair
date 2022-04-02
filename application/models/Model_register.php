<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_register extends CI_Model {

    public function get_provinsi(){
        $q =  $this->db->query('select * from provinsi');
        return $q;
    }

    public function get_kabupaten(){
        $q =  $this->db->query("select kabupaten.*,provinsi.* from kabupaten inner join provinsi on provinsi.id_provinsi = kabupaten.id_provinsi")->result();
        return $q;
    }

    public function get_kecamatan(){
        $q =  $this->db->query("select kecamatan.*,kabupaten.* from kecamatan inner join kabupaten on kabupaten.id_kabupaten = kecamatan.id_kabupaten")->result();
        return $q;
    }

    public function login($username,$password){
        $q = $this->db->query("select * from user where  username='$username' and password=md5('$password') ");
        return $q;
    }

    public function register($table, $data){
        $this->db->insert($table, $data);
    }
}

/* End of file Model_register.php */

?>