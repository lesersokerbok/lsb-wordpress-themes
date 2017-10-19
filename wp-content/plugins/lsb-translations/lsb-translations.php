<?php
/**
 * Plugin Name: LSB: Oversettelser
 * Description: Oversettelse av Boksøks hovedkategorier
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Translations;

include('lib/common.php');
include('lib/group.php');
include('lib/init.php');

add_action( 'acf/init', __NAMESPACE__ . '\\init' );