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
        <h1>Profil Mahasiswa</h1>
    </div>
    <div class="container">
        <div class="content">
            <h2>Data Mahasiswa &raquo; Profile</h2>
            <hr />

            <?php
                $nim = $_GET['nim']; // mengambil data nim dari nim yang terpilih

            $sql = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'"); // query memilih entri nim pada database
            if(mysqli_num_rows($sql) == 0){
                header("Location: index.php");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }

            if(isset($_GET['aksi']) == 'delete'){ // jika tombol 'Hapus Data' pada baris 87 ditekan
                $delete = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'"); // query delete entri dengan nim terpilih
                if($delete){ // jika query delete berhasil dieksekusi
                    echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>'; // maka tampilkan 'Data berhasil dihapus.'
                }else{ // jika query delete gagal dieksekusi
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>'; // maka tampilkan 'Data gagal dihapus.'
                }
            }
            ?>
            <!-- bagian ini digunakan untuk menampilkan data mahasiswa -->
            <table class="table table-striped table-condensed">
                <tr>
                    <th width="20%">NIM</th>
                    <td><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <th>Nama mahasiswa</th>
                    <td><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td><img src="img/<?php echo $row['foto']; ?>" style="width: 86px; height:115px"></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <th>Tempat & Tanggal Lahir</th>
                    <td><?php echo $row['tempat_lahir'].', '.$row['tanggal_lahir']; ?></td>
                </tr>
                <tr>
                    <th>Alamat Asal</th>
                    <td><?php echo $row['alamat_asal']; ?></td>
                </tr>
                <tr>
                    <th>Alamat Sekarang</th>
                    <td><?php echo $row['alamat_sekarang']; ?></td>
                </tr>
                <tr>
                    <th>No Telepon</th>
                    <td><?php echo $row['no_telepon']; ?></td>
                </tr>
                <tr>
                    <th>Prodi</th>
                    <td><?php echo $row['prodi']; ?></td>
                </tr>


            </table>

            <a href="data.php" class="ui-btn ui-btn-inline ui-shadow ui-icon-back ui-btn-icon-left ui-mini"><span aria-hidden="true"></span> Kembali</a>
            <a href="edit.php?nim=<?php echo $row['nim']; ?>" class="ui-btn ui-btn-inline ui-shadow ui-mini ui-icon-edit ui-btn-icon-left"><span aria-hidden="true"></span> Edit Data</a>
            <a href="#myPopupDialog" data-rel="popup" class="ui-btn ui-btn-inline ui-shadow ui-icon-delete ui-btn-icon-left ui-mini ui-corner-all ui-mini" data-transition="pop" data-position-to="window">Hapus Data</a>
            <div data-role="popup" id="myPopupDialog" data-overlay-theme="b" align="">

                <div data-role="main" class="ui-content" >
                    <p>Anda yakin akan mengahapus data <?php echo $row['nama']; ?>?</p>
                    <center>
                    <a href="profile.php?aksi=delete&nim=<?php echo $row['nim']; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left">YA</a>
                    <a href="#myPopupDialog" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left">TIDAK</a>
                    </center>
                </div>
                </div>
        </div> <!-- /.content -->
    </div> <!-- /.container -->
    </div>
</body>
    <div data-role="footer">
        <?php
        include("footer.php"); // memanggil file footer.php
        ?>
    </div>
</html>
