<?php
    include('includes/db.php');
?>

<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>e-Commerce|Insert Product</title>
  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">

  <link href="style.css" rel="stylesheet" media="all">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>

    <form action="insert_product.php" method="post" enctype="multipart/form-data">
        <table align="center" width="1000" border="2px">
            <tr align="center">
                <td colspan="8"><h2>Insert New Post Here</h2></td>
            </tr>
            
            <tr>
                <td>Product Title</td>
                <td><input type="text" name="product_title" required></td>
            </tr>
            
            <tr>
                <td>Product Category</td>
                <td>
                    <select required name="product_cat">
                        <option>Select Category</option>
                        <?php 
                            $get_cats = "SELECT * FROM categories";
    
                            $run_cats = mysqli_query($connection, $get_cats);

                            while ($row_cats = mysqli_fetch_array($run_cats)) {
                                    $cat_id = $row_cats['cat_id'];
                                    $cat_title = $row_cats['cat_title'];

                                    echo"<option value='$cat_id'>$cat_title</option>";
                                }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>Product Brand</td>
                <td>
                    <select required name="product_brand">
                        <option>Select a Brand</option>
                        <?php
                            $get_brands = "SELECT * FROM brands";
    
                            $run_brands = mysqli_query($connection, $get_brands);

                            while ($row_brand = mysqli_fetch_array($run_brands)) {
                                $brand_id = $row_brand['brand_id'];
                                $brand_title = $row_brand['brand_title'];

                                echo"<option value='$brand_id'>$brand_title</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>Product Price</td>
                <td><input required type="text" name="product_price"></td>
            </tr>
            
            <tr>
                <td>Product Image</td>
                <td><input required type="file" name="product_image"></td>
            </tr>
            
            <tr>
                <td>Product Description</td>
                <td><textarea name="product_desc" cols="20" rows="5"></textarea></td>
            </tr>
            
            <tr>
                <td>Product Keywords</td>
                <td><input required type="text" name="product_keywords"></td>
            </tr>
            
            <tr align="center">
                <td colspan="8"><input required type="submit" name="insert_post" value="Insert"></td>
            </tr>
        </table>
    </form>
    
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
    if(isset($_POST['insert_post'])) {
        //getting data from fields
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        
        //getting image from field
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name']; 
        
        move_uploaded_file($product_image_tmp,"product_images/$product_image");
        
        $insert_product = "INSERT INTO products (product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) VALUES ('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
        
        $insert_pro = mysqli_query($connection, $insert_product);
        
        if ($insert_pro) {
            echo "<script>alert('Success!! Product Inserted!')</script>";
            echo "<script>window.open('index.php?insert_product.php','_self'</script>";   
        }
    }
?>