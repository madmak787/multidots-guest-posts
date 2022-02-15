var $j = jQuery.noConflict();
$j(document).ready(function() {
    $j(document).on("submit", "#guestpost form", function(e) {
        e.preventDefault();
        var frm = $j(this);
        frm.find('.wp-block-button__link').prop('disabled',true);
        $j.ajax({
            type: "POST",
            url: ajaxurl,
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(data) {
                frm.find('.wp-block-button__link').prop('disabled',false);
                frm.find('.wp-block-button__link').after('<p style="color:red">Submitted successfully.</p>');
                document.getElementById("#guestpost-form").reset();
            },
            error: function(data) {
                frm.find('.wp-block-button__link').prop('disabled',false);
            }
        });
    });

    $j(document).on("click", ".approve-guest-post", function(e) {
        e.preventDefault();
        var btn = $j(this);
        btn.addClass('disabled');
        var data = {
            'action': 'approve_guest_post',
            'post_id': btn.data('id'),
            'nonce': btn.data('nonce')
        };
        $j.ajax({
            type: "POST",
            url: ajaxurl,
            data,
            success: function(data) {
                setTimeout(function() {
                    btn.removeClass('disabled');
                    btn.html('Published');
                },200);
                setTimeout(function() {
                    //btn.parent().parent().fadeOut('slow');
                },1000);
            },
            error: function(data) {
                btn.removeClass('disabled');
            }
        });
    });
});