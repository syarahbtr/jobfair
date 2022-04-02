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
$sqldetil = $this->db->query("select pelatihan.*,user.id_user,user.nama_user from pelatihan 
                            left join user on user.id_user=pelatihan.id_user 
                            where pelatihan.tanggal_selesai>='$today' 
                            order by pelatihan.id_pelatihan");
//body

$pdf->SetFont('Times','B',14);
$pdf->Cell(0,5,'LAPORAN DATA PELATIHAN',0,1,'C');	
$pdf->Cell(30,8,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(7,6,'NO',1,0, 'C');
$pdf->Cell(40,6,'Nama Penyedia',1,0, 'C');
$pdf->Cell(25,6,'Tanggal Mulai',1,0, 'C');
$pdf->Cell(25,6,'Tanggal Selesai',1,0, 'C');
$pdf->Cell(40,6,'Nama Pelatihan',1,0, 'C');
$pdf->Cell(100,6,'Alamat',1,0, 'C');
$pdf->Cell(20,6,'Jam',1,0, 'C');
$pdf->Cell(25,6,'Jumlah Peserta',1,1, 'C');
$i=1;
foreach($sqldetil->result() as $d){
        $pdf->SetFont('Times','',9);
        $pdf->Cell(7,6,$i++,1,0);
        $pdf->Cell(40,6,$d->nama_user,1,0);
        $pdf->Cell(25,6,$d->tanggal_mulai,1,0);
        $pdf->Cell(25,6,$d->tanggal_selesai,1,0);
        $pdf->Cell(40,6,$d->nama_pelatihan,1,0);
        $pdf->Cell(100,6,$d->alamat,1,0);
        $pdf->Cell(20,6,$d->jam,1,0);
        $pdf->Cell(25,6,$d->jumlah_peserta,1,1);
}

$pdf->SetFont('Times','',10);

$pdf->Output('Data Pelatihan.pdf', 'I');