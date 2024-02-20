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
    public function get_employees($request)
    {
        global $wpdb;
        $table = $wpdb->prefix . 'rank_math_stat';

        // Get the number of days from the request parameters or set default to 7
        $days = $request->get_param('days') ?: 15;
        $start_date = date('Y-m-d', strtotime("-$days days"));
        $end_date = date('Y-m-d');

        // Construct the SQL query with date range condition
        $query = $wpdb->prepare("
            SELECT *
            FROM `$table`
            WHERE `activedate` BETWEEN %s AND %s
        ", $start_date, $end_date);

        // Execute the query
        $list = $wpdb->get_results($query);

        return $list;
    }
}
