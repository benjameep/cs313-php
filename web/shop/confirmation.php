<!DOCTYPE html>
<?php session_start(); ?>
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
	<h1>Enjoy your Fruit!</h1>
	<div id="store">
		<div hidden class="item" id="Apple">
			<pre>
 ,(.
(   )
 `"'
			</pre>
		</div>
		<div hidden class="item" id="Pear">
			<pre>
  (
 / \
(   )
 `"'
			</pre>
		</div>
		<div hidden class="item" id="Banana">
			<pre>
,
\`.__.
 `._,'
			</pre>
		</div>
		<div hidden class="item" id="Orange">
			<pre>
 ,=.
(.`:)
 `-'
			</pre>
		</div>
		<div hidden class="item" id="Lemon">
			<pre>
 ,.
(:;)
 `'
			</pre>
		</div>
	</div>
	<p>
		address:
		<?php
			echo htmlspecialchars($_POST["address"]);
		?>
	</p>
	<script>
		var cart = <?=$_SESSION["cart"]?>;
		console.log(cart)
		Object.keys(cart).forEach(fruit => {
			if(cart[fruit]){
				$('#'+fruit).toggle()
			}
		})
	</script>
</body>

</html>
