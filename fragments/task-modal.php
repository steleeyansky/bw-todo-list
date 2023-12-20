<div id="task-modal" class="task-modal" style="display:none;">
    <span class="close-modal">X</span>
    <form id="task-form" class="task-form">
        <div class="form-field">
            <label for="task-title">Title:</label>
          <input type="text" id="task-title" name="title" required class="left-aligned-text">
        </div>
        <div class="form-field">
            <label for="task-description">Description:</label>
            <textarea id="task-description" name="description" rows="5" class="left-aligned-text"></textarea>
        </div>
        <div class="form-field">
            <input type="submit" value="Save Todo" class="button button-primary">
        </div>
    </form>
</div>
<div id="task-modal-backdrop" class="task-modal-backdrop"></div>