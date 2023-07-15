@extends('layout.admin')
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
    <form action="/admin/wisata" method="GET">
        <div class="row p-4">
            <div class="col-md-3">
                <input type="text" value="{{ Request::get('nama_wisata') }}" class="form-control" name="nama_wisata"
                    placeholder="nama wisata">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success">Cari</button>
                <a href="/admin/wisata" class="btn btn-dark">Reset</a>
            </div>
        </div>
    </form>
</div>

<div class="card shadow">
    <div class="card-header">
        <h3 class="card-title">Laporan Pendapatan</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
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

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection