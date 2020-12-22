<section class="content">
  <div class="box">
    <div class="box-body">
      
    
<?php
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch($aksi) {
case 'list' :
?>
<h1>Data Jenis Barang </h1>

<p><a href="?p=jenisbarang&aksi=entri" class="btn btn-primary"> + Tambah data</a></p>
<table class="table table-condensed" id="tabeljenisbarang">
	<thead>
  <tr>
		<th>No</th>
		<th>Jenis Barang</th>
		<th>Keterangan</th>
		<th>Aksi</th>
	</tr>
  </thead>
  
	<?php
	$koneksi=mysqli_connect("localhost","root","","db_iventory"); //koneksi ke mysql
	$data=mysqli_query($koneksi,"SELECT * FROM jenis_barang");
	$no=1;
	while ($row=mysqli_fetch_array($data)){
	?>
  <tbody>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $row['nama_jenis'] ?></td>
		<td><?php echo $row['keterangan'] ?></td>
    <?php
            if ($_SESSION['level']=='admin') {
            ?>
		<td><a href="aksi_jenisbarang.php?proses=hapus&kode=<?php echo $row['id_jenis'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Hapus</a>
		<a href="?p=jenisbarang&aksi=edit&kode=<?php echo $row['id_jenis'] ?>" class="btn btn-primary">Edit</a>
    <?php
      }
      ?>
		</td>
	</tr>
	<?php
	$no++;
	}
	?>
  </tbody>
</table>

<?php
break;
case 'entri':
?>
<h1>Masukkan Jenis Barang</h1>
<form class="form-horizontal" role="form" action="aksi_jenisbarang.php?proses=tambah" method="post">
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Jenis Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="jenisbarang" placeholder="Jenis Barang" name="jenisbarang">
    </div>
  </div>
 <div class="form-group">
    <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="keterangan" name="keterangan" rows="5" cols="35"></textarea>
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
</form>

<?php
break;
case 'edit':

$koneksi=mysqli_connect('localhost','root','','db_iventory');
$ambil=mysqli_query($koneksi,"SELECT * FROM jenis_barang WHERE id_jenis='$_GET[kode]'");
$data=mysqli_fetch_array($ambil);
?>
<h1>Edit Jurusan</h1>
<form class="form-horizontal" role="form" action="aksi_jenisbarang.php?proses=ubah&kode=<?= $data['id_jenis']?>" method="post">
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Jenis Barang</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="jenisbarang" placeholder="Jenis Barang" name="jenisbarang" value="<?= $data['nama_jenis']?>">
    </div>
  </div>
 <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="jurusan" name="keterangan" rows="5" cols="35"><?= $data['keterangan'] ?></textarea>
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <Input type="submit" name="submit" class="btn btn-primary">
    </div>
  </div>
</form>
<?php
break;
}
?>
</div>
  </div>
  
</section>