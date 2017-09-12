<?php
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
error_reporting(0);
?>
    <div class="container">
        <div class="content">
            <h2>Data Mahasiswa &raquo; Edit Data</h2>
            <hr />

            <?php
            $nim = $_GET['nim']; // assigment nim dengan nilai nim yang akan diedit
            $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'"); // query untuk memilih entri data dengan nilai nim terpilih
            if(mysqli_num_rows($sql) == 0){
                header("Location: index.php");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            if(isset($_POST['save'])){ // jika tombol 'Simpan' dengan properti name="save" pada baris 162 ditekan
                $nim		     = $_POST['nim'];
                $nama		     = $_POST['nama'];
                $foto            = $_POST['foto'];
                $jenis_kelamin   = $_POST['jenis_kelamin'];
                $tempat_lahir	 = $_POST['tempat_lahir'];
                $tanggal_lahir	 = $_POST['tanggal_lahir'];
                $alamat_asal     = $_POST['alamat_asal'];
                $alamat_sekarang = $_POST['alamat_sekarang'];
                $no_telepon      = $_POST['no_telepon'];
                $prodi  	     = $_POST['prodi'];

                $update = mysqli_query($koneksi, "UPDATE mahasiswa SET nama='$nama', foto='$foto', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat_asal='$alamat_asal', alamat_sekarang='$alamat_sekarang', no_telepon='$no_telepon', prodi='$prodi' WHERE nim='$nim'") or die(mysqli_error()); // query untuk mengupdate nilai entri dalam database
                if($update){ // jika query update berhasil dieksekusi
                    header("Location: edit.php?nim=".$nim."&pesan=sukses"); // tambahkan pesan=sukses pada url
                }else{ // jika query update gagal dieksekusi
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; // maka tampilkan 'Data gagal disimpan, silahkan coba lagi.'
                }
            }

            if(isset($_GET['pesan']) == 'sukses'){ // jika terdapat pesan=sukses sebagai bagian dari berhasilnya query update dieksekusi
                echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="data.php"><- Kembali</a></div>'; // maka tampilkan 'Data berhasil disimpan.'
            }
            ?>
            <!-- bagian ini merupakan bagian form untuk mengupdate data yang akan dimasukkan ke database -->
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">nim</label>
                    <div class="col-sm-2">
                        <input type="text" name="nim" value="<?php echo $row ['nim']; ?>" class="form-control" placeholder="nim" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-4">
                        <input type="text" name="nama" value="<?php echo $row ['nama']; ?>" class="form-control" placeholder="Nama" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Foto Sekarang</label>
                    <div class="col-sm-2">
                        <?php echo '<img src="img/' . $row['foto'] . '" style="width: 86px; height:115px">'; ?>
                    </div>
                    <div class="col-sm-3">
                        <b>Ganti Foto (3x4 cm) :</b> <input type="file" name="foto" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Kelamin</label>
                    <div class="col-sm-2">
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value=""> - Jenis Kelamin - </option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tempat Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" name="tempat_lahir" value="<?php echo $row ['tempat_lahir']; ?>" class="form-control" placeholder="Tempat Lahir" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Lahir</label>
                    <div class="col-sm-4">
                        <input type="text" name="tanggal_lahir" value="<?php echo $row ['tanggal_lahir']; ?>" class="input-group datepicker form-control" date="" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat Asal</label>
                    <div class="col-sm-3">
                        <textarea name="alamat_asal" class="form-control" placeholder="Alamat Asal"><?php echo $row ['alamat_asal']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat Sekarang</label>
                    <div class="col-sm-3">
                        <textarea name="alamat_sekarang" class="form-control" placeholder="Alamat Sekarang"><?php echo $row ['alamat_sekarang']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Telepon</label>
                    <div class="col-sm-3">
                        <input type="text" name="no_telepon" value="<?php echo $row ['no_telepon']; ?>" class="form-control" placeholder="No Telepon" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Prodi</label>
                    <div class="col-sm-2">
                        <select name="prodi" class="form-control" required>
                            <option value=""> - Prodi Terbaru - </option>
                            <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                            <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                            <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                            <option value="S1 Pendidikan Teknologi Informasi">S1 Pendidikan Teknologi Informasi</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <b>Prodi Sekarang :</b> <span class="label label-success"><?php echo $row['prodi']; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Mahasiswa">
                        <a href="data.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
                    </div>
                </div>
            </form>
        </div> <!-- /.content -->
    </div> <!-- /.container -->
<?php
include("footer.php"); // memanggil file footer.php
?>