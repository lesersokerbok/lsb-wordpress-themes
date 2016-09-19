# Websites for Leser søker bok
Leser søker bok has three main websites:
* Home page (lesersokerbok.no)
* Boksøk (boksok.no) | A searchable directory of books reviewed by Leser søker bok.
* Ut av Hylla (utavhylla.wordpress.com) | A blog and resource center for "Bok for alle"-bibliotek.

This repository contains the code for the two first sites, the third runs on wordpress.com.

## Gitter
This repository has a chatroom on Gitter:  

[![Join the chat at https://gitter.im/lesersokerbok/lsb-wordpress-themes](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/lesersokerbok/lsb-wordpress-themes?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## Themes & Plugins
There are two themes with multiple plugins: 
* [`lsb-theme-home`](https://github.com/lesersokerbok/lsb-theme-home)
  * [`lsb-people`](https://github.com/lesersokerbok/lsb-people)
  * [`lsb-frontpage-sections`](https://github.com/lesersokerbok/lsb-frontpage-sections)
* [`lsb-theme-boksok`](https://github.com/lesersokerbok/lsb-theme-boksok)
  * [`lsb-boksok-bibsyst`](https://github.com/lesersokerbok/lsb-boksok-bibsyst)
  * [`lsb-boksok-core`](https://github.com/lesersokerbok/lsb-boksok-core)

Both themes are based on roots.io.

In addition there is a public plugin to be used by libraries 
and organizations to add a Boksøk search widget in their sidebar.
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

## Dev

### Branching strategy
The projects uses [GitHub Flow](https://guides.github.com/introduction/flow/).

### Localization
Norwegian is used as the base language and all strings shuld be ready for translations. This is also true for backend code.

### Grunt
* [TODO] Update

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

## Test / Release
The sites are hosted at WPEnginge as multisite installs.

There are two installs:
* [lsbtest.wpengine.com](http://lsbtest.wpengine.com/): Used for testing purposes
* [lsb.wpengine.com](http://lsb.wpengine.com/): Used for production.

### Deployment
If you have not already done so go through the Initial Setup process.

#### Testing
Before finishing a feature branch or accepting a pull request test 
the changes at the `lsbtest` install.
* Build assets:  
`grunt build`
* Commit assets:  
`git commit -a -m "Assets built for testing"`
* Push to test:  
`git push lsbtest`

#### Release
Releases and hotfixes should be tested at the `lsbtest` install before being
pushed to the `lsb` install.

* [TODO] Update

#### Initial Setup  
* Get push access e-mail Benedicte (raae@bgraphic.no) your SSH Public Key.
* Continue when you have gotten access to the installs, check by running:  
`ssh git@git.wpengine.com info`
* Add lsbtest as a remote:  
`git remote add lsbtest git@git.wpengine.com:production/lsbtest.git`
* Add lsb as a remote:  
`git remote add lsbprod git@git.wpengine.com:production/lsb.git`