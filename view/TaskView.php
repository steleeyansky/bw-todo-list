<?php
namespace BW\TodoList\View;

use BW\TodoList\Helpers\FragmentRenderer;

class TaskView {
    public static function render($tasks, $color = '#000000') {
        ob_start();
       
        
        FragmentRenderer::render('task-list', ['tasks' => $tasks, 'color' => $color]);
        return ob_get_clean();
    }
}
