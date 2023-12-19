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


$('.delete-task').on('click', function () {
    let taskId = $(this).data('id');
    makeAjaxCall('delete_todo_task', { id: taskId, action: 'delete_todo_task' }, function (response) {
        if (response.success) {
            $('tr[data-task-id="' + response.data.task_id + '"]').remove();
        }
    });
});

$(document).ready(function ($) {
    // Open modal on 'Add New Todo' button click
    $('#add-new-task').click(function () {
        $('#task-modal-backdrop').show();
        $('#task-modal').show();
    });

    // Close modal on clicking the close button or the backdrop
    $('.close-modal, #task-modal-backdrop').click(function () {
        $('#task-modal-backdrop').hide();
        $('#task-modal').hide();
    });

    $('#task-modal').click(function (event) {
        event.stopPropagation();
    });

    $('#task-form').submit(function (event) {
        event.preventDefault();

        let formData = {
            title: $('#task-title').val(),
            description: $('#task-description').val()
        };

        makeAjaxCall('add_todo_task', formData, function (response) {
            $('#the-list').append(response.data.html);
            $('#task-modal').hide();
            $('#task-modal-backdrop').hide();
            $('#task-form')[0].reset();
        });
    });
});
