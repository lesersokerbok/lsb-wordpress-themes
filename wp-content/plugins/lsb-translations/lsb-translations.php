<?php
/**
 * Plugin Name: LSB: Oversettelser
 * Description: Oversettelse av Boksøks hovedkategorier (og ny-i-norge målgruppen).
 * Version: 1.0.0
 * Author: Lilly Labs
 * Author URI: http://lillylabs.no
 */

namespace LSB\Translations;

include('lib/common.php');
include('lib/group.php');
include('lib/init.php');
include('lib/rule-match.php');

add_action( 'acf/init', __NAMESPACE__ . '\\init' );
add_filter( 'acf/location/rule_match/lsb_tax_audience', __NAMESPACE__ . '\\location_rules_match_lsb_tax_audience', 10, 3);