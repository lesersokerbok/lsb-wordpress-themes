# Websites for Leser søker bok
Leser søker bok has three main websites:
* Home page (lesersokerbok.no)
* Boksøk (boksok.no) | A searchable directory of books reviewed by Leser søker bok.
* Ut av Hylla (utavhylla.wordpress.com) | A blog and resource center for "Bok for alle"-bibliotek.
  * Discontinued, but is still available.

This repository contains the code for the two first sites, the third runs on wordpress.com.

## Testing
There is also a test site [lsbtest.wpengine.com](http://lsbtest.wpengine.com/).

## Themes
There is one theme:
* `lsb-base-theme`

The theme is based on [roots.io](roots.io).

## Plugins
There are several plugins:
* `lsb-bibsyst-integration`
	* Responsible for the Bibsyst integration.
* `lsb-boksok-core`
	* Adds Boksøks core functionality
* `lsb-page-sections`
	* Responsible for page section acf fields
	* Used by the frontpage template
* `lsb-people`
	* Adds the custom post type person
	* Used for emplyees and board members
	* Used by the board and employee templates.
	
In addition there is a public plugin to be used by libraries and organizations to add a Boksøk search widget in their sidebar.
* [`lsb-boksok-public`](https://github.com/lesersokerbok/lsb-boksok-public)

## Issues
Issues are tracked with [GitHub Issues](https://github.com/lesersokerbok/lsb-wordpress-themes/issues), but can also be viewed as a kanban board through [Huboard](https://huboard.com/lesersokerbok/lsb-wordpress-themes#/).

**[Huboard](https://huboard.com)**
is a kanban webservice for GitHub issues.  
Sign in using your GitHub account.

### Issue process
* When you start work on an issue add yourself as assignee. 
* Then pull the issue into the next appropriate lane if needed.
* When you are done with the work mark the issue as "ready for next stage".
* If you are having problems and/or need help mark the issue as "blocked".

Never push an issue into the next lane when you are done.

## Development

The projects uses the [GitHub Flow](https://guides.github.com/introduction/flow/).

All work is done in a seperate branch and added to the `master` branch using pull requests. 

### Initial Setup  
* Clone this project:  
`git clone git@github.com:lesersokerbok/lsb-wpengine.git`
* Install packages needed by the `lsb-base-theme`:  
	`(cd wp-content/themes/lsb-base-theme/ && npm install)`
* Set up push access to WPEngine innstalls before testing and deployment.
	* E-mail Benedicte (raae@bgraphic.no) with your SSH Public Key.
	* Check if you have access by running:  
	`ssh git@git.wpengine.com info`
	* Add lsbtest as a remote:  
	`git remote add lsbtest git@git.wpengine.com:production/lsbtest.git`
	* Add lsbprod as a remote:  
	`git remote add lsbprod git@git.wpengine.com:production/lsb.git`

### Development
To build assets while developing use:  
`(cd wp-content/themes/lsb-base-theme/ && grunt dev)`

### Testing
Before a pull request is accepted it should be testet at the `lsbtest` origin.

```
(cd wp-content/themes/lsb-base-theme/ && grunt build)
git commit -a -m "Assets built"
git push lsbtest
```

### Accepting a pull request
Pull request are accepted and merged using the `squash and merge` option.

### Deploying
After a pull request is accepted the `master` branch should be deployed as soon as possible.

```
git checkout master
git pull
git push lsbprod
```

### Localization
Norwegian is used as the base language and all strings shuld be ready for translations. This is also true for backend code.

### Debugging

Add / modify the following to wp-config.php:

```
define('WP_DEBUG',         true);  // Turn debugging ON
define('WP_DEBUG_DISPLAY', false); // Turn forced display OFF
define('WP_DEBUG_LOG',     true);  // Turn logging to wp-content/debug.log
define('WP_ENV', 'development');
```

Now you can use the ```_log(String)``` function, and monitor output in ```wp-content/debug.log```:

```
// In some php file:
<?php _log("I'm debugging!"); ?>

// In terminal:
$ tail -f wp-content/debug.log
[06-Aug-2014 10:46:30 UTC] I'm debugging!
```

The ```debug.log``` file is ignored by git.
