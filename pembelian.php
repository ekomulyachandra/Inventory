<section class="content">
  <div class="box">
    <div class="box-body">
      
    
<?php
$aksi=isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch($aksi) {
case 'list' :
?>
<h1>Data Pembelian</h1>
<p><a href="laporanpembelian.php" class="btn btn-default"> + Cetak</a></p>
<div class="col-sm-5">
</div>
<p><a href="?p=pembelian&aksi=entri" class="btn btn-primary"> + Tambah data</a></p>
<table class="table table-condensed" id="tabeljenisbarang">
	<thead>
  <tr>
    <th>No</th>
		<th>Faktur</th>
		<th>Tanggal</th>
		<th>Nama Supplier</th>
    <th>Total Bayar</th>
    <th>Keterangan</th>
		<th>Aksi</th>
	</tr>
  </thead>
  
	<?php
	$koneksi=mysqli_connect("localhost","root","","db_iventory"); //koneksi ke mysql
  $data=mysqli_query($koneksi,"SELECT * FROM pembelian,supplier where pembelian.id_supplier=supplier.id_supplier");
  $no=1;
	while ($row=mysqli_fetch_array($data)){
	?>
  <tbody>
	<tr>
		<td><?php echo $no; ?></td>
		<td><?php echo $row['faktur'] ?></td>
    <td><?php echo $row['tgl_pembelian'] ?></td>
    <td><?php echo $row['nama_supplier'] ?></td>
    <td><?php echo $row['total_bayar'] ?></td>
		<td><?php echo $row['keterangan'] ?></td>
    <?php
            if ($_SESSION['level']=='admin') {
            ?>
		<td><a href="aksi_pembelian.php?proses=hapus&kode=<?php echo $row['faktur'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Hapus</a>
		<a href="?p=pembelian&aksi=edit&kode=<?php echo $row['faktur'] ?>" class="btn btn-primary">Edit</a>
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
<h1>Transaksi Pembelian</h1>
<form class="form-horizontal" role="form" action="aksi_pembelian.php?proses=tambah" method="post">
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label"><h4>Data Transaksi</h4></label>
    <div class="col-sm-10">
    </div>
  </div>
  <?php
  include "nofakturr.php"
  ?>
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">No. Faktur</label>
    <div class="col-sm-2">
      <input type="text" class="form-control txtnofaktur"  id="txtnofaktur"  name="txtnofaktur"    value="<?= $faktur ?>">
    </div>
    <label for="jurusan" class="col-sm-2 control-label">Tanggal Pembelian</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="tgl_penjualan"  name="tgl_pembelian" value="<?= date("ymd")?>">
    </div>
  </div>

  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Pelanggan</label>
    <div class="col-sm-3">
      <select class="form-control" id="id_supplier"  name="id_supplier">
    <?php 
    $koneksi=mysqli_connect("localhost","root","","db_iventory"); //koneksi ke mysql
    $data=mysqli_query($koneksi,"SELECT * FROM supplier");
    while ($row=mysqli_fetch_array($data)) {
      echo "<option value=$row[id_supplier]>$row[nama_supplier]</option>";
    }
    ?>
    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="keterangan"  name="keterangan">
    </div>
  </div>

  <div class="form-group">
    <label for="jurusan" class="col-sm-8 control-label">Total Bayar</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="total_bayar"  name="total_bayar" readonly value="0" onchange="hitungtotal()">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-3">
      
    </div>
    <div class="col-sm-4"> 
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Tambah Barang
              </button>  
    </div>
    <div class="col-sm-3">
      <button type="submit" name="submitt" class="btn btn-primary" >Simpan</button>
    </div>
  </div>

  

<h1>Daftar Barang </h1>

<table class="table table-condensed" id="tabeldetail">
  <thead>
  <tr>
    <th>No</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga Jual</th>
    <th>Jumlah</th>
    <th>Sub Total</th>
    <th>Aksi</th>
  </tr>
  </thead>
  
  <?php
  $koneksi=mysqli_connect('localhost','root','','db_iventory');
  $today = date('ymd');
  $cari_faktur = mysqli_query($koneksi,"select max(faktur) as last from pembelian where faktur like '$today%'");
  $data = mysqli_fetch_array($cari_faktur);
  if($data['last']){
    $nomor = explode("-",$data['last'],2);
    $faktur = $today.'-'.str_pad(($nomor[1]+1),3,'0',STR_PAD_LEFT);
  }else{
    $faktur = $today.'-'.'001';
  }
  $data1=mysqli_query($koneksi,"SELECT * FROM detail_pembelian,barang where detail_pembelian.id_barang=barang.id_barang and faktur like '$faktur'");
  $no=1;
  while ($row=mysqli_fetch_array($data1)){
  ?>
  <tbody>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $row['id_barang'] ?></td>
    <td><?php echo $row['nama_barang'] ?></td>
    <td><?php echo $row['harga_jual'] ?></td>
    <td><?php echo $row['jml_barang'] ?></td>
    <td><?php echo $row['subtotal'] ?></td>
    <?php
            if ($_SESSION['level']=='admin') {
            ?>
    <td><a href="aksi_penjualan.php?proses=hapusdetail&kode=<?php echo $row['faktur'] ?>&id=<?php echo $row['id_barang'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure ?')">Hapus</a>
    
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
</form>
<?php
break;
case 'edit':

$koneksi=mysqli_connect('localhost','root','','db_iventory');
$ambil1=mysqli_query($koneksi,"SELECT * FROM penjualan WHERE faktur='$_GET[kode]'");
$data1=mysqli_fetch_array($ambil1);
?>
<h1>Transaksi Penjualan</h1>
<form class="form-horizontal" role="form" action="aksi_penjualan.php?proses=edit" method="post">
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label"><h4>Data Transaksi</h4></label>
    <div class="col-sm-10">
    </div>
  </div>
  <?php
  include "nofaktur.php"
  ?>
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">No. Faktur</label>
    <div class="col-sm-2">
      <input type="text" class="form-control txtnofaktur"  id="txtnofaktur"  name="txtnofaktur"   readonly value="<?= $data1['faktur']?>">
    </div>
    <label for="jurusan" class="col-sm-2 control-label">Tanggal Pembelian</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="tgl_penjualan"  name="tgl_penjualan" value="<?= date("ymd")?>">
    </div>
  </div>

  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Pelanggan</label>
    <div class="col-sm-3">
      <select class="form-control" id="id_pelanggan"  name="id_pelanggan">
    <?php 
    $koneksi=mysqli_connect("localhost","root","","db_iventory"); //koneksi ke mysql
    $data=mysqli_query($koneksi,"SELECT * FROM pelanggan");
    while ($row=mysqli_fetch_array($data)) {
      echo "<option value=$row[id_pelanggan]>$row[nama_pelanggan]</option>";
    }
    ?>
    </select>
    </div>
  </div>
  <div class="form-group">
    <label for="jurusan" class="col-sm-2 control-label">Keterangan</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="keterangan"  name="keterangan" value="<?= $data1['keterangan']?>">
    </div>
  </div>

  <div class="form-group">
    <label for="jurusan" class="col-sm-8 control-label">Total Bayar</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" id="total_bayar"  name="total_bayar" readonly value="<?= $data1['total_bayar']?>" onchange="hitungtotal()">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-3">
      
    </div>
    <div class="col-sm-4"> 
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-success">
                Tambah Barang
              </button>  
    </div>
    <div class="col-sm-3">
      <button type="submit" name="submitt" class="btn btn-primary" >Simpan</button>
    </div>
  </div>

  

<h1>Daftar Barang </h1>

<table class="table table-condensed" id="tabeldetail">
  <thead>
  <tr>
    <th>No</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Harga Jual</th>
    <th>Jumlah</th>
    <th>Sub Total</th>
    <th>Aksi</th>
  </tr>
  </thead>
  
  <?php
  $koneksi=mysqli_connect('localhost','root','','db_iventory');
  $data2=mysqli_query($koneksi,"SELECT * FROM detail_penjualan,barang where detail_penjualan.id_barang=barang.id_barang and faktur like '$_GET[kode]'");
  $no=1;
  while ($row=mysqli_fetch_array($data2)){
  ?>
  <tbody>
  <tr>
    <td><?php echo $no; ?></td>
    <td><?php echo $row['id_barang'] ?></td>
    <td><?php echo $row['nama_barang'] ?></td>
    <td><?php echo $row['harga_jual'] ?></td>
    <td><?php echo $row['jml_barang'] ?></td>
    <td><?php echo $row['subtotal'] ?></td>
    <?php
            if ($_SESSION['level']=='admin') {
            ?>
   <td><a href="aksi_penjualan.php?proses=hapusdetail&kode=<?php echo $row['faktur'] ?>&nama=<?php echo $row['nama_barang'] ?>&jml=<?php echo $row['jml_barang'] ?>&subtotal=<?php echo $row['subtotal'] ?>&jml=<?php echo $row['jml_barang'] ?>&id=<?php echo $row['id_barang'] ?>&harga=<?php echo $row['harga_jual'] ?>">Hapus</a>
    
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
</form>
<?php
break;
}
?>
</div>
  </div>
  
</section>

<div class="modal modal-success fade" id="modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" role="form" action="tambahdetailbarang.php?proses=tambahpembelian" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Success Modal</h4>
              </div>
              <div class="modal-body">
                <div class="modal-body">
                  <div class="form-group">
                      <label for="jurusan" class="col-sm-2 control-label" >No Faktur</label>
                      <?php
                      include "nofaktur.php"
                      ?>
                      <div class="col-sm-4">
                         <input type="text" class="form-control" id="faktur"  name="faktur" data
                         value="<?= $faktur?>" style="display: none;">
                      </div>
            </div>
                  <div class="form-group">
                  <label for="jurusan" class="col-sm-2 control-label">Nama Barang</label>
                 <div class="col-sm-5">
                    <select class="form-control" id="id_barang"  name="id_barang">
                    <?php 
                    $koneksi=mysqli_connect("localhost","root","","db_iventory"); //koneksi ke mysql
                    $data1=mysqli_query($koneksi,"SELECT * FROM barang");
                    while ($row=mysqli_fetch_array($data1)) {
                      echo "<option value=$row[id_barang]>$row[nama_barang]</option>";
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="form-group">
              <label for="jurusan" class="col-sm-2 control-label">Harga Jual</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="harga_jual"  name="harga_jual" onchange="subtotalbarang()" >
              </div>
            </div>
            <div class="form-group">
              <label for="jurusan" class="col-sm-2 control-label">Jumlah</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="jml_barang"  name="jml_barang" onchange="subtotalbarang()" >
              </div>
            </div>
            <div class="form-group">
              <label for="jurusan" class="col-sm-2 control-label">Sub Total</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" id="subtotal"  name="subtotal" value="0" onchange="subtotalbarang()" >
              </div>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline" name="submit">Save changes</button>
              </div>
            </div>
          </form>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>


    <script type="text/javascript">
    function subtotalbarang() {
    var hargajual = parseInt(document.getElementById('harga_jual').value);
    var jumlah = parseInt(document.getElementById('jml_barang').value);
    var subtotal = hargajual*jumlah;

    document.getElementById('subtotal').value = subtotal;
    }
    


    var table = document.getElementById("tabeldetail"),sumVal=0;
    for(var i = 1;i <table.rows.length;i++){
      sumVal = sumVal+parseInt(table.rows[i].cells[5].innerHTML);
    }
    document.getElementById('total_bayar').value = sumVal;
      

    

    </script>