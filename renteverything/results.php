<?php

include("includes/db.php");
include("functions/functions.php");

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
				<div id="headline">
				  <div id="headline_content">
				
				
				<b>Welcome!</b>
					<b style="color:antiquewhite;">shopping cart:</b>
					<span> Total Items:<?php items() ?> - Total Price: <?php total_price(); ?>-<a href="cart.php" style="color:#C9266C">Go to cart</a>
						
						 <?php
						
						if(!isset($_COOKIE['customer_email'])){
							echo"<a href='checkout.php' style='color:skyblue;'>Login</a>";
						}
						else{
							echo"<a href='logout.php' style='color:#F93;'>Logout</a>";
						
						}
						
						?>
				  </div>
			    </div>
			<div id="product_box">
				<?php
	
	if(isset($_GET['search'])){
		$user_keyword = $_GET['user_query'];
	
	            $get_products = "select * from products where product_keywords like '%$user_keyword%' ";
		
				$run_products = mysqli_query($con, $get_products);
				
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
					
				?>
				
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