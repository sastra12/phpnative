<?php
//koneksi ke database
$conn= mysqli_connect("localhost","root","","projectweb");

function query($query){
  global $conn;
  $hasil = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($hasil)) {
    $rows []= $row;
  }
  return $rows;
}

function tambahdata($data){
  global $conn;
  // ambil data dari elemen form
  $nmbarang = htmlspecialchars($data["namabarang"]);
  $jnsbarang = htmlspecialchars($data["jenisbarang"]);
  $hrgmodal = htmlspecialchars($data["hargamodal"]);
  $hrgjual = htmlspecialchars($data["hargajual"]);
  $stok = htmlspecialchars($data["stok"]);
  //insert data ke database
  $query= "INSERT INTO barang VALUES
          ('','$nmbarang','$jnsbarang','$hrgmodal',
            '$hrgjual','$stok')";
  mysqli_query($conn,$query);
  return mysqli_affected_rows($conn);
}

function registrasi($data){
  global $conn;

  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn,$data["password"]);
  $password1 = mysqli_real_escape_string($conn,$data["password1"]);

  //cek username sudah ada apa belum
  $hasil=mysqli_query($conn,"SELECT username FROM users WHERE username = '$username'");
  if(mysqli_fetch_assoc($hasil)){
    echo "<script>alert('Username yang di masukan sudah ada')</script>";
    //supaya insertnya gagal
    return false;
  }

  //cek konfirmasi password1
  if ($password !== $password1) {
    echo "<script>
        alert('Konfirmasi Password keliru')
      </script>";
  return false;
  }
  // enskripsi password (ditimpa)
  $password = password_hash($password, PASSWORD_DEFAULT);
  // tambahakan ke database
  mysqli_query($conn, "INSERT INTO users VALUES('','$username','$password')");

  // untuk menghasilkan angka 1 jika berhasil dan angka -1 jika gagal
  return mysqli_affected_rows($conn);
}

function hapusdata($id){
  global $conn;
  mysqli_query($conn, "DELETE FROM barang WHERE idbarang  = $id");
  return mysqli_affected_rows($conn);
}

function ubah($data){
  global $conn;
  $idbarang = $data["idbarang"];
  $nmbarang = htmlspecialchars($data["namabarang"]);
  $jnsbarang =htmlspecialchars($data["jenisbarang"]);
  $hrgmodal =htmlspecialchars($data["hargamodal"]);
  $hrgjual  =htmlspecialchars($data["hargajual"]);
  $stok = htmlspecialchars($data["stok"]);

  // query insert data
  $query= "UPDATE barang SET
          namabarang='$nmbarang',
          jenisbarang='$jnsbarang',
          hargamodal='$hrgmodal',
          hargajual='$hrgjual',
          stok='$stok'
          WHERE idbarang = $idbarang";
  mysqli_query($conn,$query);
  return mysqli_affected_rows($conn);
}

function hapushistoryjual($id){
  global $conn;
  mysqli_query($conn,"DELETE FROM jualsatuan WHERE idjual=$id");
  return mysqli_affected_rows($conn);
}

function cari($keyword){
  global $conn;
  $cari = "SELECT * FROM barang
            WHERE namabarang LIKE '%$keyword%'
            ";
  return query($cari);
}

?>
