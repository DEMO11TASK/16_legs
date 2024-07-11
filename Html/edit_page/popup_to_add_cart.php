<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
	
    <script>
function addToCart(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../product/add_to_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            return conform();
        }
    };
    xhr.send("id=" + productId);
}


function addToCart(productId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../product/add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                return conform();
            }
        };
        xhr.send("id=" + productId);
    }

    function conform() {
        document.getElementById("conformPopup").style.display = "block";
    }

    function closeConform() {
        document.getElementById("conformPopup").style.display = "none";
    }

    function viewShoppingBag() {
        window.location.href = "../product/cart.php"; // Adjust the URL to your shopping bag page
    }

    function continueShopping() {
        closeConform();
    }



</script>



<style type="text/css">
		/*popup window ------conform to add in cart*/
       #conformPopup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
            background-color: white;
            padding: 20px;
            width: 600px;
            height: 300px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
            margin-right: 25%;
            margin-bottom: 10%;

        }

        .form-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        .form-popup .btn {
            display: block;
            margin: 10px 0;
            padding: 10px;
            text-align: center;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
            margin-left: 15px;

        }

        .form-popup .btn.cancel {
            background-color: #f0a330;
                   }

         #conformPopup div{
       		display: flex;
            justify-content: center;
           	padding-top:30px;

                   }

         #conformPopup p{
         	text-align: center;
         	padding: 10px
         }


</style>
<body>
	<div class="form-popup" id="conformPopup">
        <span class="close-btn" onclick="closeConform()">&times;</span>
        <p>Add Conform</p>
        <div>
        <button class="btn" onclick="viewShoppingBag()">View Shopping Bag</button>
        <button class="btn cancel" onclick="continueShopping()">Continue Shopping</button>
        </div>
    </div>


</body>
</html>