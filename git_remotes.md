#Git 001: Git Remotes

A remote is any non-local repository. Remotes are used as aliases for a URL which points to a remote repository. You use remotes to fetch, merge, push and pull between your local remote repositories.

Let's cover some basic commands.

### List Remotes

	#List all remotes in your repository
	$ git remote -v

Here's some sample output. Note this repo has one remote, `origin`. Note also that you can define a fetch and push location per alias.

	origin git@yourcompany.beanstalkapp.com:/repo.git (fetch)
	origin git@dyourcompany.beanstalkapp.com:/repo.git (push)

### Add Remotes

Let's say you want to add a remote. Git is not have a central server. Rather it is distributed - every repository has all the information about the project. You can add remotes to collaborate with other people.

	$ git remote add some_alias git@github.com:user/repo.git

A use case for adding an origin is if you have forked a project on Github, but want to update your code with the latest from the 'parent' project. You can add the parent project as a remote and pull from it.

	$ git remote -v
	#Now yields:
	origin git@yourcompany.beanstalkapp.com:/repo.git (fetch)
	origin git@dyourcompany.beanstalkapp.com:/repo.git (push)
	some_alias git@github.com:user/repo.git (fetch)
	some_alias git@github.com:user/repo.git (push)

You can now pull from a branch in the new `some_alias` remote.

	$ git pull some_alias master

### Remove Remotes

If you want to remove a remote, you can do that as well. Removing a remote does not affect your code nor your commit history. You will not lose work, but you will not be able to push or pull to that alias after removing it. I will remove the recently added remote `some_alias`:

	$ git remote rm some_alias

### Rename Remotes:

You can also rename a remote at any time. If I wanted to rename the alias `some_remote` rather than delete it, I would do:

	#Rename from 'some_alias' to 'steve'
	$ git remote rename some_alias  steve
	
### Change Remote URL:

If you need to change the URL of a remote, you can do that as well:

	$ git remote set-url origin git@github.com:/user/repo.git

This is useful if you switched your repository from (for example) Beanstalkapp.com to Github.com. Rather than clone an empty repository and copy files in, or some other more complicated measures, you can simply change the URL the remote `origin` (or *any* alias) points to, and push to it.

### Caveats / Notes:

1. You **CAN** add a remote from **ANY** repository and pull/merge from it. This will combine the two repositories. You could end up with a huge mess if you add and merge with a completely different repository. If you need to combine two or more separate projects into one, consider using a [Subtree Merge](http://help.github.com/subtree-merge/) or [Submodule](http://help.github.com/submodules/).
2. You **CAN NOT** push to just **ANY** project. When you perform a push, git essentially does a `$ git log` to determine if the tip of the *remote* branch is in your history. If it is not, it rejects the push. In other words, you can't push unless you have some shared commit history and, like normal, you can't override changes others have pushed up without first pulling those changes down.