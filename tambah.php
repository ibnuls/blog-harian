<?php
include 'config.php';

if(isset($_POST['submit'])){
  $judul=$_POST['judul']; 
  $isi=$_POST['isi'];
  $g=$_FILES['gambar']['name']; 
  $t=$_FILES['gambar']['tmp_name'];

  if($g){
    move_uploaded_file($t,"uploads/$g");
    mysqli_query($conn,"INSERT INTO posts(judul,isi,gambar) VALUES('$judul','$isi','$g')");
  } else {
    mysqli_query($conn,"INSERT INTO posts(judul,isi) VALUES('$judul','$isi')");
  }

  header("Location:index.php"); exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tulis Blog</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body{background:#0f172a;color:white;font-family:Poppins,sans-serif;}
  .card-dark{background:#1e293b;border:none;border-radius:18px;}
  .form-control{background:#0f172a;color:white;border:1px solid #334155;}
  .form-control::placeholder{color:#94a3b8;}
</style>
</head>

<body class="container d-flex justify-content-center align-items-center min-vh-100">

<div class="col-md-6">
  <div class="card card-dark p-4 shadow-lg">

    <h4 class="mb-3 fw-bold">✍️ Tulis Blog</h4>

    <form method="post" enctype="multipart/form-data">
      <input class="form-control mb-3" name="judul" placeholder="Judul..." required>
      <textarea class="form-control mb-3" rows="5" name="isi" placeholder="Isi blog..." required></textarea>
      <input type="file" class="form-control mb-3" name="gambar">

      <div class="d-flex justify-content-between">
        <a href="index.php" class="btn btn-secondary btn-sm">←</a>
        <button class="btn btn-primary btn-sm" name="submit">Publish</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>

