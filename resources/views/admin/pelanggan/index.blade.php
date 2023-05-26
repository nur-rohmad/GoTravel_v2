@extends('layout.admin')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/loader/ldld.min.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Pelanggan</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Daftar Pelanggan</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="pelanggan">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No Handpone</th>
                                <th>status</th>
                                <th>Terakhir Login</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $item)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td>{{ ucwords($item->name) }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->NoHP }}</td>
                                <td><span
                                        class="badge badge-sm bg-{{ $item->status == 1 ? 'success' : 'danger' }}">{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                <td>{{ date("d M Y H:s", strtotime($item->last_login)) }}</td>
                                <td class="text-center">
                                    <button onclick="update({{ $item }})" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addscript')
<!-- FILE UPLOADES JS -->
<script src="/assets/plugins/fileuploads/js/fileupload.js"></script>

<script src="/assets/plugins/select2/select2.full.min.js"></script>

<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="/assets/js/table-data.js"></script>
@endsection