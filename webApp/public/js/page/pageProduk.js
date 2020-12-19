$(document).ready(function () {
    $('#datatable').dataTable()
    $('#btn-tambahkan').attr('disabled', true)
    getBahan()
})

function getBahan() {
    $.ajax({
        url: '/produk/tmp',
        method: 'post',
        dataType: 'json',
        success: function (response) {
            html = ''
            if (response.length > 0) {
                no = 1
                for (i = 0; i < response.length; i++) {
                    html += `
                        <tr>
                            <td width="50px">` + no + `</td>
                            <td width="250px">
                                <input type="hidden" name="bahan_id[]" class="bahan_id" value="` + response[i].id + `">
                                ` + response[i].bahan + `
                                </td>
                            <td width="250px">
                                <div class="input-group">
                                    <input type="number" name="jumlah[]" class="form-control jumlah" step="any" data-id="` + response[i].id + `" value="` + response[i].jumlah + `" min="1" required>
                                    <div class="input-group-append"><span class="input-group-text">` + response[i].satuan + `</span></div>
                                </div>
                            </td>
                            <td width="10px"><a href="#" class="hapus text-danger" data-id="` + response[i].id + `"><i class="fas fa-fw fa-trash"></i></a></td>
                        </tr>
                    `
                    no++
                }
            } else {
                html += '<tr><td colspan="4">Belum ada data</td></tr>'
            }
            $('#tableBahan tbody').html(html)
        }
    })
}

$('#bahan_id').on('change', function () {
    if (!$(this).val()) {
        $('#btn-tambahkan').attr('disabled', true)
    } else {
        $('#btn-tambahkan').attr('disabled', false)
    }
})

$('#btn-tambahkan').on('click', function () {
    $.ajax({
        url: '/produk/savetmp',
        method: 'post',
        data: {
            id: $('#bahan_id').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menambahkan bahan',
                    showConfirmButton: false,
                    timer: 1000
                })
                getBahan()
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menambahkan bahan',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
            $('#bahan_id').val('')
        }
    })
})

$(document).on('change', '.jumlah', function () {
    $.ajax({
        url: '/produk/savetmp',
        method: 'post',
        data: {
            id: $(this).data('id'),
            jumlah: $(this).val()
        },
        dataType: 'json',
        success: function () {
            getBahan()
        }
    })
})

$(document).on('click', '.hapus', function () {
    $.ajax({
        url: '/produk/deletetmp',
        method: 'post',
        data: {
            id: $(this).data('id')
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menghapus bahan',
                    showConfirmButton: false,
                    timer: 1000
                })
                getBahan()
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menghapus bahan',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        }
    })
})

$('#form').on('submit', function (e) {
    e.preventDefault();
    var url = '/produk/save';
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
                        location.href = '/produk'
                    }
                })
            }
            $('.btn-submit').attr('disabled', false)
        }
    })
})

$('#formHapus').on('submit', function (e) {
    e.preventDefault()
    url = '/produk/delete'
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
                        Swal.fire({
                            title: 'Gagal',
                            icon: 'error',
                            text: response.msg
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
                                location.href = '/produk'
                            }
                        })
                    }
                }
            })
        }
    })
})