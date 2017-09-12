<?php
include("header.php"); // memanggil file header.php
include("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
?>
    <!DOCTYPE html>
    <html>
    <head>
    <!-- Include meta tag to ensure proper rendering and touch zooming -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include jQuery Mobile stylesheets -->
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <!-- Include the jQuery library -->

    <!-- Include the jQuery Mobile library -->
    <script src="js/jquery.mobile-1.4.5.min.js"></script>
    </head>
    <body>
    <div data-role="page" id="pageone">
        <div data-role="header">
            <h1>Buku Angkatan 2015</h1>
        </div>
    <div class="container">
        <div class="content">
            <h1>Data Mahasiswa</h1>
            <hr />

            <?php
            if(isset($_GET['aksi']) == 'delete'){ // mengkonfirmasi jika 'aksi' bernilai 'delete' merujuk pada baris 97 dibawah
                $nim = $_GET['nim']; // ambil nilai nim
                $cek = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'"); // query untuk memilih entri dengan nim yang dipilih
                if(mysqli_num_rows($cek) == 0){ // mengecek jika tidak ada entri nim yang dipilih
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; // maka tampilkan 'Data tidak ditemukan.'
                }else{ // mengecek jika terdapat entri nim yang dipilih
                    $delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'"); // query untuk menghapus
                    if($delete){ // jika query delete berhasil dieksekusi
                        echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
                    }else{ // jika query delete gagal dieksekusi
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
                    }
                }
            }
            //pagination
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $per_page = 3;
            // Page will start from 0 and Multiple by Per Page
            $start_from = ($page - 1) * $per_page;
            ?>
            <!-- bagian ini untuk memfilter data berdasarkan fakultas -->
            <form class="form-inline" method="get">
                <div class="form-group">
                    <select name="filter" class="form-control" onchange="form.submit()">
                        <option value="0">Filter Data Mahasiswa</option>
                        <?php $filter = (isset($_GET['filter']) ? strtolower($_GET['filter']) : NULL);  ?>
                        <option value="D3 Manajemen Informatika" <?php if($filter == 'D3 Manajemen Informatika'){ echo 'selected'; } ?>>D3 Manajemen Informatika</option>
                        <option value="S1 Teknik Informatika" <?php if($filter == 'S1 Teknik Informatika'){ echo 'selected'; } ?>>S1 Teknik Informatika</option>
                        <option value="S1 Sistem Informasi" <?php if($filter == 'S1 Sistem Informasi'){ echo 'selected'; } ?>>S1 Sistem Informasi</option>
                        <option value="S1 Pendidikan Teknologi Informasi" <?php if($filter == 'S1 Pendidikan Teknologi Informasi'){ echo 'selected'; } ?>>S1 Pendidikan Teknologi Informasi</option>
                    </select>
                </div>
            </form> <!-- end filter -->
            <br />
            <!-- memulai tabel responsive -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>No Telepon</th>
                        <th>Prodi</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    if($filter){
                        $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE prodi='$filter' ORDER BY nim ASC"); // query jika filter dipilih
                    }else{
                        $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim ASC"); // jika tidak ada filter maka tampilkan semua entri
                    }
                    if(mysqli_num_rows($sql) == 0){
                        echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; // jika tidak ada entri di database maka tampilkan 'Data Tidak Ada.'
                    }else{ // jika terdapat entri maka tampilkan datanya
                        $no = 1; // mewakili data dari nomor 1
                        while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
                            echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['nim'].'</td>
								<td><a href="profile.php?nim='.$row['nim'].'">'.$row['nama'].'</a></td>
								<td><img src="img/' . $row['foto'] . '" style="width: 86px; height:115px"></td>
								<td>'.$row['jenis_kelamin'].'</td>
								<td>'.$row['tempat_lahir'].'</td>
								<td>'.$row['tanggal_lahir'].'</td>
								<td>'.$row['no_telepon'].'</td>
								<td>';
                            if($row['prodi'] == 'D3 Manajemen Informatika'){
                                echo '<span class="label label-success">D3 Manajemen Informatika</span>';
                            }
                            else if ($row['prodi'] == 'S1 Teknik Informatika' ){
                                echo '<span class="label label-success">S1 Teknik Informatika</span>';
                            }
                            else if ($row['prodi'] == 'S1 Sistem Informasi' ){
                                echo '<span class="label label-success">S1 Sistem Informasi</span>';
                            }
                            else if ($row['prodi'] == 'S1 Pendidikan Teknologi Informasi' ){
                                echo '<span class="label label-success">S1 Pendidikan Teknologi Informasi</span>';
                            }
                            echo '
								</td>
								<td>
									<a href="edit.php?nim='.$row['nim'].'" title="Edit Data" data-toggle="tooltip" class="ui-btn ui-shadow ui-corner-all ui-mini"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="data.php?aksi=delete&nim='.$row['nim'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['nama'].'?\')" class="ui-btn ui-shadow ui-corner-all ui-mini"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
                            $no++; // mewakili data kedua dan seterusnya
                        }
                    }
                    ?>
                </table>
            </div> <!-- /.table-responsive -->
        </div> <!-- /.content -->

    </div> <!-- /.container -->
    </body>
<?php
include("footer.php"); // memanggil file footer.php
?>