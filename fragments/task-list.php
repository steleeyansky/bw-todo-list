<style>
    .bw-todo-item, .bw-todo-item h4{
        color: <?php echo esc_attr($color); ?>;
    }
</style>

<div class="bw-todo-list">
    <?php foreach ($tasks as $task) : ?>
        <div class="bw-todo-item">
            <h4>
                <?php echo esc_html($task['title']); ?>
            </h4>

            <p>
                <?php echo  esc_html($task['description']);  ?>
            </p>

            <p>
                <?php echo esc_html($task['priority']); ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>