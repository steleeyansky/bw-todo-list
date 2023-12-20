<div class="wrap">
    <h1>BW Todo List</h1>
    
    <div class="bw-todo-list-search">
        <input type="text" id="search-todos" placeholder="Search todos..." class="regular-text">
        <button id="search-todos-button" class="button">Search</button>
    </div>


    <div>
        <div class="bw-todo-list-sort">
            <label for="todo-sort">Sort by Priority:</label>
            <select id="todo-sort" name="todo-sort">
                <option value="asc">High</option>
                <option value="desc">Low</option>
            </select>
            <button id="apply-sort" class="button">Apply</button>
        </div>
    </div>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-title">Todo Title</th>
                <th scope="col" id="description" class="manage-column column-description">Description</th>
                <th scope="col" id="priority" class="manage-column column-priority">Priority</th>
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
                        <td class="priority column-priority" data-colname="Priority">
                            <?php echo esc_html($task['priority']); ?>
                        </td>

                        <td class="actions column-actions" data-colname="Actions">
                            <button class="button edit-task" data-id="<?php echo esc_attr($task['id']); ?>">Edit</button>
                            <button class="button delete-task" data-id="<?php echo esc_attr($task['id']); ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td class="js-no-tasks" colspan="3">No tasks found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button id="add-new-task" class="button button-primary">Add New Todo</button>
    <?php BW\TodoList\Helpers\FragmentRenderer::render('task-modal'); ?>
</div>