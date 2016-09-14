


<?php
//echo "hello";

/*$products1='{ "products":[
{"id":"1", "productName":"book", "price":"100"},
    {"id":"2","productName":"harddisk", "price":"500"},
    {"id":"3","productName":"pendrive", "price":"500"}
    ]

}';*/

$products = array(
		array(
			"id"=>2,
			"productName"=>"harddisk",
			"price"=>500
		),
		array(
			"id"=>3,
			"productName"=>"harddisk",
			"price"=>500
		)
	);

$cart= array(
	array(
		'id' => 1, 
		'quantity' => 2
		),
	array(
		'id' => 2,
		'quantity'=>2 
		)
	 );

function add_item_to_products($products)
{
	// global $products;
	header('Content-Type: application/json');
	#$json_products= json_decode($products);
	#$array= $json_products->products;
	$new_data= array("id"=>$_POST["productId"],"productName"=>$_POST["productName"],"price"=>$_POST["price"]);
	array_push($products, $new_data);
	$products=json_encode($products);
	return $products;
}
function get_products_inventory($products){
	// global $products;
	header('Content-Type: application/json');
	return json_encode($products);
}

function remove_item_from_products($products){
	header('Content-Type: application/json');

	$id=$_GET["Id"];
	echo $id;
	foreach ($products as $key => $product) {
		if($product['id']==$id)
		{
			unset($products[$key]);
			break;
		}
		
	}
	$products=json_encode($products);
	return $products;
}



function get_cart($cart){
	
	header('Content-Type: application/json');
	return json_encode($cart);
}


function add_item_to_cart($cart)
{
	
	header('Content-Type: application/json');
	#$json_products= json_decode($cart);
	#$array= $json_products->cart;
	
	$new_data= array("id"=>$_POST["productId"],"quantity"=>$_POST["quantity"]);
	#$new_data= array("id"=>3,"quantity"=>3);
	array_push($cart, $new_data);
	$cart=json_encode($cart);

	return $cart;
}

function remove_item_from_cart($cart){
	header('Content-Type: application/json');
	$id=$_GET["Id"];
	foreach ($cart as $key => $product) {
		if($product['id']==$id){
			unset($cart[$key]);

			break;
		}
	}

	$cart=json_encode($cart);
	return $cart;
}
echo $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD']=='GET'&& isset($_GET['products'])){
	echo get_products_inventory($products); die;
}

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['cart'])){
	echo get_cart($cart);die;
}

if($_SERVER['REQUEST_METHOD']=='POST'&& isset($_GET['products'])){
	echo add_item_to_products($products);
}

if($_SERVER['REQUEST_METHOD']=='DELETE' && $_GET['request']=='1'){
	echo remove_item_from_products($products); die;
}
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['cart'])){
	
	#echo $_POST["productId"];
	echo add_item_to_cart($cart);
}
if($_SERVER['REQUEST_METHOD']== "DELETE" && $_GET['request']=='2'){
	
	#echo $_POST["productId"];
	echo remove_item_from_cart($cart);
}

?>


