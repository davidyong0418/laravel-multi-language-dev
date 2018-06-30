$(document).ready(function($) {

    $('select#type').change(function() {
        switch ($(this).val()) {
            case TYPE_LINK:
                $("input#url").parent().parent().eq(0).removeClass('hidden');
                $("select#page_id").parent().parent().eq(0).addClass('hidden');
                break;
            case TYPE_PAGE:
                $("input#url").parent().parent().eq(0).addClass('hidden');
                $("select#page_id").parent().parent().eq(0).removeClass('hidden');
                break;
        }
    });

});