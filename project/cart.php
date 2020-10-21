<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>

<html>
    <head>
        <title>Burger House</title>
        <style>
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
            .table td {
	            border-bottom: #F0F0F0 1px solid;
	            padding: 10px;
            }
            .cart .remove {
                background: none;
                border: none;
                color: #0067ab;
                cursor: pointer;
                padding: 0px;
	        }
            .cart .remove:hover {
	            text-decoration:underline;
            }
            a {
                color: #000000;
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
        <div id="content" style="width:700px; margin:50 auto;"><?php
            if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>
            <div class="cart_div">
            <a href="cart.php"><img src="images/cart-icon.png" /> Cart<span><?php echo $cart_count; ?></span></a>
            </div>
            <?php
            }
            ?>

            <div class="cart">
            <?php
            if(isset($_SESSION["shopping_cart"])){
                $total_price = 0;
            ?>	
            <table class="table">
            <tbody>
            <tr>
            <td></td>
            <td>ITEM NAME</td>
            <td>QUANTITY</td>
            <td>UNIT PRICE</td>
            <td>ITEMS TOTAL</td>
            </tr>	
            <?php		
            foreach ($_SESSION["shopping_cart"] as $product){
            ?>
            <tr>
            <td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
            <td><?php echo $product["name"]; ?><br />
            <form method='post' action=''>
            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
            <input type='hidden' name='action' value="remove" />
            <button type='submit' class='remove'>Remove Item</button>
            </form>
            </td>
            <td>
            <form method='post' action=''>
            <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
            <input type='hidden' name='action' value="change" />
            <select name='quantity' class='quantity' onChange="this.form.submit()">
            <option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
            <option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
            <option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
            <option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
            <option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
            </select>
            </form>
            </td>
            <td><?php echo "$".$product["price"]; ?></td>
            <td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
            </tr>
            <?php
            $total_price += ($product["price"]*$product["quantity"]);
            }
            ?>
            <tr>
            <td colspan="5" align="right">
            <strong>TOTAL: <?php echo "$".$total_price; ?></strong>
            </td>
            </tr>
            </tbody>
            </table>		
            <?php
            }else{
	            echo "<h3>Your cart is empty!</h3>";
	        }
            ?>
            <br><br><a href="order.php">Continue Shopping</a>
        </div>
    </div>
        <footer>
            <small><i>Copyright &copy; Burger House</i></small>
        </footer>
    </body>
</html>