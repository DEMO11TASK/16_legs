<?php
	
include "api.php";

$s = hash_hmac('sha256', 'Message', 'secret', true);
//echo base64_encode($s);

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">

<body>



	<div class="product-container">
	  <div class="product-card">
		<img src="https://picsum.photos/200/300" alt="Product 1">
		<h3>Product 1</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
		<span class="price">$19.99</span>
	  </div>
 	
		
	
	  </div>

	</div>
     



 <form action="<?php echo $esewa_url ?>" method="POST">
 <input type="hidden" id="amount" name="amount" value="100" required>
 <input type="hidden" id="tax_amount" name="tax_amount" value ="10" required>
 <input type="hidden" id="total_amount" name="total_amount" value="110" required>
 <input type="hidden" id="transaction_uuid" name="transaction_uuid"required>
 <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
 <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
 <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
 <input type="hidden" id="success_url" name="success_url" value="https://esewa.com.np" required>
 <input type="hidden" id="failure_url" name="failure_url" value="https://google.com" required>
 <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
 <input type="hidden" id="signature" name="signature" " required>
 <input value="Shop Now" type="Submit" class="cta">
 </form>


 



</body>
</html> 
