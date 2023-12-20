<?php

add_action('wp_ajax_add_todo_task', 'add_todo_task_callback');
add_action('wp_ajax_edit_todo_task', 'edit_todo_task_callback');
add_action('wp_ajax_delete_todo_task', 'delete_todo_task_callback');

function add_todo_task_callback()
{
    // Only users with manage_options capability can add tasks
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Insufficient permissions']);
        return;
    }

    // Validate and sanitize input
    $title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
    $description = isset($_POST['description']) ? sanitize_textarea_field($_POST['description']) : '';

    if (empty($title)) {
        wp_send_json_error(['message' => 'Title is required']);
        return;
    }

    // Perform the add operation
    try {


        $task_id = BW\TodoList\Models\TodoItem::create([
            'title' => $title,
            'description' => $description
        ]);

        if ($task_id) {
            $task_html = get_task_html($task_id, $title, $description);

            wp_send_json_success(['html' => $task_html]);
        } else {
            throw new Exception('Failed to create the task.');
        }
    } catch (Exception $e) {
        wp_send_json_error(['message' => $e->getMessage()]);
    }
}

function edit_todo_task_callback()
{
    // Check for required permissions
    if (!current_user_can('manage_options')) {
        wp_send_json_error(['message' => 'Insufficient permissions']);
        return;
    }
  
    $task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;
   
    if ($task_id <= 0) {
        wp_send_json_error(['message' => 'Invalid Task ID']);
        return;
    }
    $title = sanitize_text_field($_POST['title']);
    $description = sanitize_textarea_field($_POST['description']);

    $success = BW\TodoList\Models\TodoItem::update($task_id, [
        'title' => $title,
        'description' => $description
    ]);

    if ($success) {
        $task_html = get_task_html($task_id, $title, $description);
        wp_send_json_success(['html' => $task_html, 'task_id' => $task_id]);
    } else {
        wp_send_json_error(['message' => 'An error occurred while updating the task']);
    }
}

function delete_todo_task_callback()
{
    // Only users with manage_options capability can delete tasks
    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Insufficient permissions'));
        return;
    }


    // Validate and sanitize input (task ID)
    $task_id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($task_id <= 0) {
        wp_send_json_error(array('message' => 'Invalid Task ID'));
        return;
    }

    // Perform the delete operation
    try {
        BW\TodoList\Models\TodoItem::delete($task_id);
        wp_send_json_success(array(
            'message' => 'Task deleted successfully',
            'task_id'  => $task_id,
        ));
    } catch (Exception $e) {
        wp_send_json_error(array('message' => 'An error occurred while deleting the task'));
    }
}

function get_task_html($task_id, $title, $description)
{
    ob_start();
?>
    <tr data-task-id="<?php echo esc_attr($task_id); ?>">
        <td class="title column-title" data-colname="Title"><?php echo esc_html($title); ?></td>
        <td class="description column-description" data-colname="Description"><?php echo esc_html($description); ?></td>
        <td class="actions column-actions" data-colname="Actions">
            <button class="button edit-task" data-id="<?php echo esc_attr($task_id); ?>">Edit</button>
            <button class="button delete-task" data-id="<?php echo esc_attr($task_id); ?>">Delete</button>
        </td>
    </tr>
<?php
    return ob_get_clean();
}
