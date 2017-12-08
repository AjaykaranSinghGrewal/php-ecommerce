<?php
    include('includes/db.php');
?>  
<div>
    <form method="post" action="">
        <table width="500" align="center" bgcolor="skyblue">
            <tr align="center">
                <td colspan="3"><h2>Login/Register to Buy</h2></td>
            </tr>
            
            <tr>
                <td>Email:</td>
                <td><input type="email" name="email" placeholder="Enter Email" required /></td>
            </tr>
            
            <tr>
                <td>Password:</td>
                <td><input type="password" name="pass" placeholder="Enter Password" required /></td>
            </tr>
            
            <tr align="center">
                <td colspan="3"><a href="checkout.php"?forgot_pass>Forgot password?</a></td>
            </tr>
            
            <tr>
                <td colspan="3"><input type="submit" name="login" value="Login" /></td>
            </tr>
        </table>
        
        <h3 style="float:left; padding:5px;"><a href="customer_register.php">New User? Register Here</a></h3>
    </form>
    
    
    <?php
        if(isset($_POST['login'])) {
            $c_email = $_POST['email'];
            $c_pass = $_POST['pass'];
            
            $select_customer = "SELECT * FROM customers WHERE customer_email = '$c_email' AND customer_pass = '$c_pass'";
            
            $run_select_customer = mysqli_query($connection, $select_customer);
            
            $check_customer = mysqli_num_rows($run_select_customer);
            
            if ($check_customer == 0) {
                echo "<script>alert('Email or password is incorrect.');</script>";
                exit();
            }
            
            $ip = getIp();
            
            $sel_cart = "SELECT * FROM cart WHERE ip_add = '$ip'";
        
            $run_sel_cart = mysqli_query($connection, $sel_cart);

            $check_cart = mysqli_num_rows($run_sel_cart);
            
            if ($check_customer > 0 AND $check_cart == 0) {
                $_SESSION['customer_email'] = $c_email;
                echo "<script>alert('You have logged in succesfully!');</script>";
                echo "<script>window.open('customer/my_account.php','_self');</script>";
            }
            else {
                $_SESSION['customer_email'] = $c_email;
                echo "<script>alert('You have logged in succesfully!');</script>";
                echo "<script>window.open('checkout.php','_self');</script>";
            }

        }    
    ?>
</div>