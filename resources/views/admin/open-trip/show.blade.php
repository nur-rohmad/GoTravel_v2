@extends('layout.admin')
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Detail Open Trip</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/admin">Open Trip</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $openTrip->title }}</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="container-fluid">
    <div class="card show">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$openTrip->poster) }}" alt="poster">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-semibold">{{ $openTrip->title }}</h3>
                    <h4 class="mt-4"><b> Deshripsi</b></h4>
                    <div class="">
                        {!! $openTrip->deskripsi !!}
                    </div>
                    <h4 class="mb-4"><span class="me-2 fw-bold fs-25 d-inline-flex"> {{ number_format($openTrip->harga)
                            }} </h3>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection