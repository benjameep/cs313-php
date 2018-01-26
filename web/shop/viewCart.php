<!DOCTYPE html>
<?php session_start(); 
	if(!isset($_SESSION["cart"])){
		$_SESSION["cart"] = "{}";
	}
?>
<html>

<head>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
</head>

<body>
	<h1>Your Cart</h1>
	<div id="store">
		<p hidden class="item" id="Apple">
			<span class="name">Apple</span>
			<span class="price">$0.23</span>
			<button onclick="toggleInCart($(this).parent())">remove</button>
		</p>
		<p hidden class="item" id="Pear">
			<span class="name">Pear</span>
			<span class="price">$0.57</span>
			<button onclick="toggleInCart($(this).parent())">remove</button>
		</p>
		<p hidden class="item" id="Banana">
			<span class="name">Banana</span>
			<span class="price">$0.38</span>
			<button onclick="toggleInCart($(this).parent())">remove</button>
		</p>
		<p hidden class="item" id="Orange">
			<span class="name">Orange</span>
			<span class="price">$0.39</span>
			<button onclick="toggleInCart($(this).parent())">remove</button>
		</p>
		<p hidden class="item" id="Lemon">
			<span class="name">Lemon</span>
			<span class="price">$0.12</span>
			<button onclick="toggleInCart($(this).parent())">remove</button>
		</p>
	</div>
	<p>total $<span id="total"></span></p>
	<a href="browse.php">Back to Shop</a>
	<a href="checkout.php">Checkout</a>

	<script>
		var cart = <?=$_SESSION["cart"]?>;
		console.log(cart)
		
		Object.keys(cart).forEach(fruit => {
			if(cart[fruit]){
				toggleItem($('#'+fruit))
			}
		})
		updateTotal()
		
		function toggleInCart($item) {
			var fruitName = $item.attr('id')
			cart[fruitName] = !cart[fruitName]
			updateCart()
			toggleItem($item)
		}
		
		function toggleItem($item){
			$item.toggle()
			updateTotal()
		}
		
		function updateTotal(){
			var total = Object.keys(cart).filter(k => cart[k]).reduce((total,fruit) => total + Number($(`#${fruit} .price`).text().match(/[\d.]+/)),0)
			var temp = String(Math.round(total*100)).padStart(3,0).split('')
			temp.splice(-2,-2,'.')
			$("#total").text(temp.join(''))
		}
		
		function updateCart(){
			$.post('updateCart.php', {cart:JSON.stringify(cart)},()=>{});
		}
	</script>
</body>

</html>
