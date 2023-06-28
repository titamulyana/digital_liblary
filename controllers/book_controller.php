<?php
    include("../config/connection.php");

    class book_controller {
        static function create_book($tittle,$author,$file_name,$description,$category_id,$rack_id,$user_id) {
            global $connection;
            static $status = "";


            $query = "INSERT INTO books (tittle,author,img,description,category_id,rack_id,user_id) values ('$tittle','$author','$file_name','$description','$category_id','$rack_id','$user_id')";
            $insert = mysqli_query($connection,$query);

            if($insert) {
                return $status = "sukses";
            } else {
                return $status = "gagal";
            }
        }

        static function upload() {
            static $status_upload = "";
            $file_name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $extention_accept = array('png','jpg','jpeg');
            $explod = explode(".",$file_name);
            $extention = strtolower(end($explod));

            if(in_array($extention,$extention_accept)==true) {
                if($size < 1044070) {
                    move_uploaded_file($file_tmp,'../asset/img/'.$file_name);
                    $status_upload = "sukses";
                }
            } else {
                $status_upload = "gagal";
            }

            return array($file_name,$status_upload);
        }

        static function get_category_rack() {
            global $connection;
            $query_category = "SELECT * from categories";
            $query_rack = "SELECT * from racks";
            $category = mysqli_query($connection,$query_category);
            $rack = mysqli_query($connection,$query_rack);

            return array($category,$rack);
        }

        static function get_book() {
            global $connection;
            $query = "SELECT b.id as 'id', b.tittle, b.author, b.img, b.description, c.name as 'category', r.rack_number, r.rack_code FROM books b
            inner JOIN categories c on c.id = b.category_id
            inner JOIN  racks r on r.id = b.rack_id;";
            $books = mysqli_query($connection,$query);

            return $books;
        }

        static function delete($id) {
            global $connection;
            $query = "DELETE FROM books WHERE id = $id";
            $del = mysqli_query($connection,$query);

            if($del) {
                echo 'del()';
            } else {
                echo "
                <script>
                    alert('buku Gagal dihapus!');
                </script>
                ";
            }
        }

        static function get_by_id($id) {
            global $connection;
            $query = "SELECT * FROM books WHERE id = '$id'";
            $book_data = mysqli_query($connection,$query);
            return $book_data;
        }

        static function update_book($id,$tittle,$author,$file_name,$description,$category_id,$rack_id,$user_id) {
            global $connection;
            $query = "
            UPDATE books
            SET books.tittle = '$tittle', books.author = '$author', books.img = '$file_name',
            books.description = '$description', books.category_id = '$category_id', books.rack_id = '$rack_id', books.user_id = '$user_id' where books.id = '$id'" ;
            $update_book = mysqli_query($connection,$query);
            if($update_book) {
                echo "
                    <script>
                        alert('buku berhasil diupdate!');
                        document.location.href='/admin/book_list.php';
                    </script>
                    ";
            } else {
                echo "
                    <script>
                        alert('buku gagal diupdate!');
                        document.location.href='/admin/book_list.php';
                    </script>
                    ";
            }
        }
    }
?>