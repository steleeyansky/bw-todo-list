<?php
/**
 * Plugin Name: BW Todo List
 * Plugin URI: http://todo.com/to-do-list
 * Description: A simple and efficient to-do list plugin.
 * Version: 1.0
 * Author: Name Surname
 * Author URI: http://author-url.com
 */

define('BW_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BW_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));

require_once __DIR__ . '/vendor/autoload.php';



use BW\TodoList\DatabaseManager;
use BW\TodoList\AdminPage;
use BW\TodoList\Includes\RenderTodoShortcode;
use Carbon_Fields\Carbon_Fields;

// Hook the DatabaseManager's createTable method to plugin activation
register_activation_hook(__FILE__, [DatabaseManager::class, 'createTable']);

add_action('after_setup_theme', function() {
    Carbon_Fields::boot();
    require_once plugin_dir_path(__FILE__) . 'blocks/bw-todo-list-block.php';
});

$adminPage = new AdminPage();

add_action('init', [new RenderTodoShortcode(), '__construct']);

add_action('admin_init', function() {
    if (isset($_POST['import_todos']) && check_admin_referer('bw_import_todos', 'bw_import_todos_nonce')) {
        $adminPage = new AdminPage();
        $adminPage->importTodos();
    }

    if (isset($_POST['export_todos']) && check_admin_referer('bw_export_todos', 'bw_export_todos_nonce')) {
        $adminPage = new AdminPage();
        $adminPage->exportTodos();
    }
});
