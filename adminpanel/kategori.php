<?php 
  require "session.php";
  require "../koneksi.php";

  $queryKategori = mysqli_query($con,"SELECT * FROM kategori");
  $jumlahKategori = mysqli_num_rows($queryKategori);

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
  <?php require"navbar.php";?>
  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <a href="../adminpanel">
            <i class="fa-solid fa-house"></i> Home
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
      </ol>
    </nav>

    <div class="my-5 col-12 col-md-6">
      <h5 class="mb-3">Tambah Kategori</h5>
      <form action="" method="post">
        <div class="d-flex flex-row">
          <input type="text" name="kategori" id="kategori" placeholder="simpan kategori disini" class="form-control"
            autocomplete="off" />
          <button class="btn btn-primary ml-3" type="submit" name="simpan_kategori">simpan</button>
        </div>
      </form>

      <?php 
      if(isset($_POST['simpan_kategori'])){
        $kategori = htmlspecialchars($_POST['kategori']);

        $queryExist = mysqli_query($con, "SELECT nama FROM kategori WHERE nama='$kategori'");
        $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

        if($jumlahDataKategoriBaru > 0){
       ?>
      <div class="alert alert-danger mt-3" role="alert">
        Kategori Sudah ada! (kalau belum ada, perhatikan huruf kapital nya!)
      </div>
      <?php
      }
      else{
        $querySimpan = mysqli_query($con,"INSERT INTO kategori(nama) VALUES('$kategori') ");
        if ($querySimpan){
          ?>
      <div class="alert alert-success mt-3" role="alert">
        berhasil menambahkan kategori baru!
      </div>

      <meta http-equiv="refresh" content="1" ; url="kategori.php" />
      <?php
      
      }else{
        echo mysqli_error($con);
      }
      }
      }
      ?>

    </div>

    <div class="mt-3">
      <h2>List Kategori</h2>
      <div class="table-responsive mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($jumlahKategori == 0){
              ?>
            <tr>
              <td colspan="3" class="text-center">Data Kategori Tidak Tersedia</td>
            </tr>
            <?php
            } 
            else{
              $jumlah = 1;
              while($data=mysqli_fetch_array($queryKategori)){
                ?>
            <tr>
              <td><?php echo $jumlah; ?></td>
              <td><?php echo $data['nama']; ?></td>
              <td> <a href="kategori-detail.php?p= <?php echo $data['id']; ?>" class="btn btn-info"> <i
                    class="fas fa-search"></i> </a>
              </td>
            </tr>

            <?php
            $jumlah++;
            }
          }
            ?>
          </tbody>
        </table>
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