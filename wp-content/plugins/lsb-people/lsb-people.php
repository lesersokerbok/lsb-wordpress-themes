<?php
/**
 * Plugin Name: LSB: Personer
 * Description: Legger til innholdstype Person. Brukes for ansatte og styremedlemmer.
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\People;

include('lib/custom-fields.php');
include('lib/image-sizes.php');
include('lib/post-type.php');
include('lib/relationship.php');

add_action( 'init', __NAMESPACE__ . '\\register_post_type' );
add_action( 'init', __NAMESPACE__ . '\\add_image_size' );
add_action( 'acf/init', __NAMESPACE__ . '\\register_custom_fields' );
add_action( 'acf/init', __NAMESPACE__ . '\\register_relationship' );
