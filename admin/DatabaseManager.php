<?php

namespace BW\TodoList;

class DatabaseManager {
    public static function createTable() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'tasks';
        $charset_collate = $wpdb->get_charset_collate();

      $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            title varchar(255) NOT NULL,
            description text,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id),
            KEY user_id (user_id),
            CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES {$$wpdb->prefix}users(ID)
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

