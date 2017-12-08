<h2 style="text-align:center;">Change Your Password</h2>

<form action="" method="post">
    <b>Enter Current Password:</b><input type="password" name="current_pass" required/><br/>
    <b>Enter New Password:</b><input type="password" name="new_pass" required/><br/>
    <b>Enter New Password Again:</b><input type="password" name="new_pass_again" required/><br/>
    
    <input type="submit" name="change_pass" value="Change Password"/>
</form>

<?php
    include('includes/db.php');

    if(isset($_POST['change_pass'])) {
        
        $user = $_SESSION['customer_email'];
        
        $current_pass = $_POST['current_pass'];
        $new_pass = $_POST['new_pass'];
        $new_again = $_POST['new_pass_again'];
        
        $sel_pass = "SELECT * FROM customers WHERE customer_pass = '$current_pass' AND customer_email = '$user'";
        
        $run_pass = mysqli_query($connection,$sel_pass);
        
        $check_pass = mysqli_num_rows($run_pass);
        
        if ($check_pass == 0) {
            echo "<script>alert('Wrong Password');</script>";
            exit();
        }
        
        if($new_pass != $new_again) {
            echo "<script>alert('Passwords dont match');</script>";
            exit();
        }
        
        else {
            $update_pass = "UPDATE customers SET customer_pass = '$new_pass' WHERE customer_email = '$user'"; 
            
            $run_update = mysqli_query($connection,$update_pass);
            
            echo "<script>alert('Password Updated');</script>";
            echo "<script>window.opem('my_account.php','_self');</script>";
        }
        
    }
?>