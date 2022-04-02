<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_lowongan extends CI_Model
{

    function tambahloker($data)
    {
        $this->db->insert('lowongan', $data);
    }
    public function update_loker($table, $data , $where)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
        
    }
}
    
    /* End of file Model_lowongan.php */
