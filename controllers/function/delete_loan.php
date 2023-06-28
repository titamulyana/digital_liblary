<?php
    include("../../config/connection.php");
    global $connection;
    $loan_id = $_GET['id'];

    $query = "DELETE FROM loans WHERE id = '$loan_id'";
    $result = mysqli_query($connection,$query);

    if($result) {
        echo "
            <script>
                alert('data peminjam berhasil dihapus!');
                document.location.href='/admin/loan_list.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('data peminjam gagal dihapus!');
                document.location.href='/admin/loan_list.php';
            </script>
            ";
    }
?>