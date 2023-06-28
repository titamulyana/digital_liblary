<?php
    $all_book = book_controller::get_book();
    if(isset($_POST['submit'])) {
        $book_id = $_POST['book_id'];
        $name = $_POST['name'];
        $class = $_POST['kelas'];
        $address = $_POST['address'];
        $status = '0';
        $create = loans_controller::create_loan($name,$class,$address,$book_id,$status);
        if($create = "sukses"){
          echo "
              <script>
                alert('data peminjaman berhasil disimpan!');
                document.location.href='/admin/loan_list.php';
              </script>
              ";
        } else {
          echo "
              <script>
                alert('data peminjaman gagal disimpan!');
                document.location.href='/admin/loan_list.php';
              </script>
              ";
        }
      

    }
?>


<div class="modal fade" id="create-loan" tabindex="-1" aria-labelledby="create-book" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-create-book">Tambah Peminjam Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Buku</label>
            <select data-control="select2" data-live-search="true" name="book_id" id="book_id" class="form-select" aria-label="Default select example">
            <?php    
            while($row = mysqli_fetch_assoc($all_book)) {
            ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['tittle']; ?></option>
            <?php 
            }
            ?>
            </select>
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Nama Peminjam</label>
            <input required type="text" maxlength="50" name="name" id="name" class="form-control form-control-lg"
            placeholder="masukan nama peminjam" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Kelas</label>
            <input required type="text" maxlength="50" name="kelas" id="kelas" class="form-control form-control-lg"
            placeholder="masukan kelas peminjam" />
        </div>
        <div class="form-outline mt-3 mb-4">
            <label class="form-label" for="form3Example3">Alamat</label>
            <textarea name="address" id="address" required class="form-control" placeholder="deskripsi" id="floatingTextarea"></textarea>
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