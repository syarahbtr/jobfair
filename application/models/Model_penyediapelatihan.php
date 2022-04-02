<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_penyediapelatihan extends CI_Model {

    function update_profile($where, $data, $table){
        $this->db->where($where);
        $this->db->update($data, $table);
    }
    

}

/* End of file Model_penyediapelatihan.php */
