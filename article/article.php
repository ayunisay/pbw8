<?php
include 'koneksi.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="#">My Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./article/article.php">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <?php
                    if (isset($_GET['message'])) {
                        $message = $_GET['message'];
                ?>
                    <div class="alert alert-success my-4"><?= $message ?></div>
                <?php
                    }
                ?>
                <div class="card border-0">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h2>List Articles</h2>

                            <!-- // Ganti isi dari href dengan URL yang sesuai untuk menambahkan artikel (add) -->
                            <a href="add.php" class="btn btn-primary">Add Article</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Category</th>
                                    <th>Thumbnail</th>
                                    <th>Act</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $query = mysqli_query($koneksi, "SELECT * FROM articles");
                                    foreach ($query as $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['title'] ?></td>
                                        <td><?= $data['content'] ?></td>
                                        <td><?= $data['category'] ?></td>
                                        <td>

                                        <img src="images/<?= $data['thumbnail'] ?>" class="img-fluid img-
                                        thumbnail w-25 h-auto">
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                            <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-warning">Edit</a>
                                            <a href="delete.php?id=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>

                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>