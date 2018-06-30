$(document).ready(function($) {
    // Sortable
    if ($('.sortable').length && $('.sortable tr').length > 1) {
        $('.sortable').sortable().bind('sortupdate', function(e, ui) {
            //ui.item contains the current dragged element.
            //Triggered when the user stopped sorting and the DOM position has changed.

            current_id = ui.item.data('id');
            next_id =  ui.item.next().data('id');
            prev_id = ui.item.prev().data('id');

            $.ajax({
                type: 'POST',
                url: $('.sortable').eq(0).data('ajax-sortable-url'),
                data: {
                    current_id: current_id,
                    next_id: next_id,
                    prev_id: prev_id
                },
                success: function( msg ) {
                }
            });
        });
    }
});