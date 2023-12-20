<?php
// Check if the user has the required capability
if (!current_user_can('manage_options')) {
    return;
}

?>
<div class="wrap">
    <h1>Import/Export Todos</h1>

    <div class="tab">
        <button class="tablinks" open-tab="Import">Import</button>
        <button class="tablinks" open-tab="Export">Export</button>
    </div>

    <div id="Import" class="tabcontent">
        <h2>Import Todos</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="todo_import_file" id="todo_import_file">
            <input type="submit" name="import_todos" class="button button-primary" value="Import">
            <!-- Add a nonce field for security -->
            <?php wp_nonce_field('bw_import_todos', 'bw_import_todos_nonce'); ?>
        </form>
    </div>

  
    <div id="Export" class="tabcontent">
        <h2>Export Todos</h2>
        <form method="post">
            <input type="submit" name="export_todos" class="button button-secondary" value="Export">
            <!-- Add a nonce field for security -->
            <?php wp_nonce_field('bw_export_todos', 'bw_export_todos_nonce'); ?>
        </form>
    </div>
</div>