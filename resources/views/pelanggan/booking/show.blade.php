@extends('layout.'.auth()->user()->role)
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Detail Booking</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/pelanggan/booking">Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $invoice->booking->id }}</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Detail Booking</h3>
                <span class="badge bg-{{ $invoice->booking->badge_color }} py-2">{{ ucwords(str_replace("_", " ",
                    $invoice->booking->status)) }}</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label"> ID Invoice </label>
                    <input type="text" class="form-control" disabled value="{{ $invoice->id }}">
                </div>
                <div class="form-group">
                    <label class="form-label"> Judul Open Trip </label>
                    <input type="text" class="form-control" disabled value="{{ $invoice->booking->open_trip->title }}">
                </div>
                <div class="form-group">
                    <label class="form-label"> Harga / Orang </label>
                    <input type="text" class="form-control" disabled
                        value="{{ number_format($invoice->booking->open_trip->harga) }}">
                </div>
                <div class="form-group">
                    <label class="form-label"> Jumlah </label>
                    <input type="text" class="form-control" disabled value="{{ $invoice->booking->jumlah_booking }}">
                </div>
                <div class="form-group">
                    <label class="form-label"> Total Bayar </label>
                    <div class="input-group">
                        <input type="text" class="form-control" disabled value="{{ number_format($invoice->amount) }}">
                        <button class="btn btn-info" onclick="copy('{{ $invoice->amount }}')">copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Metode Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('storage/'. $invoice->chanel_pembayaran->image) }}" width="200px"
                        alt="Chanel Pembayaran">
                </div>
                <div class="form-group">
                    <label class="form-label">Metode Pembayan</label>
                    <input type="text" class="form-control"
                        value="{{ ucwords(str_replace('_', ' ', $invoice->metode_pembayaran)) }}" disabled>
                </div>
                @if (in_array($invoice->metode_pembayaran, ['bank_transfer', 'cstore']))
                <div class="form-group">
                    <label class="form-label">Bank / Store</label>
                    <input type="text" class="form-control" value="{{ strtoupper($invoice->bank) }}" disabled>
                </div>
                @endif
                @if (in_array($invoice->metode_pembayaran, ['bank_transfer', 'cstore']))
                <div class="form-group">
                    <label class="form-label">Kode Pembayaran</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{ $invoice->va_number }}" disabled>
                        <button class="btn btn-info" onclick="copy('{{ $invoice->va_number }}')">copy</button>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label class="form-label">Scan Qris</label>
                    <div class="d-flex justify-content-center">
                        <img src="{{ $invoice->pay_url }}" width="200px" alt="">
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
    <!-- COL-END -->
</div>
@endsection
@section('addscript')
<script>
    function copy(text) {
            navigator.clipboard.writeText(text);
            $.growl.notice({
                title: '<i class="fa fa-check"></i> SUKSES',
                message: "Berhasil menyalin text",
                duration: 2000
            });
        }
</script>
@endsection