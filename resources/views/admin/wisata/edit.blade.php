@extends('layout.admin')
@section('addcss')
<link
rel="stylesheet"
href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"
/>s
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Edit Wisata</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="/admin/wisata">Wisata</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Wisata</li>
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
                <h3 class="card-title">Edit wisata</h3>
                <a href="javascript:void(0)" class="btn btn-success" onclick="showMap()">cari Lokasi <i
                    class="fa fa-map-o ms-2"></i></a>
                <a href="/admin/wisata" class="btn btn-sm btn-dark"><i class="fa fa-arrow-left me-2"></i>Kembali</a>
            </div>
            <div class="card-body">
                <form action="/admin/wisata/proccess-edit-wisata" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$wisata->id}}" name="id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama Wisata <span class="text-red">*</span></label>
                                <input type="text" name="nama_wisata"
                                    class="form-control @error('nama_wisata') is-invalid @enderror"
                                    placeholder="Bromo.." id="nama_wisata" value="{{ old('nama_wisata', $wisata->nama_wisata) }}">
                                @error('nama_wisata')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Kota Wisata <span class="text-red">*</span></label>
                                <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror"
                                    placeholder="Bromo.." id="nama_kota" value="{{ old('kota', $wisata->kota) }}">
                                @error('kota')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Foto <span class="text-red">*</span></label>
                                <div class="input-group">
                                    <input type="file" class="dropify" name="image"
                                        data-default-file="{{ asset('storage/'. $wisata->image) }}"
                                        data-bs-height="180">
                                </div>
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Status<span class="text-red">*</span></label>
                                <select name="status" class="form-control form-select select2"
                                    data-bs-placeholder="Select Status">
                                    <option value="draf" {{ $wisata->status == 'draf' ? 'selected' : ''}}>Draf</option>
                                    <option value="publish" {{ $wisata->status == 'publish' ? 'selected' : ''}} >Publish
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Longitude <span class="text-red">*</span></label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                    name="longitude" id="longitude"
                                    value="{{ old('longitude' ,  $wisata->location->longitude) }}" readonly>
                                @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> Laitude <span class="text-red">*</span></label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    name="latitude" id="latitude"
                                    value="{{ old('latitude' , $wisata->location->latitude) }}" readonly>
                                @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Deskripsi<span class="text-red">*</span></label>
                                <textarea class="content @error('deskripsi') is-invalid @enderror" id="summernote"
                                    name="deskripsi">{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
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
{{-- peta lokasi --}}
<!-- /Row -->
@endsection
@section('addscript')

<!-- FILE UPLOADES JS -->
<script src="/assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="/assets/plugins/fileuploads/js/file-upload.js"></script>

<!-- INTERNAL SUMMERNOTE Editor JS -->
<script src="/assets/plugins/summernote1/summernote1.js"></script>
<script src="/assets/js/summernote.js"></script>

<!-- INTERNAL Notifications js -->
<script src="/assets/plugins/notify/js/rainbow.js"></script>
{{-- <script src="/assets/plugins/notify/js/sample.js"></script> --}}
<script src="/assets/plugins/notify/js/jquery.growl.js"></script>
<script src="/assets/plugins/notify/js/notifIt.js"></script>

<script src="/assets/plugins/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

<!-- INTERNAL leaflet js -->
<script src="/assets/plugins/leaflet/leaflet.js"></script>

{{-- geosearch --}}
<script src="https://unpkg.com/leaflet-geosearch@3.5.0/dist/geosearch.umd.js"></script>


<script>
    $(document).ready(function (e) {
        $('#foto_wisata').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
        $('#preview-image_edit').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
    
    });

    function searchEventHandler(result) {
            // insert latitude and longitude
            $('#latitude').val(result.location.y)
            $('#longitude').val(result.location.x)

            // ambil nama lokasi 
           let label = result.location.label.split(",")
            // insert nama dan kota wisata
            $('#nama_wisata').val(label[0])
            $('#nama_kota').val(label[2])
             $.growl.notice({
                title: '<i class="fa fa-check"></i> Sukses',
                message: `berhasil menambahkan <br/> latitude : ${result.location.y} <br/> longitude : ${result.location.x}`,
                duration: 2000
            });
         }

    // load location
   function showMap()
   {
       // add canva map
       $('#modal-body').append( `<div class="ht-300" id="leaflet2" style="height: 400px;"></div>`)
       
        //creatre icon
        const iconLama = L.icon({
            iconUrl: '/assets/images/icon-map/icon-lama-merah.png',
            iconSize: [50, 50],
        })
        const iconBaru = L.icon({
            iconUrl: '/assets/images/icon-map/icon-baru-biru.png',
            iconSize: [50, 50],
        })

       // inisialisasi map
       var peta = L.map('leaflet2').setView([{{$wisata->location->latitude}} , {{$wisata->location->longitude}}], 20);
       setTimeout(function(){ peta.invalidateSize()}, 400);
       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
           attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
       }).addTo(peta);
       
       //add maker 
       L.marker([{{$wisata->location->latitude}} , {{$wisata->location->longitude}}], {icon: iconLama}).addTo(peta)
            .bindPopup('titik lama')

        const search = new GeoSearch.GeoSearchControl({
            provider: new GeoSearch.OpenStreetMapProvider(),
            style: 'bar',
        });


        peta.on('geosearch/showlocation', searchEventHandler);
        peta.addControl(search);
       
        var theMarker = {}
       
         // create event  saat peta diclick
        peta.on('click', function(ev){
            var latlng = peta.mouseEventToLatLng(ev.originalEvent);
            
            // check apakah marker sudah ada jika sudah ada maka akan diremove dahulu
            if (theMarker != undefined) {
                peta.removeLayer(theMarker);
            };
            
            // add marker to map
            theMarker = L.marker([latlng.lat , latlng.lng], {icon: iconBaru}).addTo(peta)
            theMarker.bindPopup('titik baru')
            // add latlng to form
            $('#latitude').val(latlng.lat)
            $('#longitude').val(latlng.lng)

            // notif penambahan latitude and longitude
            $.growl.notice({
                    title: '<i class="fa fa-check"></i> Sukses',
                    message: `berhasil menambahkan <br/> latitude : ${latlng.lat} <br/> longitude : ${latlng.lng}`,
                    duration: 2000
            });
        });
        // tampilkan modal
       $('#modal-location').modal('show');
   }

   // remove canva map saat modal tertutup
   $('#modal-location').on('hide.bs.modal', function(){
       $('#leaflet2').remove()
   })
  

</script>

@endsection