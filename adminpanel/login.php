<?php
session_start();
  require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  height: 100vh;
}

.main {
  width: 500px;
  height: 300px;
  border-radius: 10px;

}
</style>

<body class="d-flex flex-column justify-content-center align-items-center">
  <div class="main p-5 shadow">
    <form action="" method="post">
      <div>
        <label for="username">username</label>
        <input type="text" class="form-control" name="username" id="username">
      </div>
      <div>
        <label for="password">password</label>
        <input type="password" class="form-control" name="password" id="password">
      </div>
      <div>
        <button class="btn btn-success mt-4 form-control" type="submit" name="loginbtn">Login</button>
      </div>

    </form>
  </div>
  <div class="mt-5">
    <?php
    if(isset($_POST['loginbtn'])){
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);

      $query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
      $countdata = mysqli_num_rows($query);
      $data = mysqli_fetch_array($query);
      
    if($countdata > 0){
      if (password_verify($password, $data['password'])){
        $_SESSION['username'] = $data['username'];
        $_SESSION['login'] = true;
        header('location: index.php');
      }else{
        ?>
    <div class="alert alert-warning" role="alert">
      WRONG PASSWORD!
    </div>
    <?php 
      }
    } else{
      ?>
    <div class="alert alert-warning" role="alert">
      WRONG USERNAME & PASSWORD ADMIN!
    </div>
    <?php 
    }
    }
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
  </script>
</body>

</html>