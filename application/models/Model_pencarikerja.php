<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pencarikerja extends CI_Model {
    public function update_profil($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }
    

}

/* End of fi_pencarikerja.php */
