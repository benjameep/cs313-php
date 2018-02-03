<!DOCTYPE html>
<?php
	try
	{
		$user = 'fhtpdujbrnegmq';
		$password = '5b7d0196b882f4f833208b469f66affff3314a511fb3a84c74f4d3f2f588bd29';
		$db = new PDO('pgsql:host=ec2-54-83-204-230.compute-1.amazonaws.com;dbname=d5ugpkepuq2kse', $user, $password);
	}
	catch (PDOException $ex)
	{
		echo 'Error!: ' . $ex->getMessage();
		die();
	}
?>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css" />
	<script src="http://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.js"></script>
</head>

<body>
	<div class="ui container">
	<div class="ui right fixed vertical menu">
		<a class="header item" href="index.html">
			<img class="ui mini image" src="logo.jpg">
		</a>
		<a class="item" href="sign-in.html">Sign-in</a>
		<div class="item">
			<div class="header">All Posts</div>
			<div class="menu">
				<?php
					foreach ($db->query('SELECT title, id FROM post') as $row)
					{
						echo '<a class="item" href="posts.php?id=' . $row['id'] . '">';
						echo $row['title'];
						echo '</a>';
					}
				?>
			</div>
		</div>
	</div>
		<h1 class="ui header">
			Welcome to Exerner!
		</h1>
		<p>Home of the simplest blog posts ever!</p>
	</div>
</body>

</html>
