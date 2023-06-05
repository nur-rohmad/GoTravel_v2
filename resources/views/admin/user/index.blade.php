@extends('layout.admin')
@section('addcss')
<link rel="stylesheet" href="/assets/plugins/loader/ldld.min.css">
@endsection
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">User</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page"><a href="/admin">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">User</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="card-title">Daftar User</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom" id="pelanggan">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Alamat</th>
                                <th>No Handpone</th>
                                <th>status</th>
                                <th>Terakhir Login</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td class="text-center">{{ $loop->index+1 }}</td>
                                <td>{{ ucwords($item->name) }}</td>
                                <td>{{ $item->email }}</td>
                                <td><span
                                    class="badge badge-sm bg-{{ $item->role == 'admin' ? 'primary' : 'warning' }}">{{ $item->role == 'admin' ? 'Admin' : 'Pelanggan' }}</span></td>
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

{{-- modal edit pelanggan --}}
<div class="modal fade" id="modalDataUser" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kelola Data User</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-user" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="my-loader" class="ldld default"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Email User</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div id="error-email" class="text-danger">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div id="error-password" class="text-danger">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama User</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div id="error-name" class="text-danger">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">No Handpone</label>
                                <input type="text" name="NoHP" class="form-control">
                            </div>
                            <div id="error-NoHP" class="text-danger">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                               <textarea name="alamat" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            <div id="error-alamat" class="text-danger">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Status User</label>
                                <select name="status" class="form-control form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak aktif</option>
                                </select>
                                <div id="error-status" class="text-danger">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Role User</label>
                                <select name="role" class="form-control form-select">
                                    <option value="pelanggan">Pelanggan</option>
                                    <option value="admin">Tidak aktif</option>
                                </select>
                                <div id="error-role" class="text-danger">

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
{{-- modal edit pelanggan --}}
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
<script src="/assets/plugins/loader/ldld.min.js"></script>
<script>
    let ldld = new ldLoader({ root: "#my-loader" });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#form-user').submit((e)=>{
        ldld.on();
        e.preventDefault();
        let form = $('#form-user')
        let data1 = new FormData(form[0])
        this.reset_error()
        $.ajax({
            type:  'POST' ,
            url:  '/admin/user/edit/',
            data: data1,
            processData: false,
            contentType: false,
            success: (result)=> {
                ldld.off();
                $('#modalDataUser').modal('hide')
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
            if (error.status == 422) {
                let error_message = error.responseJSON.errors
                $.each(error_message, (key,value) => {
                    let error_html = $('#error-'+ key);
                    $.each(value, (key1,value1) => {
                         error_html.text(value1);
                     })
                })
            }else {
                $.growl.error({
                title: '<i class="fa fa-exclamation-triangle"></i> GAGAL',
                message: "Terjadi kesalahan pada sistem",
                duration: 2000 });
            }
        },

        })
    })

    function update(data){
        $('#form-user').append(`<input type="hidden" name="id" value="${data.id}">`)
        // add uploadfile
        // $('#modal-title').text("Edit Data Barang")
        // reset form
        $('#form-user')[0].reset()
        // reset error
        this.reset_error()
        // add value in button
        // $('#submit').val('update');
        $.each(data, (key, value) => {
            //  if(key != 'password'){
                $(`[name="${key}"]`).val(value)
            // }
        })
        $('#modalDataUser').modal('show')
    }

function reset_error(){
    $('#error-email').text('')
    $('#error-name').text('')
    $('#error-status').text('')
    $('#error-NoHP').text('')
    $('#error-alamat').text('')
    $('#error-role').text('')
    $('#error-password').text('')
}
</script>
@endsection