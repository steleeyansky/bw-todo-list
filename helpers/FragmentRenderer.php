<?php 
namespace BW\TodoList\Helpers;

class FragmentRenderer {
    public static function render($fragment_name, $params = []) {
        $fragment_path = plugin_dir_path(__DIR__) . 'fragments/' . $fragment_name . '.php';

        if (file_exists($fragment_path)) {
            extract($params, EXTR_SKIP);
            include($fragment_path);
        } else {
            // Handle the error
            error_log("Fragment file not found: " . $fragment_path);
        }
    }
}
