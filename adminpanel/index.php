<?php 
  require "session.php";
  require "../koneksi.php";

  $queryKategori = mysqli_query($con,"SELECT * FROM kategori");
  $jumlahKategori = mysqli_num_rows($queryKategori);
  $queryProduk = mysqli_query($con,"SELECT * FROM produk");
  $jumlahProduk = mysqli_num_rows($queryProduk);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
.kotak {
  border: solid;
}

.sumary-kategori {
  background-color: #3481B2;
  border-radius: 10px;
}

.sumary-produk {
  background-color: #2CB67C;
  border-radius: 10px;
}

p {
  font-size: 19px;
}

p>a {
  font-size: 17px;
  text-decoration: none;
  color: white;
}



p>a:hover {
  color: aqua;
}
</style>

<body>
  <?php require"navbar.php";?>
  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"> <i class="fa-solid fa-house"></i> Home</li>
      </ol>
    </nav>
    <h2>Halo <?php echo $_SESSION['username'] ?>

      <div class="container mt-5">
        <div class="row">
          <div class="col-lg-3 col-md-6 mb-3 ">
            <div class="sumary-kategori p-3">
              <div class="row ">
                <div class="col-6 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-box-archive fa-3x light"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-start">
                  <p class="text-white ">Kategori</p>
                  <p class="text-white">
                    <?php echo $jumlahKategori; ?> Kategori</p>
                  <p class="text-white "><a href="kategori.php">Lihat Detail</a></p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mb-3 ">
            <div class="sumary-produk p-3">
              <div class="row ">
                <div class="col-6 d-flex align-items-center justify-content-center">
                  <i class="fa-solid fa-bag-shopping fa-3x"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-start">
                  <p class="text-white ">Produk</p>
                  <p class="text-white"> <?php echo $jumlahProduk ?> Produk</p>
                  <p class="text-white "><a href="produk.php">Lihat Detail</a></p>
                </div>
              </div>
            </div>
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