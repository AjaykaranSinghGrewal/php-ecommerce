<?php
                include('includes/db.php');
                
                $user = $_SESSION['customer_email'];
                    
                $get_customer = "SELECT * FROM customers WHERE customer_email = '$user'";
                    
                $run_get_customer = mysqli_query($connection, $get_customer);
                
                $row_customer = mysqli_fetch_assoc($run_get_customer);

                $c_id = $row_customer['customer_id'];
                $name = $row_customer['customer_name'];
                $email = $row_customer['customer_email'];
                $pass = $row_customer['customer_pass'];
                $country = $row_customer['customer_country'];
                $city = $row_customer['customer_city'];
                $address = $row_customer['customer_address'];
                $image = $row_customer['customer_image'];
                $contact = $row_customer['customer_contact'];

?>


                <form action="" method="post" enctype="multipart/form-data">
                    <table align="center" width="750">
                        <tr>
                            <td colspan="6"><h3>Update An Account</h3></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Name:</td>
                            <td><input type="text" name="c_name" value="<?php echo $name; ?>" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Email:</td>
                            <td><input type="email" name="c_email" disabled value="<?php echo $email ?>" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Password:</td>
                            <td><input type="password" name="c_pass" disabled value="<?php echo $pass; ?>" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Country</td>
                            <td><select name="c_country" disabled>
                                    <option><?php echo $country; ?></option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer City</td>
                            <td><input type="text" name="c_city" value="<?php echo $city; ?>" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Contact Number</td>
                            <td><input type="tel" value="<?php echo $contact; ?>" name="c_contact" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Address</td>
                            <td><textarea name="c_address" value="<?php echo $address; ?>" cols="20" rows="5" required></textarea></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer image</td>
                            <td><input type="file" name="c_image" required/><img src="customer_images/<?php echo $image; ?>" width="50" height="50" /></td>
                        </tr>
                        
                        <tr align="center">
                            <td colspan="6"><input type="submit" name="update" value="Update Account"/></td>
                        </tr>
                    </table>
                </form>


<?php
    if(isset($_POST['update'])) {
        
        $ip = getIp();
        $customer_id = $c_id;
        $c_name = $_POST['c_name'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];
        
        move_uploaded_file($c_image_tmp,"customer_images/$c_image");
        
        $update_c = "UPDATE customers SET customer_name='$c_name',customer_image='$c_image',customer_city='$c_city',customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address' WHERE customer_id = '$customer_id'";
        
        $run_update_c = mysqli_query($connection, $update_c);
        
        if ($run_update_c) {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Updated Successful!');</script>";
            echo "<script>window.open('my_account.php','_self');</script>";
        }
    }
?>