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
$sqldetil = $this->db->query("select lowongan.*,user.id_user,user.nama_user from lowongan 
                        left join user on user.id_user=lowongan.id_user
                        where lowongan.jenis_lowongan='Luar Negeri' and lowongan.tgl_tutup_loker>='$today'  ");
//body

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,5,'LAPORAN DATA LOWONGAN LUAR NEGERI',0,1,'C');	
$pdf->Cell(30,8,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(7,6,'NO',1,0, 'C');
$pdf->Cell(35,6,'Nama Perusahaan',1,0, 'C');
$pdf->Cell(25,6,'Tanggal Mulai',1,0, 'C');
$pdf->Cell(25,6,'Tanggal Selesai',1,0, 'C');
$pdf->Cell(120,6,'Judul Lowongan',1,0, 'C');
$pdf->Cell(45,6,'Jurusan',1,0, 'C');
$pdf->Cell(25,6,'Jumlah Pelamar',1,1, 'C');
$i=1;
foreach($sqldetil->result() as $d){
        $pdf->SetFont('Times','',9);
        $pdf->Cell(7,6,$i++,1,0);
        $pdf->Cell(35,6,$d->nama_user,1,0);
        $pdf->Cell(25,6,$d->tgl_buka_loker,1,0);
        $pdf->Cell(25,6,$d->tgl_tutup_loker,1,0);
        $pdf->Cell(120,6,$d->judul_lowongan,1,0);
        $pdf->Cell(45,6,$d->jurusan,1,0);
        $pdf->Cell(25,6,$d->jumlah,1,1);
}


$pdf->SetFont('Times','',10);

$pdf->Output('Lowongan Kerja Luar Negeri.pdf', 'I');