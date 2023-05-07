// QUANTITY CART INCREASE AND DECREASE

$(function () {
    "use strict";
    let hargaAwal = parseInt($("#harga-awal").val());
    $(".counter-plus").on("click", function () {
        var $qty = $(this).closest("div").find(".qty");
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal)) {
            if (currentVal < 5) {
                $qty.val(currentVal + 1);
                hitungTotal($qty.val(), hargaAwal);
            } else {
                $.growl.error({
                    title: '<i class="fa fa-check"></i> Gagal',
                    message: "Jumlah Booking Tidak Boleh lebih dari 5",
                    duration: 2000,
                });
            }
        }
        $("#jumlah-booking-preview").text($qty.val());
        $("#jumlah").val($qty.val());
    });
    $(".counter-minus").on("click", function () {
        var $qty = $(this).closest("div").find(".qty");
        var currentVal = parseInt($qty.val());
        if (!isNaN(currentVal) && currentVal > 0) {
            if (currentVal <= 1) {
                $.growl.error({
                    title: '<i class="fa fa-check"></i> Gagal',
                    message: "Jumlah Booking Tidak kurang dari 1",
                    duration: 2000,
                });
            } else {
                $qty.val(currentVal - 1);
                hitungTotal($qty.val(), hargaAwal);
            }
        }
        $("#jumlah-booking-preview").text($qty.val());
        $("#jumlah").val($qty.val());
    });

    function hitungTotal(jumlah, hargaAwal) {
        let hasil = parseInt(jumlah) * parseInt(hargaAwal);
        let formatHarga = new Intl.NumberFormat().format(hasil);

        $("#pay-total").text(formatHarga);
    }
});
