<?php
	$koneksi=mysqli_connect("localhost","root","","db_iventory");
	if ($_GET['proses']=='tambahdetail'){
		if (isset($_POST['submit'])) {
			$simpan=mysqli_query($koneksi,"INSERT INTO detail_penjualan(faktur,id_barang,harga_jual,jml_barang,subtotal) values(
			'$_POST[faktur]',
			'$_POST[id_barang]',
			'$_POST[harga_jual]',
			'$_POST[jml_barang]',
			'$_POST[subtotal]')");
		if ($simpan)
			header('location:index.php?p=penjualan');
		}
	}
?>