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
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Item Open Trip </h3>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <img class="avatar-xxl br-7" src="{{ asset('storage/'. $openTrip->poster) }}" alt="img">
                    <div class="ms-3">
                        <h4 class="mb-1 fw-semibold fs-14"><a href="shop-description.html">{{ $openTrip->title}}</a>
                        </h4>
                        <div class="text-warning fs-14 mb-2">
                            <span class="badge rounded-pill bg-success badge-sm me-2 py-1"> <i
                                    class="fa fa-user me-1"></i> {{
                                $openTrip->sisa_kuota }} orang </span>
                            <span class="badge rounded-pill bg-primary badge-sm py-1"> <i
                                    class="fa fa-calendar-check-o me-1"></i>
                                {{
                                date("d M Y H:i", strtotime($openTrip->tgl_berangkat)) }} </span>
                        </div>
                        {!! $openTrip->deskripsi !!}
                        <div class="handle-counter" id="handleCounter1">
                            <button type="button" class="counter-minus btn btn-white lh-2 shadow-none">
                                <i class="fa fa-minus text-muted"></i>
                            </button>
                            <input type="text" value="1" class="qty" name="jumlah_booking">
                            <button type="button" class="counter-plus btn btn-white lh-2 shadow-none">
                                <i class="fa fa-plus text-muted"></i>
                            </button>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <span class="fs-16 fw-semibold">{{ number_format($openTrip->harga) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- metodew pembayaran --}}
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Metode Pembayran</h3>
            </div>
            <div class="card-body">
                <div class="card-pay">
                    <ul class="tabs-menu nav">
                        <li><a href="#tab20" data-bs-toggle="tab" class="payment-icon active"><i
                                    class="fa fa-bank me-2"></i>
                                Bank
                                Transfer</a></li>
                        <li class=""><a href="#tab22" class="payment-icon" data-bs-toggle="tab"> <i
                                    class="fa fa-qrcode fa-1x me-2"></i> QRIS</a></li>
                        <li><a href="#tab21" data-bs-toggle="tab" class="payment-icon"> <i
                                    class="fa fa-shopping-bag me-2"></i> Customer Store </a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab20">
                            @foreach ($chanelPembayaran as $item)
                            @if ($item->payment_type == 'bank_transfer')
                            <div class="card ribbone-card border" id="chanel-{{ $item->id }}" onclick="select(id)"
                                style="cursor: pointer">
                                <div class="d-flex px-5 py-5">
                                    <img class="avatar avatar-xl me-3" alt="avatra-img"
                                        src="{{ asset('storage/'.$item->image) }}">
                                    <div class="my-2">
                                        <a href="javascript:void(0)" class="text-default fw-semibold">{{ $item->name
                                            }}</a>
                                        <p class="text-muted ">Di cek secara otomatis</p>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="tab-pane" id="tab21">
                            @foreach ($chanelPembayaran as $item)
                            @if ($item->payment_type == 'gopay')
                            <div class="card ribbone-card border" id="chanel-{{ $item->id }}" onclick="select(id)"
                                style="cursor: pointer">
                                <div class="d-flex px-5 py-5">
                                    <img class="avatar avatar-xl me-3" alt="avatra-img"
                                        src="{{ asset('storage/'.$item->image) }}">
                                    <div class="my-2">
                                        <a href="javascript:void(0)" class="text-default fw-semibold">{{ $item->name
                                            }}</a>
                                        <p class="text-muted ">Di cek secara otomatis</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="tab-pane" id="tab22">
                            @foreach ($chanelPembayaran as $item)
                            @if ($item->payment_type == 'cstore')
                            <div class="card ribbone-card border" id="chanel-{{ $item->id }}" onclick="select(id)"
                                style="cursor: pointer">
                                <div class="d-flex px-5 py-5">
                                    <img class="avatar avatar-xl me-3" alt="avatra-img"
                                        src="{{ asset('storage/'.$item->image) }}">
                                    <div class="my-2">
                                        <a href="javascript:void(0)" class="text-default fw-semibold">{{ $item->name
                                            }}</a>
                                        <p class="text-muted ">Di cek secara otomatis</p>
                                    </div>
                                </div>

                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5"></div>
</div>
@endsection
@section('addscript')
<!-- Handle Counter js -->
<script src="/assets/js/handlecounter.js"></script>
<script>
    function select(id)
    {
        let select  = $('#select').remove()
        $('#'+id).append(`<div class="power-ribbone power-ribbone-top-left text-success" id="select"><span class="bg-success"><i
                    class="fa fa-check text-light"></i></span></div>`)
    }
</script>
@endsection