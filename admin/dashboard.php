<!DOCTYPE html>
<html lang="en">
<?php 
    include("../layout/header.php")
?>
<style>
body {
  background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
  main {
    padding-left: 240px;
  }
}

/* Sidebar */
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  padding: 58px 0 0; /* Height of navbar */
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
  width: 240px;
  z-index: 600;
}

@media (max-width: 991.98px) {
  .sidebar {
    width: 100%;
  }
}
.sidebar .active {
  border-radius: 5px;
  box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
  position: relative;
  top: 0;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

h1 {
    font-family: 'Caveat', cursive;
    font-weight: bold;
    }

</style>
<body>
<?php
    include_once("../middleware/authn.php");
    include_once("../layout/sidebar.php");
    include_once("../controllers/dashboard_controller.php");
    $data = dashboard_controller::get_data();
    static $total_book;
    static $total_loan;
    static $loan_history;

    while($items = mysqli_fetch_array($data)) {
        $total_book = $items['total_book'];
        $total_loan = $items['total_loan'];
        $loan_history = $items['loan_history'];
    }
?>
<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4">
      <div class="d-flex justify-content-center mt-2 mb-2">
          <h2>Data Buku dan Peminjaman</h2>
      </div>
      <div class="mt-4 d-flex justify-content-center">
        <div class="card mx-2 d-flex justify-content-center align-items-center bg-light" style="width: 18rem;">
          <h2 class="fs-1 fw-bold"><?php echo $total_book?></h2>
          <div class="card-body bg-primary d-flex justify-content-center">
            <center>
              <p class="card-text fs-5 fw-bold">Total buku tersedia di perpustakaan</p>
            </center>
          </div>
        </div>
        <div class="card mx-2 d-flex justify-content-center align-items-center bg-light" style="width: 18rem;">
          <h2 class="fs-1 fw-bold"><?php echo $total_loan?></h2>
          <div class="card-body bg-info d-flex justify-content-center">
            <center>
              <p class="card-text fs-5 fw-bold">Total buku belum dikembalikan</p>
            </center>
          </div>
        </div>
        <div class="card mx-2 d-flex justify-content-center align-items-center bg-light" style="width: 18rem;">
          <h2 class="fs-1 fw-bold"><?php echo $loan_history?></h2>
          <div class="card-body bg-warning d-flex justify-content-center">
            <center>
              <p class="card-text fs-5 fw-bold">Total buku sudah dikembalikan</p>
            </center>
          </div>
        </div>
      </div>
  </div>
</main>
</body>
</html>