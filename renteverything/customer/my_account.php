<?php
session_start();
include("../includes/db.php");
include("../functions/functions.php");

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
		<a href="../index.php"><img src="../images/header.jpg" width="1000px" height="200px"></a>		
		</div>
		<!--header ends-->
		<!--navagation bar starts-->
		<div id="navbar">
		<ul id="menu">
			<li><a href="../index.php">Home</a></li>
			<li><a href="../all_products.php">All products</a></li>
			<li><a href="../customer/my_account.php">My account</a></li>
			
			
			<li><a href="../customer_register.php">Sign up</a></li>
			
			
			<li><a href="../cart.php">Shopping cart</a></li>
			<li><a href="../contact.php">Contact us</a></li>
			</ul>
				<div id="form">
				  <form method="get" action="../results.php" enctype="multipart/form-data">
					  <input type="text" name="user_query" placeholder="Search a product"/>
					  <input type="submit" name="search" value="Search" />
					  
					  
					</form>
				</div>
		
		</div>
		<!--nav ends-->
		<div class="content_wrapper">
			<div id="left_sidebar">
			 
			 <div id="sidebar_title">Manage accounts:</div>
				<ul id="cats">
					<?php
					
					//
						$customer_session =isset( $_COOKIE['customer_email'])?$_COOKIE['customer_email']:"";
					
					$get_customer_pic = "select * from customers where customer_email='$customer_session'";
					
					$run_customer = mysqli_query($con, $get_customer_pic);
					
					$row_customer = mysqli_fetch_array($run_customer);
					//
					$customer_pic = isset( $row_customer['customer_image']) ? $row_customer['customer_image'] : '';
					
					echo"<img src='customer_photos/$customer_pic' width='150' height='150'";
					 
					?>
					<br>
					<li><a href="my_orders.php? my_orders">My orders</a></li>
					
					<li><a href="logout.php">Logout</a></li>
				
				</ul>
				
			</div>
			
			
			<div id="right_content">
				<?php  cart();  ?>
				
				
				<div id="headline">
				  <div id="headline_content">
						  
				<?php   
				if(isset($_COOKIE['customer_email'])){
					echo"<b>Welcome:"."</b>"."<b style='color:skyblue;'>".$_COOKIE['customer_email']."</b>";
				}
					  
			?>
				
			 <?php
					global $db;	
				if(isset($_COOKIE['customer_email']))
				{
					echo"<a href='../logout.php' style='color:skyblue;'>Logout</a>";
				}
				
			else{
	          echo "<a href='../login.php' style='color:blue;'>Login</a>";
			}
					  
						
					?>  
					  </span>
				  </div>
			  
			</div>
				
		</div>	
			
				<div>
				
					
					
					<h1 style="background:#000; color:#FC9; padding:10px; text-align:center;"> Mange Your Account Here: </h1>
				
				<?php getDefault() ?>
				
			
			</div>
			
		
		<div class="footer">
			
			<div>
			<h1 style="color:#D01B60; padding-top:30px; text-align: center;">&copy; 2020-By www.renteverything@bangladesh.com
			</h1>
			</div>
			</div>
	
	</div>
	<!--main container starts-->
</body>
</html>