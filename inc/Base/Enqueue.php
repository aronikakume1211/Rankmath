<?php

/**
 * 
 * @package RankMath
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        if (is_admin()) {
            $screen = get_current_screen();
            if (isset($screen->base) && 'dashboard' === $screen->base) {
                wp_enqueue_style('rankmath-style', $this->plugin_url . 'build/index.css');
                wp_enqueue_script('rankmath-script', $this->plugin_url . 'build/index.js', ['wp-element','wp-api-fetch','wp-components'], '1.0.0', true);
            }
        }
    }
}
