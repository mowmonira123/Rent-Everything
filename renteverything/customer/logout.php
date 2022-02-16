<?php

setcookie("customer_email","",time()-3600);

echo "<script>window.open('../index.php','_self')</script>";
?>