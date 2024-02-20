<?php

/**
 * Package RankMath
 */

namespace Inc\Api;

use Inc\Api\Callbacks\AdminCallbacks;

class SettingsApi
{
    public $callbacks;

    public function register()
    {
        $this->callbacks = new AdminCallbacks();
        add_action('wp_dashboard_setup', array($this, 'admin_init_widget'));
        return $this;
    }

    public function admin_init_widget()
    {
        if (current_user_can('manage_options')) {
            wp_add_dashboard_widget('rank_math',  __('Rank Math Widget', 'rank-math'), array($this->callbacks, "admin_dashboard"));
        }
    }

    // REST API for employees
    public function get()
    {
        add_action('rest_api_init', function () {
            register_rest_route('rankmath/v1', '/employees', array(
                'methods'             => 'GET',
                'callback'            => array($this->callbacks, 'get_employees'),
                'args'                => array(
                    'days' => array(
                        'default' => 7, // Default to last 7 days
                    ),
                ),
            ));
        });
        return $this;
    }
}
