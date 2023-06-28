<?php
    include("../../config/connection.php");
    global $connection;
    $book_id = $_GET['id'];

    $query = "DELETE FROM books WHERE id = '$book_id'";
    $result = mysqli_query($connection,$query);

    if($result) {
        echo "
            <script>
                alert('buku berhasil dihapus!');
                document.location.href='/admin/book_list.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('buku gagal dihapus!');
                document.location.href='/admin/book_list.php';
            </script>
            ";
    }
?>