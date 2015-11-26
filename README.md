# wingify
Wingify Assignment

Wingify Assignment
Wingify_Api_v1.0

Problem – 
Design a RESTful API for an online store which can be used to manage different products
Functionality of API –
Product Add, Product Delete, Product Update and Search of product.
Language and Tools –
1.	Core PHP and MySQL.
2.	Tools – PHPStorm and phpmyadmin.
URL for API –
1.	Ability to add Product –/api/AddProduct
Request Type – POST
Parameters for POST – name, desc, quantity, price, sku, category, image
Quantity is Stock Availability.
2.	Ability to Delete Product - /api/DeleteProduct
Request Type – DELETE
Parameter for DELETE – id.
First list of all the products would appear, then as per list products could be deleted.
3.	Update details for an existing product - /api/UpdateProduct
Request Type – PUT
Parameters for PUT – id, name, desc, quantity, price, sku, category, image
4.	Search for Product - /api/search
Request Type – POST
Parameter for POST – keyword

Database Scheme – 
Tables – 
products – productId(INT), productSku(VARCHAR), productName(VARCHAR), productPrice(FLOAT), productDesc(TEXT), productCategory(VARCHAR), productQuantity(INT), productImage(VARCHAR)
user – userId(INT), username(VARCHAR), password(VARCHAR)
Description – 
Go to URL http://couponbargain.co/wingify/ and login page would appear.
Username – rdxshubham
Password – rdx
(Future we could implement for more users)
After logging in, home page would appear having add product, edit product, delete product and search option.
Add Product – 
In add product we have to enter the product name, product description, quantity, price, sku code, category and photo url. After submitting the data, REST API call is made to AddProduct with parameters and JSON response is returned.
Update Product – 
In update product, first the list of all the products would appear with all the details stored in the database, hence as per the list, records could be updated and response would be returned.
Delete Product – 
In delete product, first the list of all the products would appear with delete button in front of each product, hence products would be deleted as per request and response is generated.
Search Product – 
In search product, keyword is used as a parameter to search for particular product. Hence call is made to search api and json response is generated.

Response generated in each api is of JSON Format.
Implementation Design – 
First of all the user table contains the record of user including the username and password. User, example username – rdxshubham and password – rdx enters the combination and gets in to home.php which includes addition, updation, deletion and search of product. Hence while in addition process, user enters the details and as soon as click the button Add, request to api call is made with the data as parameters and data is stored in db and json response is generated.
In deletion process, list view is made for all the products and on pressing the delete button, ID is passed to api and hence as per the id the record is deleted.
In update  process, id is passed as a request call to api and json is generated.
In search operation, keyword is passed as a request call to api and the result as per the record is displayed as a json format response.
Github URL - https://github.com/kthankbye/wingify





