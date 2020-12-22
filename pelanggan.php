 	      <section class="content">
  <div class="box">
    <div class="box-body">
          <?php
            $page= isset($_GET['page'])?$_GET['page']:'list';
            switch($page){
                case 'list':
              ?>
                <h1>List Pelanggan</h1>
                <p><a href="?p=pelanggan&page=entri" class="btn btn-primary"><i class=""></i>+ Tambah Data</a></p>
                <table class="table table-bordered text-center mt-3">
                    <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
					<th>Telp</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                    <th>Kota</th>
                    <th>Provinsi</th>
					<?php
						if ($_SESSION['level']=='admin') {
						?>
                    <th>Aksi</th>
						<?php
						}
						?>
                    </tr>
                    <?php
                        $koneksi=mysqli_connect("localhost","root","","db_iventory");
                        $data = mysqli_query($koneksi,"select * from pelanggan");
                        $i =1;
                        while ($row=mysqli_fetch_array($data)) {
                    ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row['nama_pelanggan']?></td>
                        <td><?php echo $row['telp']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo $row['alamat']?></td>
                        <td><?php echo $row['kelurahan']?></td>
                        <td><?php echo $row['kecamatan']?></td>
                        <td><?php echo $row['kota']?></td>
                        <td><?php echo $row['provinsi']?></td>
                        <td>
                        <a href="aksi_pelanggan.php?aksi=hapus&kode=<?php echo $row['id_pelanggan']?>" class="btn btn-danger pr-2 pl-2" ><i class="fas fa-trash mr-2"></i>Hapus
                        <a href="?p=pelanggan&page=edit&kode=<?php echo $row['id_pelanggan']?>" class="btn btn-primary ml-2 pr-2 pl-2"><i class="far fa-edit mr-2"></i>Edit
                        </td>
                    </tr>
                    <?php $i++;}?>
                </table>
                <?php
                    break;
                    case 'entri':
                ?>
                    <h2>Input Data Pelanggan</h2>
                    <form class="form-group mt-5" method="post" action="aksi_pelanggan.php?aksi=tambah">
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Nama Pelanggan
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukan Nama Supplier">
                            </div>
                        </div>
						<div class="row mt-2">
                            <div class="col-md-2">
                                Telp
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="telp" class="form-control" placeholder="Masukan No Telp">
                            </div>
                        </div>
						
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Email
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="email" class="form-control" placeholder="Masukan Email">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Alamat
                            </div>
                            <div class="col-md-5">
                                <textarea name="alamat" rows="8" cols="80" class="form-control" placeholder="Masukan Alamat ">
                                    
                                </textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Kelurahan
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kelurahan" class="form-control" placeholder="Masukan Kelurahan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Kecamatan
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kecamatan" class="form-control" placeholder="Masukan Kecamatan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Kota
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kota" class="form-control" placeholder="Masukan Kota">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Provinsi
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="provinsi" class="form-control" placeholder="Masukan Provinsi">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary">
                                <input type="reset" name="btnReset" value="Reset" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                    <?php
                        break;
                        case 'edit':
						$koneksi=mysqli_connect('localhost','root','','db_iventory');
                        $ambil = mysqli_query($koneksi,"select * from pelanggan where id_pelanggan='$_GET[kode]'");
                        $data = mysqli_fetch_array($ambil);
                    ?>
                    <h2>Edit Data Pelanggan</h2>
                    <form class="form-group mt-5" method="post" action="aksi_pelanggan.php?aksi=ubah&kode=<?php echo $data['id_pelanggan']?>">
                         <div class="row mt-2">
                            <div class="col-md-2">
                                Nama Pelanggan
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukan Nama Supplier" value="<?= $data['nama_pelanggan']?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Telp
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="telp" class="form-control" placeholder="Masukan No Telp" value="<?= $data['telp']?>">
                            </div>
                        </div>
                        
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Email
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="email" class="form-control" placeholder="Masukan Email" value="<?= $data['email']?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Alamat
                            </div>
                            <div class="col-md-5">
                                <textarea name="alamat" rows="8" cols="80" class="form-control" placeholder="Masukan Alamat"><?php echo $data['alamat']?>
                                </textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Kelurahan
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kelurahan" class="form-control" placeholder="Masukan Kelurahan" value="<?= $data['kelurahan']?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Kecamatan
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kecamatan" class="form-control" placeholder="Masukan Kecamatan" value="<?= $data['kecamatan']?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Kota
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="kota" class="form-control" placeholder="Masukan Kota" value="<?= $data['kota']?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                Provinsi
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="provinsi" class="form-control" placeholder="Masukan Provinsi" value="<?= $data['provinsi']?>">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2">
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                <input type="submit" name="btnSubmit" value="Submit" class="btn btn-primary">
                                <input type="reset" name="btnReset" value="Reset" class="btn btn-danger">
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