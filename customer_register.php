<?php
    session_start();
    include('functions/functions.php');
    include('includes/db.php');
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
                    <span style="float:right; padding:5px; line-height:40px;">Welcome Guest! Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?><a href="cart.php"> Go to Cart</a></span>
                </div>
                
                <form action="customer_register.php" method="post" enctype="multipart/form-data">
                    <table align="center" width="750">
                        <tr>
                            <td colspan="6"><h3>Create An Account</h3></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Name:</td>
                            <td><input type="text" name="c_name" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Email</td>
                            <td><input type="email" name="c_email" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Password</td>
                            <td><input type="password" name="c_pass" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Country</td>
                            <td><select name="c_country" required>
                                    <option>Select a Country</option>
                                    <option value="canada">Canada</option>
                                    <option value="usa">U.S.A</option>
                                    <option value="india">India</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer City</td>
                            <td><input type="text" name="c_city" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Contact Number</td>
                            <td><input type="tel" name="c_contact" required/></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer Address</td>
                            <td><textarea name="c_address" cols="20" rows="5" required></textarea></td>
                        </tr>
                        
                        <tr>
                            <td align="right">Customer image</td>
                            <td><input type="file" name="c_image" required/></td>
                        </tr>
                        
                        <tr align="center">
                            <td colspan="6"><input type="submit" name="register" value="Create Account"/></td>
                        </tr>
                    </table>
                </form>
                
            </div>
        </div>

        <div id="footer">
            <h2 style="text-align:center; padding-top: 30px;">&copy; <?php echo date("Y"); ?> Copyright.</h2>
        </div>
    </div>
    
    <script src="js/scripts.js"></script>
</body>
</html>


<?php
    if(isset($_POST['register'])) {
        
        $ip = getIp();
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_image = $_FILES['c_image']['name'];
        $c_image_tmp = $_FILES['c_image']['tmp_name'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_contact = $_POST['c_contact'];
        $c_address = $_POST['c_address'];
        
        move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
        
        $insert_c = "INSERT INTO customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) VALUES ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
        
        $run_c = mysqli_query($connection, $insert_c);
        
        $sel_cart = "SELECT * FROM cart WHERE ip_add = '$ip'";
        
        $run_sel_cart = mysqli_query($connection, $sel_cart);
        
        $check_cart = mysqli_num_rows($run_sel_cart);
        
        if ($check_cart == 0) {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Registration Successful!');</script>";
            echo "<script>window.open('customer/my_account.php','_self');</script>";
        }
        else {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Registration Successful!');</script>";
            echo "<script>window.open('checkout.php','_self');</script>";
        }
    }
?>