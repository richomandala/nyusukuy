$('#formLogin').on('submit', function (e) {
    e.preventDefault()
    $.ajax({
        url: '/auth/login',
        method: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function (response) {
            if (response.error > 0) {
                msg = ''
                for (i = 0; i < response.msg.length; i++) {
                    msg += response.msg[i]
                    if (i < response.msg.length - 1) {
                        msg += '<br>'
                    }
                }
                Swal.fire({
                    title: 'Error',
                    icon: 'error',
                    html: msg
                })
            } else {
                Swal.fire({
                    title: 'Sukses',
                    text: response.msg,
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    onClose: () => {
                        location.href = '/home'
                    }
                })
            }
            $('.btn-submit').attr('disabled', false)
        }
    })
})