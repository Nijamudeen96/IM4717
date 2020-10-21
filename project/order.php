<?php
session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `food` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>

<html>
    <head>
        <title>Burger House</title>
        <style type="text/css">
            body {
                margin: 0;
            }
            header {
                background-color: #000000;
                height: 60px;
            }
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                float: right;
            }
            li {
                float: left;
                margin-top: 10px;
                padding-right: 20px;
                }
            li a {
                display: block;
                text-align: center;
                padding: 10px 20px;
                font-family: arial;
                text-decoration: none;
                font-size: 14px;
            }
            li a:link {
                color: #ffffff;
            }
            li a:visited {
                color: #ffffff;
            }
            #order {
                border: 1px solid #ffffff;
                border-radius: 8px;
            }
            #content {
                min-height: 500px;
            }
            footer {
                background-color: #000000;
                padding-left: 15px;
                padding-top: 15px;
                color: #ffffff;
                font-family: arial;
                height: 30px;
            }
            .product_wrapper {
	            float:left;
	            padding: 10px;
	            text-align: center;
            }
            .product_wrapper:hover {
	            box-shadow: 0 0 0 2px #e5e5e5;
	            cursor:pointer;
            }
            .product_wrapper .name {
	            font-weight:bold;
            }
            .product_wrapper .buy {
	            text-transform: uppercase;
                background: #F68B1E;
                border: 1px solid #F68B1E;
                cursor: pointer;
                color: #fff;
                padding: 8px 40px;
                margin-top: 10px;
            }
            .product_wrapper .buy:hover {
	            background: #f17e0a;
                border-color: #f17e0a;
            }
            .cart_div {
	            float:right;
	            font-weight:bold;
	            position:relative;
            }
            .cart_div a {
                color:#000;
                text-decoration: none;
	        }	
            .cart_div span {
	            font-size: 12px;
                line-height: 14px;
                background: #F68B1E;
                padding: 2px;
                border: 2px solid #fff;
                border-radius: 50%;
                position: absolute;
                top: -1px;
                left: 13px;
                color: #fff;
                width: 14px;
                height: 13px;
                text-align: center;
	        }
        </style>
    </head>
    <body>
        <header>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="menu.html">Menu</a></li>
                <li><a href="location.html">Location</a></li>
                <li><a href="login.html">Log In</a></li>
                <li><a href="order.php" id="order">Order Now</a></li>
            </ul>
        </header>
    <div id="content" style="width:700px; margin:50 auto;">
    <?php
        if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    ?>
    <div class="cart_div">
    <a href="cart.php"><img src="images/cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
    </div>
    <?php
    }

    $result = mysqli_query($con,"SELECT * FROM `food`");
    while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />
			  <div class='image'><img src='".$row['image']."' width='240px' height='180px'/></div>
			  <div class='name'>".$row['name']."</div>
		   	  <div class='price'>$".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";
        }
    mysqli_close($con);
    ?>
    <div style="clear:both;"></div>

    <div class="message_box" style="margin:10px 0px;">
    <?php echo $status; ?>
    </div>
    </div>
        <footer>
            <small><i>Copyright &copy; Burger House</i></small>
        </footer>
    </body>
</html>
