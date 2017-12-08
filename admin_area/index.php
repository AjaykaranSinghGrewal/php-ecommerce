<?php
    session_start();

    if(!isset($_SESSION['user_email'])) {
        echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self');</script>";
    }

    else {
?>

<!DOCTYPE>

<html>
    <head>
        <title>Admin Area</title>
        
        <style type="text/css">

            html, body, div, span, applet, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            a, abbr, acronym, address, big, cite, code,
            del, dfn, em, img, ins, kbd, q, s, samp,
            small, strike, strong, sub, sup, tt, var,
            b, u, i, center,
            dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, canvas, details, embed, 
            figure, figcaption, footer, header, hgroup, 
            menu, nav, output, ruby, section, summary,
            time, mark, audio, video {
                margin: 0;
                padding: 0;
                border: 0;
                vertical-align: baseline;
            }
            /* HTML5 display-role reset for older browsers */
            article, aside, details, figcaption, figure, 
            footer, header, hgroup, menu, nav, section {
                display: block;
            }

            body {
                background: skyblue;
            }
            
            .main_wrapper {
                width:1000px;
                height: auto;
                margin: auto;
            }
            
            #header {
                width: 1000px;
                border-bottom: 5px groove orange;
                background: white;
                height: 120px;
            }
            
            #right{
                width: 200px;
                height: 600px;
                float: right;
                border-left: 5px groove orange;
                background: #187aea;
                
            }
            
            #left {
                width: 795px;
                height: 600px;
                float: left;
            }
            
            #right a{
                text-decoration: none;
                color: white;
                font-size: 18px;
                font-family: cursive;
                text-align: left;
                padding: 6px;
                margin: 6px;
                display: block;
            }


    </style>
    </head>
    
    <body>
        <div class="main_wrapper">
            <div id="header">
                
            </div>
            
            <div id="right">
                <h2 style="text-align:center;">Manage Content</h2>
                
                <a href="index.php?insert_product">Insert Product</a>
                <a href="index.php?view_products">View All Products</a>
                <a href="index.php?insert_cat">Insert Category</a>
                <a href="index.php?view_cats">View All Categories</a>
                <a href="index.php?insert_brand">Insert New Brand</a>
                <a href="index.php?view_brands">View All Brands</a>
                <a href="index.php?view_customers">View Customers</a>
                <a href="index.php?view_orders">View Orders</a>
                <a href="index.php?view_payments">View Payments</a>
                <a href="logout.php">Admin Logout</a>
            </div>
                
            <div id="left">
                
                <?php
                    if(isset($_GET['insert_product'])) {
                        include('insert_product.php');
                    }
                
                    if(isset($_GET['view_products'])) {
                        include('view_products.php');
                    }
                
                    if(isset($_GET['edit_pro'])) {
                        include('edit_pro.php');
                    }
                
                    if(isset($_GET['insert_cat'])) {
                        include('insert_cat.php');
                    }
                
                    if(isset($_GET['view_cats'])) {
                        include('view_cats.php');
                    }
                
                    if(isset($_GET['view_customers'])) {
                        include('view_customers.php');
                    }
                    
                    if(isset($_GET['view_orders'])) {
                        include('view_orders.php');
                    }
                    
                    if(isset($_GET['view_payments'])) {
                        include('view_payments.php');
                    }
                ?>
                
            </div>
        </div>
    </body>
</html>


<?php
    include('includes/db.php');

    if(isset($_GET['confirm_order'])) {
        $get_id = $_GET['confirm_order'];
        $status = 'Completed';
        
        $update_order = mysqli_query($connection, "UPDATE orders SET status = '$status' WHERE order_id = '$get_id'");
        
        if($update_order) {
            echo "<script>alert('Order Updated')</script>";
            echo "<script>window.open('index.php?view_orders','_self'</script>"; 
        }
    }
?>


<?php } ?>
