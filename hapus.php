<?php
session_start();
if (!isset($_SESSION["login2"])) {
  // code...
  header("Location: loginA.php");
  exit;
}
require 'functions.php';
$id = $_GET["idbarang"];

if(hapusdata($id)>0){
  echo "<script>
  alert('Data berhasil dihapus');
  document.location.href='index.php';
  </script>";
  }
else {
  echo "
    <script>
    alert('Data tidak berhasil dihapus');
    document.location.href='index.php';
    </script>";
}
 ?>
