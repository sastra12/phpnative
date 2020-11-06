<?php
session_start();
if (!isset($_SESSION["login2"])) {
  // code...
  header("Location: loginA.php");
  exit;
}
require 'functions.php';
$nmbarang = $_POST["namabarang"];
$jmlbarang = $_POST["jmlbarang"];
$jmlbayar = $_POST["jmlbayar"];


$view = mysqli_query($conn,"SELECT * FROM barang WHERE idbarang='$nmbarang'");
$result = mysqli_fetch_assoc($view);
if ($jmlbarang<= $result["stok"]) {
  if ($jmlbayar>= $result["hargajual"]) {
    $tmbah= mysqli_query($conn,"INSERT INTO
    jualsatuan SET
    idbarang= '$nmbarang',
    hargajual='$result[hargajual]',
    jumlah='$jmlbarang',
    nominalbayar='$jmlbayar',
    totaljual='$jmlbarang*$jmlbayar',
    tanggal= DATE(now())");
    if ($tmbah) {
      mysqli_query($conn, "UPDATE barang SET stok=stok-$jmlbarang where idbarang='$nmbarang' ");
      echo "<script>alert('proses penjualan anda berhasil');document.location.href='tabel.php';</script>";
    }
    else {
      echo "<script>alert('proses penjualan anda gagal');document.location.href='tabel.php';</script>";
    }
  }else {
    echo "<script>alert('nominal anda tidak cukup');document.location.href='tabel.php';</script>";
  }
}else {
  echo "<script>alert('stok tidak cukup');document.location.href='tabel.php';</script>";
}
 ?>
