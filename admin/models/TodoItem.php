<?php

namespace BW\TodoList\Models;

class TodoItem
{
    public static function create($data)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';

        // only registerd users can create tasks (premium feature for non registred..)
        if (!is_user_logged_in()) {
            return;
        }
        $wpdb->insert($table_name, [
            'title' => sanitize_text_field($data['title']),
            'description' => sanitize_textarea_field($data['description']),
            'user_id' => get_current_user_id()
        ]);


        return $wpdb->insert_id;
    }

    public static function read($user_id = null) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
    
        if ($user_id !== null) {
            // Fetch tasks for a specific user
            return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id), ARRAY_A);
        } else {
            // Fetch all tasks
            return $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
        }
    }
    
    public static function update($id, $data)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';
    
        $updated = $wpdb->update(
            $table_name,
            [
                'title' => sanitize_text_field($data['title']),
                'description' => sanitize_textarea_field($data['description']),
            ],
            ['id' => $id],
            ['%s', '%s'], // Data format for 'title' and 'description'
            ['%d']        // Where format for 'id'
        );
    
        return $updated !== false; 
    }
    

    public static function delete($id)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'tasks';

        $wpdb->delete($table_name, ['id' => $id]);
    }
}
