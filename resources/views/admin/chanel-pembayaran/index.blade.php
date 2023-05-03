@extends('layout.admin')
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
                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#addModalChanelPembayaran">
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
                                <td>{{ $item->payment_type }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->payment_code }}</td>
                                <td> <img src="{{ asset('storage/'.$item->image) }}" alt="logo Chanel" width="100px">
                                </td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <button onclick="update({{ $item }})" class="btn btn-sm btn-warning"><i
                                            class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
                <h5 class="modal-title">Tambah Chanel Pembayaran</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-chanel-pembayaran" enctype="multipart/form-data">
                <div class="modal-body">
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
                                <label class="form-label">Logo Chanel Pembayaran</label>
                                <input type="file" name="image" class="dropify">
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
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('addscript')
<!-- FILE UPLOADES JS -->
<script src="/assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="/assets/plugins/fileuploads/js/file-upload.js"></script>

<script src="/assets/plugins/select2/select2.full.min.js"></script>

<script src="/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="/assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>
<script src="/assets/js/table-data.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#form-chanel-pembayaran').submit((e)=>{
        e.preventDefault();
        // $('#form-chanel-pembayaran').addClass('d-none')
        let form = $('#form-chanel-pembayaran')
        let data1 = new FormData(form[0])
        this.reset_error()
        $.ajax({
            type: 'POST',
            url: '/admin/chanel-pembayaran',
            data: data1,
            processData: false,
            contentType: false,
            success: (result)=> {
                // $('#loader').addClass('d-none')
                console.log(result)
                // $('#addModalChanelPembayaran').removeClass('d-none')
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
            console.log(error)
            // $('#form-submit-barang').removeClass('d-none')
            // $('#loader').addClass('d-none')
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

function update(data){
    console.log(data)
    // $('#modal-title').text("Edit Data Barang")
    $('#form-chanel-pembayaran')[0].reset()
    this.reset_error()
    $('#button_submit').val('update');
    $.each(data, (key, value) => {
        if (key == 'image') {
            $('[name="image"]').attr('data-default-file', '{{ asset('storage') }}/'+data.image);
        }
        else if(['name','payment_type', 'payment_code' ].includes(key)){
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
</script>
@endsection