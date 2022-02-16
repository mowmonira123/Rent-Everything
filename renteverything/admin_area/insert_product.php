<?php
include ("includes/db.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Insert product!</title>
	
</head>

<body bgcolor=#696969>
	<form method ="post" action ="insert_product.php"
		  enctype="multipart/form-data">
	<table width="700" align="center" border="1" bgcolor="#228B87">
	<tr align="center">
		<td colspan="2"><h1>Insert New product:</h1></td>
		</tr>
		<tr>
			<td align="right"><b>Product Title</b></td>
			<td><input type="text" name="product_title" size="50"/></td>
		</tr>
			
		<tr>
			<td align="right"><b>Product category</b></td>
			<td><select name="product_cat">
		<option>
			select category
			</option>
			
				<?php
					$get_cats = "select * from categories";
					
					$run_cats =mysqli_query($con, $get_cats);
					
					while($row_cats=mysqli_fetch_array($run_cats)){
						$cat_id= $row_cats['cat_id'];
						$cat_title = $row_cats['cat_title'];
					 echo"<option value='$cat_id'>$cat_title</option>";	
						
					}
				
					
				
				?>
			
			</select>
		</td>
		</tr>
		
		
		<tr>
			<td align="right"><b>Product image</b></td>
			<td><input type="file" name="product_img"/>
			</td>
		</tr>
			
		<tr>
			<td align="right"><b>Rent_price</b></td>
			<td><input type="int" name="Rent_price" size="50"/>
			</td>
		</tr>
			

		<tr>
			<td align="right"><b>Product Description</b></td>
			<td><textarea name="product_desc" cols="40" rows="5"></textarea>
			</td>
		</tr>
			
		<tr>
			<td align="right"><b>Product Keyword</b></td>
			<td><input type="text" name="product_keyword" size="50"/>
			</td>
		</tr>
			
		<tr align="center">
	
			<td colspan="2"><input type="submit" name="insert_product" value="Insert Product"/>
			</td>
		</tr>

	</table>
	</form>
</body>
</html>
<?php
 if(isset($_POST['insert_product'])){
	 //text data var
	 
	 $product_title= $_POST['product_title'];
	 $product_cat= $_POST['product_cat'];
	 $Rent_price= $_POST['Rent_price'];
	 $product_desc= $_POST['product_desc'];
	 $status= 'on';
	 $product_keyword= $_POST['product_keyword'];
	 
	 //img names
	 $product_img =$_FILES['product_img']['name'];
	 
	 //img temp names
	 $temp_name =$_FILES['product_img']['tmp_name'];
	 
	 
	 if($product_title=='' OR $product_cat=='' OR $Rent_price=='' OR $product_desc=='' OR $product_keyword=='' OR $product_img==''){
		 echo"<script>alert('Please fill all the fields!')</script>";
		 exit();
	 }
	 else{
	 
	 //uploading img to its folder
		 move_uploaded_file($temp_name,"product_images/$product_img");
	 $insert_product ="insert into products(cat_id,Date,Product_title,Product_img,Rent_price,status,Product_des) values('$product_cat',NOW(),'$product_title','$product_img','$Rent_price','$status','$product_desc') ";
		 
		 $run_product = mysqli_query($con, $insert_product);
		 if($run_product){
			 echo "<script>alert('Product inserted successfully!')</script>";
		 }
	 }
 }




