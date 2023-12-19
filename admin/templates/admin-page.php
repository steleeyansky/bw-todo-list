<div class="wrap">
    <h1>BW Todo List</h1>


    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-title">Todo Title</th>
                <th scope="col" id="description" class="manage-column column-description">Description</th>
                <th scope="col" id="actions" class="manage-column column-actions">Actions</th>
            </tr>
        </thead>


        <tbody id="the-list">
            <?php if (!empty($tasks)) : ?>
                <?php foreach ($tasks as $task) : ?>
                    <tr data-task-id="<?php echo esc_attr($task['id']); ?>">
                        <td class="title column-title" data-colname="Title">
                            <?php echo esc_html($task['title']); ?>

                        </td>
                        <td class="description column-description" data-colname="Description">
                            <?php echo esc_html($task['description']); ?>
                        </td>
                        <td class="actions column-actions" data-colname="Actions">
                            <button class="button edit-task" data-id="<?php echo esc_attr($task['id']); ?>">Edit</button>
                            <button class="button delete-task" data-id="<?php echo esc_attr($task['id']); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button id="add-new-task" class="button button-primary">Add New Todo</button>
    <div id="task-modal" class="task-modal" style="display:none;">
        <span class="close-modal">X</span>
        <form id="task-form" class="task-form">
            <div class="form-field">
                <label for="task-title">Title:</label>
                <input type="text" id="task-title" name="title" required>
            </div>
            <div class="form-field">
                <label for="task-description">Description:</label>
                <textarea id="task-description" name="description" rows="5"></textarea>
            </div>
            <div class="form-field">
                <input type="submit" value="Save Todo" class="button button-primary">
            </div>
        </form>
    </div>
    <div id="task-modal-backdrop" class="task-modal-backdrop"></div>



</div>
