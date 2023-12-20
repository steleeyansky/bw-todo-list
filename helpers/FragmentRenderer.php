<?php 
namespace BW\TodoList\Helpers;

class FragmentRenderer {
    public static function render($fragment_name) {
        $fragment_path = plugin_dir_path(__DIR__) . 'fragments/' . $fragment_name . '.php';

        if (file_exists($fragment_path)) {
            include($fragment_path);
        } else {
            // Handle the error
            error_log("Fragment file not found: " . $fragment_path);
        }
    }
}
