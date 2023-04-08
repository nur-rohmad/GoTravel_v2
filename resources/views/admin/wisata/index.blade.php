@extends('layout.admin')
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Wisata</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Wisata</li>
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
                <h3 class="card-title">Daftar wisata</h3>
                <a href="/admin/wisata/tambah-wisata" class="btn btn-sm btn-danger"> <i class="fa fa-plus"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                            <th width="5%">No</th>
                            <th>Nama Wisata</th>
                            <th>Kota</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th width="5%">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($wisata as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item->nama_wisata }}</td>
                                <td>{{ $item->kota }}</td>
                                <td><button class="btn btn-sm btn-dark"
                                        onclick="showDeskripsi('{{ $item->deskripsi }}')">lihat deskripsi</button></td>
                                <td></td>
                                <td><button class="btn btn-sm btn-info" onclick="showLocation('{{$item->nama_wisata}}', '{{$item->location->latitude}}', '{{$item->location->longitude}}')">Lihat Peta</button></td>
                                <td class="text-center"><span
                                        class="badge  bg-{{ $item->status == 'draf' ? 'danger' : 'success'  }} badge-sm ">{{
                                        ucWords($item->status)
                                        }}</span>
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- modal deskripsi --}}
<div class="modal fade effect-rotate-bottom" id="modal-deskripsi">
    <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Deskripsi Wisata</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <textarea id="summernote" name="deskripsi"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
{{-- modal deskripsi --}}
{{-- modal map --}}
<div class="modal fade effect-rotate-bottom" id="modal-location">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Lokasi Wisata <span id="nama-wisata"></span></h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" id="modal-body">
                
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
{{-- modal map --}}
<!-- /Row -->
@endsection
@section('addscript')
<!-- INTERNAL SELECT2 JS -->
<script src="/assets/plugins/select2/select2.full.min.js"></script>
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

<!-- INTERNAL summernote -->
<script src="/assets/plugins/summernote1/summernote1.js"></script>

 <!-- INTERNAL leaflet js -->
 <script src="/assets/plugins/leaflet/leaflet.js"></script>
 {{-- <script src="/assets/js/map-leafleft.js"></script> --}}
<script>
    
     $(document).ready(function() {
        'use strict';
        
        $('#summernote').summernote('disable');
         // Adding a Popu
    });
    // load deskripsi
    function showDeskripsi(deskripsi) 
    {
        $('#summernote').summernote('code', deskripsi);
        $('#modal-deskripsi').modal('show');
    }
    // load location
    function showLocation(nama_wisata, latitude, longitude)
    {
        // add judul modal
        $('#nama-wisata').text(nama_wisata)
        // add canva map
        $('#modal-body').append( `<div class="ht-300" id="leaflet2" style="height: 400px;"></div>`)
        // inisialisasi map
        var peta = L.map('leaflet2').setView([-7.4040, 111.4452], 13);
        setTimeout(function(){ peta.invalidateSize()}, 400);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(peta);
        L.marker([latitude , longitude]).addTo(peta)
            .bindPopup(nama_wisata)
            .openPopup();
            // tampilkan modal
        $('#modal-location').modal('show');
    }

    // remove canva map saat modal tertutup
    $('#modal-location').on('hide.bs.modal', function(){
        $('#leaflet2').remove()
    })
   

</script>
@endsection