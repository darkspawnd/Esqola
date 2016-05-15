$(function () {

    $('.ui.button').click(function () {$(this).addClass('loading')});

    $('.yesnomodallink').click(function(e) {
        e.preventDefault();
        $redirection = $(this).attr('href');
        $('.ui.modal').modal('setting', {
            closable: false,
            onApprove: function () {
                window.location = $redirection;
            }
        }).modal('show');
    });
});
