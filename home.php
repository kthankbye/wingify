<?php
/**
 * Created by PhpStorm.
 * User: rDx.LoRD
 * Date: 11/25/2015
 * Time: 1:30 PM
 */
session_start();
if(isset($_SESSION['auth_token'])) {
    include "connect.php";
    $add = md5("add");
    $delete = md5("delete");
    $update = md5("update");
    $search = md5("search");
    ?>
    <html>
    <head>

    </head>
    <body>
    <div align="center">
        <button onclick="location.href = 'home.php?event=<?= $add; ?>';">Add Product</button>
        <button onclick="location.href = 'home.php?event=<?= $delete; ?>';">Delete Product</button>
        <button onclick="location.href = 'home.php?event=<?= $update; ?>';">Update Product</button>
        <button onclick="location.href = 'home.php?event=<?= $search; ?>';">Search Product</button>
        <button onclick="location.href = 'logout.php';">Logout</button>
        <?php
        if (isset($_GET['event']) && $_GET['event'] == md5("add")) {
            ?>
            <form action="action.php?event=<?=$add;?>" method="post">
                <input type="text" name="name" placeholder="Name"><br>
                <input type="text" name="desc" placeholder="Description"><br>
                <input type="text" name="quantity" placeholder="Quantity"><br>
                <input type="text" name="price" placeholder="Price"><br>
                <input type="text" name="sku" placeholder="SKU"><br>
                <select name="category">
                    <option value="Electronics">Electronics</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Baby & Kids">Baby & Kids</option>
                    <option value="Home & Furniture">Home & Furniture</option>
                    <option value="Books & Media">Books & Media</option>
                    <option value="Auto & Sports">Auto & Sports</option>
                </select><br>
                <input type="text" name="image" placeholder="Image URL"><br>
                <input type="submit" value="Add"><br>
            </form>
            <?php
        }
    if (isset($_GET['event']) && $_GET['event'] == md5("delete")) {
        $fetch_details_query = "SELECT * FROM products";
        $result_query = mysqli_query($con,$fetch_details_query);
        ?>
        <table>
            <thead>
            <th>
                Product Id
            </th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>SKU Code</th>
            <th>Category</th>
            <th>URL</th>
            <th>Event</th>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['productId'];
                $product_name = $row['productName'];
                $product_desc = $row['productDesc'];
                $quantity = $row['productQuantity'];
                $price = $row['productPrice'];
                $skucode = $row['productSku'];
                $category = $row['productCategory'];
                $url = $row['productImage'];
                ?>
                <tr>
                    <td><?=$product_id;?></td>
                    <td><?=$product_name;?></td>
                    <td><?=$product_desc;?></td>
                    <td><?=$quantity;?></td>
                    <td><?=$price;?></td>
                    <td><?=$skucode;?></td>
                    <td><?=$category;?></td>
                    <td><?=$url;?></td>
                    <td><button onclick="location.href = 'action.php?event=<?=$delete;?>&id=<?=$product_id;?>';">Delete</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    if (isset($_GET['event']) && $_GET['event'] == md5("update")) {
        $fetch_details_query = "SELECT * FROM products";
        $result_query = mysqli_query($con,$fetch_details_query);
        ?>
        <table>
            <thead>
            <th>
                Product Id
            </th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>SKU Code</th>
            <th>Category</th>
            <th>URL</th>
            <th>Event</th>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['productId'];
                $product_name = $row['productName'];
                $product_desc = $row['productDesc'];
                $quantity = $row['productQuantity'];
                $price = $row['productPrice'];
                $skucode = $row['productSku'];
                $category = $row['productCategory'];
                $url = $row['productImage'];
                ?>
                <tr>
                    <td><?=$product_id;?></td>
                    <td><?=$product_name;?></td>
                    <td><?=$product_desc;?></td>
                    <td><?=$quantity;?></td>
                    <td><?=$price;?></td>
                    <td><?=$skucode;?></td>
                    <td><?=$category;?></td>
                    <td><?=$url;?></td>
                    <td><button onclick="location.href = 'action.php?event=update&id=<?=$product_id;?>';">Update</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
        if (isset($_GET['event']) && $_GET['event'] == md5("search")) {
            ?>
            <form action="action.php?event=<?=$search;?>" method="post">
                <input type="text" name="keyword" placeholder="Keyword"><br>
                <input type="submit" value="Search">
            </form>
            <?php
        }
        ?>
    </div>
    </body>
    </html>
    <?php
} else {
    echo "Signin is required to access this page. Go to -> <a href='index.php'>Login Page </a>";
}