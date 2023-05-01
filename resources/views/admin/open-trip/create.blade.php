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
                <form action="/admin/open-trip/proccess-add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Judul</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title') }}" name="title">
                                @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tanggal Berangkat</label>
                                <input type="datetime-local"
                                    class="form-control @error('tgl_berangkat') is-invalid @enderror"
                                    value="{{ old('tgl_berangkat') }}" name="tgl_berangkat">
                                @error('tgl_berangkat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Lama Open Trip</label>
                                <input type="number" class="form-control @error('lama_open_trip') is-invalid @enderror"
                                    value="{{ old('lama_open_trip') }}" name="lama_open_trip">
                                @error('lama_open_trip')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Kuota</label>
                                <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror"
                                    value="{{ old('jumlah_peserta') }}" name="jumlah_peserta">
                                @error('jumlah_peserta')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Harga / orang</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ old('harga') }}" name="harga">
                                @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Lokasi Wisata </label>
                                <select class="form-control @error('lokasi_tujuan') is-invalid  @enderror"
                                    name="lokasi_tujuan[]" id="select2-multiple" multiple="multiple">
                                    <option value=""></option>
                                    @foreach ($wisata as $item)
                                    <option value="{{$item->id}}">{{ $item->nama_wisata }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('lokasi_tujuan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Poster</label>
                                <div class="input-group">
                                    <input type="file" name="poster" id="foto-poster"
                                        class="form-control @error('poster') is-invalid @enderror" />
                                </div>
                                @error('poster')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="privew-image">
                                    <img id="preview-image_add"
                                        src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                        alt="preview image" style="max-height: 200px; max-width: 250px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label"> Lokasi Penjemputan</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                        name="longitude" id="longitude" value="{{ old('longitude') }}"
                                        placeholder="Longitude" readonly>
                                    @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="input-group ms-2">
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                            name="latitude" id="latitude" value="{{ old('latitude') }}"
                                            placeholder="Latitude" readonly>
                                        <a href="javascript:void(0)" class="btn btn-dark" onclick="showMap()">Buka
                                            Peta <i class="fa fa-map-o ms-2"></i></a>
                                    </div>
                                    @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="content @error('deskripsi') is-invalid @enderror" id="summernote"
                                    name="deskripsi">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success float-end me-2">Simpan</button>
                            <button type="reset" class="btn btn-outline-dark float-end me-2">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- peta lokasi --}}
<div class="modal fade" id="modal-location">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Lokasi Wisata <span id="nama-wisata"></span></h6><button aria-label="Close"
                    class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" id="modal-body">

            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
@endsection
@section('addscript')
{{-- select2 --}}
<script src="/assets/plugins/select2/select2.full.min.js"></script>

<!-- INTERNAL SUMMERNOTE Editor JS -->
<script src="/assets/plugins/summernote1/summernote1.js"></script>
<script src="/assets/js/summernote.js"></script>

<!-- INTERNAL leaflet js -->
<script src="/assets/plugins/leaflet/leaflet.js"></script>
<script>
    $(document).ready(function() {
        $('#select2-multiple').select2({
            placeholder: 'Pilih Maximal 5 wisata',
            allowClear: true,
            maximumSelectionLength: 5
        })

        $('#foto-poster').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-image_add').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
        });
    })

    function showMap()
    {
        // add canva map
        $('#modal-body').append( `<div class="ht-300" id="leaflet2" style="height: 400px;"></div>`)
        // inisialisasi map
        var peta = L.map('leaflet2').setView([-2.504, 117.905], 5);
        setTimeout(function(){ peta.invalidateSize()}, 400);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(peta);
        // create event saat peta diclick
        var theMarker = {}
        peta.on('click', function(ev){
        var latlng = peta.mouseEventToLatLng(ev.originalEvent);
        // check apakah marker sudah ada jika sudah ada maka akan diremove dahulu
        if (theMarker != undefined) {
        peta.removeLayer(theMarker);
        };
        // add marker to map
        theMarker = L.marker([latlng.lat , latlng.lng]).addTo(peta)
        // add latlng to form
        $('#latitude').val(latlng.lat)
        $('#longitude').val(latlng.lng)
        
        // notif
        $.growl.notice({
        title: '<i class="fa fa-check"></i> Sukses',
        message: `berhasil menambahkan <br /> latitude : ${latlng.lat} <br /> longitude : ${latlng.lng}`,
        duration: 2000
        });
        
        });
        $('#modal-location').modal('show');
    }

    // remove canva map saat modal tertutup
    $('#modal-location').on('hide.bs.modal', function(){
    $('#leaflet2').remove()
    })
</script>
@endsection