$(document).ready(function () {
    $('#datatable').dataTable();
    $('#satuan').val($('#satuan').data('value'))
})

$('#form').on('submit', function (e) {
    e.preventDefault();
    $('.btn-submit').attr('disabled', true)
    var url = '/bahan/save';
    var method = 'post';
    var data = $(this).serialize();

    $.ajax({
        url: url,
        method: method,
        data: data,
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
                        location.href = '/bahan'
                    }
                })
            }
            $('.btn-submit').attr('disabled', false)
        }
    })
})

$('#formHapus').on('submit', function (e) {
    e.preventDefault()
    url = '/bahan/delete'
    method = 'post'
    data = $(this).serialize()
    Swal.fire({
        title: 'Hapus data',
        text: "Yakin menghapus data?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Hapus!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.error) {
                        msg = ''
                        for (i = 0; i < response.msg.length; i++) {
                            msg += response.msg[i]
                            if (i < response.msg.length - 1) {
                                msg += '<br>'
                            }
                        }
                        Swal.fire({
                            title: 'Gagal',
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
                                location.href = '/bahan'
                            }
                        })
                    }
                }
            })
        }
    })
})