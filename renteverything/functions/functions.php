<?php 


$db = mysqli_connect("localhost","root","","renteverything");

//function for getting the ip address

function getRealIpAddr()
{
 if (!empty($_SERVER['HTTP_CLIENT_IP']))
//check ip from share internet
{ 
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}

elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
//to check ip is pass from proxy
{
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
} 

else
{
 $ip=$_SERVER['REMOTE_ADDR'];
}

return $ip;

}
//getting defaults for customer

function getDefault()
{  global $db;
	if(!isset($_GET['my_orders'])){
		if(!isset($_GET['edit_account'])){
			if(!isset($_GET['change_pass'])){
				if(!isset($_GET['delete_account'])){
	
	$c = isset($_SESSION['customer_email']) ? $_SESSION['customer_email']:'';
	
	$get_c = "select * from customers where customer_email='$c'";
	$run_c = mysqli_query($db, $get_c);
	
	$row_c =mysqli_fetch_array($run_c);
		
		$customer_id = isset($row_c['customer_id']) ? $row_c['customer_id']:'';
	
		$get_orders = "select * from customer_orders where customer_id='$customer_id' AND order_status='pending'";
					$run_orders = mysqli_query($db, $get_orders);
					$count_orders = mysqli_num_rows($run_orders);
					if($count_orders>0){
						echo "
						<div style='padding:10px;'>
						<h1 style='color:red;'>Important!</h1>
						<h2>You have $count_orders orders</h2>
						<h3>Please see your order details by clicking this <a href='my_account.php?my_orders'>LINK</a></h3>
						
						
						</div>
						
						
						";
					}
					
		
	}	
	}
	
}
	}
	
}

//creating the cart
function cart()
{
	global $db;
	if(isset($_GET['add_cart'])){
		$ip_add = getRealIpAddr();
		$p_id =$_GET['add_cart'];
		$check_pro="select * from cart where ip_add='$ip_add'AND p_id='$p_id'";
		
		$run_check = mysqli_query($db,$check_pro);
		if(mysqli_num_rows($run_check)>0){
			echo"";
		}
			
		else{
			$q = "insert into cart(p_id,ip_add) values ('$p_id','$ip_add')";
			$run_q = mysqli_query($db,$q);
			echo"<script>window.open('index.php','_self')</script>";
		}
		
	}
}

//getting the nmber of items from the cart

function items(){
	global $db;
	if(isset($_GET['add_cart'])){
		$ip_add = getRealIpAddr();
		
		$get_items = "select *from cart where ip_add='$ip_add'";
		
		$run_items = mysqli_query($db, $get_items);
		
		$count_items = mysqli_num_rows($run_items);
	}
	else{
		$ip_add = getRealIpAddr();
		
		$get_items = "select *from cart where ip_add='$ip_add'";
		
		$run_items = mysqli_query($db, $get_items);
		
		$count_items = mysqli_num_rows($run_items);
	}
	
	
	echo $count_items;
	
	
	
}

//getting total price from cart

function total_price(){
	
	$ip_add = getRealIpAddr();
	global $db;
	$total = 0;
	$sel_price ="select *from cart where ip_add='$ip_add'";
	
	$run_price = mysqli_query($db,$sel_price);
	
	while ($record = mysqli_fetch_array($run_price)){
		$pro_id = $record['p_id'];
		$pro_price = "select * from products where product_id ='$pro_id'";
		$run_pro_price = mysqli_query($db, $pro_price);
		
		while ($p_price=mysqli_fetch_array($run_pro_price)){
			
			$rent_price = array($p_price['Rent_price']);
			
			$values = array_sum($rent_price);
			
			$total+=$values;
		}
	}
	
	echo"tk". $total;
	
}






					
//getting the product to disply
function getPro() 
{
	global $db;
	if(!isset($_GET['cat'])){
	$get_products = "select * from products order by rand() limit 0,6";
				$run_products = mysqli_query($db, $get_products);
				
		while($row_products = mysqli_fetch_array($run_products)){
					
					$pro_id = $row_products['Product_id'];
					$pro_title = $row_products['Product_title'];
					$pro_cat = $row_products['cat_id'];
					$pro_des = $row_products['Product_des'];
			        $rent_price = $row_products ['Rent_price'];
					$pro_img = $row_products ['Product_img'];
			
					echo"
					<div id='single_product'>
					<h3> $pro_title</h3>
					
					<img src = 'admin_area/product_images/$pro_img' width='180' height='180' />
					
					<br>
					<p><b>Rent Price:$rent_price tk</b></p>
					
					<a href='details.php?pro_id=$pro_id' style='float:left;'>details</a>
				
				
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
					
					</div>
					";
					
					
					
					
				}
	
	
				
     }
}


//getting category product
function getCatPro() {
	
		global $db;
	if(isset($_GET['cat'])){
		
		 $cat_id= $_GET['cat'];
	
				$get_cat_pro = "select * from products where cat_id='$cat_id'";
		
				$run_cat_pro = mysqli_query($db, $get_cat_pro);
				$count= mysqli_num_rows($run_cat_pro);
				if($count==0){
				echo"<h2>No product found in this category!</h2>";
				}
				
		while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
					
					$pro_id = $row_cat_pro ['Product_id'];
					$pro_title = $row_cat_pro ['Product_title'];
					$pro_cat = $row_cat_pro ['cat_id'];
					$pro_des = $row_cat_pro ['Product_des'];
					$rent_price = $row_cat_pro ['Rent_price'];
					$pro_img = $row_cat_pro ['Product_img'];
					
					echo"
					<div id='single_product' >
					<h3> $pro_title </h3>
					
					<img src = 'admin_area/product_images/$pro_img' width='180' height='180' />
					
					<br><a href='details.php?pro_id=$pro_id' style='float:left;'>details</a>
				
					<p><b>Rent Price:$rent_price tk</b></p>
					
					<a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to cart</button></a>
					
					</div>
					";
					
				}
			}
 }


//getting categories to display
function getCats()
	
{
	                global $db;
	
					$get_cats = " select * from categories ";
					
					$run_cats =mysqli_query($db, $get_cats);
					
					while($row_cats=mysqli_fetch_array($run_cats)){
						$cat_id= $row_cats ['cat_id'];
						$cat_title = $row_cats ['cat_title'];
					 echo"<li><a href='index.php?cat=$cat_id'> $cat_title </a></li>";	
						
					}
				
	
	
}





?>