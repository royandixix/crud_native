<?php

include 'koneksi.php';
session_start();

$query =  "SELECT * FROM tb_siswa";
$sql =  mysqli_query($conn, $query);
$no = 0;

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-xxz27z3bZRnXvtw4z5473KVc2jUy6an7QpfYov3+9kXNYoayng1oyRvJWNL9z+Kt" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

<body>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid d-flex justify-content-center">
            <a class="navbar-brand" href="#">
                Selamat Datang Admin
            </a>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-3 fs-3">Data PC.Central Mamuju </h1>
        <figure>
            <blockquote class="blockquote">
                <p>Berisi data Pekerja</p>
            </blockquote>
            <figure>
                <figcaption class="blockquote-footer mb-4"> <!-- Menambahkan margin bottom -->
                    Penambahan Data <cite title="Source Title"> <!-- CREATE READ UPDATE DELETE --></cite>
                </figcaption>
            </figure>

            <a href="kelola.php" type="button" class="btn btn-primary mb-4"> <!-- Menambahkan margin bottom -->
                <i class="fa fa-plus"></i>
                Tambah Data
            </a>
            <?php
                if(isset($_SESSION['eksekusi'])):
            ?>
                <div class="alert alert-info alert-dismissible fade show mb-4" role="alert"> <!-- Menambahkan margin bottom -->
                    <strong>
                        <?php echo $_SESSION['eksekusi']; ?>
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php 
                session_destroy();
                endif;  
            ?>

            <div class="table-responsive mt-4">
                <table class="table align-middle table-bordered table-hover" style="text-align: center;">
                    <thead>
                        <tr class="color_1">
                            <th>No.</th>
                            <th>NISN</th>
                            <th>Nama </th>
                            <th>Jenis Kelamin</th>
                            <th>Foto </th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1; // Inisialisasi nomor urutan
                        while ($result = mysqli_fetch_assoc($sql)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $counter; ?>. <!-- Nomor urutan -->
                                </td>
                                <td><?php echo $result['nisn']; ?></td>
                                <td><?php echo $result['nama_siswa']; ?></td>
                                <td><?php echo $result['jenis_kelamin']; ?></td>
                                <td><img src="img/<?php echo $result['foto_siswa']; ?>" style="width: 50px;"></td>
                                <td><?php echo $result['alamat']; ?></td>

                                <td>
                                    <a href="kelola.php?ubah=<?php echo $result['id_siswa']; ?>" type="button" class="btn btn-success btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="proses.php?hapus=<?php echo $result['id_siswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                            <tr class="align-bottom"></tr>
                        <?php
                            $counter++; // Tingkatkan nomor urutan
                        }
                        ?>
                    </tbody>


                </table>
            </div>

    </div>



    <!-- Sisipkan skrip JavaScript Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>