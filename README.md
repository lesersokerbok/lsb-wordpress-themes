# Debugging

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
