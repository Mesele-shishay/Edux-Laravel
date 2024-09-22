var Ajax = new function() {

    this.send = function (postUrl, data, callback) {

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            url : postUrl,
            type: "POST",
            data : data,
            success: function(response){
                if (response.status == 'error') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else if (response.status == 'ajax') {
                    $.each(response.data,function(name,value){
                        $('.invalid-feedback').siblings('input').removeClass("is-invalid");
                        $('.invalid-feedback').remove()
                        $('#'+name).addClass('is-invalid');
                        if ($('[name=label_'+name+']').length < 1) {
                            $('#'+name).parent().append("<div name='label_"+name+"' class='invalid-feedback'>"+value+"</div>");
                        }else{
                            $('[name=label_'+name+']').html(value);
                        }
                    })
                }
                else if (response.status == 'success') {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            },

            error: function (jqXHR, textStatus, errorThrown)
            {
                Swal.fire({
                    icon: "error",
                    title: "Connection Error",
                    text: errorThrown
                });
            }
        });
    };
};


