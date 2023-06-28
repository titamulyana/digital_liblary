<!DOCTYPE html>
<html lang="en">
<?php
    include("../layout/header.php");
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
    include("../controllers/book_controller.php");
    include("../controllers/loans_controller.php");
    $loan_id = $_GET['id'];
    $all_book = book_controller::get_book();
    $loan = loans_controller::get_by_id($loan_id);
    
    if(isset($_POST['submit'])) {
      $book_id = $_POST['book_id'];
      $name = $_POST['name'];
      $class = $_POST['kelas'];
      $address = $_POST['address'];

      $update_loan = loans_controller::update_loan($loan_id,$name,$class,$address,$book_id);
    }
?>
<main style="margin-top: 58px;" >
    <div class="container pt-4">
        <?php
            while($items = mysqli_fetch_array($loan)) {
        ?>
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
            <img src="<?php echo $items['img'] ?>" class="card-img-top" alt="judul buku">
            <div class="card-body">
                <h5 class="card-title"><?php echo $items['tittle'] ?></h5>
            </div>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Buku</label>
            <select data-control="select2" data-live-search="true" name="book_id" id="book_id" class="form-select" aria-label="Default select example">
            <?php    
            while($row = mysqli_fetch_assoc($all_book)) {
            ?>
                <option 
                <?php
                  if($items['book_id'] == $row['id']) {
                    echo 'selected';
                  } 
                ?>
                value="<?php echo $row['id']; ?>"><?php echo $row['tittle']; ?></option>
            <?php 
            }
            ?>
            </select>
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Nama Peminjam</label>
            <input value="<?php echo $items['name']; ?>" required type="text" maxlength="50" name="name" id="name" class="form-control form-control-lg"
            placeholder="masukan nama peminjam" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Kelas</label>
            <input value="<?php echo $items['class']; ?>" required type="text" maxlength="50" name="kelas" id="kelas" class="form-control form-control-lg"
            placeholder="masukan kelas peminjam" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Alamat</label>
            <textarea name="address" id="address" required class="form-control" placeholder="deskripsi" id="floatingTextarea"><?php echo $items['address']; ?></textarea>
        </div>
        <div class="modal-footer">
          <a href="/admin/loan_list.php" type="button" class="btn btn-secondary mx-3" data-bs-dismiss="modal">Batal</a>
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
    </div>
    <?php
        }
    ?>
</main>
</body>
</html>