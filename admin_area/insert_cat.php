<form action="" method="post">
    
    <b>Insert New Category</b>
    
    <input type="text" name="new_cat" required/>
    <button type="submit" name="add_cat" value="Add">ADD</button>
    
</form>


<?php
    include('includes/db.php');

    if(isset($_POST['add_cat'])) {
        $new_cat = $_POST['new_cat'];

        $insert_cat = mysqli_query($connection, "INSERT INTO categories (cat_title) VALUES ('$new_cat')");

        if($insert_cat) {
                echo "<script>alert('Category Inserted');</script>";
                echo "<script>window.open('index.php?view_cats', '_self');</script>";
        }
    }
    
?>