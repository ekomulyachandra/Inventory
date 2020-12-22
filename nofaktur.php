<?php
  $koneksi=mysqli_connect('localhost','root','','db_iventory');
  // $data = mysqli_query($koneksi,"select * from penjualan where tgl_penjualan = now()");
  // $jumlahbaris = mysqli_num_rows($data) + 1;
  // echo date('dmy').'-'.str_pad($jumlahbaris,3,'0',STR_PAD_LEFT);
  $today = date('ymd');
  $cari_faktur = mysqli_query($koneksi,"select max(faktur) as last from penjualan where faktur like '$today%'");
  $data = mysqli_fetch_array($cari_faktur);
  if($data['last']){
    $nomor = explode("-",$data['last'],2);
    $faktur_pecah=sprintf('%03s',$nomor[1]+1);
    $faktur = $today.'-'.$faktur_pecah;
  }else{
    $faktur = $today.'-'.'001';
  }
  
?>
