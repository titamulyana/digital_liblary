<?php 
    include("../config/connection.php");

    class loans_controller {
        static function create_loan($name,$class,$address,$book_id,$status) {
            global $connection;
            static $create_status = "";
            $query = "INSERT INTO loans (loans.name,loans.class,loans.address,loans.book_id,loans.status) 
            values ('$name','$class','$address','$book_id','$status')";
            $create_loan = mysqli_query($connection,$query);

            if($create_loan) {
                return $create_status = 'sukses';
            } else {
                return $create_status = 'gagal';
            }
        }
        

        static function get_loan() {
            global $connection;
            $query = "SELECT l.id as 'id',l.name,l.class,l.address,l.book_id,l.status,b.tittle,b.img FROM loans l
            join books b on b.id = l.book_id 
            WHERE l.status = '0'";
            $loans = mysqli_query($connection,$query);

            return $loans;
        }

        static function get_loan_history() {
            global $connection;
            $query = "SELECT l.id as 'id',l.name,l.class,l.address,l.book_id,l.status,b.tittle,b.img FROM loans l
            join books b on b.id = l.book_id";
            $loans = mysqli_query($connection,$query);

            return $loans;
        }

        static function get_by_id($id) {
            global $connection;
            $query = "SELECT l.id as 'id',l.name,l.class,l.address,l.book_id,l.status,b.tittle,b.img FROM loans l
            join books b on b.id = l.book_id WHERE l.id = '$id'";
            $loan_data = mysqli_query($connection,$query);
            return $loan_data;
        }

        static function update_loan($id,$name,$class,$address,$book_id) {
            global $connection;
            $query = "
            UPDATE loans 
            SET loans.name = '$name' ,loans.class = '$class' ,loans.address = '$address' ,loans.book_id = '$book_id'
            where id = '$id'" ;
            $update_loan = mysqli_query($connection,$query);
            if($update_loan) {
                echo "
                    <script>
                        alert('loan berhasil diupdate!');
                        document.location.href='/admin/loan_list.php';
                    </script>
                    ";
            } else {
                echo "
                    <script>
                        alert('loan gagal diupdate!');
                        document.location.href='/admin/loan_list.php';
                    </script>
                    ";
            }
        }
    }

?>