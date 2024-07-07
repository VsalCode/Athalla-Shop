<nav class="navbar navbar-expand-lg bg-dark navbar-dark sticky-top">
  <div class="container p-2">
    <a class="navbar-brand" style="font-weight: 600;" href="#">Athalla Shop👗</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="faq.php">FAQ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kontak
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" target="_blank"
                href="https://api.whatsapp.com/send/?phone=6287808003323&text&type=phone_number&app_absent=0">Whatsapp
                <i class="fa-brands fa-whatsapp"></i></a>
            </li>
            <li><a class="dropdown-item" href="faq.php">Email <i class="fa-regular fa-envelope"></i></a></li>
          </ul>
        </li>

      </ul>
      <form class="d-flex" role="search" method="get" action="produk.php">
        <input class="form-control me-2" type="search" placeholder="cari kategori / produk" aria-label="Search"
          name="keyword" autocomplete="off">
        <button class="btn btn-success" type="submit">cari</button>
      </form>
    </div>
  </div>
</nav>