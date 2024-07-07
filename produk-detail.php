<?php
session_start(); // Start the session
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($con, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($con,"SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' LIMIT 4");

date_default_timezone_set('UTC'); // Set the default timezone
$targetTime = strtotime('+30 days'); // Target time is 2 days from now
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Athalla Shop | Produk Detail</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require "navbar.php"; ?>

  <!-- DETAIL PRODUK -->
  <div class="container-fluid py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 mb-5">
          <img src="image/<?php echo htmlspecialchars($produk['foto']); ?>" class="img-fluid" alt="Product Image">
        </div>
        <div class="col-lg-7">
          <h2 class="mb-4 fw-bold"><?php echo htmlspecialchars($produk['nama']); ?></h2>
          <p class="mb-4"><?php echo htmlspecialchars($produk['detail']); ?></p>
          <h4 class="text-harga fw-bold mb-3" style="color:green;">
            Rp.<?php echo number_format($produk['harga'], 0, ',', '.'); ?></h4>
          <p class="ketersediaan-barang fst-italic">Status:
            <?php echo htmlspecialchars($produk['ketersediaan_stok']); ?></p>
          <a target="_blank"
            href="https://api.whatsapp.com/send/?phone=6287808003323&text&type=phone_number&app_absent=0"><button
              type="submit" name="add_to_cart" class="btn btn-success">Beli
              Sekarang</button></a>


          <h4 class="text-harga fw-bold mt-5" style="color:red;">DISCOUNT 5%</h4>
          <label>Masa Berlaku Promo: <div id="countdown" class="fw-bold" style="color:red;"></div>
          </label>


        </div>
      </div>
    </div>
  </div>

  <!-- PRODUK TERKAIT -->
  <div class="container-fluid py-5">
    <div class="container">
      <h2 class="text-center mb-5">Produk yang serupa</h2>
      <div class="row">
        <?php while($data = mysqli_fetch_array($queryProdukTerkait)){ ?>
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card">
            <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>">
              <img src="image/<?php echo htmlspecialchars($data['foto']); ?>" class="card-img-top img-fluid"
                alt="Related Product">
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
  <script>
  // Get the target time from PHP
  var targetTime = <?php echo $targetTime * 1000; ?>;

  function startCountdown() {
    var now = new Date().getTime();
    var distance = targetTime - now;

    if (distance < 0) {
      // Reset the target time if the countdown is finished
      targetTime = new Date().getTime() + (2 * 24 * 60 * 60 * 1000);
      distance = targetTime - now;
    }

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

    if (distance < 0) {
      document.getElementById("countdown").innerHTML = "EXPIRED";
    }
  }

  setInterval(startCountdown, 1000);
  </script>
</body>

</html>