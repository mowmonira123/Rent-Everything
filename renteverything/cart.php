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
					<span> Total Items:<?php items() ?> - Total Price: <?php total_price(); ?>-<a href="cart.php" style="color:#C9266C">Back to shopping</a>
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
				
				
				
			<div id="product_box"> <br>
				<form action="cart.php" method="post" enctype="multipart/form-data">
				
				<br><table width="740" align="center" bgcolor="#5ED9EC">
					
					<tr align="center">
						
						<td><b>Product(s)</b> </td>
						<td><b>Quantity</b></td>
						<td><b>Total Price</b></td>
						<td><b>Remove</b></td>
					
					
					 </tr>
					
<?php				
	$ip_add = getRealIpAddr();
	global $db;
	$total = 0;
	$sel_price ="select *from cart where ip_add='$ip_add'";
	
	$run_price = mysqli_query($con,$sel_price);
	
	while ($record = mysqli_fetch_array($run_price)){
		$pro_id = $record['p_id'];
       $pro_price = "select * from products where product_id ='$pro_id'";
		$run_pro_price = mysqli_query($db, $pro_price);
		
		while ($p_price=mysqli_fetch_array($run_pro_price)){
			
			$rent_price = array($p_price['Rent_price']);
			$product_title =$p_price['Product_title'];
			$product_img = $p_price['Product_img'];
			$only_price = $p_price['Rent_price'];
	
			
			$values = array_sum($rent_price);
			
			$total+=$values;
	
	
	
?>
					
					<tr>
					
					<td><?php echo $product_title; ?><br><img src="admin_area/product_images/<?php echo $product_img; ?>" height="80" width="80"></td>
						
<td>  <?php  echo $qty="1" ?> </td>
					
						
						
			<td><?php echo "tk".$only_price ?></td>
						
				<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
						
					</tr>
					
					<?php }} ?>
					<tr align="right">
					<td colspan="2" align="right"><b>Sub Total: </b></td>
					<td align="center"><b><?php echo "tk".$total; ?></b></td>
					</tr>
					
					<tr>
					
					
					<tr> </tr>
					
					
					
					</tr>
					
					<tr align="center">
						<br>
					<td><input type="submit" name="update" value="update cart" /></td>
					<td><input type="submit" name="continue" value="continue shopping" /></td>
					<td><button><a href="Checkout.php" style="text-decoration:none; color: #000000;">checkout</a></button></td>
					</tr>
					
					
					
					
					
					</table>
				
				</form>
				<?php
				
 function updatecart(){		
	 
	 global $con;
		
				if(isset($_POST['update']))
				{
				  foreach($_POST['remove'] as $remove_id)
				  {
					  $delete_products ="delete from cart where p_id='$remove_id'" ;
					  
					  $run_delete = mysqli_query($con, $delete_products);
					  
					  if($run_delete)
					  {
						  
						  echo"<script>window.open('cart.php','_self')</script>";					  }
				  }
	
					
					
					}
				if(isset($_POST['continue']))
	           {
					
		echo "<script>window.open('index.php','_self')</script>";
					
					
				}
		}
				
				echo @ $up_cart = updatecart();
				
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