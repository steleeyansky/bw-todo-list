<?php 

function bw_enqueue_todo_styles() {
    global $post;
    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'bw-render-todo') ) {

        wp_enqueue_style( 'bw-todo-frontend', BW_PLUGIN_DIR_URL . 'assets/styles/todo-frontend.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'bw_enqueue_todo_styles' );