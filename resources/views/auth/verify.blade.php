@extends('layout.pelanggan')

@section('main')
<div class="page-header">
    <h1 class="page-title">Verivikasi Email</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Verivikasi Email</li>
        </ol>
    </div>
</div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Silahkan Verivikasi Email Terlebih Dahulu') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Email verivikasi berhasil dikirim ke alamat email yang terdaftar' ) }}
                        </div>
                    @endif

                   <h5>{{ __('Sebelum dapat melakukan aktifitas pada website ini, Lihat pada kotak masuk email untuk melakukan aktivasi email.') }}</h5> 
                    {{ __('jika tidak mendapatkan email maka dapat menekan tombol dibawah ini untuk mengirimkan email verivikasi ulang') }},
                    <form class="" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-4">{{ __('Verivikasi Email') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
