$(document).ready(function() {
    $( ".check-all" ).click(function() {
        $('input:checkbox').attr('checked','checked');
    });

    $( ".check-group" ).click(function() {
        $(this).parent().parent().find(":checkbox").attr('checked','checked');
    });
});