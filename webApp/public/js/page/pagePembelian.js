$(document).ready(function () {
    $('#datatable').dataTable()
    $('#btn-tambahkan').attr('disabled', true)
    $('#supplier_id').val($('#supplier_id').data('value'))
    getBahan()
})

function getBahan() {
    $.ajax({
        url: '/pembelian/tmp',
        method: 'post',
        dataType: 'json',
        success: function (response) {
            html = ''
            total = ''
            if (response.length > 0) {
                no = 1
                for (i = 0; i < response.length; i++) {
                    total += response[i].harga
                    html += `
                    <tr>
                        <td width="50px">` + no + `</td>
                        <td width="250px">
                            <input type="hidden" name="bahan_id[]" class="bahan_id" value="` + response[i].id + `">
                            ` + response[i].bahan + `
                            </td>
                        <td width="250px">
                            <div class="input-group">
                                <input type="number" name="jumlah[]" class="form-control jumlah" step="any" min="0" data-id="` + response[i].id + `" value="` + response[i].jumlah + `" required>
                                <div class="input-group-append"><span class="input-group-text">` + response[i].satuan + `</span></div>
                            </div>
                        </td>
                        <td width="250px">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                                <input type="number" name="harga[]" class="form-control harga" step="any" min="0" data-id="` + response[i].id + `" value="` + response[i].harga + `" required>
                            </div>
                        </td>
                        <td width="10px"><a href="#" class="hapus text-danger" data-id="` + response[i].id + `"><i class="fas fa-fw fa-trash"></i></a></td>
                    </tr>
                `
                    no++
                }
            } else {
                html += '<tr><td colspan="6">Belum ada data</td></tr>'
            }
            $('#tableModal tbody').html(html)
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
        url: '/pembelian/savetmp',
        method: 'post',
        data: {
            id: $('#bahan_id').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                getBahan()
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menambahkan bahan',
                    showConfirmButton: false,
                    timer: 1000
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menambahkan bahan',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
            $('#bahan_id').val('')
            $('#btn-tambahkan').attr('disabled', true)
        }
    })
})

$(document).on('change', '.jumlah', function () {
    $.ajax({
        url: '/pembelian/savetmp',
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

$(document).on('change', '.harga', function () {
    $.ajax({
        url: '/pembelian/savetmp',
        method: 'post',
        data: {
            id: $(this).data('id'),
            harga: $(this).val()
        },
        dataType: 'json',
        success: function () {
            getBahan()
        }
    })
})

$(document).on('click', '.hapus', function () {
    $.ajax({
        url: '/pembelian/deletetmp',
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
    $('.btn-submit').attr('disabled', true)
    var url = '/pembelian/save';
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
                        location.href = '/pembelian'
                    }
                })
            }
            $('.btn-submit').attr('disabled', false)
        }
    })
})