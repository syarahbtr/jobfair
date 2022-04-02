<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_artikel extends CI_Model {

function add_post($data1){
    $this->db->trans_start();
    $this->db->insert('admin',$data1);
    $this->db->trans_complete();
    return $this->db->insert_id();
}

public function artikel_perpage($offset,$limit)
	{
		$hsl = $this->db->query("select artikel.*,user.nama_user,kategori.kategori from artikel inner join user on user.id_user = artikel.id_user inner join kategori on kategori.id_kategori = artikel.id_kategori limit  $offset,$limit");
		return 	$hsl;
	}

function cari_artikel($keyword){
		$hsl = $this->db->query("select artikel.*,user.nama_user,kategori.kategori from artikel 
    inner join user on user.id_user = artikel.id_user 
    inner join kategori on kategori.id_kategori = artikel.id_kategori 
    where judul LIKE '%$keyword%' LIMIT 5");
		return $hsl;
	}

    
function show_komentar_by_artikel_id($kode){
		$hsl=$this->db->query("SELECT * FROM komentar_artikel WHERE id_artikel='$kode'");
		return $hsl;
	}

    
function artikel_by_kode($kode){
		$hsl = $this->db->query("select artikel.*,user.nama_user,kategori.kategori from artikel 
    inner join user on user.id_user = artikel.id_user 
    inner join kategori on kategori.id_kategori = artikel.id_kategori 
    where artikel.id_artikel='$kode'");
		return $hsl;
	}

function get_slug($slug){
    $query = $this->db->query("select artikel.*,user.nama_user,kategori.kategori from artikel 
    inner join user on user.id_user = artikel.id_user 
    inner join kategori on kategori.id_kategori = artikel.id_kategori  
    where slug='$slug'");
    return $query;
}

function update_view($kode){
    $kode = $this->db->query("UPDATE artikel SET views=views+1 WHERE id_artikel='$kode'");
    return $kode;
}

function get_popular(){
    $popular = $this->db->query("select * from artikel order by views desc limit 5")->result();
    return $popular;
}

function get_kategori(){
    $kategori = $this->db->query("select artikel.*,count(*) as jml,kategori.kategori from artikel 
        inner join kategori on kategori.id_kategori = artikel.id_kategori");
    return $kategori;
}

}

/* End of file Model_artikel.php */

