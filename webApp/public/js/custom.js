/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$('#logout').on('click', function (e) {
    e.preventDefault()
    Swal.fire({
        title: 'Keluar?',
        text: "Kamu yakin ingin keluar?",
        icon: 'danger',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Keluar!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            document.location.href = "/auth/logout"
        }
    })
})
$('.btn-hapus').attr('disabled', true)
$("[data-checkboxes]").each(function () {
    var me = $(this),
        group = me.data('checkboxes'),
        role = me.data('checkbox-role');

    me.change(function () {
        var all = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"])'),
            checked = $('[data-checkboxes="' + group + '"]:not([data-checkbox-role="dad"]):checked'),
            dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
            total = all.length,
            checked_length = checked.length;

        if (role == 'dad') {
            if (me.is(':checked')) {
                $('.btn-hapus').attr('disabled', false)
                all.prop('checked', true);
            } else {
                $('.btn-hapus').attr('disabled', true)
                all.prop('checked', false);
            }
        } else {
            if (checked_length >= total) {
                $('.btn-hapus').attr('disabled', false);
                dad.prop('checked', true);
            } else if (checked_length > 0) {
                $('.btn-hapus').attr('disabled', false);
            } else {
                $('.btn-hapus').attr('disabled', true);
                dad.prop('checked', false);
            }
        }
    });
});