<?php
    //session_start();
    include('functions/functions.php');
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>e-Commerce</title>

<style type="text/css">
    /* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
*/

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

    body{
        background-color: aquamarine;
    }

    .main_wrapper {
        width: 1000px;
        height: auto;
        margin: auto;
    }

    .header_wrapper{
        width: 1000px;
        height: 150px;
        margin: auto;
    }

    #logo {
        float: left;
    }

    #banner{
        float: right;
    }

    .menubar {
        width: 1000px;
        height: 50px;
        background: grey;
        color: white;
    }

    #menu {
        padding: 0;
        margin: 0;
        line-height: 35px;
        float: left;
    }

    #menu li {
        list-style: none;
        display: inline;
    }

    #menu a {
        text-decoration: none;
        color: aliceblue;
        padding: 10px;
        margin: 5px;
        font-size: 18px;
        font-family: monospace;
    }

    #form {
        float: right;
        padding-right: 8px;
        padding-top: 5px;
    }

    .content-wrapper {
        width: 1000px;
        margin: auto;
        background: pink;
    }

    #content-area {
        float: right;
        width: 800px;
        background: pink;
    }

    #sidebar {
        width: 200px;
        background: black;
        float: left;
    }

    #sidebar_title {
        background-color: white;
        color: black;
        font-size: 16px;
        font-family: sans-serif;
    }

    #cats {
        padding: 0;
    }

    #cats li {
        list-style: none;
    }

    #cats a{
        color: whitesmoke;
        text-align: center;
        margin: 5px;
        padding: 8px;
        font-size: 15px;
        font-family: monospace;
    }

    #products-box {
        width: 780px;
        text-align: center;
        margin-left: 30px;
        margin-bottom: 10px;
    }

    #single-product {
        float: left;
        margin-left: 20px;
        padding: 10px;
    }

    #single-product img {
        border: 2px solid black;
    }

    #shopping_cart{
        width: 800px;
        height: 50px; 
        background: black;
        color: white;

    }

    #footer {
        width: 1000px;
        height: 100px;
        background: grey;
        clear: both;
    }


</style>

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
    
    <div class="main_wrapper">
        <div class="header_wrapper">
            <div>
                <a href="index.php"><img id="logo" src=""></a>
                <img id="banner" src="images/banner.png">
            </div>   
        </div>
        
        <div class="menubar">
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                <li><a href="customer/my_account.php">My account</a></li>
                <li><a href="">Sign Up</a></li>
                <li><a href="cart.php">Shopping Cart</a></li>
                <li><a href="">Contact Us</a></li>
            </ul>
            
            <div id="form">
                <form method="get" action="results.php" enctype="multipart/form-data">
                    <input type="text" placeholder="search" name="user_query" />
                    <input type="submit" name="search" value="Search" />
                </form>
            </div>
        </div>
        
        <div class="content-wrapper">
            <div id="sidebar">
                <div id="sidebar_title">Categories</div>
                
                <ul id="cats">
                    <?php getcats(); ?>
                </ul>
                
                <div id="sidebar_title">Brands</div>
                <ul id="cats">
                    <?php getbrands(); ?>
                </ul>
                
                
            </div>

            <div id="content-area">
            <?php cart(); ?>
                
                <div id="shopping_cart">
                    <span style="float:right; padding:5px; line-height:40px;">
                        <?php
                            if(isset($_SESSION['customer_email'])) {
                                echo "<b>Welcome </b>" .$_SESSION['customer_email']. "Your Cart:";
                            }
                            else {
                                echo "Welcome Guest!";
                            }
                        ?>
                        
                        Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?><a href="index.php"> Back to Shop</a>
                        
                        <?php
                            if(!isset($_SESSION['customer_email'])) {
                                echo "<a href='checkout.php'  style='color:orange;'>Login</a>";
                            }
                            else {
                                echo "<a href='logout.php' style='color:orange;'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                
                <div id="products-box">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="700" bgcolor="skyblue">
                            
                            <tr align="center">
                                <th>Remove</th>
                                <th>Product(s)</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                            
                            <?php
                                $total = 0;
                                global $connection;
                                $ip = getIp();

                                $sel_price = "SELECT * FROM cart WHERE ip_add = '$ip'";

                                $run_price = mysqli_query($connection, $sel_price);

                                while ($p_price = mysqli_fetch_array($run_price)) {
                                    $pro_id = $p_price['p_id'];

                                    $pro_price = "SELECT * FROM products WHERE product_id = '$pro_id'";

                                    $run_pro_price = mysqli_query($connection, $pro_price);

                                    while ($p_pro_price = mysqli_fetch_array($run_pro_price)) {
                                        $product_price = array($p_pro_price['product_price']);
                                        
                                        $product_title = $p_pro_price['product_title'];
                                        
                                        $product_image = $p_pro_price['product_image'];
                                        
                                        $single_price = $p_pro_price['product_price'];
                                        
                                        $values = array_sum($product_price);
                                        
                                        $total += $values;
                            ?>
                            
                            <tr align="center">
                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
                                <td><?php echo $product_title; ?> <br/>
                                    <img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60"></td>
                                <td><input type="text" size="4" name="qty" placeholder="<?php echo count($product_title); ?>"/></td>
                                
                                <?php
                                    /*if(isset($_POST['update_cart'])) {
                                        $qty = $_POST['qty'];
                                        
                                        $update_qty = "UPDATE cart SET qty = '$qty'";
                                        
                                        $run_update_qty = mysqli_query($connection, $update_qty);
                                        
                                        $_SESSION['qty'] = $qty;
                                        
                                        $total = $total * $qty;
                                    } */     
                                ?>
                                
                                <td><?php echo "$ " .$single_price; ?></td>
                            </tr>
                            
                            <?php } } ?>
                            
                            <tr align="right">
                                <td colspan="4"><b>Sub Total</b></td>
                                <td><?php echo "$" .$total; ?></td>
                            </tr>
                            
                            <tr>
                                <td><input type="submit" name="update_cart" value="Update Cart"/></td>
                                <td><input type="submit" name="continue" value="Continue Shopping"/></td>
                                <td><button><a href="checkout.php">Checkout</a></button></td>
                            </tr>
                            
                        </table>
                    </form> 
                    
                    <?php
                        $ip = getIp();
                        
                        if(isset($_POST['update_cart'])) {
                            foreach ($_POST['remove'] as $remove_id) {
                                
                                $delete_product = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip'";
                                
                                $run_delete = mysqli_query($connection, $delete_product);
                                
                                if ($run_delete) {
                                    echo "<script>window.open('cart.php','_self');  </script>";
                                }
                                
                            }
                        }
                    
                        if(isset($_POST['continue'])) {
                            echo "<script>window.open('index.php','_self');  </script>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <div id="footer">
            <h2 style="text-align:center; padding-top: 30px;">&copy; <?php echo date("Y"); ?> Copyright.</h2>
        </div>
    </div>
    
    <script src="js/scripts.js"></script>
</body>
</html>