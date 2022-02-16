<?php
session_start();
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
			<li><a href="../customer_register.php">Sign up</a></li>
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
				
				<?php
				if(!isset($_COOKIE['customer_email']))
				{
					echo "<b>Welcome!</b> <b style='color:antiquewhite'>shopping cart:</b>";
				}
				 else{
		echo"<b>Welcome:" . "<span style='color:skyblue'>" . $_COOKIE['customer_email'] . "</span>" . "</b>";
					  }
				?>
					
					<span> Total Items:<?php items() ?> - Total Price: <?php total_price(); ?>-<a href="cart.php" style="color:#C9266C">Go to cart</a>
					  
			&nbsp; <?php
						
				if(!isset($_COOKIE['customer_email']))
				{
					echo"<a href='checkout.php' style='color:skyblue;'>Login</a>";
					
				}
				
			else{
	          echo "<a href='logout.php' style='color:skyblue;'>Logout</a>";
			}
					  
						
					?>  
					  </span>
						
					  
				  </div>
			    </div>
				
				
				
			<div id="product_box">
				<?php
	          
				if(!isset($_COOKIE['customer_email'])){
					include("customer/customer_login.php");
				}
				else{
					include("payment_options.php");
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