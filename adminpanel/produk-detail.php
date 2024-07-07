<?php 
  require "session.php";
  require "../koneksi.php";

  $id = $_GET['p'];

  $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
  $data = mysqli_fetch_array($query);

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

  function generateRandomString($length = 10) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters); 
    $randomString = ''; 
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    } 
    return $randomString;  
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
.foto label {
  font-weight: 700;
}
</style>

<body>
  <?php require "navbar.php"; ?>

  <div class="container mt-5">
    <h2>Detail Produk</h2>

    <div class="col-12 col-md-6">
      <form action="" method="post" enctype="multipart/form-data" class="mb-5">
        <div class="mb-4">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars(trim($data['nama'])); ?>"
            class="form-control" autocomplete="off" required>
        </div>
        <div class="mb-4">
          <label for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-control" required>
            <option value="<?php echo htmlspecialchars($data['kategori_id']); ?>">
              <?php echo htmlspecialchars($data['nama_kategori']); ?></option>
            <?php while ($dataKategori = mysqli_fetch_array($queryKategori)) { ?>
            <option value="<?php echo htmlspecialchars($dataKategori['id']); ?>">
              <?php echo htmlspecialchars($dataKategori['nama']); ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="harga">Harga</label>
          <input type="number" class="form-control" value="<?php echo htmlspecialchars($data['harga']); ?>" name="harga"
            id="harga" required>
        </div>
        <div class="mb-3 mt-3 foto">
          <label for="currentFoto">Foto Produk Sekarang</label>
          <br>
          <img src="../image/<?php echo htmlspecialchars($data['foto']); ?>" alt="" width="200px">
        </div>
        <div class="mb-4 foto">
          <label for="foto">Upload Foto Baru : </label>
          <input type="file" name="foto" id="foto">
        </div>
        <div class="mb-4">
          <label for="detail">Detail</label>
          <textarea name="detail" id="detail" cols="30" rows="10"
            class="form-control"><?php echo htmlspecialchars(trim($data['detail'])); ?></textarea>
        </div>
        <div class="mb-4">
          <label for="ketersediaan_stok">Ketersediaan Stok</label>
          <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control" required>
            <option value="<?php echo htmlspecialchars($data['ketersediaan_stok']); ?>">
              <?php echo htmlspecialchars($data['ketersediaan_stok']); ?></option>
            <?php if ($data['ketersediaan_stok'] == 'tersedia') { ?>
            <option value="habis">Habis</option>
            <?php } else { ?>
            <option value="tersedia">Tersedia</option>
            <?php } ?>
          </select>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-primary" name="simpan">Simpan Perubahan</button>
          <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
        </div>
      </form>

      <?php
      if (isset($_POST['simpan'])) {
        $nama = htmlspecialchars(trim($_POST['nama']));
        $kategori = htmlspecialchars(trim($_POST['kategori']));
        $harga = htmlspecialchars(trim($_POST['harga']));
        $detail = htmlspecialchars(trim($_POST['detail']));
        $ketersediaan_stok = htmlspecialchars(trim($_POST['ketersediaan_stok']));

        // FOTO 
        $target_dir = "../image/";
        $nama_file = basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $nama_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image_size = $_FILES["foto"]["size"];
        $random_name = generateRandomString(20);
        $new_name = $random_name . "." . $imageFileType;

        if ($nama == '' || $kategori == '' || $harga == '') {
          echo '<div class="alert alert-danger mt-3" role="alert">Nama, Kategori, & Harga Wajib Diisi!!</div>';
        } else {
          $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id=$id");

          if ($nama_file != '') {
            if ($image_size > 500000) {
              echo '<div class="alert alert-warning mt-3" role="alert">File Tidak boleh lebih dari 500kb!!</div>';
            } else {
              if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                echo '<div class="alert alert-warning mt-3" role="alert">Upload file yang bertipe png, jpeg, dan jpg!!</div>';
              } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name)) {
                  $queryUpdate = mysqli_query($con, "UPDATE produk SET foto='$new_name' WHERE id='$id'");
                  if ($queryUpdate) {
                    echo '<div class="alert alert-success mt-3" role="alert">Produk berhasil diUpdate!</div>';
                    echo '<meta http-equiv="refresh" content="2; url=produk.php" />';
                  } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">Gagal mengupdate produk!</div>';
                  }
                } else {
                  echo '<div class="alert alert-danger mt-3" role="alert">Gagal mengupload gambar!</div>';
                }
              }
            }
          } else {
            if ($queryUpdate) {
              echo '<div class="alert alert-success mt-3" role="alert">Produk berhasil diUpdate!</div>';
              echo '<meta http-equiv="refresh" content="2; url=produk.php" />';
            } else {
              echo '<div class="alert alert-danger mt-3" role="alert">Gagal mengupdate produk!</div>';
            }
          }
        }
      }
      
      if(isset($_POST['hapus'])){
        $queryHapus = mysqli_query( $con,"DELETE FROM produk WHERE id='$id'");

        if($queryHapus){
          ?>
      <div class="alert alert-primary mt-3" role="alert">
        Produk berhasil dihapus!
      </div>

      <meta http-equiv="refresh" content="1 ; url=produk.php" />
      <?php
        }
      }
      
      ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
</body>

</html>