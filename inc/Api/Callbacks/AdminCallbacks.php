<?php

/**
 * @package RankMath
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function admin_dashboard()
    {
        return require_once("$this->plugin_path/templates/app.php");
    }

    // Callbacks for REST API
    public function get_employees()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'rank_math_stat';
        $query = "SELECT * FROM `$table`";
        $list = $wpdb->get_results($query);
        return $list;
    }
}
