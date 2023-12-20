$ = jQuery;
function makeAjaxCall(action, data, successCallback, methodType = 'POST') {
    let ajaxLoading = false;
    if (ajaxLoading) return;
    ajaxLoading = true;
    $body = $('body');

    $.ajax({
        url: todo_ajax_obj.ajax_url,
        type: methodType,
        data: $.extend({ action: action }, data),
        beforeSend: function () {
            $body.addClass('is-loading');
        },
        success: function (response) {
            successCallback(response);
        },
        error: function (xhr) {
            console.error(xhr);
        },
        complete: function () {
            ajaxLoading = false;
            $body.removeClass('is-loading');
        }
    });
}


var currentEditingTaskId = null;

function openAddTaskModal() {
    currentEditingTaskId = null;
    $('#task-title').val('');
    $('#task-description').val('');
    $('#task-modal-backdrop').show();
    $('#task-modal').show();
}

function openEditTaskModal(taskId) {
    // Populate the form with the task's existing data
    var taskRow = $('tr[data-task-id="' + taskId + '"]');

    $('#task-title').val($.trim(taskRow.find('.title').text()));
    $('#task-description').val($.trim(taskRow.find('.description').text()));
    currentEditingTaskId = taskId;
    $('#task-modal-backdrop').show();
    $('#task-modal').show();
}

$('#add-new-task').click(function () {
    openAddTaskModal();
});

$('#the-list').on('click', '.edit-task', function () {
    var taskId = $(this).data('id');
    openEditTaskModal(taskId);
});

// Close modal logic
$('.close-modal, #task-modal-backdrop').click(function () {
    $('#task-modal-backdrop').hide();
    $('#task-modal').hide();
});

// Stop propagation to prevent modal from closing when clicking inside it
$('#task-modal').click(function (event) {
    event.stopPropagation();
});

// Form submission logic for adding or editing a task
$('#task-form').submit(function (event) {
    event.preventDefault();

    var action = currentEditingTaskId ? 'edit_todo_task' : 'add_todo_task';

    let formData = {
        title: $('#task-title').val(),
        description: $('#task-description').val(),
        priority: $('#task-priority').val(),
        task_id: currentEditingTaskId
        
    };

    makeAjaxCall(action, formData, function (response) {
        if (response.success) {
            if (action === 'edit_todo_task') {
                $('tr[data-task-id="' + currentEditingTaskId + '"]').replaceWith(response.data.html);
                currentEditingTaskId = null; // Reset the editing task ID
            } else {
                // Append a new task 
                $('.js-no-tasks').remove();
                console.log( response.data);
                $('#the-list').append(response.data.html);
            }
            // Hide the modal and reset the form
            $('#task-modal').hide();
            $('#task-modal-backdrop').hide();
            $('#task-form')[0].reset();
        } else {
            // Handle error
            alert(response.data.message);
        }
    });

});

$('#the-list').on('click', '.delete-task', function () {
    let taskId = $(this).data('id');
    makeAjaxCall('delete_todo_task', { id: taskId, action: 'delete_todo_task' }, function (response) {
        if (response.success) {
            $('tr[data-task-id="' + response.data.task_id + '"]').remove();
        } else {
            // Handle error
            alert(response.data.message);
        }
    });
});




