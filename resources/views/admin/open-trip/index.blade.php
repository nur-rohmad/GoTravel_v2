@extends('layout.admin')
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Open Trip</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Open Trip</li>
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
                <h3 class="card-title">Daftar Open Trip</h3>
                <a href="/admin/open-trip/tambah-open-trip" class="btn btn-sm btn-danger"><i
                        class="fa fa-plus me-1"></i>
                    Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="open-trip">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal Berangkat</th>
                                <th>Durasi (Hari)</th>
                                <th>Tujuan Wisata</th>
                                <th>Jumlah Peserta</th>
                                <th>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($openTrip as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ date('d M Y H:i', strtotime($item->tgl_berangkat)) }}</td>
                                <td>{{ $item->lama_open_trip }}</td>
                                <td>
                                    <ol>
                                        @foreach ($item->lokasi_tujuan as $lokasi)
                                        <li>{{$lokasi->nama_wisata}}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>{{ $item->jumlah_peserta }}</td>
                                <td>{{ number_format($item->harga) }}</td>
                                <td>
                                    <a href="/admin/open-trip/show/{{ $item->slug }}" class="btn btn-sm btn-info"><i
                                            class="fa fa-eye"></i></a>
                                    <a href="/admin/open-trip/edit/{{ $item->slug }}" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger" onclick="deleteOpenTrip('{{ $item->id }}','{{ $item->title }}')"><i class="fa fa-trash"></i></button>
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

<script>
    // delete wisata
    function deleteOpenTrip(id, name_wisata){
        Swal.fire({
            title: 'apakah anda yakin ?',
            icon: 'warning',
            html: `Menghapus Open Trip dengan nama open Trip <span class="text-danger fw-bold">${name_wisata}</span>`,
            confirmButtonColor: "#dc3545",
            showCancelButton: true,
            confirmButtonText: 'Delete',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
            return fetch(`/admin/open-trip/delete`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json' 
                },
                body: JSON.stringify({id_openTrip: id})
            }).then((result) => {
                if (!result.ok) {
                    if (result.status == 503) {
                        swal.fire('Gagal','Data Open Trip yang telah dibooking tidak dapat dihapus', 'error')
                    }else {
                        swal.fire('Gagal','Gagal Menghapus data', 'error')
                    }
                }else{
                    swal.fire('Sukses','Data wisata berhasil dihapus', 'success').then(() => {
                    location.reload()
                })
                }
            })
            .catch(error => {
                swal.fire('Gagal','Terjadi kesalahan pada sistem', 'error')
            })
            },
                allowOutsideClick: () => !Swal.isLoading()
            })
    }
</script>

@if (session('gagal'))
<script>
    // notif<i class="fas fa-exclamation-triangle"></i>
         $.growl.error({
                title: '<i class="fa fa-exclamation-triangle"></i> GAGAL',
                message: "{{ session('gagal') }}",
                duration: 5000
        });
</script>
@endif
@if (session('success'))
<script>
    // notif<i class="fas fa-exclamation-triangle"></i>
         $.growl.notice({
                title: '<i class="fa fa-check"></i> SUKSES',
                message: "{{ session('success') }}",
                duration: 5000
        });
</script>
@endif
@endsection