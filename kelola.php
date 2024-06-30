<!doctype html>
<?php

include "koneksi.php";
session_start();



$id_siswa = '';
$nisn = '';
$nama_siswa = '';
$jenis_kelamin = '';
$alamat = '';

if (isset($_GET['ubah'])) {
    $id_siswa = $_GET['ubah'];
    $query = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa';";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);
    $nisn = $result['nisn'];
    $nama_siswa = $result['nama_siswa'];
    $jenis_kelamin = $result['jenis_kelamin'];
    $alamat = $result['alamat'];
}

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-xxz27z3bZRnXvtw4z5473KVc2jUy6an7QpfYov3+9kXNYoayng1oyRvJWNL9z+Kt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav class="navbar bg-body-tertiary mb-5">
        <div class="container-fluid d-flex justify-content-center">
            <a class="navbar-brand" href="#">
                Selamat Datang Admin
            </a>
        </div>
    </nav>

    <div class="container">
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $id_siswa; ?>" name="id_siswa">
            <div class="mb-3 row">
                <label for="nisn" class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-10">
                    <input required type="number" name="nisn" class="form-control" id="nisn" placeholder="Masukan NISN Anda" value="<?php echo $nisn; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="nama_siswa" class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input required type="text" name="nama_siswa" class="form-control" id="nama_siswa" placeholder="Masukan Nama Anda" value="<?php echo $nama_siswa; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select required id="jenis_kelamin" name="jenis_kelamin" class="form-select">
                        <option value="" <?php if (empty($jenis_kelamin)) echo "selected"; ?>>Jenis Kelamin</option>
                        <option value="Laki-Laki" <?php if ($jenis_kelamin == 'Laki-Laki') echo "selected"; ?>>Laki-Laki</option>
                        <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo "selected"; ?>>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="foto" class="col-sm-2 col-form-label">Foto Siswa</label>
                <div class="col-sm-10">
                    <input <?php if (!isset($_GET['ubah'])) {
                                echo "required";
                            } ?> class="form-control" type="file" name="foto" id="foto" accept="image/png, image/jpeg">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea required class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukan alamat Anda"><?php echo $alamat ; ?></textarea>
                </div>
            </div>


            <div class="mb-3 row mt-5">
                <div class="col">
                    <?php if (isset($_GET['ubah'])) { ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            Simpan Perubahan
                        </button>
                    <?php } else { ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary">
                            <i class="fa fa-address-book" aria-hidden="true"></i>
                            Tambahkan
                        </button>
                    <?php } ?>

                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Sisipkan skrip JavaScript Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>

</html>