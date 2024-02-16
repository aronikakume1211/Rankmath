<?

/**
 * @package RankMath
 */


/**
 * Plugin Name: Rank Math Stat
 * Plugin URI: https://rankmath.com/
 * Description: Rank Math Stat is a plugin that allows you to see the statistics of your website.
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * Version: 1.0.0
 * Author: Rank Math
 * Author URI: https://rankmath.com/
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rank-math
 */

/*
This program is free software: you can redistribute
 it and/or modify it under the terms of the GNU General 
 Public License as published by the Free Software Foundation,
  either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
See the GNU General Public License for more details.

You should have received a copy of the GNU General
 Public License along with this program. If not,
  see <https://www.gnu.org/licenses/>.
*/

// If this file is called directly, abort.
defined('ABSPATH') or die('No script kiddies please!');

// Require once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Inc\Base\Activate;
use Inc\Base\Deactivate;

/**
 * The code that runs during plugin activation
 * 
 */

function activate_rank_math_stat()
{
	Activate::activate();
	Activate::create_table();
	Activate::insert_data();
}

/**
 * The code that runs during plugin deactivation
 * 
 */

function deactivate_rank_math_stat()
{
	Deactivate::deactivate();
}


register_activation_hook(__FILE__, 'activate_rank_math_stat');
register_deactivation_hook(__FILE__, 'deactivate_rank_math_stat');

/**
 * Initialize all the core classes of the plugin
 * 
 */


if (class_exists('Inc\\Init')) {
	Inc\Init::register_services();
}
