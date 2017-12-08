<?php
    include("includes/db.php");

        if(isset($_GET['delete_c'])) {
            $delete_id = $_GET['delete_c'];

            $delete_c = "DELETE FROM customers WHERE customer_id = '$delete_id'";

            $run_delete = mysqli_query($connection,$delete_c);

            if($run_delete) {
                echo "<script>alert('Customer Deleted');</script>";
                echo "<script>window.open('index.php?view_cats', '_self');</script>";
            }
        }
?>