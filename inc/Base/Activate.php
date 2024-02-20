<?php

/**
 * @package RankMath
 */

namespace Inc\Base;

use DateTime;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }


    public static function create_table()
    {
        global $wpdb;
        global $jal_db_version;

        $table_name = $wpdb->prefix . 'rank_math_stat';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id int NOT NULL AUTO_INCREMENT,
            activedate DATETIME,
            writer VARCHAR(50),
            price int NOT NULL,
            PRIMARY KEY  (id)
            ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        add_option('jal_db_version', $jal_db_version);
    }

    public static function insert_data()
    {
        $data = [
            [
                "name" => __("test1", "rank-math"),
                "price" => __("5", "rank-math"),
                "date" => __("2024-02-11T19:30:33", "rank-math")

            ],
            [
                "name" => __("test2", "rank-math"),
                "price" => __("4", "rank-math"),
                "date" => __("2024-02-17T19:30:33", "rank-math")
            ],
            [
                "name" => __("test3", "rank-math"),
                "price" => __("3", "rank-math"),
                "date" => __("2024-01-26T19:30:33", "rank-math")
            ],
            [
                "name" => __("test4", "rank-math"),
                "price" => __("2", "rank-math"),
                "date" => __("2024-01-25T19:30:33", "rank-math")
            ],
            [
                "name" => __("test5", "rank-math"),
                "price" => __("7", "rank-math"),
                "date" => __("2024-02-16T19:30:33", "rank-math")
            ],
            [
                "name" => __("test6", "rank-math"),
                "price" => __("5", "rank-math"),
                "date" => __("2024-02-18T19:30:33", "rank-math")

            ],
            [
                "name" => __("test7", "rank-math"),
                "price" => __("7", "rank-math"),
                "date" => __("2024-02-14T19:30:33", "rank-math")
            ],
            [
                "name" => __("test8", "rank-math"),
                "price" => __("3", "rank-math"),
                "date" => __("2024-02-19T19:30:33", "rank-math")
            ],
            [
                "name" => __("test9", "rank-math"),
                "price" => __("1", "rank-math"),
                "date" => __("2024-02-12T19:30:33", "rank-math")
            ],
            [
                "name" => __("test10", "rank-math"),
                "price" => __("6", "rank-math"),
                "date" => __("2024-01-27T19:30:33", "rank-math")
            ]
        ];
        global $wpdb;
        $table = $wpdb->prefix . 'rank_math_stat';
        $count = $wpdb->get_var("SELECT COUNT(*) FROM $table");
        // Check if the table has data
        if ($count > 0) {
            return;
        }
        foreach ($data as $key => $value) {
            $sql = array(
                'activedate' => esc_attr($value['date'], 'rank-math'),
                'writer' => esc_attr__($value['name'], 'rank-math'),
                'price' => esc_attr__($value['price'], 'rank-math'),
            );
            $list = $wpdb->insert($table, $sql);
        }

        return $list;
    }
}
