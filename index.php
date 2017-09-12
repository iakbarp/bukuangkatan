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
            <div class="jumbotron">
                <h1 style="font-size: 52px">Mahasiswa Informatika 2015</h1>
                <p>MIM Mafaza (15050623002)</p>
                <p>Muhammad Saiful Rokhim (15050623004)</p>
                <a href="data.php" data-toggle="tooltip" title="Lihat Data Mahasiswa" class="ui-btn ui-btn-inline ui-shadow "role="button"><span class="glyphicon glyphicon-user"></span> Data Mahasiswa</a>
                <a href="tambah.php" data-toggle="tooltip" title="Tambah Data Mahasiswa" class="ui-btn ui-btn-inline ui-shadow ui-icon-grid ui-btn-icon-left" role="button"> Tambah Data</a>
            </div> <!-- /.jumbotron -->
        </div> <!-- /.content -->
    </div>

    <div data-role="footer">
        <?php
        include("footer.php"); // memanggil file footer.php
        ?>
    </div>
</div>

</body>
</html>

