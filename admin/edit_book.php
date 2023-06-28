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
    $book_id = $_GET['id'];
    $select_data = book_controller::get_category_rack();
    list($category,$rack) = $select_data;
    $data = book_controller::get_by_id($book_id);
    
    if(isset($_POST['submit'])) {
        $user_id = $_COOKIE["user_id"];
        $tittle = $_POST['tittle'];
        $author = $_POST['author'];
        $rack_id = $_POST['rack_id'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        static $image_name = "";
        if($_FILES['image']['error'] === 4) {
            $image_name = $_POST['recent_img'];
        } else {
            $upload_file = book_controller::upload();
            list($file_name,$status_upload) = $upload_file;
            $image_name = '../asset/img/'.$file_name;
        }

        book_controller::update_book($book_id,$tittle,$author,$image_name,$description,$category_id,$rack_id,$user_id);
    }
?>
<main style="margin-top: 58px;" >
    <div class="container pt-4">
        <?php
            while($items = mysqli_fetch_array($data)) {
        ?>
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 18rem;">
            <img src="<?php echo $items['img'] ?>" class="card-img-top" alt="judul buku">
            <div class="card-body">
                <h5 class="card-title"><?php echo $items['tittle'] ?></h5>
                <p class="card-text"><?php echo $items['description'] ?></p>
            </div>
            </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Judul</label>
            <input value="<?php echo $items['tittle'] ?>" required type="text" maxlength="50" name="tittle" id="tiitle" class="form-control form-control-lg"
            placeholder="masukan judul" />
            <!-- <input type="hidden" name="book_id" id="book_id" value="<?php echo $items['id']; ?>"> -->
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Penulis</label>
            <input value="<?php echo $items['author'] ?>" required type="text" maxlength="50" name="author" id="author" class="form-control form-control-lg"
            placeholder="masukan penulis" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Gambar</label>
            <input type="file" name="image" id="image" class="form-control form-control-lg"
            placeholder="upload gambar" />
            <input type="hidden" name="recent_img" id="recent_img" value="<?php echo $items['img']; ?>">
        </div>
        <div class="form-outline mt-3 mb-4">
          <label class="form-label" for="form3Example3">Kategori</label>
          <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
            <?php
              while ($row = mysqli_fetch_assoc($category)){
            ?>
            <option 
                <?php if($items['category_id'] = $row['id']) {
                    echo 'selected';
                    } 
                ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-outline mt-3 mb-4">
          <label class="form-label" for="form3Example3">Rak</label>
          <select name="rack_id" id="rack_id" class="form-select select2" aria-label="rack_id">
            <?php
              while ($row = mysqli_fetch_assoc($rack)){
            ?>
            <option
            <?php if($items['rack_id'] = $row['id']) {
                echo 'selected';
                } 
            ?>
            value="<?php echo $row['id']; ?>"><?php echo $row['rack_number']; echo $row['rack_code'];?></option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Deskripsi</label>
            <textarea name="description" id="description" required class="form-control" placeholder="deskripsi" id="floatingTextarea"><?php echo $items['description']; ?></textarea>
        </div>
        <div class="modal-footer">
          <a href="/admin/book_list.php" type="button" class="btn btn-secondary mx-3" data-bs-dismiss="modal">Batal</a>
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