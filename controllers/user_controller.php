<?php
    include('../config/connection.php');
    class user_controller {
        static function create($username,$password) {
            global $connection;
            static $status = "";
            $query = "INSERT INTO users (username,password) values ('$username','$password')";
            $insert = mysqli_query($connection,$query);

            if($insert) {
                return $status = "sukses";
            } else {
                return $status = "gagal";
            }
        }

        static function login($username,$password) {
            global $connection;
            static $status = "";
            $query = "SELECT * from users WHERE username = '$username' AND password = '$password'";

            $user = mysqli_query($connection,$query);

            if($user->num_rows > 0) {
                $status = "sukses";
            } else {
                $status = "gagal";
            }

            mysqli_close($connection);
            return array($status,$user);
        }
    }
?>