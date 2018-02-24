<!DOCTYPE html>
<html>
<?php
	require_once '_shared.php';
	
	$postid = safe_get('id','1');

//	 Getting the post information
	$stmt = $db->prepare('SELECT title, body, 
	post.rating AS postRating,
	personid,username,
	person.rating AS personRating 
		FROM post
		JOIN person
    ON post.personid = person.id
		WHERE post.id=:id;');
	$stmt->execute(array('id' => $postid));
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
	$stmt->execute(array('id' => $postid));
	$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	?>

	<head>
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css" />
		<script src="//code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
		    crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/qwest/4.5.0/qwest.min.js"></script>
	</head>

	<body>
		<div class="ui container">
			<?php require "menu.php"; ?>
			<h1>Exerner!</h1>
			<h2 class="ui top attached header">
				<?=$title?>
					<div class="sub header">By
						<?=$opusername?>
					</div>
			</h2>
			<div class="ui attached segment">
				<p>
					<?=$body?>
				</p>
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
				<form class="ui reply form" hidden>
					<div class="field">
						<textarea style="height:10px"></textarea>
					</div>
					<div class="ui primary submit labeled icon button">
						<i class="icon edit"></i> Add Reply
					</div>
				</form>
			</div>
		</div>
		<script>
			if(localStorage.userid){
				$('.reply').show()
				$('.submit').click(async e => {
					var match = location.search.match(/id=(\d+)/)
					await qwest.post('addComment.php',{
						personid:localStorage.userid,
						postid:match?match[1]:1,
						body:$('.reply textarea').val()
					})
					location.reload()
				})
			}
		</script>
	</body>

</html>