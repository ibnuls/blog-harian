<?php
include 'config.php';

$id=intval($_GET['id']);
$q=mysqli_query($conn,"SELECT * FROM posts WHERE id=$id");
$d=mysqli_fetch_assoc($q);
if(!$d) die("404 Not Found");

if(isset($_POST['submit'])){
  $judul=$_POST['judul']; 
  $isi=$_POST['isi'];
  $g=$_FILES['gambar']['name']; 
  $t=$_FILES['gambar']['tmp_name'];

  if($g){
    move_uploaded_file($t,"uploads/$g");
    mysqli_query($conn,"UPDATE posts SET judul='$judul',isi='$isi',gambar='$g' WHERE id=$id");
  } else {
    mysqli_query($conn,"UPDATE posts SET judul='$judul',isi='$isi' WHERE id=$id");
  }
  header("Location:index.php"); exit();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Edit Blog</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
  body{background:#0f172a;color:white;font-family:Poppins,sans-serif;}
  .card-dark{background:#1e293b;border:none;border-radius:18px;}
  .form-control{background:#0f172a;color:white;border:1px solid #334155;}
  .form-control::placeholder{color:#94a3b8;}
  img{border-radius:12px;max-height:180px;}
</style>
</head>

<body class="container d-flex justify-content-center align-items-center min-vh-100">

<div class="col-md-6">
  <div class="card card-dark p-4 shadow-lg">

    <h4 class="mb-3 fw-bold">✏️ Edit Blog</h4>

    <form method="post" enctype="multipart/form-data">
      <input class="form-control mb-3" name="judul" value="<?= $d['judul'] ?>" required>
      <textarea class="form-control mb-3" rows="5" name="isi" required><?= $d['isi'] ?></textarea>

      <?php if($d['gambar']) { ?>
          <img src="uploads/<?= $d['gambar'] ?>" class="mb-3 w-100">
      <?php } ?>

      <input type="file" class="form-control mb-3" name="gambar">

      <div class="d-flex justify-content-between">
        <a href="index.php" class="btn btn-secondary btn-sm">←</a>
        <button class="btn btn-warning btn-sm" name="submit">Update</button>
      </div>
    </form>

  </div>
</div>

</body>
</html>
