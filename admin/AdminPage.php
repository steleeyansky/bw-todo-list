<?php
namespace BW\TodoList;

use BW\TodoList\Models\TodoItem;

class AdminPage {
    public function __construct() {
        add_action('admin_menu', [$this, 'addAdminMenu']);
    }


    public function addAdminMenu() {
        add_menu_page(
            'BW Todo List',
            'Todo List',
            'manage_options',
            'bw-todo-list',
            [$this, 'renderAdminPage'],
            'dashicons-list-view',
            6
        );
    }

    public function renderAdminPage() {
        require_once plugin_dir_path(__FILE__) . 'templates/admin-page.php';

    }
}


