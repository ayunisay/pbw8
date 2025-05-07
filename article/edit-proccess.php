<?php
include 'koneksi.php';


// Ini akan mengecek apakah ada data yang dikirimkan melalui metode POST itu ada
if (isset($_POST['edit'])) {
    $title = $_POST['title'];
    $id = $_POST['id'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $thumbnail = $_POST['thumbnail'];
    $extension_allowed = array('png', 'jpg');
    $name = $_FILES['thumbnail']['name'];
    $x = explode('.', $name);
    $extension = strtolower(end($x));
    $size = $_FILES['thumbnail']['size'];
    $file_tmp = $_FILES['thumbnail']['tmp_name'];

    // Ini adalah bagian untuk memproses upload file
    // Jika ekstensi file yang diupload adalah png atau jpg
    // maka akan diproses

    if (in_array($extension, $extension_allowed) === true) {
        // Jika ukuran file kurang dari 1MB maka akan diproses
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, 'images/' . $name);
            $query = mysqli_query($koneksi, "UPDATE articles SET title='$title', content='$content', category='$category', thumbnail='$name' WHERE id='$id'");
            if ($query) {
                $message = "Data berhasil diubah";
                $message = urlencode($message);
                header("Location:article.php?message={$message}");

                // Jika query gagal maka akan menampilkan pesan gagal
            } else {
                $message = "Data gagal diubah";
                $message = urlencode($message);
                header("Location:add.php?message={$message}");
            }
            // Jika ukuran file lebih dari 1MB maka akan ditolak
        } else {
            $message = "Ukuran File Terlalu Besar";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");
        }
        // Jika kedua kondisi di atas tidak terpenuhi maka akan menampilkan pesan error seperti ini
    } else {
        $query = mysqli_query($koneksi, "UPDATE articles SET title='$title', content='$content', category='$category' WHERE id='$id'");
        if ($query) {
            $message = "Data berhasil diubah";
            $message = urlencode($message);
            header("Location:article.php?message={$message}");
        } else {
            $message = "Data gagal diubah";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");
        }
    }
}