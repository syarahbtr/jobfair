<?php
$config = $this->db->query("select * from setting")->row();
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage(); 
$pdf->SetFont('Times','B',18);
$pdf->Image('./image/'.$config->logo,30,5,27,24);
$pdf->Cell(25);
$pdf->SetFont('Times','B',20);
$pdf->Cell(0,5,$config->web,0,1,'C');
$pdf->Cell(25);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,5,'Website :'.$config->web .'/ E-Mail : '.$config->email,0,1,'C');
$pdf->Cell(25);
$pdf->SetFont('Times','B',10);
$pdf->Cell(0,5,' Telp : '.$config->telp,0,1,'C');

//head
$pdf->SetLineWidth(1);
$pdf->Line(10,36,300,36);
$pdf->SetLineWidth(0);
$pdf->Line(10,37,300,37);
$pdf->Cell(30,17,'',0,1);
$pdf->SetFont('Times','B',11);
$today = date("Y-m-d");
$sqldetil = $this->db->query("select daftar_pelatihan.*,user.*,pencari_kerja.*,pendidikan.nama_pendidikan 
                            from daftar_pelatihan
                            left join user on user.id_user=daftar_pelatihan.id_user
                            left join pencari_kerja on pencari_kerja.id_user=user.id_user
                            left join pendidikan on pendidikan.id_pendidikan=pencari_kerja.id_pendidikan
                            where daftar_pelatihan.id_pelatihan");
//body
$configx = $this->db->query("select daftar_pelatihan.*,pelatihan.*,user.* from daftar_pelatihan
left join pelatihan on pelatihan.id_pelatihan=daftar_pelatihan.id_pelatihan
left join user on user.id_user=pelatihan.id_user
")->row();

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,5,"LAPORAN DATA PENDAFTAR $configx->nama_user",0,1,'C');	
$pdf->Cell(30,8,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(7,6,'NO',1,0, 'C');
$pdf->Cell(45,6,'Nama Pendaftar',1,0, 'C');
$pdf->Cell(30,6,'NIK',1,0, 'C');
$pdf->Cell(30,6,'Pendidikan',1,0, 'C');
$pdf->Cell(110,6,'Alamat',1,0, 'C');
$pdf->Cell(45,6,'Email',1,1, 'C');
$i=1;
foreach($sqldetil->result() as $d){
        $pdf->SetFont('Times','',9);
        $pdf->Cell(7,6,$i++,1,0);
        $pdf->Cell(45,6,$d->nama_user,1,0);
        $pdf->Cell(30,6,$d->nik_pencaker,1,0);
        $pdf->Cell(30,6,$d->nama_pendidikan,1,0);
        $pdf->Cell(110,6,$d->alamat_user,1,0);
        $pdf->Cell(45,6,$d->email_user,1,1);
}

$pdf->SetFont('Times','',10);

$pdf->Output('Data Riwayat Pendaftar Pelatihan.pdf', 'I');