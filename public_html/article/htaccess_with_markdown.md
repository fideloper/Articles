# An Interesting Use of .htaccess

I enjoy using [Markdown](http://daringfireball.net/projects/markdown/) as a tool to publish to the web. I often use Markdown files to power the content of my sites.

To that end, I use Apache's `.htaccess` along with `mod_rewrite`. This allows me to test if a Markdown file is being requested, and if so, pass that request to a script to handle that request. In this example, the `index.php` file will handle the request and load the appropriate Markdown file to be used to display the final HTML code.

Here's how.

### The setup
***.htaccess :*** [Related Gist](https://gist.github.com/2509880)
	
	#Turn on Rewrite Engine
	RewriteEngine On

	#Check if requested file ends in .md or .markdown
	RewriteCond $1 \.(md|markdown)$ [NC]

	#Check if file exists
	RewriteCond %{REQUEST_FILENAME} -f

	#Rewrite so $_GET['file'] is available to PHP code
	RewriteRule ^(.*)$ /index.php?file=$1 [L]

As you can see, the `.htaccess` file sends any direct request for a Markdown file and sends that request through the site's index.php. The index.php can then test for the GET request parameter 'file' load a Markdown file if appropriate.

The power of using `.htaccess` in this manner is that it will still responsd with a 404 error if the Markdown file does not exist. It will not rewrite the request unless it is a Markdown file AND unless the file exists.

***index.php :***

	#Extremely simplified, insecure example of retrieving Markdown file
	if(isset($_GET['file'])) {
		$content = file_get_contents($_GET['file']);
		$final_content = $markdown->parse($content);
	}

You can use this method to display the content in a template:

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