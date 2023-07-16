@extends('layout.admin')
@section('addcss')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Laporan</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="card shadow">
    <form action="/admin/laporan" method="GET">
        <div class="row p-4">
            <div class="col-md-3">
                <input type="date" value="{{ Request::get('start_date') }}" class="form-control" name="start_date"
                    placeholder="Tanggal Awal">
            </div>
            <div class="col-md-3">
                <input type="date" value="{{ Request::get('end_date') }}" class="form-control" name="end_date"
                    placeholder="Tanggal Awal">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Cari</button>
                <a href="/admin/laporan" class="btn btn-dark">Reset</a>
            </div>
        </div>
    </form>
</div>

<div class="card shadow">
    <div class="card-header">
        <h3 class="card-title">Laporan Pendapatan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="table_laporan">
            <table class="table" id="laporan">
                <thead>
                    <tr>
                        <th>ID Booking</th>
                        <th>Tanggal Booking</th>
                        <th>Pelanggan</th>
                        <th>Open Trip</th>
                        <th>Jumlah Booking</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($booking as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ date("d M Y H:i:s", strtotime($item->created_at)) }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->open_trip->title }}</td>
                        <td class="text-center">{{ $item->jumlah_booking }}</td>
                        <td class="text-center">
                            {{ $item->invoice->chanel_pembayaran->name }}
                        </td>
                        <td class="text-center">{{ number_format($item->invoice->amount) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center"> <i class="fas fa-folder-open fa-2x"></i> <br> Data tidak
                            ditemukan </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('addscript')
{{-- datatable --}}
<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script> --}}
<script>
    $(document).ready(function() {
        //______File-Export Data Table
        var table = $("#laporan").DataTable({
        dom: "Bfrtip",
        lenghtMenu: [
        [10, 25, 50, -1],
        ["q", "q", "e", "e"],
        ],
        lengthChange: true,
        buttons: [
        // {
        // extend: "print",
        // text: '<i class="fas fa-print mr-1"></i>Print',
        // className: "btn btn-success mr-2 mb-2",
        // title: "<h1>Data Booking Go-Travel</h1> ",
        // },
        {
        extend: "excel",
        text: '<i class="fas fa-file-excel mr-1"></i> Donwload Excel',
        className: "btn btn-primary mr-2 mb-2",
        filename: "laporan_booking",
        title: "Data Booking Go-Travel ",
        },
        {
        extend: "pdf",
        text: '<i class="fas fa-file-pdf mr-1"></i> Donwload PDF',
        className: "btn btn-warning mr-2 mb-2",
        filename: "laporan_booking",
        title: "Data Booking Go-Travel ",
        },
        ],
        searching: false,
        });
    })

    
</script>
@endsection