<table width="795" align="center" bgcolor="pink">
    
    <tr align="center">
        <td colspan="6"><h2>View All Orders</h2></td>
    </tr>
    
    <tr align="center" bgcolor="skyblue">
        <th># No.</th>
        <th>Cust email</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Invoice Number</th>
        <th>Order Date</th>
        <th>Action</th>
    </tr>
    
    
    <?php
        include('includes/db.php');
        
        $run_order = mysqli_query($connection, "SELECT * FROM orders");
        
        $i = 0;
        
        while ($row_order = mysqli_fetch_array($run_order)) {
            $order_id = $row_order['order_id'];
            $qty = $row_order['qty'];
            $pro_id = $row_order['p_id'];
            $c_id = $row_order['c_id'];
            $invoice_no = $row_order['invoice_no'];
            $order_date = $row_order['order_date'];
            $status = $row_order['status'];
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
        <td><?php echo $qty; ?></td>
        <td><?php echo $invoice_no; ?></td>
        <td><?php echo $order_date; ?></td>
        <td><a href='index.php?confirm_order=<?php echo $order_id; ?>'>Complete Order</a></td>
    </tr>
    
    <?php } ?>
    

</table>
