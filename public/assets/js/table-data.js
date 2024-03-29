$(function (e) {
    "use strict";

    //______Basic Data Table
    $("#basic-datatable").DataTable({
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
        },
    });

    //______Basic Data Table
    $("#responsive-datatable").DataTable({
        language: {
            searchPlaceholder: "Cari Kota/Nama Wisata",
            scrollX: "100%",
            sSearch: "",
        },
    });
    $("#booking").DataTable({
        language: {
            searchPlaceholder: "Cari ID Booking / Open Trip",
            scrollX: "100%",
            sSearch: "",
        },
    });
    $("#open-trip").DataTable({
        language: {
            searchPlaceholder: "Cari ID Open Trip / Judul Open Trip",
            scrollX: "100%",
            sSearch: "",
        },
    });
    $("#chanel-pembayaran").DataTable({
        language: {
            searchPlaceholder: "Cari Nama Chanel pembayaran",
            scrollX: "100%",
            sSearch: "",
        },
    });
    $("#pelanggan").DataTable({
        language: {
            searchPlaceholder: "Cari Nama/email user",
            scrollX: "100%",
            sSearch: "",
        },
    });

    // //______File-Export Data Table
    // var table = $("#laporan").DataTable({
    //     dom: "Bfrtip",
    //     lenghtMenu: [
    //         [10, 25, 50, -1],
    //         ["q", "q", "e", "e"],
    //     ],
    //     lengthChange: true,
    //     buttons: [
    //         {
    //             extend: "print",
    //             text: '<i class="fas fa-print mr-1"></i>Print',
    //             className: "btn btn-success mr-2",
    //             title: "<h1 >Data Booking Go-Travel</h1> ",
    //             exportOptions: {
    //                 columns: ":visible:not(:contains(Action),:contains(No))",
    //             },
    //         },
    //         {
    //             extend: "excel",
    //             text: '<i class="fas fa-file-excel mr-1"></i> Donwload Excel',
    //             className: "btn btn-primary mr-2",
    //             filename: "data_transaksi",
    //             title: "Data Booking Go-Travel ",
    //             exportOptions: {
    //                 columns: ":visible:not(:contains(Action),:contains(No))",
    //             },
    //         },
    //         {
    //             extend: "pdf",
    //             text: '<i class="fas fa-file-pdf mr-1"></i> Donwload PDF',
    //             className: "btn btn-warning mr-2",
    //             filename: "data_transaksi",
    //             title: "Data Booking Go-Travel ",
    //             exportOptions: {
    //                 columns: ":visible:not(:contains(Action),:contains(No))",
    //             },
    //         },
    //     ],
    //     searching: true,
    // });
    // table
    //     .buttons()
    //     .container()
    //     .appendTo("#file-datatable_wrapper .col-md-6:eq(0)");

    //______Delete Data Table
    var table = $("#delete-datatable").DataTable({
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
        },
    });
    $("#delete-datatable tbody").on("click", "tr", function () {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
        } else {
            table.$("tr.selected").removeClass("selected");
            $(this).addClass("selected");
        }
    });
    $("#button").on("click", function () {
        table.row(".selected").remove().draw(false);
    });
    $("#example3").DataTable({
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return "Details for " + data[0] + " " + data[1];
                    },
                }),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: "table",
                }),
            },
        },
    });
    $("#example2").DataTable({
        responsive: true,
        language: {
            searchPlaceholder: "Search...",
            sSearch: "",
            lengthMenu: "_MENU_ items/page",
        },
    });

    //______Select2
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
    });
});
