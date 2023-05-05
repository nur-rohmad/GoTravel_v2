@extends('layout.admin')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/loader/ldld.min.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Chanel Pembayaran</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chanel Pembayaran
            </li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

{{-- content --}}
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">Daftar Chanel Pembayaran</h3>
                <button class="btn btn-sm btn-danger" onclick="add()">
                    <i class="fa fa-plus"></i> Tambah </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="responsive-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Group Chanel</th>
                                <th>Nama Chanel</th>
                                <th>Kode Chanel</th>
                                <th>Logo Chanel</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chanelPembayaran as $item)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ ucwords(str_replace('_', " ", $item->payment_type)) }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->payment_code }}</td>
                                <td> <img src="{{ asset('storage/'.$item->image) }}" alt="logo Chanel" width="100px">
                                </td>
                                <td><span
                                        class="badge badge-sm bg-{{ $item->status == 'active' ? 'success' : 'danger' }}">{{
                                        $item->status }}</span></td>
                                <td class="text-center">
                                    <button onclick="update({{ $item }})" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i></button>
                                    {{-- <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> --}}
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

{{-- modal tambah Chanel Pembayaran --}}
<div class="modal fade" id="addModalChanelPembayaran" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Chanel Pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-chanel-pembayaran" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="my-loader" class="ldld default"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama Chanel Pembayaran</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div id="error-name" class="text-danger">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Group Chanel Pembayaran</label>
                                <select name="payment_type" class="form-control form-select">
                                    <option value="bank_transfer">Bank Transfer</option>
                                    <option value="qris">Qris</option>
                                    <option value="cstore">Conter Payment</option>
                                </select>
                                <div id="error-payment_type" class="text-danger">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Kode Chanel Pembayaran</label>
                                <input type="text" name="payment_code" class="form-control">
                                <div id="error-payment_code" class="text-danger">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" id="label-image">Logo Chanel Pembayaran</label>
                                <div id="error-image" class="text-danger">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="reset">
                        Reset
                    </button>
                    <button type="submit" id="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('addscript')
<!-- FILE UPLOADES JS -->
<script src="/assets/plugins/fileuploads/js/fileupload.js"></script>
{{-- <script src="/assets/plugins/fileuploads/js/file-upload.js"></script> --}}

<script src="/assets/plugins/select2/select2.full.min.js"></script>

<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="/assets/js/table-data.js"></script>

{{-- loader --}}
<script src="/assets/plugins/loader/ldld.min.js"></script>
<script>
    var ldld = new ldLoader({ root: "#my-loader" });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#form-chanel-pembayaran').submit((e)=>{
        ldld.on();
        e.preventDefault();
        let form = $('#form-chanel-pembayaran')
        let data1 = new FormData(form[0])
        this.reset_error()
        $.ajax({
            type:  'POST' ,
            url:  $('#submit').val() == 'add' ?  '/admin/chanel-pembayaran' :  '/admin/chanel-pembayaran/edit',
            data: data1,
            processData: false,
            contentType: false,
            success: (result)=> {
                ldld.off();
                $('#addModalChanelPembayaran').modal('hide')
                Swal.fire({
                    title: "Success",
                    text: result.message,
                    icon: "success"
                }).then(() => {
                    location.reload()
                })

        },
        error: (error) => {
            ldld.off();
            let error_message = error.responseJSON.errors
            $.each(error_message, (key,value) => {
                let error_html = $('#error-'+ key);
                $.each(value, (key1,value1) => {
                     error_html.text(value1);
                 })
            })
        },

        })
})

function add(){
    // reset error
    reset_error()
    // reset form
    $('#form-chanel-pembayaran')[0].reset()
    // add image upload
    $('#label-image').after(`<div id="image"><input type="file" name="image" id="image-upload" class="dropify"></div>`)
    dropify()
    // add value button
    $('#submit').val('add')
    // tampilkan modal
    $('#addModalChanelPembayaran').modal('show')
}

function update(data){
    $('#form-chanel-pembayaran').append(`<input type="hidden" name="id" value="${data.id}">`)
    // add uploadfile
    $('#label-image').after(`<div id="image"><input type="file" name="image" id="image-upload" data-default-file="{{ asset('storage/${data.image}') }}" class="dropify"></div>`)
    dropify()
    // $('#modal-title').text("Edit Data Barang")
    // reset form
    $('#form-chanel-pembayaran')[0].reset()
    // reset error
    this.reset_error()
    // add value in button
    $('#submit').val('update');
    $.each(data, (key, value) => {
         if(['name','payment_type', 'payment_code' ].includes(key)){
            $(`[name="${key}"]`).val(value)
        }
    })
    $('#addModalChanelPembayaran').modal('show')
}

function reset_error(){
    $('#error-name').text('')
    $('#error-payment_type').text('')
    $('#error-payment_code').text('')
    $('#error-image').text('')
}

$('#addModalChanelPembayaran').on('hide.bs.modal', function(){
    $('#image').remove()
})

function dropify()
{
    $('.dropify').dropify({
    messages: {
    'default': 'Drag and drop a file here or click',
    'replace': 'Drag and drop or click to replace',
    'remove': 'Remove',
    'error': 'Ooops, something wrong appended.'
    },
    error: {
    'fileSize': 'The file size is too big (2M max).'
    }
    });
}
</script>
@endsection