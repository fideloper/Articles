<!-- Date: April 30, 2012 -->
#Changing Apache Run User
In development, especially when dealing with projects in Git, I often find it necessary (or rather, more convenient) to change the user Apache runs as. This gives a few advantages in development:

1. **Useful for dynamically generated images or files.**
You may want such files in your Git repository. This is useful when switching branches or when Git does other file IO operations. If Git does not have permission to delete or create a file, switching branches will lead to repository issues.
2. **SSH Keys**
Using the same user also prevents issues of having to use `sudo` for file IO. This also keeps you from having to create SSH keys for user 'root' as well as the current user for Git commands. This is especially in the case of Ubuntu where you do not log in as user 'root'.
3. **If you are developing a web application on a *nix server.**
You might be networking into your development server via SMB or other file-sharing means. It is convenient make the user you log in as, the apache user, and the directory owner all the same login. In this way, Apache will not have issues running files made from users it does not have access to.

Here's how to do it in Apache:

On my *Ubuntu 12.04 Server*, the Apache directory is found here:

	$ sudo nano /etc/apache2/envvars
	
Edit:

	export APACHE_RUN_USER=www-data
	export APACHE_RUN_GROUP=www-data
To:

	export APACHE_RUN_USER=YOUR_USER
	export APACHE_RUN_GROUP=YOUR_USER

After that, restart Apache.

	$ sudo service apache2 restart

In Nginx, I believe you edit:

	$ sudo nano /etc/nginx/nginx.conf

At the top of the file, you should see "user www-data". You can change your user there. Restart nginx when complete:
	
	$ sudo service nginx restart

*Note:* You may need to `chown` your web files to user you've changed Apache/Nginx to run as.