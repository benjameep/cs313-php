<?php
require_once '_shared.php';
?>

<div class="ui right fixed vertical menu">
    <a class="header item" href="index.php">
        <img class="ui mini image" src="assets/logo.jpg">
    </a>
    <div id="welcome" class="item" hidden>Welcome</div>
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
    <a id="newPost" class="item" href="createPost.php" hidden><i class="add icon"></i> Create Post</a>
    <script>
        var sign = document.getElementById('sign')
        if(localStorage.userid){
            sign.innerHTML = "Log out"
            sign.href = "javascript:(function(){delete localStorage.userid;location.reload()})()"
            document.getElementById('newPost').removeAttribute('hidden')
            var welcome = document.getElementById('welcome')
            welcome.removeAttribute('hidden')
            qwest.get(`_getusername.php?id=${localStorage.userid}`).then(r => {
                welcome.innerHTML = 'Welcome '+r.responseText
            })
        } else {
            sign.innerHTML = "Login / Sign Up"
            sign.href = "login.html"
        }
    </script>
</div>