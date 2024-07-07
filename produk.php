<?php
require "koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");

//get produk by nama produk/keyword
if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($con, $_GET['keyword']);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama LIKE '%$keyword%' ");
}
//get produk by kategori 
else if (isset($_GET['kategori'])) {
    $kategori = mysqli_real_escape_string($con, $_GET['kategori']);
    $queryGetKategoriId = mysqli_query($con, "SELECT id FROM kategori WHERE nama='$kategori' ");
    $kategoriId = mysqli_fetch_array($queryGetKategoriId);
    $queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]' ");
}
//get produk default 
else {
    $queryProduk = mysqli_query($con, "SELECT * FROM produk");
}

    $countdata = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Athalla Shop | Produk</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require "navbar.php"; ?>

  <div class="container py-5">
    <div class="row">
      <div class="col-lg-3 mb-4">
        <h4>Kategori Produk</h4>
        <ul class="list-group">
          <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
          <a style="text-decoration: none;"
            href="produk.php?kategori=<?php echo htmlspecialchars($kategori['nama']); ?>">
            <li class="list-group-item"><?php echo htmlspecialchars($kategori['nama']); ?></li>
          </a>
          <?php } ?>
        </ul>
      </div>
      <div class="col-lg-9">
        <h4 class="text-center mb-3">Produk</h4>
        <?php
                if ($countdata < 1) {
                    ?>
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">Tidak dapat menemukan barang yang anda cari!😥</h4>
          <hr>
          <p class="mb-0">Silahkan pilih produk yang tersedia di kolom "Kategori Produk"</p>
        </div>
        <?php
                }
                ?>
        <div class="row">
          <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="image-box">
                <img src="image/<?php echo htmlspecialchars($produk['foto']); ?>"
                  alt="<?php echo htmlspecialchars($produk['nama']); ?>" class="card-img-top">
              </div>
              <div class="card-body">
                <h4 class="card-title"><?php echo htmlspecialchars($produk['nama']); ?></h4>
                <p class="card-text text-truncate"><?php echo htmlspecialchars($produk['detail']); ?></p>
                <p class="card-text text-harga">Rp.<?php echo number_format($produk['harga'], 0, ',', '.'); ?></p>
                <a href="produk-detail.php?nama=<?php echo urlencode($produk['nama']); ?>" class="btn btn-success">Lihat
                  Detail</a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
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