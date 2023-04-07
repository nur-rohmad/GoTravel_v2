@extends('layout.admin');
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Tambah Wisata</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/admin/wisata">Wisata</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Wisata</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<!-- ROW-1 OPEN -->
<!-- Row -->
<div class="row ">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Tambah wisata</h3>
                <a href="/admin/wisata" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left me-2"></i>Kembali</a>
            </div>
            <div class="card-body">
                <form action="/admin/wisata/proccess-add-wisata" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama Wisata <span class="text-red">*</span></label>
                                <input type="text" name="nama_wisata"
                                    class="form-control @error('nama_wisata') is-invalid @enderror"
                                    placeholder="Bromo.." value="{{ old('nama_wisata') }}">
                                @error('nama_wisata')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Kota Wisata <span class="text-red">*</span></label>
                                <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror"
                                    placeholder="Bromo.." value="{{ old('kota') }}">
                                @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Foto <span class="text-red">*</span></label>
                                <input type="file" id="demo" name="image"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept=".jpg, .png, image/jpeg, image/png" multiple>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Status<span class="text-red">*</span></label>
                                <select name="status" class="form-control form-select select2"
                                    data-bs-placeholder="Select Status">
                                    <option value="draf">Draf</option>
                                    <option value="publish">Publish</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Longitude <span class="text-red">*</span></label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                                    value="{{ old('longitude') }}">
                                @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Laitude <span class="text-red">*</span></label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                    value="{{ old('latitude') }}">
                                @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Deskripsi<span class="text-red">*</span></label>
                                <textarea class="content @error('deskripsi') is-invalid @enderror" id="summernote" name="deskripsi">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success float-end mt-4"><i class="fa fa-check"></i>
                                Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
@endsection
@section('addscript')
<!-- INTERNAL summernote -->
 <!-- INTERNAL SUMMERNOTE Editor JS -->
 <script src="/assets/plugins/summernote1/summernote1.js"></script>
 <script src="/assets/js/summernote.js"></script>


<script src="/assets/plugins/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

@endsection