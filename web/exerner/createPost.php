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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css" />
		<script src="http://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
		    crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/qwest/4.5.0/qwest.min.js"></script>
	</head>

	<body>
		<div class="ui container">
			<?php require "menu.php"; ?>
			<h1>Exerner!</h1>
			<form class="ui form">
				<h2 class="ui top attached header">
					<input type="text"></input>
				</h2>
				<div class="ui attached segment">
					<div class="field">
						<textarea></textarea>
					</div>
					<div class="ui primary submit button">
						Create Post
					</div>
				</div>
            </form>
		</div>
		<script>
			$('.submit').click(async e => {
				var r = await qwest.post('_createPost.php',{
					body:$('.form textarea').val(),
					title:$('.form .header input').val(),
					personid:localStorage.userid,
				})
				window.location.href = 'posts.php?id='+r.responseText
			})
		</script>
	</body>

</html>