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

	wp_enqueue_script( 'wp-util' );
	wp_enqueue_script( 'algolia-instantsearch' );
	//wp_enqueue_script('modernizr', get_template_directory_uri() . $assets['modernizr'], array(), null, false);
	wp_enqueue_script('lsb_js', $assets['js'], array( 'jquery' ), $version['js'], true);
}
add_action('wp_enqueue_scripts', 'roots_scripts', 100);

function roots_admin_scripts() {

		/**
		 * The build task in Grunt renames production assets with a hash
		 * Read the asset names from assets-manifest.json
		 */

		// Development assets
		$assets = array(
			'css'       => 'assets/css/admin.temp.css',
			);

		$version = array(
			'css'				=> time()
		);

		if ('development' !== WP_ENV) {
			// Production assets
			$assets['css'] = 'assets/css/admin.min.css';

			$manifest_json = file_get_contents(get_template_directory() . '/assets/manifest.json');
			$manifest     = json_decode($manifest_json, true);

			$version['css'] = $manifest[$assets['css']];
		}

		$assets['css'] = get_template_directory_uri() . '/' . $assets['css'];

		wp_enqueue_style('lsb_css', $assets['css'], array(), $version['css'], 'all');
	}
	add_action('admin_enqueue_scripts', 'roots_admin_scripts', 100);

/**
 * Google Analytics snippet from HTML5 Boilerplate
 */
function roots_google_analytics() {
	if (WP_ENV === 'development') { ?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics_debug.js','ga');

			ga('create', '<?php echo GOOGLE_ANALYTICS_ID; ?>', 'auto');

			if (location.hostname == 'localhost') {
				ga('set', 'sendHitTask', null);
			}

			ga('send', 'pageview');
		</script>
	<?php
	} else { ?>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', '<?php echo GOOGLE_ANALYTICS_ID; ?>', 'auto');
			ga('send', 'pageview');
		</script>
	<?php
	}
}

if (GOOGLE_ANALYTICS_ID && ((WP_ENV === 'development') || !current_user_can('manage_options'))) {
	add_action('wp_head', 'roots_google_analytics', 20);
}
