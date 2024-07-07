<?php 
  require "session.php";
  require "../koneksi.php";

  $id = $_GET['p'];

  $query = mysqli_query($con, "SELECT * FROM kategori WHERE id='$id'");
  $data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Kategori</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php require "navbar.php"; ?>
  <div class="container mt-5">
    <h2 class="mb-4">Detail Kategori</h2>
    <div class="col-12 col-md-6">
      <form action="" method="post">
        <div>
          <label for="kategori">Kategori</label>
          <input type="text" name="kategori" id="kategori" value="<?php echo htmlspecialchars($data['nama']); ?>">
        </div>
        <div class="mt-3 d-flex justify-content-between">
          <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
          <button type="submit" class="btn btn-danger" name="deleteBtn">Delete</button>
        </div>
      </form>

      <?php 
      if(isset($_POST['editBtn'])){
        $kategori = htmlspecialchars($_POST['kategori']);

        if($data['nama'] == $kategori){
          ?>
      <meta http-equiv="refresh" content="1;url=kategori.php" />
      <?php
        } else {
          $query = mysqli_query($con, "SELECT * FROM kategori WHERE nama='$kategori'");
          $jumlahData = mysqli_num_rows($query);  

          if($jumlahData > 0){ 
            ?>
      <div class="alert alert-danger mt-3" role="alert">
        Kategori sudah ada! (perhatikan huruf kapitalnya!)
      </div>
      <?php
          } else {
            $querySimpan = mysqli_query($con, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");
            if ($querySimpan){
              ?>
      <div class="alert alert-success mt-3" role="alert">
        Kategori berhasil diupdate!
      </div>

      <meta http-equiv="refresh" content="1;url=kategori.php" />
      <?php
            } else {
              echo mysqli_error($con);
            }
          }
        }
      }
      if(isset($_POST["deleteBtn"])){
        
        $queryCheck = mysqli_query($con,"SELECT * FROM produk WHERE kategori_id='$id' ");
        $dataCount = mysqli_num_rows($queryCheck);
        if($dataCount > 0){
          ?>
      <div class="alert alert-warning mt-3" role="alert">
        Kategori tidak dapat dihapus, karena sudah digunakkan di produk!
      </div>
      <?php
      die();
      }

      $queryDelete = mysqli_query( $con,"DELETE FROM kategori WHERE id='$id'");
      if($queryDelete){
      ?>
      <div class="alert alert-primary mt-3" role="alert">
        Kategori berhasil dihapus!
      </div>

      <meta http-equiv="refresh" content="1;url=kategori.php" />
      <?php
      }
      else{
        echo mysqli_error($con);
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