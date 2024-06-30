<?php

include 'koneksi.php';
function tambah_data($data, $files)
{
    global $conn;
    // echo "tambah data ";
    // die();
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $split = explode(',',$files['foto']['name']);
    $ekstensi =  $split[count($split)-1];
    $foto = $nisn.'.'.$ekstensi;
    $alamat = $data['alamat'];
    // Tangani upload file
    $dir = "img/";
    $tmpFILE = $files['foto']['tmp_name'];
    move_uploaded_file($tmpFILE, $dir . $foto);
    // Masukkan data ke dalam database
    $query = "INSERT INTO tb_siswa (nisn, nama_siswa, jenis_kelamin, foto_siswa, alamat) VALUES ('$nisn', '$nama_siswa', '$jenis_kelamin', '$foto', '$alamat')";
    // $sql = mysqli_query($conn, $query);
    $sql = mysqli_query($GLOBALS['conn'], $query);
    return true;
}

function edit_data($data, $files)
{
    global $conn;
    $id_siswa = $data['id_siswa'];
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $jenis_kelamin = $data['jenis_kelamin'];
    $alamat = $data['alamat'];

    // Ambil data yang ada
    $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    // Tangani upload file
    if ($files['foto']['name'] == "") {
        $foto = $result['foto_siswa'];
    } else {
        $split = explode('.',$files['foto']['name']);
        $ekstensi = $split[count($split)-1];
        $foto = $result['nisn'].'.'.$ekstensi;

        $foto = $files['foto']['name'];
        unlink("img/" . $result['foto_siswa']);
        move_uploaded_file($files['foto']['tmp_name'], 'img/' .$foto);
    }
    // Perbarui data di dalam database
    $query = "UPDATE tb_siswa SET nisn='$nisn', nama_siswa='$nama_siswa', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto_siswa='$foto' WHERE id_siswa='$id_siswa'";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}
function hapus_data($data){
    global $conn;
    $id_siswa = $data['hapus'];
    $queryShow = "SELECT * FROM tb_siswa WHERE id_siswa = '$id_siswa'";
    $sqlShow = mysqli_query($conn, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    if ($result) {
        unlink("img/" . $result['foto_siswa']);
        // Hapus data dari database
        $query = "DELETE FROM tb_siswa WHERE id_siswa = '$id_siswa'";
        $sql = mysqli_query($GLOBALS['conn'], $query);  
        return true;
    }
}