@extends('layout.pelanggan')
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Booking</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Booking</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Daftar Booking</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="booking">
                        <thead>
                            <tr>
                                <th>ID Booking</th>
                                <th>Open Trip</th>
                                <th>Tanggal Berangkat</th>
                                <th>Jumlah Booking</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($booking as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->open_trip->title }}</td>
                                <td>{{ date("d M Y H:i:s", strtotime($item->open_trip->tgl_berangkat)) }}</td>
                                <td>{{ $item->jumlah_booking }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/'.$item->invoice->chanel_pembayaran->image) }}"
                                        width="100px" alt="">
                                </td>
                                <td><span class="badge badge-sm bg-{{ $item->badge_color }}"> {{
                                        ucwords(str_replace("_", " ", $item->status)) }} </span></td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="/pelanggan/booking/detail/{{ $item->invoice->id}}">
                                        detail</a>
                                </td>
                            </tr>
                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addscript')
{{-- datatable --}}
<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
<script src="/assets/plugins/datatable/js/jszip.min.js"></script>
<script src="/assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
<script src="/assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
<script src="/assets/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="/assets/js/table-data.js"></script>

@if (session('gagal'))
<script>
    // notif<i class="fas fa-exclamation-triangle"></i>
         $.growl.error({
                title: '<i class="fa fa-exclamation-triangle"></i> GAGAL',
                message: "{{ session('gagal') }}",
                duration: 5000
        });
</script>
@endif
@if (session('success'))
<script>
    // notif<i class="fas fa-exclamation-triangle"></i>
         $.growl.notice({
                title: '<i class="fa fa-check"></i> SUKSES',
                message: "{{ session('success') }}",
                duration: 5000
        });
</script>
@endif
@endsection