<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class model_web_profil extends CI_Model {

    public function get_setting_website($data){
        $this->db->update('setting', $data);
    }

}

/* End of file model_web_profil.php */
