<?php
$host = "localhost"; // server
$user = "root"; // username
$pass = ""; // password
$database = "angkatan"; // nama database

$koneksi = mysqli_connect($host, $user, $pass, $database); // menggunakan mysqli_connect

if(mysqli_connect_errno()){ // mengecek apakah koneksi database error
    echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error(); // pesan ketika koneksi database error
}
?>
<script>
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
    })
</script>
</body>
</html>
