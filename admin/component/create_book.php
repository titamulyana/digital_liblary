<?php
    $select_data = book_controller::get_category_rack();
    $all_book = book_controller::get_book();
    list($category,$rack) = $select_data;
    if(isset($_POST['submit'])) {
        $user_id = $_COOKIE["user_id"];
        $tittle = $_POST['tittle'];
        $author = $_POST['author'];
        $rack_id = $_POST['rack_id'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $upload_file = book_controller::upload();
        list($file_name,$status_upload) = $upload_file;
        $directory_image = '../asset/img/'.$file_name;
        if ($status_upload = "sukses") {
          $create = book_controller::create_book($tittle,$author,$directory_image,$description,$category_id,$rack_id,$user_id);
          if($create = "sukses"){
            echo "
                <script>
                  alert('buku berhasil disimpan!');
                  document.location.href='/admin/book_list.php';
                </script>
                ";
          } else {
            echo "
                <script>
                  alert('buku Gagal disimpan!');
                </script>
                ";
          }
        } 

    }
?>


<div class="modal fade" id="create-book" tabindex="-1" aria-labelledby="create-book" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-create-book">Tambah Buku Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Judul</label>
            <input required type="text" maxlength="50" name="tittle" id="tiitle" class="form-control form-control-lg"
            placeholder="masukan judul" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Penulis</label>
            <input required type="text" maxlength="50" name="author" id="author" class="form-control form-control-lg"
            placeholder="masukan penulis" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Gambar</label>
            <input required type="file" name="image" id="image" class="form-control form-control-lg"
            placeholder="upload gambar" />
        </div>
        <div class="form-outline mt-3 mb-4">
          <label class="form-label" for="form3Example3">Kategori</label>
          <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
            <?php
              while ($row = mysqli_fetch_assoc($category)){
            ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
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
            <option value="<?php echo $row['id']; ?>"><?php echo $row['rack_number']; echo $row['rack_code'];?></option>
            <?php
              }
            ?>
          </select>
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Deskripsi</label>
            <textarea name="description" id="description" required class="form-control" placeholder="deskripsi" id="floatingTextarea"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>