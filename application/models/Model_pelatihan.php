<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pelatihan extends CI_Model {

    public function get_pelatihan($data){
       $this->db->insert('pelatihan',$data);
    }

    public function update_pelatihan($where, $data){
        $this->db->where($where);
        $this->db->update('pelatihan',$data);
    }

}

/* End of file Model_pelatihan.php */
