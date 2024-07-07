<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require "navbar.php" ?>

  <div class="d-flex flex-column justify-content-center align-items-center mt-5">
    <h1 class="mb-4">Frequently Asked Questions</h1>
    <h5 style="font-style:italic;">(pertanyaan yang sering ditanyakan pelanggan)</h5>
  </div>

  <div class="accordion mt-5 mb-5 px-5" id="panelsStayOpen-headingOne">
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
          Cara melihat produk yang tersedia?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
        aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
          jika anda ingin melihat produk-produk yang tersedia di athalla shop, silahkan klik tombol <strong>"produk"
            yang ada di navigasi bar paling atas dalam web</strong>, jika anda membuka web ini pada versi mobile,
          silahkan <strong>klik garis 3 yang ada di navigasi bar, lalu pilih "produk"</strong>, nanti anda akan
          diarahkan ke halaman produk.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
          Bagaimana cara memesan / beli produk?
        </button>
      </h2>
      <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
        aria-labelledby="panelsStayOpen-headingTwo">
        <div class="accordion-body">
          pastikan anda sudah membuka halaman produk, lalu sudah memilih produk yang anda ingin pesan/order, setelah itu
          <strong>klik
            tombol "beli sekarang"</strong> nanti anda akan
          diarahkan
          whatsapp untuk memesan langsung.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
          aria-controls="panelsStayOpen-collapseThree">
          Kendala dalam proses pemesanan / ingin merubah pesanan
        </button>
      </h2>
      <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
        aria-labelledby="panelsStayOpen-headingThree">
        <div class="accordion-body">
          Silahkan klik tombol "kontak", <strong>lalu pilih "email" / "whatsapp"</strong>, nanti anda akan diarahkan ke
          whatsapp
          atau email
          dan anda
          bisa langsung mengkonfirmasi pesanan anda atau menanyakan langsung kendala anda dalam proses pemesanan.
        </div>
      </div>
    </div>

    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingFour">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
          aria-controls="panelsStayOpen-collapseFour">
          Stok produk yang tidak tersedia
        </button>
      </h2>
      <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
        aria-labelledby="panelsStayOpen-headingFour">
        <div class="accordion-body">
          Apabila produk yang anda cari tidak ada dalam halaman produk di website kami, berarti stok habis atau kami
          tidak sedang menjual produk yang sedang anda cari tersebut.
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