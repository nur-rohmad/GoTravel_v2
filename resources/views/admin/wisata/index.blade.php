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
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->nama_wisata }}</td>
                                <td>{{ $item->kota }}</td>
                                <td>{{ $item->lokasi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
@endsection
@section('addscript')
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
@endsection