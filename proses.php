<?php
include 'fungsi.php';
session_start();        
if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == "add") {
        // Tangani data dari form
        $berhasil = tambah_data($_POST, $_FILES);
        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Ditambakan";
            header("Location: index.php");
        } else {
            echo "$berhasil";
            // echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else if ($_POST['aksi'] == "edit") {
        $berhasil = edit_data($_POST, $_FILES);
        if ($berhasil) {
            $_SESSION['eksekusi'] = "Data Berhasil Di Perbarui";
            header("Location: index.php");
        } else {
            // echo "Error: " . $query . "<br>" . mysqli_error($conn);
            echo "$berhasil";
        }
    }
}
if (isset($_GET['hapus'])) {
    $berhasil = hapus_data($_GET);
    if ($berhasil) {
        $_SESSION['eksekusi'] = "Data Berhasil Di Hapus";
        header("Location: index.php");
    } else {
        // echo "Error: " . $query . "<br>" . mysqli_error($conn)
        echo "$berhasil";
    }
}
