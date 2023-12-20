jQuery(document).ready(function ($) {
    $('#apply-sort').click(function () {
        var sortOrder = $('#todo-sort').val(); // 'asc' or 'desc'
        var $table = $('.wp-list-table');
        var $tbody = $table.find('tbody');
        var rows = $tbody.find('tr').toArray();

        rows.sort(function (a, b) {
            var priorityA = $(a).find('.priority').text();
            var priorityB = $(b).find('.priority').text();

         
            if (priorityA === "Medium") {
                priorityA = 'high'
            }
            if (priorityB === "Medium") {
                priorityB = (sortOrder === 'asc') ? "Most Important" : "Least Important";
            }

            if (sortOrder === 'asc') {
                return priorityA.localeCompare(priorityB);
            } else {
                return priorityB.localeCompare(priorityA);
            }
        });

        $tbody.empty().append(rows);
    });
});

