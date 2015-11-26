<?php
/**
 * Created by PhpStorm.
 * User: KThanksBye
 * Date: 11/25/2015
 * Time: 9:45 AM
 */
require_once 'rest.inc.php';
class API_Wingify extends REST {
    const hostname = "localhost";
    const username = "shubham_me";
    const password = "Shubham.95";
    const db_name = "shubham_wingify";
    private $db_result = null;
    public function __construct() {
        parent::__construct();
        $this->db_connect();
    }
    private function db_connect() {
        $this->db_result = mysqli_connect(self::hostname,self::username,self::password,self::db_name);
    }
    public function processApi() {
        $return_fun = strtolower(trim(str_replace("/","",$_REQUEST['request'])));
        if(method_exists($this,$return_fun) > 0) {
            $this->$return_fun();
        } else {
            $response = array("msg" => "Wrong Function Call");
            $this->response(json_encode($response));
        }
    }
    public function AddProduct() {
        if($this->get_request() != "POST") {
            $response = array("msg" => $this->get_request()." Not Allowed!");
            $this->response(json_encode($response));
        } else {
            $product_name = $this->request['name'];
            $product_desc = $this->request['desc'];
            $product_quantity = $this->request['quantity'];
            $product_price = $this->request['price'];
            $product_sku = $this->request['sku'];
            $product_category = $this->request['category'];
            $product_image = $this->request['image'];
            if (!empty($product_name) && !empty($product_category) && !empty($product_desc) && !empty($product_image) && !empty($product_quantity) && !empty($product_price) && !empty($product_sku)) {
                if (is_numeric($product_quantity) && is_numeric($product_price)) {
                    $query = "INSERT INTO products VALUES (null,'$product_sku','$product_name',$product_price,'$product_desc','$product_category',$product_quantity,'$product_image')";
                    $result = mysqli_query($this->db_result, $query) or die(mysqli_error($this->db_result));
                    if ($result) {
                        $response = array("msg" => "Product Added");
                        $this->response(json_encode($response));
                    } else {
                        $response = array("msg" => "Product $product_name was not added");
                        $this->response(json_encode($response));
                    }
                } else {
                    $response = array("msg" => "Error in Product Quantity or Product Price");
                    $this->response(json_encode($response));
                }
            } else {
                $response = array("msg" => "Check the values, some values are empty");
                $this->response(json_encode($response));
            }
        }
        }
    public function DeleteProduct() {
        if($this->get_request() != "POST") {
            $response = array("msg" => $this->get_request()." Not Allowed");
            $this->response(json_encode($response));
        } else {
            $id = trim($this->request['id']);
            if(is_numeric($id)) {
                $query = "DELETE FROM products WHERE productId = $id";
                $result = mysqli_query($this->db_result,$query);
                if($result) {
                    $response = array("msg" => "Product Deleted");
                    $this->response(json_encode($response));
                } else {
                    $response = array("msg" => "Product Not Found");
                    $this->response(json_encode($response));
                }
            } else {
                $response = array("msg" => "Id should be Numeric");
            }
        }
    }
    public function UpdateProduct() {
        if($this->get_request() != "PUT") {
            $response = array("msg" => $this->get_request()." Not Allowed!");
            $this->response(json_encode($response));
        } else {
            $id = $this->request['id'];
            $product_name = $this->request['name'];
            $product_desc = $this->request['desc'];
            $product_quantity = $this->request['quantity'];
            $product_price = $this->request['price'];
            $product_sku = $this->request['sku'];
            $product_category = $this->request['category'];
            $product_image = $this->request['image'];
            if (!empty($id) && !empty($product_name) && !empty($product_category) && !empty($product_desc) && !empty($product_image) && !empty($product_quantity) && !empty($product_price) && !empty($product_sku)) {
                if (is_numeric($product_quantity) && is_numeric($product_price)) {
                    $check_query = "SELECT * FROM products WHERE productId = $id";
                    $check_Result = mysqli_query($this->db_result,$check_query);
                    if(mysqli_num_rows($check_Result) == 1) {
                    $query = "UPDATE products SET productName = '$product_name', productDesc = '$product_desc', productQuantity = $product_quantity, productPrice = $product_price, productSku = '$product_sku', productCategory = '$product_category', productImage = '$product_image' WHERE productId = $id";
                    $result = mysqli_query($this->db_result,$query);
                    if($result) {
                        $response = array("msg" => "Product Updated");
                        $this->response(json_encode($response));
                    } else {
                        $response = array("msg" => "Product Not Found");
                        $this->response(json_encode($response));
                    }} else {
                        $response = array("msg" => "Product Not Found");
                        $this->response(json_encode($response));
                    }

                } else {
                    $response = array("msg" => "Product Qunatity and Price should be numeric.");
                    $this->response(json_encode($response));
                }
            } else {
                $response = array("msg" => "Empty Field");
                $this->response(json_encode($response));
            }
        }
    }
    public function search() {
        if($this->get_request() != "POST") {
            $this->response("Wrong Request");
        }
        $keyword = $this->request['keyword'];
        if(!empty($keyword)) {
            $query = "SELECT * FROM products WHERE productName LIKE '%$keyword%'";
            $result = mysqli_query($this->db_result,$query) or die(mysqli_error($this->db_result)) ;
            $sum_result = array();
            if($result) {
                while($row = mysqli_fetch_assoc($result)) {
                    $sum_result[] = $row;
                }
                $this->response(json_encode($sum_result));
            } else {
                $tempp = array(array("Status" => "Error", "Msg" => "Content not Found"));
                $this->response(json_encode($tempp));
            }
        } else {
            $response = array("msg" => "Keyword Blank");
            $this->response(json_encode($response));

        }
    }

}
$api_call = new API_Wingify();
$api_call->processApi();