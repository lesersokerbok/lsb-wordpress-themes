<?php
/**
 * Plugin Name: LSB: Nye seksjoner
 * Description: Legg til seksjoner på sider og innlegg
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Section;

include('lib/common.php');
include('lib/feed.php');
include('lib/hero.php');
include('lib/init.php');
include('lib/menu.php');
include('lib/oembeds.php');
include('lib/post.php');

add_action( 'acf/init', __NAMESPACE__ . '\\init' );