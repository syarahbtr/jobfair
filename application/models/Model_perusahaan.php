<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_perusahaan extends CI_Model
{
    public function update_profil($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($data, $table);
    }
}

/* End of file Model_perusahaan.php */
