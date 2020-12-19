$(document).ready(function () {
    $('#datatable').dataTable();
    $('#btn-tambahkan').attr('disabled', true)
    $('#selesai').attr('disabled', true)
    getProduk()
})

$('#produk').on('change', function () {
    if (!$(this).val()) {
        $('#btn-tambahkan').attr('disabled', true)
    } else {
        $('#btn-tambahkan').attr('disabled', false)
    }
})

function getProduk() {
    $.ajax({
        url: '/penjualan/tmp',
        method: 'post',
        dataType: 'json',
        success: function (response) {
            html = ''
            total = 0
            if (response.length > 0) {
                no = 1
                for (i = 0; i < response.length; i++) {
                    total += parseInt(response[i].total)
                    html += `
                        <tr>
                            <td>` + no++ + `</td>
                            <td>
                                <input type="hidden" name="produk_id[]" value="` + response[i].produk_id + `">
                                ` + response[i].produk + `
                            </td>
                            <td>
                                <input type="number" name="jumlah[]" class="form-control jumlah" data-id="` + response[i].produk_id + `" value="` + response[i].jumlah + `" step="any" min="1">
                            </td>
                            <td>Rp ` + parseInt(response[i].harga).toLocaleString('id') + `</td>
                            <td>Rp ` + parseInt(response[i].total).toLocaleString('id') + `</td>
                            <td>
                                <a href="#" class="hapus text-danger" data-id="` + response[i].produk_id + `"><i class="fas fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    `
                }
            } else {
                html += '<tr><td colspan="6">Belum ada data</td></tr>'
            }
            $('#tableTambah tbody').html(html)
            $('#total').html('Rp ' + parseInt(total).toLocaleString('id')).attr('data-total', total)
            $('#bayar').val('')
        }
    })
}

$('#bayar').on('keyup', function () {
    if (!$(this).val() || $(this).val() == 0) {
        $('#selesai').attr('disabled', true)
    } else if (parseInt($(this).val()) < parseInt($('#total').data('total'))) {
        $('#selesai').attr('disabled', true)
    } else {
        $('#selesai').attr('disabled', false)
    }
})

$('#btn-tambahkan').on('click', function () {
    $('#btn-tambahkan').attr('disabled', true)
    $.ajax({
        url: '/penjualan/savetmp',
        method: 'post',
        data: {
            id: $('#produk').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menambahkan produk',
                    showConfirmButton: false,
                    timer: 1000
                })
                getProduk()
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menambahkan produk',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        }
    })
    $("#produk").val('')
    $('#btn-tambahkan').attr('disabled', false)
})

$(document).on('change', '.jumlah', function () {
    $.ajax({
        url: '/penjualan/savetmp',
        method: 'post',
        data: {
            id: $(this).data('id'),
            jumlah: $(this).val()
        },
        dataType: 'json',
        success: function () {
            getProduk()
        }
    })
})

$(document).on('click', '.hapus', function () {
    $.ajax({
        url: '/penjualan/deletetmp',
        method: 'post',
        data: {
            id: $(this).data('id')
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil menghapus produk',
                    showConfirmButton: false,
                    timer: 1000
                })
                getProduk()
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menghapus produk',
                    showConfirmButton: false,
                    timer: 1000
                })
            }
        }
    })
})

$('#form').on('submit', function (e) {
    e.preventDefault();
    $('#selesai').attr('disabled', true)
    var url = '/penjualan/save';
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
                        location.href = '/penjualan'
                    }
                })
            }
            $('#selesai').attr('disabled', false)
        }
    })
})