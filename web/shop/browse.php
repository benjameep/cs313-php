<!DOCTYPE html>
<?php session_start(); 
	if(!isset($_SESSION["cart"])){
		$_SESSION["cart"] = "{}";
	}
?>
<html>

<head>
	<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<style>
		#store{
			display:flex;
			flex-wrap: wrap;
			justify-content: center;
		}
	</style>
</head>

<body>
	<h1>Welcome the the ASCII fruit store</h1>
	<div id="store">
		<div class="item" id="Apple">
			<p>Apple</p>
			<pre>
 ,(.
(   )
 `"'
			</pre>
			<span hidden>Added to cart</span><br/>
			<button onclick="toggleInCart($(this).parent())">Add To Cart</button>
		</div>
		<div class="item" id="Pear">
			<p>Pear</p>
			<pre>
  (
 / \
(   )
 `"'
			</pre>
			<span hidden>Added to cart</span><br/>
			<button onclick="toggleInCart($(this).parent())">Add To Cart</button>
		</div>
		<div class="item" id="Banana">
			<p>Banana</p>
			<pre>
,
\`.__.
 `._,'
			</pre>
			<span hidden>Added to cart</span><br/>
			<button onclick="toggleInCart($(this).parent())">Add To Cart</button>
		</div>
		<div class="item" id="Orange">
			<p>Orange</p>
			<pre>
 ,=.
(.`:)
 `-'
			</pre>
			<span hidden>Added to cart</span><br/>
			<button onclick="toggleInCart($(this).parent())">Add To Cart</button>
		</div>
		<div class="item" id="Lemon">
			<p>Lemon</p>
			<pre>
 ,.
(:;)
 `'
			</pre>
			<span hidden>Added to cart</span><br/>
			<button onclick="toggleInCart($(this).parent())">Add To Cart</button>
		</div>
	</div>
	<a href="viewCart.php">Go To Cart</a>

	<script>
		var cart = <?=$_SESSION["cart"]?>;
		console.log(cart)
		Object.keys(cart).forEach(fruit => {
			if(cart[fruit]){
				toggleItem($('#'+fruit))
			}
		})
		
		function toggleInCart($item) {
			var fruitName = $item.attr('id')
			cart[fruitName] = !cart[fruitName]
			updateCart()
			toggleItem($item)
		}
		
		function toggleItem($item){
			$item.find('span').toggle()
			if(cart[$item.attr('id')]){
				$item.find('button').text('Remove from Cart')
			} else {
				$item.find('button').text('Add to Cart')
			}
		}
		
		function updateCart(){
			$.post('updateCart.php', {cart:JSON.stringify(cart)},()=>{});
		}
	</script>
</body>

</html>
