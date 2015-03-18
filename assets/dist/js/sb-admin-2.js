$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    if($('#dataTables-admin').length) {
        $('#dataTables-admin').dataTable();
    }

    var url = window.location;
    var element = $('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

$("#loginForm").on( 'submit', function (event) {
    event.preventDefault();
    if($('#loginForm input[name="username"]').val().trim() == '') {
        alertify.error("Please enter username.");
        $('#loginForm input[name="username"]').focus();
        return;
    }
    if($('#loginForm input[name="password"]').val().trim() == '') {
        alertify.error("Please enter password.");
        $('#loginForm input[name="password"]').focus();
        return;
    }
    var url = $('#loginForm input[name="url"]').val();
    var redirectUrl = $('#loginForm input[name="redirectUrl"]').val();
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        beforeSend: function() { alertify.log('Logging in...') },
        success: function (result) {
            if(result.login_success) {
                location.href = redirectUrl;
            } else {
                alertify.error(result.message);
            }
        },
        error: function(result) {
            alertify.error('Unexpexted error');
        }
    });
});