<!DOCTYPE html>
<html>

<body>

	<p>
		Hello
		<?php echo $_POST["name"]; ?>
	</p>
	<p>
		Your email:
		<a href='mailto:<?php echo $_POST["email"]; ?>' target="_top">
			<?php echo $_POST["email"]; ?>
		</a>
	</p>
	<p>
		Your major:
		<?php echo $_POST["major"]; ?>
	</p>
	<p>
		Your comments:
		<?php echo $_POST["comments"]; ?>
	</p>
</body>

</html>
