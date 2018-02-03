<!DOCTYPE html>
<html>
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
		<?php
	$postid = htmlspecialchars($_GET["id"]);
	
//	 Getting the post information
	$stmt = $db->prepare('SELECT title, body, 
	post.rating AS postRating,
	personid,username,
	person.rating AS personRating 
		FROM post
		JOIN person
    ON post.personid = person.id
		WHERE post.id=:id;');
	$stmt->bindValue(':id', $postid, PDO::PARAM_INT);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
//	 Setting the post information
	$title = htmlspecialchars($rows[0]["title"]);
	$body = htmlspecialchars($rows[0]["body"]);
	$postrating = htmlspecialchars($rows[0]["postrating"]);
	$opid = htmlspecialchars($rows[0]["personid"]);
	$opusername = htmlspecialchars($rows[0]["username"]);
	$oprating = htmlspecialchars($rows[0]["personrating"]);
	
	$stmt = $db->prepare('SELECT body,comment.rating AS commentRating,username,person.rating AS personRating FROM comment
    JOIN person
    ON comment.personid = person.id
    WHERE comment.postid=:id;');
	$stmt->bindValue(':id', $postid, PDO::PARAM_INT);
	$stmt->execute();
	$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	?>
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
		<h1>Exerner!</h1>
		<h2 class="ui top attached header">
			<?=$title?>
			<div class="sub header">By <?=$opusername?></div>
		</h2>
		<div class="ui attached segment">
			<p><?=$body?></p>
		</div>
		<div class="ui comments">
			<h4 class="ui dividing header">Comments</h4>
			<?php
				foreach($comments as $comment){
					echo '<div class="comment"><div class="content">';
					echo '<a class="author">' . $comment['username'] . "</a>";
					echo '<div class="text">' . $comment['body'] . '</div>';
					echo "</div></div>";
				}
			?>
		</div>
	</div>
</body>

</html>
