<?php
require_once '_shared.php';
?>

<div class="ui right fixed vertical menu">
    <a class="header item" href="index.html">
        <img class="ui mini image" src="assets/logo.jpg">
    </a>
    <a id="sign" class="item"></a>
    <div class="item">
        <div class="header">All Posts</div>
        <div class="menu">
<?php
$query = $db->query('SELECT title, id FROM post');
foreach ($query as $row)
{
	echo '<a class="item" href="posts.php?id=' . $row['id'] . '">';
	echo $row['title'];
	echo '</a>';
}
?>
        </div>
    </div>
    <a id="newPost" class="item" href="createPost.php"><i class="add icon"></i> Create Post</a>
    <script>
        var sign = document.getElementById('sign')
        if(localStorage.userid){
            sign.innerHTML = "Log out"
            sign.href = "javascript:(function(){delete localStorage.userid;location.reload()})()"
            newPost.removeAttribute('hidden')
        } else {
            sign.innerHTML = "Login / Sign Up"
            sign.href = "login.html"
            document.getElementById('newPost').style.display = 'none'
        }
    </script>
</div>