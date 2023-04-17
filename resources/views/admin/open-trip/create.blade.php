@extends('layout.admin')
@section('main')
     <!-- PAGE-HEADER -->
     <div class="page-header">
        <h1 class="page-title">Tambah Open Trip</h1>
        <div>
            <ol class="breadcrumb">
                <li class="breadcrumb-item " aria-current="page"><a href="/admin">Admin</a></li>
                <li class="breadcrumb-item " aria-current="page"><a href="/admin/open-trip">Open Trip</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <!-- Row -->
    <div class="row ">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">Tambah Open Trip</h3>
                    <a href="/admin/open-trip" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left me-2"></i>Kembali</a>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Judul</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Tanggal Berangkat</label>
                                    <input type="date" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Lama Open Trip</label>
                                    <input type="number" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Kuota</label>
                                    <input type="number" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Harga / orang</label>
                                    <input type="number" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
@endsection