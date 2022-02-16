<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
$con = mysqli_connect("localhost", "root","", "renteverything");

?>

<!doctype html>

<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Rent Everything</title>
<link rel="stylesheet" href="styles/style.css" media="all" />
	
	
</head>

<body>
		<!--main container starts-->
	<div class="main_wrapper">
	
		<!--header starts-->
	<div class="header_wrapper">
		<a href="index.php"><img src="images/header.jpg" width="1000px" height="200px"></a>		
		</div>
		<!--header ends-->
		<!--navagation bar starts-->
		<div id="navbar">
		<ul id="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="all_products.php">All products</a></li>
			<li><a href="../renteverything/admin_area/insert_product.php">Add Product</a></li>
			<li><a href="customer_register.php">Sign up</a></li>
			<li><a href="cart.php">Shopping cart</a></li>
			<li><a href="contact.php">Contact us</a></li>
			</ul>
				<div id="form">
				  <form method="get" action="results.php" enctype="multipart/form-data">
					  <input type="text" name="user_query" placeholder="Search a product"/>
					  <input type="submit" name="search" value="Search" />
					  
					  
					</form>
				</div>
		
		</div>
		<!--nav ends-->
		<div class="content_wrapper">
			<div id="left_sidebar">
			 
			 <div id="sidebar_title">Categories</div>
				<ul id="cats">
					<?php getCats() ?>
				
				</ul>
				
			</div>
			
			
			<div id="right_content">
				<?php  cart();  ?>
				
				
				<div id="headline">
				  <div id="headline_content">
				
				<b>Welcome!</b>
					<b style="color:antiquewhite;">shopping cart:</b>
					<span> Total Items:<?php items() ?> - Total Price: <?php total_price(); ?>-<a href="cart.php" style="color:#C9266C">Go to cart</a>
					  <?php
						
						if(!isset($_COOKIE['customer_email'])){
							echo"<a href='checkout.php' style='color:#F93;'>Login</a>";
						}
						else{
							echo"<a href='logout.php' style='color:#F93;'>Logout</a>";
						
						}
						
						?>
					  </span>
				  </div>
			    </div>
				<div>
				<form action="customer_register.php" method="post" enctype="multipart/form-data"/>
					<table width="750" align="center" bgcolor="#249AC4">
					<tr align="center">
						<td colspan="5"><h2>Create Account</h2></td>
						</tr>
					
						<tr>
						<td align="right"><b>Customet Name</b></td>
						<td><input type="text" name="c_name" required/></td>	
						</tr>
				<tr>
						<td align="right"><b>Customet Email</b></td>
						<td><input type="text" name="c_email" required/></td>	
						</tr>
				<tr>
						<td align="right"><b>Customet Password</b></td>
						<td><input type="text" name="c_pass" required/></td>	
						</tr>
				<tr>
						<td align="right"><b>Customet country</b></td>
						<td>
					<input type="text" name="c_country" required/>
						</tr>		
				
				<tr>
						<td align="right"><b>Customet city</b></td>
						<td><input type="text" name="c_city" required/></td>	
						</tr>
				<tr>
						<td align="right"><b>Contact number</b></td>
						<td><input type="text" name="c_contact" required/></td>	
						</tr>
				<tr>
						<td align="right"><b>Customet Address</b></td>
						<td><input type="text" name="c_address" required/></td>	
						</tr>
				<tr>
						<td align="right"><b>Image</b></td>
						<td><input type="file" name="c_image"/></td>	
						</tr>
					
					
						<tr align="centre">
						<td colspan="8"> <input type="submit" name="register" value="Submit"/>
</form>
					
					</td>
					</tr> 
					</table>		
				
				</div>
				
			<div id="product_box">
			
				
								
				</div>
				
				
				
			 </div>
			
		</div>
		<div class="footer">
			<h1 style="color:#D01B60; padding-top: 30px; text-align: center;">&copy; 2020-By www.renteverything@bangladesh.com
			</h1>
			
			</div>
	
	</div>
	<!--main container starts-->
</body>
</html>

<?php
if(isset($_POST['register'])){
	
	$c_name = $_POST['c_name'];
	$c_email = $_POST['c_email'];
	$c_pas = $_POST['c_pass'];
	$c_country = $_POST['c_country'];
	$c_city = $_POST['c_city'];
	$c_contact = $_POST['c_contact'];
	$c_address = $_POST['c_address'];
	$c_image = $_FILES['c_image']['name'];
	$c_image_tmp = $_FILES['c_image']['tmp_name'];
	
	$c_ip = getRealIpAddr();
	$insert_customer = "insert into `customers` (`customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `customer_address`, `customer_image`, `customer_ip`) value('".$c_name."','".$c_email."','".$c_pas."','".$c_country."','".$c_city."','".$c_contact."','".$c_address."','".$c_image."','".$c_ip."')";
	
	mysqli_query($con,$insert_customer);
	
	move_uploaded_file($c_image_tmp,"cutsomer/customer_photos/$c_image");
	
	
	$sel_cart = "select *from cart where ip_add='$c_ip'"; 
	
	$check_cart = mysqli_query($con, $sel_cart);
	
	$check_cart = mysqli_num_rows($run_cart);
if($check_cart==1)	{
	
	$_COOKIE['customer_email']=$c_email;
	echo"<script>alert('Account Created')</script>";
	echo"<script>window.open('checkout.php')</script>";
	
}
	else{
		echo"<script>alert('Account Created')</script>";
		echo"<script>window.open('index.php')</script>";
	
		
	}
	
}

?>
