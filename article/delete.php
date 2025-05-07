<?php

// ini akan mengecek apakah ada data yang dikirimkan melalui metode GET itu ada
// jika ada maka akan diambil id dari data yang dikirimkan
if (isset($_GET['id'])) {
    include "koneksi.php";
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "DELETE FROM articles WHERE id='$id'");

    // ini adalah bagian untuk menghapus data dari database
    // jika query berhasil maka akan menampilkan pesan berhasil
    if ($query) {
        $message = "Data berhasil dihapus";
        $message = urlencode($message);
        header("Location:article.php?message={$message}");

        // jika query gagal maka akan menampilkan pesan gagal
    } else {
        $message = "Data gagal dihapus";
        $message = urlencode($message);
        header("Location:add.php?message={$message}");
    }
}
?>