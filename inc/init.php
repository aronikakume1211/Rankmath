<?php

/**
 * @package RankMath
 */

namespace Inc;

final class init
{
    /**
     * Initialize the classes
     * 
     */
    public static function get_services()
    {
        return [
            Dashboard\Admin::class,
            Base\Enqueue::class,
        ];
    }

    /**
     * Loop through the classes, initialize them, and call the register() method if it exists
     * 
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class
     * 
     * @param class $class class from the services array
     * @return class instance new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}
