<?php

namespace BW\TodoList;

use BW\TodoList\Models\TodoItem;

class AdminPage
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    public function enqueueAssets()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('todo-ajax', BW_PLUGIN_DIR_URL . 'assets/js/todo-ajax.js', ['jquery'], null, true);
        wp_enqueue_script('todo-switcher', BW_PLUGIN_DIR_URL . 'assets/js/tab-switcher.js', ['jquery'], null, true);
        wp_localize_script('todo-ajax', 'todo_ajax_obj', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
        wp_enqueue_style('todo-popup-style', BW_PLUGIN_DIR_URL . 'assets/styles/popup.css');
        wp_enqueue_style('todo-import-export', BW_PLUGIN_DIR_URL . 'assets/styles/tab-style.css');
    }

    public function addAdminMenu()
    {
        add_menu_page(
            'BW Todo List',
            'Todo List',
            'manage_options',
            'bw-todo-list',
            [$this, 'renderAdminPage'],
            'dashicons-list-view',
            6
        );

        add_submenu_page(
            'bw-todo-list',
            'Import/Export Todos',
            'Import/Export',
            'manage_options',
            'bw-todo-import-export',
            [$this, 'renderImportExportPage']
        );
    }
    public function renderImportExportPage()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/import-export-page.php';
    }


    public function importTodos()
    {
        if (!isset($_FILES['todo_import_file'])) {
            return;
        }

        if ($_FILES['todo_import_file']['error'] !== UPLOAD_ERR_OK) {
            return;
        }

        // Check if the file is a CSV
        $file_type = wp_check_filetype($_FILES['todo_import_file']['name']);
        if ($file_type['type'] !== 'text/csv') {
            throw new \Exception('Invalid file type');
        }

        // Open the file for reading
        $file = fopen($_FILES['todo_import_file']['tmp_name'], 'r');
        if (!$file) {
            throw new \Exception('Error opening file');
        }
    
        // Process CSV file
        $firstLine = true;
        while (($data = fgetcsv($file)) !== FALSE) {
            if ($firstLine) {
                $firstLine = false; 
                continue;
            }
            $title = sanitize_text_field($data[0]);
            $description = sanitize_textarea_field($data[1]);

            // Insert data into database (adjust as per your actual database interaction code)
            TodoItem::create([
                'title' => $title,
                'description' => $description,
                'created_at' => current_time('mysql'),
                'updated_at' => current_time('mysql')
            ]);
        }

        fclose($file);


        add_action('admin_notices', function () {
        ?>
                 <div class="notice notice-success is-dismissible">
                     <p>Todos imported successfully</p>
                 </div>
        <?php
             });
    }

    public function exportTodos() {
        $current_user_id = get_current_user_id();
        $todos = TodoItem::read($current_user_id);

        if (empty($todos)) {
            return;
        }

        // Set the headers to download the file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="todos.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');
        
        // Add CSV header
        fputcsv($output, ['ID', 'Title', 'Description']);

        // Add the data
        foreach ($todos as $todo) {
            fputcsv($output, [$todo['id'], $todo['title'], $todo['description']]);
        }

        fclose($output);
        exit;
    }

    public function renderAdminPage()
    {
        $current_user_id = get_current_user_id();
        $tasks = TodoItem::read($current_user_id);


        require_once plugin_dir_path(__FILE__) . 'templates/admin-page.php';
    }
}
