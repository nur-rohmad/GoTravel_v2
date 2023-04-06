@extends('layout.admin')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/richtexteditor/rte_theme_default.css" />
@endsection
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
                            <th>No</th>
                            <th>Nama Wisata</th>
                            <th>Kota</th>
                            <th>Deskripsi</th>
                            <th>Foto</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($wisata as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nama_wisata }}</td>
                                <td>{{ $item->kota }}</td>
                                <td><button class="btn btn-sm btn-dark"
                                        onclick="showDeskripsi('{{ $item->deskripsi }}')">lihat deskripsi</button></td>
                                <td></td>
                                <td><button class="btn btn-sm btn-info">Lihat Peta</button></td>
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
    <div class="modal-dialog modal-dialog-centered text-center modal-xl" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Deskripsi Wisata</h6><button aria-label="Close" class="btn-close"
                    data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <textarea class="content" name="deskripsi" disabled></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- modal deskripsi --}}
<!-- /Row -->
@endsection
@section('addscript')
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

<!-- INTERNAL Richtext Editor JS -->
<script type="text/javascript" src="/assets/plugins/richtexteditor/rte.js"></script>
<script type="text/javascript" src='/assets/plugins/richtexteditor/plugins/all_plugins.js'></script>
<script>
    var editor1 = new RichTextEditor(".content");
    function showDeskripsi(deskripsi) {
        console.log(deskripsi)
        
        editor1.insertHTML(deskripsi)
        editor1.setReadOnly(true)
        $('#modal-deskripsi').modal('show');
    }
    $('#btn-deskripsi').click((deskripsi)=>{
        
        
    })
</script>
@endsection