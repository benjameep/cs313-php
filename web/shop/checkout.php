<!DOCTYPE html>
<?php session_start(); ?>
<html>

<head>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
</head>

<body>
	<h1>Checkout</h1>
	<div id="store">
		<p hidden class="item" id="Apple">
			<span class="price">$0.23</span>
		</p>
		<p hidden class="item" id="Pear">
			<span class="price">$0.57</span>
		</p>
		<p hidden class="item" id="Banana">
			<span class="price">$0.38</span>
		</p>
		<p hidden class="item" id="Orange">
			<span class="price">$0.39</span>
		</p>
		<p hidden class="item" id="Lemon">
			<span class="price">$0.12</span>
		</p>
	</div>
	<p>total $<span id="total"></span></p>
	<form action="confirmation.php" method="POST">
		<p>address:<textarea id="address" name="address"></textarea></p>
		<input type="submit"/>
	</form>
	<a href="viewCart.php">Back to Cart</a>

	<script>
		var cart = <?=$_SESSION["cart"]?>;
		console.log(cart)
		
		updateTotal()
		
		function updateTotal(){
			var total = Object.keys(cart).filter(k => cart[k]).reduce((total,fruit) => total + Number($(`#${fruit} .price`).text().match(/[\d.]+/)),0)
			var temp = String(Math.round(total*100)).padStart(3,0).split('')
			temp.splice(-2,-2,'.')
			$("#total").text(temp.join(''))
		}
	</script>
</body>

</html>
