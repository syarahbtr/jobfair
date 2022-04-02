<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Alamat extends CI_Controller {

    public function index() {
        $res = array('message' => 'Nothing here');

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($res));
    }

    public function provinsi()
    {
        $res = $this->db->query("select * from provinsi");
        $this->output
               ->set_content_type('application/json')
               ->set_output(json_encode($res->result()));
    }

    public function kabupaten($id = null)
    {
        $query = $this->db->query("select kabupaten.*,provinsi.provinsi from kabupaten inner join provinsi on provinsi.id_provinsi = kabupaten.id_provinsi where kabupaten.id_provinsi='$id'")->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($query));
        
    }

    public function kecamatan($id = null)
    {
        $query = $this->db->query("select kecamatan.*,kabupaten.kabupaten from kecamatan inner join kabupaten on kabupaten.id_kabupaten = kecamatan.id_kabupaten where kecamatan.id_kabupaten='$id'")->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($query));
        
    }

}

/* End of file Api.php */
