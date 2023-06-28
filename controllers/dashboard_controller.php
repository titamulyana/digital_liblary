<?php 
    include("../config/connection.php");

    class dashboard_controller {
        static function get_data() {
            global $connection;
            $query = "SELECT 
            (SELECT COUNT(*) from books) as total_book,
            (SELECT COUNT(*) from loans l WHERE l.status = '0') as total_loan,
            (SELECT COUNT(*) from loans) as loan_history";
            $data = mysqli_query($connection,$query);

            return $data;
        }
        
    }

?>