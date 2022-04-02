<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {

  function create($table,$data){

    $query = $this->db->insert($table, $data);
    $id_table1 = $this->db->insert_id(); // return last insert id

    array_unshift($data, array('id_user'=>$id_table1));

    $returndata  = array($table => $id_table1);

    return $returndata;
    
} 

public function lokerdn_perpage($offset,$limit)
	{
    $today= date("Y-m-d"); 
		$hsllokerdn = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,
                        pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Umum' limit  $offset,$limit");
		return 	$hsllokerdn;
	}

public function lokerdndisabilitas_perpage($offset,$limit)
	{
    $today= date("Y-m-d"); 
		$hsllokerdndisabilitas = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,
                        pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Dalam Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas' limit  $offset,$limit");
		return 	$hsllokerdndisabilitas;
	}

public function lokerln_perpage($offset,$limit)
	{
    $today= date("Y-m-d"); 
		$hsllokerln = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Umum' limit  $offset,$limit");
		return 	$hsllokerln;
	}

public function lokerlndisabilitas_perpage($offset,$limit)
	{
    $today= date("Y-m-d"); 
		$hsllokerlndisabilitas = $this->db->query("select lowongan.*,user.id_user,user.foto_user,sektor.nama_sektor,pendidikan.nama_pendidikan from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        left join sektor on sektor.id_sektor=lowongan.id_sektor
                        left join pendidikan on pendidikan.id_pendidikan=lowongan.id_pendidikan
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today' 
                        and lowongan.status='Aktif' and lowongan.disediakanuntuk='Disabilitas' limit  $offset,$limit");
		return 	$hsllokerlndisabilitas;
	}

  public function pelatihanumum_perpage($offset,$limit)
	{
    $today= date("Y-m-d"); 
		$hslpelatihanumum = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
                        user.foto_user,pencari_kerja.id_pencaker from pelatihan
                        left join user on user.id_user=pelatihan.id_user
                        left join pencari_kerja on pencari_kerja.id_user = user.id_user
                        left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
                        where pelatihan.tanggal_selesai>='$today' and pelatihan.kategori='Umum'
                        order by pelatihan.id_pelatihan desc limit  $offset,$limit");
		return 	$hslpelatihanumum;
	}

  public function pelatihandisabilitas_perpage($offset,$limit)
	{
    $today= date("Y-m-d"); 
		$hslpelatihandisabilitas = $this->db->query("select pelatihan.*,user.nama_user,user.id_user,user.level,
                        user.foto_user,pencari_kerja.id_pencaker from pelatihan
                        left join user on user.id_user=pelatihan.id_user
                        left join pencari_kerja on pencari_kerja.id_user = user.id_user
                        left join daftar_pelatihan on daftar_pelatihan.id_pelatihan = pelatihan.id_pelatihan
                        where pelatihan.tanggal_selesai>='$today' and pelatihan.kategori='Disabilitas'
                        order by pelatihan.id_pelatihan desc limit  $offset,$limit");
		return 	$hslpelatihandisabilitas;
	}

  function update_profile($where, $data, $table){
        $this->db->where($where);
        $this->db->update($data, $table);
  }

}

/* End of file Main_model.php */
