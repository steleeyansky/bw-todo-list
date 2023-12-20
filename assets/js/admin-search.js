function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

function filterTasks() {
    var searchTerm = $('#search-todos').val().toLowerCase();
    $('#the-list tr').each(function() {
        var taskContent = $(this).text().toLowerCase();
        $(this).toggle(taskContent.includes(searchTerm));
    });
}

$(document).ready(function($) {
   
    $('#search-todos').on('input', debounce(filterTasks, 250));

    $('#search-todos-button').on('click', filterTasks);
});
