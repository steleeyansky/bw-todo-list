<?php
namespace BW\TodoList;

use BW\TodoList\Models\TodoItem;


class AdminPage {
    public function __construct() {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    public function enqueueAssets() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('todo-ajax', BW_PLUGIN_DIR_URL . 'assets/js/todo-ajax.js', ['jquery'], null, true);
        wp_localize_script('todo-ajax', 'todo_ajax_obj', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
        wp_enqueue_style('todo-popup-style', BW_PLUGIN_DIR_URL . 'assets/styles/popup.css');

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
        $current_user_id = get_current_user_id();
        $tasks = TodoItem::read($current_user_id);
    
    
        require_once plugin_dir_path(__FILE__) . 'templates/admin-page.php';


    }
}

