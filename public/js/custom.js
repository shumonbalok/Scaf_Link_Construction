$('document').ready(function () {
    $('#get_data_by_select select').change(function (evt) {
        get_data_by_select();
    });

    $(window).load(function () {
        get_data_by_select();
    });

    $('.change_status').click(function (evt) {
        var url = $(this).data('href'),
            me = $(this),
            id = $(this).data('id');
        me.attr('disabled', 'disabled');
        change_status(url, id, me);
    });

    $('body').on('click', '.get_data_by_form_submit', function (evt) {
        evt.preventDefault();
        $('.ajax-data').replaceWith('');
        var me = $(this),
            form = me.closest('form'),
            data = form.serialize(),
            url = form.attr('action');
        me.attr('disabled', 'disabled');
        get_data_by_form_submit(url, data, me);
    });

    $('body').on('click', '.get_data_by_click_btn', function (evt) {
        evt.preventDefault();
        $('.ajax-data').html('');
        var me = $(this),
            url = me.data('href');

        $.get(url, function (data, textStatus, jqXHR) {

            $('.ajax-data').html(data);

            me.addClass('worker-timecard-active');
            me.parents('.btn-group-vertical').children('.btn').not(me).removeClass('worker-timecard-active');
        });

    });


    $('body').on('click', '.create-staff-salary-list', function (evt) {
        evt.preventDefault();
        var me = $(this),
            url = me.data('href');

        $.get(url, function (res, textStatus, jqXHR) {
            if (res.error) {
                return toastr.error(res.error);
            } else {
                return toastr.success(res.success);
            }

        });

    });


    $('body').on('change', '.print-input', function (evt) {
        var me = $(this),
            form = me.parents('.ajax-data').find('form'),
            action = form.attr('action');
        data = form.serialize();

        $.ajax({
            url: action,
            type: 'put',
            data: data,
            dataType: 'html',
            success: function (response) {
                $('.total').text(response);
                toastr.success("Value has been edited.");
            },

            error: function (jqXhr, json, errorThorwn) {
                toastr.error("Somthings Wrong! try agin letter");
            }
        });


    });

    const newLocal = '.add_record_on_change';
    $('body').on('change', newLocal, function (evt) {
        evt.preventDefault();
        var me = $(this),
            form = me.closest('form'),
            data = form.serialize(),
            url = form.attr('action');

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function (response) {
                toastr.success(response.message);
            },

            error: function (jqXhr, json, errorThorwn) {
                toastr.error(jqXhr.message);
            }
        });
    });


    $('body').on('click', '.get-data-by-click', function (evt) {
        evt.preventDefault();
        $('.ajax-data').html('');
        var me = $(this),
            data = `date=${me.data('value')}`,
            url = me.data('href');

        get_data_by_click_or_change(me, data, url);

    });

    $('body').on('change', '.get-data-by-change', function (evt) {
        evt.preventDefault();
        $('.ajax-data').html('');
        var me = $(this),
            data = `date=${me.val()}`,
            url = me.data('href');

        me.parents('li').addClass('active');
        me.parents('ul').children('li').not(me.parents('li')).removeClass('active');
        get_data_by_click_or_change(me, data, url);


    });


});

function get_data_by_click_or_change(me, data, url) {
    $.ajax({
        url: url,
        type: 'GET',
        data: data,
        success: function (response) {
            $('.ajax-data').html(response);
        },

        error: function (jqXhr, json, errorThorwn) {
            toastr.error("Something went wrong. Please try again later");
        }
    });
}

function get_data_by_form_submit(url, data, me) {
    if (data) {
        $.post(url, data, function (res, textStatus, jqXHR) {
            if (res.errors) {
                return toastr.error(res.errors);
            }

            $('.custom-panel-body').append(res);
            me.removeAttr('disabled');

        });
    }

}



function get_data_by_select() {
    var department_id = $('#get_data_by_select select').val();
    if (department_id) {
        $.get('/admin/orders/productByDepartment', { department_id: department_id }, function (data, textStatus, jqXHR) {
            $('.ajax-data').replaceWith('');
            $('.custom-panel-body').append(data);
        });
    }
}

function change_status(url, id, me) {
    $.post(url, { id: id }, function (data, textStatus, jqXHR) {
        if (data.error) {
            return toastr.error(data.error);
        }
        me.replaceWith(data);
    });
}