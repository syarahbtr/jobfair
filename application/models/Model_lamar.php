<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_lamar extends CI_Model
{
    function lamarloker($data)
    {
        $this->db->insert('lamar', $data);
    }
    function lamarpelatihan($data)
    {
        $this->db->insert('daftar_pelatihan', $data);
    }
}

/* End of file Model_lamar.php */
