<?php
include 'koneksi.php';
if (isset($_POST['add'])) {

    // Ini adalah bagian untuk menambahkan artikel ke database
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $thumbnail = $_POST['thumbnail'];
    $extension_allowed = array('png', 'jpg', 'jpeg');
    $name = $_FILES['thumbnail']['name'];
    $x = explode('.', $name);
    $extension = strtolower(end($x));
    $size = $_FILES['thumbnail']['size'];
    $file_tmp = $_FILES['thumbnail']['tmp_name'];

    // Ini adalah bagian untuk memproses upload file
    if (in_array($extension, $extension_allowed) === true) {

        // Jika ukuran file kurang dari 1MB maka akan diproses
        if ($ukuran < 1044070) {
            // Memindahkan file sementara ke folder images
            move_uploaded_file($file_tmp, 'images/' . $name);

            // Menyimpan data ke database
            $query = mysqli_query($koneksi, "INSERT INTO articles VALUES(NULL, '$title','$content','$category','$name')");

            // Jika query berhasil maka akan menampilkan pesan berhasil
            if ($query) {
                $message = "Data berhasil ditambahkan";
                $message = urlencode($message);
                header("Location:article.php?message={$message}");
            }
            // Jika query gagal maka akan menampilkan pesan gagal
            else {
                $message = "Data gagal ditambahkan";
                $message = urlencode($message);
                header("Location:add.php?message={$message}");
            }
        }

        // Jika ukuran file lebih dari 1MB maka akan ditolak
        else if ($ukuran > 1044070) {
            $message = "Ukuran File Terlalu Besar";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");

            // Jika kedua kondisi di atas tidak terpenuhi maka akan menampilkan pesan error seperti ini
        } else {
            $message = "Ukuran File Terlalu Besar";
            $message = urlencode($message);
            header("Location:add.php?message={$message}");
        }
    }

    // Jika ekstensi file tidak diperbolehkan maka akan menampilkan pesan error seperti ini
    // Ekstensi yang diperbolehkan adalah png dan jpg
    else {
        $message = "Extension tidak diperbolehkan";
        $message = urlencode($message);
        header("Location:add.php?message={$message}");
    }
}
?>