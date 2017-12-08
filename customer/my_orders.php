<table width="795" align="center" bgcolor="pink">
    
    <tr align="center">
        <td colspan="6"><h2>View All Order Details</h2></td>
    </tr>
    
    <tr align="center" bgcolor="skyblue">
        <th># No.</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Invoice Number</th>
        <th>Order Date</th>
        <th>Status</th>
    </tr>
    
    
    <?php
        include('includes/db.php');
        
        // this is about the customer
		$user = $_SESSION['customer_email'];
				
		$get_c = "select * from customers where customer_email='$user'";
				
		$run_c = mysqli_query($connection, $get_c); 
				
		$row_c = mysqli_fetch_array($run_c); 
				
		$c_id = $row_c['customer_id'];
        
        $run_order = mysqli_query($connection, "SELECT * FROM orders where c_id = '$c_id'");
        
        $i = 0;
        
        while ($row_order = mysqli_fetch_array($run_order)) {
            $order_id = $row_order['product_id'];
            $qty = $row_order['qty'];
            $pro_id = $row_order['p_id'];
            $invoice_no = $row_order['invoice_no'];
            $order_date = $row_order['order_date'];
            $status = $row_order['status'];
            $i++;
            
            $get_pro = "SELECT * FROM products WHERE product_id = '$pro_id'";
            $run_get_pro = mysqli_query($connection,$get_pro);
            $row_get_pro = mysqli_fetch_array($run_get_pro);
            
            $pro_image = $row_get_pro['product_image'];
            $pro_title = $row_get_pro['product_title'];
    ?>
    <tr align="center">    
        <td><?php echo $i; ?></td>
        <td>
            <?php echo $pro_title; ?>
            <img src="../admin_area/product_images/<?php echo $pro_image; ?>" width="50" height="50"/>
        </td>
        <td><?php echo $qty; ?></td>
        <td><?php echo $invoice_no; ?></td>
        <td><?php echo $order_date; ?></td>
        <td><?php echo $status; ?></td>
    </tr>
    
    <?php } ?>
    

</table>