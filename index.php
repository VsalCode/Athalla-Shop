<?php
  require "koneksi.php";
  $queryProduk = mysqli_query($con,"SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Athalla Shop | Home</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require "navbar.php"; ?>

  <!-- CAROUSEL -->
  <div id="carouselExampleControls" class="carousel slide mt-3" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./image/banner.jpeg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./image/banner3.jpeg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./image/banner2.jpeg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- CAROUSEL END -->

  <!-- HIGHLIGHT KATEGORI -->
  <!-- <div class="container-fluid mt-5">
    <div class="container text-center">
      <h3 style="font-weight: 700;">Kategori Terlaris</h3>
      <div class="row mt-5">
        <div class="col-md-4 mb-3">
          <div class="highlited-kategori kategori-abaya d-flex justify-content-center align-items-center">
            <h3><a class="text-white" style="font-weight: 600;" href="produk.php?kategori=Abaya">Abaya</a></h3>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="highlited-kategori kategori-tas d-flex justify-content-center align-items-center">
            <h3><a class="text-white" style="font-weight: 600;" href="produk.php?kategori=Tas">Tas</a></h3>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="highlited-kategori kategori-dress d-flex justify-content-center align-items-center">
            <h3><a class="text-white" style="font-weight: 600;" href="produk.php?kategori=Dress">Dress</a></h3>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- HIGHLIGHT KATEGORI END-->

  <!-- TENTANG KAMI -->
  <!-- <div id="tentang-kami" class="container-fluid py-5">
    <div class="container text-center">
      <h3 style="font-weight: 700;">Tentang Kami</h3>
      <p class="fs-6 mt-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam iste unde adipisci aut
        doloribus
        ad
        aspernatur
        non voluptates porro dicta quidem fugiat labore repudiandae vero, minima laudantium excepturi nesciunt nulla
        autem illum in, tempora delectus commodi. Exercitationem excepturi necessitatibus, iure, error suscipit amet
        inventore, placeat soluta ea velit eveniet veniam pariatur nostrum esse qui quos quia quam magnam quod
        assumenda
        nemo? Fuga rem alias, sed numquam at dignissimos similique accusamus deserunt ab reprehenderit provident
        inventore mollitia perferendis ad obcaecati nihil.</p>
    </div>
  </div> -->
  <!-- TENTANG KAMI END-->

  <!-- PRODUK -->
  <div class="container-fluid mt-5">
    <div class="container text-center">
      <h3 style="font-weight: 600;">Highlight Produk</h3>

      <div class="row mt-5">
        <?php while($data = mysqli_fetch_array($queryProduk)) { ?>
        <div class="col-sm-6 col-md-4 mb-4">
          <div class="card ">
            <!--  h-100 -->
            <div class="image-box">
              <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="<?php echo $data['nama']; ?>">
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo $data['nama']; ?></h5>
              <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
              <p class="card-text" style="font-weight:700; color:green;">
                Rp.<?php echo number_format($data['harga'], 0, ',', '.'); ?></p>
              <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-success">Lihat Detail
                Produk</a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>

      <a class="btn btn-outline-primary" href="produk.php">lihat semua produk yang tersedia</a>
    </div>
  </div>
  <!-- PRODUK END -->

  <?php require "footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
</body>

</html>