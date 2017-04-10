<?php
/**
 * Plugin Name: LSB: Innholds-seksjoner
 * Description: Legger til muligheten for seksjoner på sider og innlegg
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\PostSection;
include('lib/add-custom-fields.php');

add_action( 'acf/init', __NAMESPACE__ . '\\add_custom_fields' );
