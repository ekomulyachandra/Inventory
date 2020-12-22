<?php
// memanggil library FPDF
require('fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'DAFTAR BARANG KEDAI MAKNYAK',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,7,'Barak Politeknik Negeri Padang',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(50,6,'NAMA BARANG',1,0);
$pdf->Cell(40,6,'JENIS BARANG',1,0);
$pdf->Cell(20,6,'SATUAN',1,0);
$pdf->Cell(30,6,'HARGA BELI',1,0);
$pdf->Cell(30,6,'HARGA JUAL',1,0);
$pdf->Cell(12,6,'STOK',1,1);


$pdf->SetFont('Arial','',10);
$no=1;
$koneksi=mysqli_connect("localhost","root","","db_iventory"); 
$data = mysqli_query($koneksi, "select * from barang,jenis_barang where barang.id_jenis=jenis_barang.id_jenis");
while ($row = mysqli_fetch_array($data)){
    $pdf->Cell(10,6,$no,1,0);
    $pdf->Cell(50,6,$row['nama_barang'],1,0);
    $pdf->Cell(40,6,$row['nama_jenis'],1,0);
	$pdf->Cell(20,6,$row['satuan'],1,0);
	$pdf->Cell(30,6,$row['harga_beli'],1,0);
	$pdf->Cell(30,6,$row['harga_jual'],1,0);
	$pdf->Cell(12,6,$row['stok'],1,1);


}
$no++;
$pdf->Output();
?>