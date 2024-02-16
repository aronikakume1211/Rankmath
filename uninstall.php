<?

/**
 * @package RankMath
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$table_name = $wpdb->prefix . 'rank_math_stat';
$sql = "DROP TABLE IF EXISTS $table_name";
$wpdb->query($sql);


// // Clear any cached data that has been removed
wp_cache_flush();

