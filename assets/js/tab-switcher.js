jQuery(document).ready(function($) {
    function openTab(tabName) {
        $('.tabcontent').hide();
        $('.tablinks').removeClass('active');
        $('#' + tabName).show();
        $('button[open-tab="' + tabName + '"]').addClass('active');
    }

    $('.tablinks').click(function() {
        var tabName = $(this).attr('open-tab');
        openTab(tabName);
    });

    // Open the default tab
    openTab('Import');
});
