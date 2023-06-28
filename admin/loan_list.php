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
    include("../middleware/authn.php");
    include("../layout/sidebar.php");
    include("../controllers/loans_controller.php");
    include("../controllers/book_controller.php");
    include("component/create_loan.php");
    $all_loan = loans_controller::get_loan();
?>
<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4">
      <div class="d-flex justify-content-between mt-2 mb-2">
          <h3 class="fs-5">List Peminjaman Buku</h1>
          <button type="button" class="btn btn-primary btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#create-loan">
              Tambah Peminjam
          </button>
      </div>
    <table id="example-table" class="table table-striped align-middle mb-0 bg-white">
    <thead class="bg-light">
        <tr>
          <th></th>
          <th>Buku</th>
          <th>Nama Peminjam</th>
          <th>Kelas</th>
          <th>Alamat</th>
          <th>Actions</th>
        </tr>
    </thead>
    <tbody>
      <?php
        while($row = mysqli_fetch_assoc($all_loan)) {
      ?>
        <tr>
        <td></td>
        <td>
            <div class="d-flex align-items-center">
            <img
                src='<?php echo $row['img']; ?>'
                alt=""
                style="width: 45px; height: 45px"
                class="rounded-circle"
                />
            <div class="ms-3">
                <p class="fw-bold mb-1"><?php echo $row['tittle']; ?></p>
                <p class="text-muted mb-0">mediakita</p>
            </div>
            </div>
        </td>
        <td>
            <p class="fw-normal mb-1"><?php echo $row['name']; ?></p>
        </td>
        <td>
            <p class="fw-normal"><?php echo $row['class']; ?></p>
        </td>
        <td>
            <p class="fw-normal"><?php echo $row['address']; ?></p>
        </td>
        <td>
            <a href="../admin/edit_loan.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-warning btn-sm btn-rounded">
            Edit
            </a>
            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Button untuk mengembalikan buku setelah selesai dipinjam">
              <a href="../controllers/function/update_status_loan.php?id=<?php echo $row['id']; ?>" type="button" class="btn btn-primary btn-sm btn-rounded">
                Simpan
              </a>
            </span>
            <a href="../controllers/function/delete_loan.php?id=<?php echo $row['id']; ?>" type="button" name="delete_loan" class="btn btn-danger btn-sm btn-rounded">
            hapus
            </a>
        </td>
        </tr>
        <?php
        }
        ?>
    </tbody>
    </table>
  </div>
</main>
</body>
</html>