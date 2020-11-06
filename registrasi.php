<?php
require 'functions.php';
if (isset($_POST["register"])) {
  // code...
  if (registrasi($_POST)>0) {
    echo "<script>
          alert('User baru berhasil ditambahkan')
          </script>";
  }
  else{
      echo mysqli_error($conn);
  }
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Halaman Login</title>
    <style media="screen">
      label{
        display: block;
      }
    </style>
  </head>
  <body>
    <h1>Halaman Registrasi</h1>
    <form class="" action="" method="post">
      <ul>
        <li>
          <label for="username">Username</label>
          <input type="text" name="username" value="" id="username">
        </li>
        <li>
          <label for="password">Password</label>
          <input type="password" name="password" value="" id="password">
        </li>
        <li>
          <label for="password1">Konfirmasi Password</label>
          <input type="password" name="password1" value="" id="password1">
        </li>
        <li>
          <button type="submit" name="register">Sign Up</button>
        </li>
      </ul>
    </form>
  </body>
</html>
