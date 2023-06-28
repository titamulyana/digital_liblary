<?php
    include("../../config/connection.php");
    global $connection;
    $loan_id = $_GET['id'];

    $query = "UPDATE loans
    SET status = '1'
    WHERE id = '$loan_id'";
    $result = mysqli_query($connection,$query);

    if($result) {
        echo "
            <script>
                alert('Buku berhasil dikembalikan!');
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
?>