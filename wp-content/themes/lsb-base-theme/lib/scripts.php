<?php
/**
 * Scripts and stylesheets
 *
 * Google Analytics is loaded after enqueued scripts if:
 * - An ID has been defined in config.php
 * - You're not logged in as an administrator
 */
function roots_scripts() {

	/**
	 * The build task in Grunt renames production assets with a hash
	 * Read the asset names from assets-manifest.json
	 */

	// Development assets
	$assets = array(
		'css'       => 'assets/css/bundle.temp.css',
		'js'        => 'assets/js/bundle.temp.js'
		);

	$version = array(
		'css'				=> time(),
		'js'				=> time()
	);

	if ('development' !== WP_ENV) {
		// Production assets
		$assets['css'] = 'assets/css/bundle.min.css';
		$assets['js'] = 'assets/js/bundle.min.js';

		$manifest_json = file_get_contents(get_template_directory() . '/assets/manifest.json');
		$manifest     = json_decode($manifest_json, true);

		$version['css'] = $manifest[$assets['css']];
		$version['js'] = $manifest[$assets['js']];
	}

	$assets['css'] = get_template_directory_uri() . '/' . $assets['css'];
	$assets['js'] = get_template_directory_uri(). '/' . $assets['js'];

	wp_enqueue_style('lsb_css', $assets['css'], array(), $version['css'], 'all');

	//wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, false);
	wp_enqueue_script('lsb_js', $assets['js'], array( 'jquery' ), $version['js'], true);
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

/**
 * Google Analytics snippet from HTML5 Boilerplate
 */
function roots_google_analytics() {
	if (WP_ENV === 'development') { ?>
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>', 'none');ga('send','pageview');
		</script>
	<?php
	} else { ?>
		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','<?php echo GOOGLE_ANALYTICS_ID; ?>');ga('send','pageview');
		</script>
	<?php
	}
}
if (GOOGLE_ANALYTICS_ID && !current_user_can('manage_options')) {
	add_action('wp_footer', 'roots_google_analytics', 20);
}
