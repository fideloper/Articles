# Home page


test ad stuff here


```
<?php
	$final_content = '<p>Something went wrong!</p>';
		
	if(isset($_GET['file'])) {
		$content = file_get_contents($_GET['file']);
			
		if($content !== FALSE) {
			$final_content = $markdown->parse($content);
		}
	} ?><!doctype html>
<html>
	<head>My Site</head>
	<body>
		<header>Welcome to My Site</header>
		<article>
			<?php echo $final_content; ?>
		</article>
		<footer>Thanks for visiting!</footer>
	</body>
</html>
```