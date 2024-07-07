<?php 

  require "session.php"; 
  require "../koneksi.php"; 

  $query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id");
  $jumlahProduk = mysqli_num_rows($query);

  $queryKategori = mysqli_query($con, "SELECT * FROM kategori");

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
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <a href="../adminpanel">
            <i class="fa-solid fa-house"></i> Home
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Produk</li>
      </ol>
    </nav>

    <!-- TAMBAH PRODUK -->
    <div class="my-5 col-12 col-md-6">
      <h5 class="mb-3">Tambah Produk</h5>

      <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="nama">Nama</label>
          <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required />
        </div>
        <div class="mb-4">
          <label for="kategori">Kategori</label>
          <select name="kategori" id="kategori" class="form-control" required>
            <option value="">Pilih Satu</option>
            <?php while ($data = mysqli_fetch_array($queryKategori)) { ?>
            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-4">
          <label for="harga">Harga</label>
          <input type="number" class="form-control" name="harga" id="harga" required />
        </div>
        <div class="mb-4">
          <label for="foto">Photo: </label>
          <input type="file" name="foto" id="foto" />
        </div>
        <div class="mb-4">
          <label for="detail">Detail</label>
          <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-4">
          <label for="ketersediaan_stok">Ketersediaan Stok</label>
          <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
            <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
          </select>
        </div>
        <div>
          <button type="submit" class="btn btn-primary" name="simpan">Tambah</button>
        </div>
      </form>
      <?php
      if (isset($_POST['simpan'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $harga = htmlspecialchars($_POST['harga']);
        $detail = htmlspecialchars($_POST['detail']);
        $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

        // FOTO 
        $target_dir = "../image/";
        $nama_file = basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $nama_file;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image_size = $_FILES["foto"]["size"];
        $random_name = generateRandomString(20);
        $new_name = $random_name . "." . $imageFileType;

        if ($nama == '' || $kategori == '' || $harga == '') {
          ?>
      <div class="alert alert-danger mt-3" role="alert">
        Nama, Kategori, & Harga Wajib Diisi!!
      </div>
      <?php
        } else {
          if ($nama_file != '') {
            if ($image_size > 500000) {
              ?>
      <div class="alert alert-warning mt-3" role="alert">
        File Tidak boleh lebih dari 500kb!!
      </div>
      <?php
            } else {
              if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                ?>
      <div class="alert alert-warning mt-3" role="alert">
        Upload file yang bertipe png, jpeg, dan jpg!!
      </div>
      <?php
              } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name)) {
                  $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$ketersediaan_stok')");

                  if ($queryTambah) {
                    ?>
      <div class="alert alert-success mt-3" role="alert">
        Berhasil menambahkan produk baru!
      </div>

      <meta http-equiv="refresh" content="1; url=produk.php" />
      <?php
                  } else {
                    echo mysqli_error($con);
                  }
                } else {
                  ?>
      <div class="alert alert-danger mt-3" role="alert">
        Gagal mengupload gambar!
      </div>
      <?php
                }
              }
            }
          } else {
            // Insert tanpa gambar
            $queryTambah = mysqli_query($con, "INSERT INTO produk (kategori_id, nama, harga, detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga', '$detail', '$ketersediaan_stok')");

            if ($queryTambah) {
              ?>
      <div class="alert alert-success mt-3" role="alert">
        Berhasil menambahkan produk baru!
      </div>

      <meta http-equiv="refresh" content="1; url=produk.php" />
      <?php
            } else {
              echo mysqli_error($con);
            }
          }
        }
      }
      ?>
    </div>

    <div class="mt-3">
      <h2>List Produk</h2>

      <div class="table-responsive mt-5">
        <table class="table">
          <thead>
            <t>
              <th>No.</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Ketersediaan Stok</th>
              <th>Action</th>
            </t>
          </thead>
          <tbody>
            <?php
      if($jumlahProduk == 0){
        ?>
            <tr>
              <td colspan="6" class="text-center">Data Produk Tidak Tersedia</td>
            </tr>
            <?php
      }
      else{
        $jumlah = 1;
        while($data = mysqli_fetch_array($query)) {
          ?>
            <tr>
              <td><?php echo $jumlah; ?></td>
              <td><?php echo $data['nama']; ?></td>
              <td><?php echo $data['nama_kategori']; ?></td>
              <td><?php echo $data['harga']; ?></td>
              <td><?php echo $data['ketersediaan_stok']; ?></td>
              <td> <a href="produk-detail.php?p= <?php echo $data['id']; ?>" class="btn btn-info"> <i
                    class="fas fa-search"></i> </a>
              </td>
            </tr>
            <?php
      }
      }
      ?>
          </tbody>
        </table>
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