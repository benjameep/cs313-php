<?php
require '_shared.php'
?>

<div class="ui right fixed vertical menu">
    <a class="header item" href="index.html">
        <img class="ui mini image" src="assets/logo.jpg">
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