<?php

        include("includes/db.php");

        if(isset($_GET['delete_cat'])) {
            $delete_id = $_GET['delete_cat'];

            $delete_pro = "DELETE FROM categories WHERE cat_id = '$delete_id'";

            $run_delete = mysqli_query($connection,$delete_pro);

            if($run_delete) {
                echo "<script>alert('Category Deleted');</script>";
                echo "<script>window.open('index.php?view_cats', '_self');</script>";
            }
        }
?>