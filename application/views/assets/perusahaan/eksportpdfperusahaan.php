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
$sqldetil = $this->db->query("select * from user  where level='2' order by id_user desc");

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,5,'LAPORAN DATA PENYEDIA KERJA',0,1,'C');	
$pdf->Cell(30,8,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(7,6,'NO',1,0, 'C');
$pdf->Cell(40,6,'Nama',1,0, 'C');
$pdf->Cell(140,6,'Alamat',1,0, 'C');
$pdf->Cell(25,6,'No HP',1,0, 'C');
$pdf->Cell(50,6,'Email',1,0, 'C');
$pdf->Cell(20,6,'Username',1,1, 'C');
$i=1;
foreach($sqldetil->result() as $d){
        $pdf->SetFont('Times','',9);
        $pdf->Cell(7,6,$i++,1,0);
        $pdf->Cell(40,6,$d->nama_user,1,0);
        $pdf->Cell(140,6,$d->alamat_user,1,0);
        $pdf->Cell(25,6,$d->nohp_user,1,0);
        $pdf->Cell(50,6,$d->email_user,1,0);
        $pdf->Cell(20,6,$d->username,1,1);
}


$pdf->SetFont('Times','',10);

$pdf->Output('Data Perusahaan.pdf', 'I');