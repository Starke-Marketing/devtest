<?php

/**
 * Plugin Name: DevTest
 * Plugin URI: http://www.example.com/
 * Description: A plugin for testing tests.
 * Version: 1.0
 * Author: John Doe
 */

// You can modify this plugin as you need to achieve the following features:

// 1. Add a new menu item to the admin menu for this plugin, and just print 'Hello World' on that page.

// 2. Set a minimum cart quantity of 2 for product id 16 (Long Sleeve Tee).

// 3. Add a discount of 10% on all products for user id 1.

// 4. Enqueue devtest.js and continue the challenge there.


// Below is a suggested structure for your plugin, but feel free to change anything you need.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class DevUser_CodeChallenge_Plugin {
    
    public function __construct() {}

    function add_menu_item() {}

    function set_minimum_cart_quantity() {}

    function add_discount_on_all_products() {}

    function enqueue_scripts() {}

}
