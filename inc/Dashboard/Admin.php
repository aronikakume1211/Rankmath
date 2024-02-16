<?php

/**
 * @package RankMath
 */

namespace Inc\Dashboard;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;

class Admin extends BaseController
{
    public $settings;

    public $callbacks;

    public function register()
    {
        $this->settings = new SettingsApi();


        // Threaded function calls
        $this->settings->get()->register();
    }

}
