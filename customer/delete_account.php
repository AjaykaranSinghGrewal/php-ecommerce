<h2 style="text-align:center;">Really Delete?</h2><br/>

<form action="" method="post">
    
    <input type="submit" name="yes" value="Yes"/>
    <input type="submit" name="no" value="No"/>
    
</form>

<?php
    include('includes/db.php');
    
    $user = $_SESSION['customer_email'];

    if (isset($_POST['yes'])) {
        $delete_customer = "DELETE FROM customers WHERE customer_email = '$user'";
        
        $run_delete = mysqli_query($connection, $delete_customer);
        
        echo "<script>alert('Sorry to see you go');</script>";
        echo "<script>window.open('../index.php','_self');</script>";
    }

    else if(isset($_POST['no'])) {
        echo "<script>alert('Come on!!!');</script>";
        echo "<script>window.open('my_account.php','_self');</script>";
    }
?>