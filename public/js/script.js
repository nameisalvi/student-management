$(document).ready( function () {
    $(document).on('click', '.add', function () {
        let form = $(this).data('target');
        $(form+" :input").each(
            function () {
                var input = $(this).attr('name');
                $(this).val('');
                var id = input + "-error";
                $('#' + id).html('');
            }
        );
    });
    $(document).on('click', '.edit', function () {
        let url = $(this).data('url');
        let form = $(this).data('target');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseUrl + url,
            method:'GET',
            success:function (response) {
                console.log(response)
                $.each(response.data, function (key, val) {
                    $(form+ " #" + key).val(val);
                });
            }
        });
    });

    $(document).on('click', '.save', function () {
        let form = $(this).data('form');
        let url = $(this).data('url');
        var form_data = new FormData($('#'+form)[0]);
        $("#"+form+" :input").each(
            function () {
                var input = $(this).attr('name');
                var id = input + "-error";
                $('#' + id).html('');
            }
        );
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseUrl + url,
            method:'POST',
            data : form_data,
            processData: false,
            contentType: false,
            error:function (jqXhr) {
                if (jqXhr.status === 422) {
                    let data = jqXhr.responseJSON;
                    $.each(data.errors, function (key, val) {
                       $("#" + key + "-error").text(val[0]);
    
                    });
                }
            },
            success:function (response) {
                $('#'+form).modal('hide');
                location.reload();
            }
        });
    });
});