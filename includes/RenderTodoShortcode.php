<?php

namespace BW\TodoList\Includes; 

use BW\TodoList\Models\TodoItem;
use BW\TodoList\View\TaskView;

class RenderTodoShortcode
{
    public function __construct()
    {
        add_shortcode('bw-render-todo', [$this, 'handle_shortcode']);
    }


    public function handle_shortcode($atts)
    {
        $atts = shortcode_atts([
            'user_id' => get_current_user_id(),
            'color' => '#000000',
        ], $atts, 'bw-render-todo');

        $user_id = intval($atts['user_id']);
        $color = sanitize_hex_color($atts['color']);
        $tasks = TodoItem::read($user_id);


        return TaskView::render($tasks, $color);
    }
}
