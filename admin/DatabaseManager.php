<?php

namespace BW\TodoList;

class DatabaseManager {
    public static function createTable() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            user_id bigint(20) NOT NULL,
            title varchar(255) NOT NULL,
            description text NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id),
            FOREIGN KEY (user_id) REFERENCES {$wpdb->prefix}users(ID) ON DELETE CASCADE
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public static function removeTable() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks';
        $sql = "DROP TABLE IF EXISTS $table_name;";

        $wpdb->query($sql);
    }
}
