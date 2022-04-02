<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_lupapassword extends CI_Model {

    public function get_username_email($username,$email){
        $q = $this->db->query("select * from user where username='$username' and email_user='$email' ");
        return $q;
    }

}

/* End of file Model_lupapassword.php */
