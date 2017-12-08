<?php

$connection = new mysqli("localhost", "id3087315_unrenthere", "b-212476", "id3087315_ecommerce");

if (mysqli_connect_errno()) {
    echo "Failedto connect: " .mysqli_connect_errno();
}


//get IP address of the user
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}


//add products to cart
function cart() {
    if (isset($_GET['add_cart'])) {
        
        global $connection;
        
        $ip = getIp();
        $pro_id = $_GET['add_cart'];
        
        $check_pro = "SELECT * FROM cart WHERE ip_add='$ip' AND p_id='$pro_id'";
        
        $run_check = mysqli_query($connection, $check_pro);
        
        if (mysqli_num_rows($run_check)>0) {
            echo " ";
        }
        else {

            $run_pro = mysqli_query($connection, "INSERT INTO cart (p_id,ip_add,qty) VALUES ('$pro_id','$ip','1')"); 
            
            if ($run_pro) {
                echo "<script>window.open('index.php','_self');</script>";
            }
        }
        
    }
}


//getting total added items
function total_items() {
    if(isset($_GET['add_cart'])) {
        
        global $connection;
        $ip = getIp();
        
        $get_items = "SELECT * FROM cart WHERE ip_add = '$ip'";
        
        $run_items = mysqli_query($connection, $get_items);
        
        $count_items = mysqli_num_rows($run_items);
    }
    else {
        global $connection;
        $ip = getIp();
        
        $get_items = "SELECT * FROM cart WHERE ip_add = '$ip'";
        
        $run_items = mysqli_query($connection, $get_items);
        
        $count_items = mysqli_num_rows($run_items);
    }
    
    echo $count_items;
}



//getting total price in the cart
function total_price() {
    
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
            
            $values = array_sum($product_price);
            
            $total += $values;
        }
    }
    
    echo "$ " .$total;
}



//getting categories
function getcats() {
    global $connection;
    
    $get_cats = "SELECT * FROM categories";
    
    $run_cats = mysqli_query($connection, $get_cats);
    
    while ($row_cats = mysqli_fetch_array($run_cats)) {
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        
        echo"<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
    }
}


//getting brands
function getbrands() {
    global $connection;
    
    $get_brands = "SELECT * FROM brands";
    
    $run_brands = mysqli_query($connection, $get_brands);
    
    while ($row_brand = mysqli_fetch_array($run_brands)) {
        $brand_id = $row_brand['brand_id'];
        $brand_title = $row_brand['brand_title'];
        
        echo"<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
    }
}



//getting products
function getPro() {
    if (!isset($_GET['cat'])) {
        if(!isset($_GET['brand'])) {
            global $connection;

            $get_pro = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";

            $run_pro = mysqli_query($connection, $get_pro);

            while ($row_pro = mysqli_fetch_array($run_pro)) {
                $pro_id = $row_pro['product_id'];
                $pro_cat = $row_pro['product_cat'];
                $pro_brand = $row_pro['product_brand'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_image = $row_pro['product_image'];

                echo "
                    <div id='single-product'>
                        <h3>$pro_title</h3> 
                        <img src='admin_area/product_images/$pro_image' width='180' height='180'>
                        <p>$ $pro_price</p>
                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='index.php?add_cart=$pro_id'><button>Add to cart</button></a>
                    </div>
                ";
            }
        }
    }
}



//getting products by category
function getCatPro() {
    if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        global $connection;

        $get_cat_pro = "SELECT * FROM products WHERE product_cat = '$cat_id'";

        $run_cat_pro = mysqli_query($connection, $get_cat_pro);
        
        $count_cats = mysqli_num_rows($run_cat_pro);

        if ($count_cats == null) {
            echo "<h2>No Products for this Category!</h2>";
        }
        else{
            while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
                $pro_id = $row_cat_pro['product_id'];
                $pro_cat = $row_cat_pro['product_cat'];
                $pro_brand = $row_cat_pro['product_brand'];
                $pro_title = $row_cat_pro['product_title'];
                $pro_price = $row_cat_pro['product_price'];
                $pro_image = $row_cat_pro['product_image'];

                 echo "
                    <div id='single-product'>
                        <h3>$pro_title</h3> 
                        <img src='admin_area/product_images/$pro_image' width='180' height='180'>
                        <p>$ $pro_price</p>
                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='index.php?pro-id=$pro_id'><button>Add to cart</button></a>
                    </div>";
            }
        }
    }
}



//getting products by brand
function getBrandPro() {
    if (isset($_GET['brand'])) {
        
        $brand_id = $_GET['brand'];
        
        global $connection;

        $get_brand_pro = "SELECT * FROM products WHERE product_brand = '$brand_id'";

        $run_brand_pro = mysqli_query($connection, $get_brand_pro);
        
        $count_brands = mysqli_num_rows($run_brand_pro);

        if ($count_brands == null) {
            echo "<h2>No Products for this Brand!</h2>";
        }
        else{
            while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
                $pro_id = $row_brand_pro['product_id'];
                $pro_cat = $row_brand_pro['product_cat'];
                $pro_brand = $row_brand_pro['product_brand'];
                $pro_title = $row_brand_pro['product_title'];
                $pro_price = $row_brand_pro['product_price'];
                $pro_image = $row_brand_pro['product_image'];

                 echo "
                    <div id='single-product'>
                        <h3>$pro_title</h3> 
                        <img src='admin_area/product_images/$pro_image' width='180' height='180'>
                        <p>$ $pro_price</p>
                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='index.php?pro_id=$pro_id'><button>Add to cart</button></a>
                    </div>";
            }
        }
    }
}


?>