<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        $this->load->model('model_artikel');
        $this->load->model('model_footer');
    }

public function artikel()
    {
        $this->load->library('pagination');
        $jum = $this->db->query("select artikel.*,user.id_user,user.nama_user,kategori.kategori 
        from artikel 
        left join user on user.id_user = artikel.id_user 
        left join kategori on kategori.id_kategori = artikel.id_kategori");
        $page=$this->uri->segment(3);
        if(!$page):
            $offset = 0;
        else:
            $offset = $page;
        endif;
        $limit=2;
        $config['base_url'] = base_url() . 'artikel/artikel/';
        $config['total_rows'] = $jum->num_rows();
        $config['per_page'] = $limit;
        $config['uri_segment'] = 3;
        //style
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $this->pagination->initialize($config);
        //end style

        $data['page'] =$this->pagination->create_links();
        $data['q']=$this->model_artikel->artikel_perpage($offset,$limit);

        $data['popular']=$this->db->query("select * from artikel order by views desc limit 5")->result();
        
        $data['kategori']=$this->db->query("select artikel.*,count(*) as jml,kategori.kategori from artikel 
        inner join kategori on kategori.id_kategori = artikel.id_kategori");

        $this->load->view('frontend/header');
        $this->load->view('frontend/artikel',$data);
        $this->load->view('frontend/footer');
    }

    function cariartikel(){
      $keyword=str_replace("'", "", htmlspecialchars($this->input->get('keyword',TRUE),ENT_QUOTES));
      $query=$this->model_artikel->cari_artikel($keyword);
      if($query->num_rows() > 0){
        $x['q']=$query;
                $x['popular']=$this->db->query("select * from artikel order by views desc limit 5")->result();
                $x['kategori']=$this->db->query("select artikel.*,count(*) as jml,kategori.kategori from artikel 
                inner join kategori on kategori.id_kategori = artikel.id_kategori");
                $this->load->view('frontend/header');
                $this->load->view('frontend/artikel',$x);
                $this->load->view('frontend/footer');
      }else{
      echo $this->session->set_flashdata('msg','<div class="alert alert-danger">Tidak dapat menemukan artikel / berita dengan kata kunci <b>'.$keyword.'</b></div>');
      redirect('artikel/artikel');
    }
  }

  public function detailartikel($slugs)
  {
    $slug=htmlspecialchars($slugs,ENT_QUOTES);
    $query = $this->model_artikel->get_slug($slug);
    if($query->num_rows() > 0){
        $b=$query->row_array();
        $kode=$b['id_artikel'];
        $this->model_artikel->update_view($kode);
        $data=$this->model_artikel->artikel_by_kode($kode);
        $row=$data->row_array();
        $x['id_artikel']=$row['id_artikel'];
        $x['judul']=$row['judul'];
        $x['date']=$row['date'];
        $x['nama']=$row['nama_user'];
        $x['kat']=$row['kategori'];
        $x['keterangan']=$row['keterangan'];
        $x['image']=$row['gambar'];
        $x['view'] =$row['views'];
        $x['slug']=$row['slug'];
        $x['popular']= $this->model_artikel->get_popular();
        $x['kategori']= $this->model_artikel->get_kategori();
        $x['totalkoment'] = $this->db->query("select * from komentar_artikel where id_artikel='$kode'")->num_rows();
        $this->load->view('frontend/header');
        $this->load->view('frontend/detailartikel',$x);
        $this->load->view('frontend/footer');
    }else{
        redirect('artikel/artikel','refresh');
    }
  }

public function loadkomentartikel($id='')
    { 

    $totalkoment = $this->db->query("select * from komentar_artikel where id_artikel='$id'")->num_rows();

        $show_komentar = $this->model_artikel->show_komentar_by_artikel_id($id);
        ?>
        <h4 class="comments-count"><?php echo $totalkoment ?> Comments</h4>

        <?php 
        if($show_komentar->num_rows() < 0){
        ?>

        <div class="alert alert-primary" role="alert">
        <strong>Informasi</strong> Belum ada komentar untuk akomodasi saat ini!
        </div>

        <?php }else{ ?>
        <?php foreach($show_komentar->result() as $row){ ?>
            <div id="comment-1" class="comment">
                <div class="d-flex">
                    <div class="comment-img"><img src="assets/img/favicon.ico" alt=""></div>
                <div>
            <h5><a href=""><?php echo $row->nama ?></a> <a href="#" class="reply"></a></h5>
            <time datetime="2020-01-01"><?php echo date("d F Y",strtotime($row->date)) ?></time>
            <p>
            <?php echo $row->komentar ?>
        </p>
      </div>
    </div>
  </div><!-- End comment #1 -->

    <?php  } ?>
  <?php }  ?>

    <?php 
    
    $vals = [
        // 'word' -> nantinya akan digunakan sebagai random teks yang akan keluar di captchanya
        'word'          => substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 5),
        'img_path'      => './captcha/',
        'img_url'       => base_url('captcha/'),
        'font_path'     => FCPATH. 'captcha/font/verdana.ttf',
        'img_width'     => 300,
        'img_height'    => 80,
        'expiration'    => 7200,
        'word_length'   => 5,
        'font_size'     => 40,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'colors'        => [
                'background'=> [255, 255, 255],
                'border'    => [255, 255, 255],
                'text'      => [0, 0, 0],
                'grid'      => [255, 40, 40]
        ]
    ];
    
    $captcha = create_captcha($vals);

    $this->session->set_userdata('captcha', $captcha['word']);
    
    ?>
   <div class="reply-form">
            <h4>Leave a Reply</h4>
            <p>Your email address will not be published. Required fields are marked * </p>
            <form action="artikel/savekomentartikel" id="masuk" method="POST">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input name="nama" type="text" class="form-control" placeholder="Your Name*">
                  <input name="idakomodasi" type="hidden" value="<?php echo $id ?>" class="form-control" placeholder="Your Name*">
                </div>
                <div class="col-md-6 form-group">
                  <input name="email" type="text" class="form-control" placeholder="Your Email*">
                </div>
              </div>
              
              <div class="row">
                <div class="col form-group">
                  <textarea name="isi" class="form-control" placeholder="Your Comment*"></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col form-group">
                <?=
                $captcha['image'];
                ?><br/>
                <br>
                <input type="text" class="form-control" name="captcha" placeholder="Silahkan Isi Capthca">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Post Comment</button>

            </form>
			<script type="text/javascript">
	$(document).ready(function()
	{
		$("#masuk").on('submit',function(e){
			e.preventDefault();
			$.ajax({
			  url:$(this).attr('action'),
			  type: 'post',
			  data: $(this).serialize(),
			  dataType: "html",
			  success: function(dt){
				if(dt==0){
					Swal.fire(
					  'Informasi',
					  'Maaf Captcha Yang Anda Ketikkan Salah!',
					  'warning'
					)
				}else{
                    Swal.fire(
                        "Informasi",
                        "Terimasi kasih,komentar anda berhasil terkirim!",
                        "success"
                    );
                    $("#loadkoment").load("artikel/loadkomentartikel/<?php echo $id; ?>")



				}
			  }
			});
		});
		});
	</script>
          </div>
  <?php  }

public function savekomentartikel($id='')
{
    $post_code  = $this->input->post('captcha');
    $captcha    = $this->session->userdata('captcha');
    if ($post_code && ($post_code == $captcha)){
        $nama = $_POST['nama']; 
        $email = $_POST['email']; 
        $isi = $_POST['isi']; 
        $idakomodasi = $_POST['idakomodasi']; 
        $this->db->query("insert into komentar_artikel values('','$idakomodasi','$nama','$email','$isi',now())");
        echo true;
    }else{
        echo false;
    }
}


}

/* End of file Artikel.php */
