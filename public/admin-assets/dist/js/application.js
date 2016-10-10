$(document).ready(function(){

    $('body').on('click', '.ajaxShow', function(e) {
        e.preventDefault();

        var targetUrl = $(this).attr('href') ? $(this).attr('href') : $(this).attr('data-href');
        var targetArea = $(this).attr('data-target');
        var isForceUpdate = $(this).attr('data-force_update') ? $(this).attr('data-force_update') : false;

        if (isForceUpdate == false && $('#' + targetArea).html().length > 0) {
            return;
        }

        $.ajax({
            url: targetUrl,
            success: function(data) {
                $('#'+targetArea).html(data.view);
            }
        });

    });

    $('body').on('click', '.ajaxSaveAndList', function(e) {
        e.preventDefault();

        var form = $(this).parents('form');
        var formData = $(form).serialize();
        var targetUrl = $(form).attr('action');

        $.ajax({
            url: targetUrl,
            type: "POST",
            data: formData,
            success: function(data) {
                $('#indexTable').find('tbody').prepend(data.view);
                $(form).parents('.box-body').html('');
            },
            error: function(data){
                var errors = errorFormatter( data.responseJSON );
                $('#formErrors').html( errors );
            }
        });
    });

    $('body').on('click', '.ajaxSaveFileAndList', function(e) {
        e.preventDefault();

        var form = $(this).parents('form');
        var targetUrl = $(form).attr('action');

        $.ajax({
            url: targetUrl,
            type: "POST",
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $('#indexTable').find('tbody').prepend(data.view);
                $(form).parents('.box-body').html('');
            },
            error: function(data){
                var errors = errorFormatter( data.responseJSON );
                $('#formErrors').html( errors );
            }
        });
    });

    $('body').on('click', '.ajaxShowRow', function(e) {
        e.preventDefault();

        var targetUrl = $(this).attr('href') ? $(this).attr('href') : $(this).attr('data-href');
        var targetArea = $(this).parents('tr');

        $.ajax({
            url: targetUrl,
            dataType: "json",
            success: function(data) {
                $(targetArea).replaceWith(data.view);
            }
        });
    });

    $('body').on('click', '.ajaxUpdateAndList', function(e) {
        e.preventDefault();

        var targetArea = $(this).parents('tr');
        var targetUrl = $(this).attr('href') ? $(this).attr('href') : $(this).attr('data-href');
        var formData = $(this).parents('tr').find('input, select, textarea').serialize();

        $.ajax({
            url: targetUrl,
            type: "PATCH",
            data: formData,
            success: function(data) {
                $(targetArea).replaceWith(data.view);
            },
            error: function(data){
                $.each(data.responseJSON, function( key, value ){
                    $.notify(
                        value,
                        {
                            position:"right bottom"
                        }
                    );
                });
            }
        });
    });

    $('body').on('click', '.ajaxDelete', function(e) {
        e.preventDefault();

        var targetUrl = $(this).attr('href');
        var token = $(this).find('input').val();

        if (confirm('Are you sure to delete this?')) {
            $.ajax({
                type: "DELETE",
                url: targetUrl,
                data: {_token: token},
                success: function(data) {
                    if (data.affectedRows > 0)
                        location.reload();
                },
                error: function(data){
                    $('#indexErrors').html('<div class="alert alert-error">This value is being used. You can\'t delete this right now.</div>');
                }
            });
        }
    });
});

function errorFormatter(data) {
    var err = listFormatter(data);
    err = alertWrapper(err, 'danger');

    return err;
}

function listFormatter(data) {
    var str = '<ul>';

    $.each(data, function( key, value ){
        str += '<li>' + value + '</li>';
    });

    str += '</ul>';

    return str;
}

function alertWrapper(data, alertType) {
    return '<div class="alert alert-'+ alertType +' alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data + '</div>';
}