<table width="795" align="center" bgcolor="pink">
    
    <tr align="center">
        <td colspan="6"><h2>View All Payments</h2></td>
    </tr>
    
    <tr align="center" bgcolor="skyblue">
        <th># No.</th>
        <th>Cust email</th>
        <th>Product ID</th>
        <th>Amount</th>
        <th>Transaction ID</th>
        <th>Order Date</th>
    </tr>
    
    
    <?php
        include('includes/db.php');
        
        $run_payment = mysqli_query($connection, "SELECT * FROM payments");
        
        $i = 0;
        
        while ($row_payment = mysqli_fetch_array($run_payment)) {
            $order_id = $row_payment['order_id'];
            $amount = $row_payment['amount'];
            $pro_id = $row_payment['product_id'];
            $c_id = $row_payment['customer_id'];
            $trx_id = $row_payment['trx_id'];
            $payment_date = $row_payment['payment_date'];
            $i++;
            
            $get_pro = "SELECT * FROM products WHERE product_id = '$pro_id'";
            $run_get_pro = mysqli_query($connection,$get_pro);
            $row_get_pro = mysqli_fetch_array($run_get_pro);
            
            $pro_image = $row_get_pro['product_image'];
            $pro_title = $row_get_pro['product_title'];
            
            $get_c = "SELECT * FROM customers WHERE customer_id = '$c_id'";
            $run_get_c = mysqli_query($connection,$get_c);
            $row_run_get_c = mysqli_fetch_array($run_get_c);
            $c_email = $row_run_get_c['customer_email']; 
    ?>
    <tr align="center">    
        <td><?php echo $i; ?></td>
        <td><?php echo $c_email; ?></td>
        <td>
            <?php echo $pro_title; ?>
            <img src="../admin_area/product_images/<?php echo $pro_image; ?>" width="50" height="50"/>
        </td>
        <td><?php echo $amount; ?></td>
        <td><?php echo $trx_id; ?></td>
        <td><?php echo $payment_date; ?></td>
    </tr>
    
    <?php } ?>
    

</table>