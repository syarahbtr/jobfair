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
$sqldetil = $this->db->query("select lamar.*,pencari_kerja.*,user.*,lowongan.id_user as nama_perusahaan from lamar
                            inner join user on user.id_user=lamar.id_user
                            inner join pencari_kerja on pencari_kerja.id_user=user.id_user
                            inner join lowongan on lowongan.id_lowongan=lamar.id_lowongan
                            where lamar.id_status_lamar='5'");

//body

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,5,'LAPORAN DATA PENEMPATAN',0,1,'C');	
$pdf->Cell(30,8,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(7,6,'NO',1,0, 'C');
$pdf->Cell(50,6,'Nama',1,0, 'C');
$pdf->Cell(40,6,'NIK',1,0, 'C');
$pdf->Cell(110,6,'Alamat',1,0, 'C');
$pdf->Cell(40,6,'Nama Perusahaan',1,0, 'C');
$pdf->Cell(30,6,'Jabatan',1,1, 'C');
$i=1;
foreach($sqldetil->result() as $d){
$user = $this->db->query("SELECT * FROM user WHERE id_user='$d->nama_perusahaan;'")->row();
        $pdf->SetFont('Times','',9);
        $pdf->Cell(7,6,$i++,1,0);
        $pdf->Cell(50,6,$d->nama_user,1,0);
        $pdf->Cell(40,6,$d->nik_pencaker,1,0);
        $pdf->Cell(110,6,$d->alamat_user,1,0);
        $pdf->Cell(40,6,$user->nama_user,1,0);
        $pdf->Cell(30,6,$d->jabatan,1,1);
} 

$pdf->SetFont('Times','',10);

$pdf->Output('Data Penempatan.pdf', 'I');