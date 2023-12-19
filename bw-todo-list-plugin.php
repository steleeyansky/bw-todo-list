<?php
/**
 * Plugin Name: BW Todo List
 * Plugin URI: http://todo.com/to-do-list
 * Description: A simple and efficient to-do list plugin.
 * Version: 1.0
 * Author: Name Surname
 * Author URI: http://author-url.com
 */

require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . '/includes/functions.php';

use BW\TodoList\DatabaseManager;
use BW\TodoList\AdminPage;

// Hook the DatabaseManager's createTable method to plugin activation
register_activation_hook(__FILE__, [DatabaseManager::class, 'createTable']);

$adminPage = new AdminPage();

