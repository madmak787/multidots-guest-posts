var $j = jQuery.noConflict();
$j(document).ready(function() {
    //$j('.guest-post-form').submit(function(e) {
    $j(document).on("submit", "#guestpost form", function(e) {
        e.preventDefault();
        var frm = $j(this);
        frm.find('.btn').prop('disabled',true);
        $j.ajax({
            type: "POST",
            url: ajaxurl,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                frm.find('.btn').prop('disabled',false);
            },
            error: function(data) {
                frm.find('.btn').prop('disabled',false);
            }
        });
    });
});