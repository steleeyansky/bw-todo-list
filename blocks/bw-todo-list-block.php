<?php

use BW\TodoList\AdminPage;
use Carbon_Fields\Block;
use Carbon_Fields\Field\Field;
use BW\TodoList\Helpers\FragmentRenderer;
wp_register_style(
	'BW-todo-block-stylesheet',
	BW_PLUGIN_DIR_URL. 'assets/styles/todo-frontend.css'
);

Block::make(__('BW Todo'))
	->set_mode('preview')
	->set_style( 'BW-todo-block-stylesheet' )
	->set_render_callback(function ($fields, $attributes, $inner_blocks) {
		$tasks = BW\TodoList\Models\TodoItem::read(get_current_user_id());
		?>
			<h2>
				<?php _e('BW Todo List'); ?>
			</h2>
		<?
		FragmentRenderer::render('task-list', ['tasks' => $tasks]);
	});
