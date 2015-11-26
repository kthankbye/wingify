<?php
/**
 * Created by PhpStorm.
 * User: rDx.LoRD
 * Date: 11/25/2015
 * Time: 1:44 PM
 */
session_start();
if(isset($_SESSION['auth_token'])) {
    include "connect.php";
    if(isset($_GET['event']) && $_GET['event'] == md5('add')) {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $sku = $_POST['sku'];
        $category = $_POST['category'];
        $image = $_POST['image'];
        $url = "http://". $_SERVER['HTTP_HOST'] ."/wingify/api/AddProduct";
        $data = "name=$name&desc=$desc&quantity=$quantity&price=$price&sku=$sku&category=$category&image=$image";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        print_r($output);
    } else {
        if(isset($_GET['event']) && $_GET['event'] == md5('delete')) {
            $id = $_GET['id'];
            $url = "http://". $_SERVER['HTTP_HOST']. "/wingify/api/DeleteProduct";
            $data = "id=$id";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            print_r($output);
        } else {
            if(isset($_GET['event']) && $_GET['event'] == md5('update')) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $sku = $_POST['sku'];
                $category = $_POST['category'];
                $image = $_POST['image'];
                $url = "http://".$_SERVER['HTTP_HOST']."/wingify/api/UpdateProduct";
                $data = "id=$id&name=$name&desc=$desc&quantity=$quantity&price=$price&sku=$sku&category=$category&image=$image";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                print_r($output);
            } else {
                if(isset($_GET['event']) && $_GET['event'] == md5('search')) {
                    $keyword = $_POST['keyword'];
                    $url = "http://".$_SERVER['HTTP_HOST']."/wingify/api/search";
                    $data = "keyword=$keyword";
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    print_r($output);
                } else {
                    if(isset($_GET['event']) && $_GET['event'] == 'update') {
                        $product_id = $_GET['id'];
                        $fetch_query = "SELECT * FROM products WHERE productId = $product_id";
                        $result_query = mysqli_query($con,$fetch_query);
                        $row = mysqli_fetch_assoc($result_query);
                        $product_name = $row['productName'];
                        $product_desc = $row['productDesc'];
                        $quantity = $row['productQuantity'];
                        $price = $row['productPrice'];
                        $skucode = $row['productSku'];
                        $category = $row['productCategory'];
                        $url = $row['productImage'];
                        $update = md5("update");
                        ?>
                        <form action="action.php?event=<?=$update;?>" method="post">
                            <input type="text" name="id" value="<?=$product_id;?>"><br>
                            <input type="text" name="name" value="<?=$product_name;?>" placeholder="Name"><br>
                            <input type="text" name="desc" placeholder="Description" value="<?=$product_desc;?>"><br>
                            <input type="text" name="quantity" placeholder="Quantity" value="<?=$quantity;?>"><br>
                            <input type="text" name="price" placeholder="Price" value="<?=$price;?>"><br>
                            <input type="text" name="sku" placeholder="SKU" value="<?=$skucode;?>"><br>
                            <select name="category">
                                <option value="Electronics">Electronics</option>
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                                <option value="Baby & Kids">Baby & Kids</option>
                                <option value="Home & Furniture">Home & Furniture</option>
                                <option value="Books & Media">Books & Media</option>
                                <option value="Auto & Sports">Auto & Sports</option>
                            </select><br>
                            <input type="text" name="image" placeholder="Image URL" value="<?=$url;?>"><br>
                            <input type="submit" value="Update"><br>
                        </form>
<?php
                    }
                }
            }
        }
    }
} else {
    echo "Signin is required to access this page. Go to -> <a href='index.php'>Login Page </a>";
}