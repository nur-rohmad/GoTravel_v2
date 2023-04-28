@extends('layout.admin')
@section('main')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Profile</h1>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="/{{ auth()->user()->role }}">{{
                    auth()->user()->role }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
</div>
<!-- PAGE-HEADER END -->

<div class="row">
    <div class="col-xl-4">
        <form action="/update-password" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Edit Password</div>
                </div>
                <input type="hidden" name="id" value="{{ $user_data->id }}">
                <div class="card-body">
                    <div class="text-center chat-image mb-5">
                        <div class="avatar avatar-xxl chat-profile mb-3 brround">
                            <a class="" href="profile.html"><img id="foto-profile-preview" alt="avatar"
                                    src="{{ $user_data->foto_profile ? $user_data->foto_profile : 'https://www.riobeauty.co.uk/images/product_image_not_found.gif' }}"
                                    class="brround"></a>
                        </div>
                        <div class="main-chat-msg-name">
                            <a href="profile.html">
                                <h5 class="mb-1 text-dark fw-semibold">{{ $user_data->name }}</h5>
                            </a>
                            <p class="text-muted mt-0 mb-0 pt-0 fs-13"><span
                                    class="badge badge-sm bg-{{ $user_data->role == 'admin' ? 'success' : 'danger' }}">{{
                                    $user_data->role }}</span></p>
                        </div>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-check-circle-o me-2" aria-hidden="true"></i> {{session('success')}}
                    </div>
                    @endif
                    @if (session('gagal'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <i class="fa fa-frown-o me-2" aria-hidden="true"></i> {{session('gagal')}}
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="form-label">Current Password</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control @error('old_password') is-invalid @enderror"
                                type="password" name="old_password" placeholder="Current Password"
                                autocomplete="current-password">
                            @error('old_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control @error('password') is-invalid @enderror" name="password"
                                type="password" placeholder="New Password" autocomplete="new-password">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="wrap-input100 validate-input input-group" id="Password-toggle2">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                            </a>
                            <input class="input100 form-control @error('password_confirmation') is-invalid @enderror"
                                type="password" name="password_confirmation" placeholder="Confirm Password"
                                autocomplete="new-password">
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="reset" class="btn btn-danger">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
        <div class="card panel-theme">
            <div class="card-header">
                <div class="float-start">
                    <h3 class="card-title">Contact</h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card-body no-padding">
                <ul class="list-group no-margin">
                    <li class="list-group-item d-flex ps-3">
                        <div class="social social-profile-buttons me-2">
                            <a class="social-icon text-primary" href="javascript:void(0)"><i class="fe fe-mail"></i></a>
                        </div>
                        <a href="javascript:void(0)" class="my-auto">support@demo.com</a>
                    </li>
                    <li class="list-group-item d-flex ps-3">
                        <div class="social social-profile-buttons me-2">
                            <a class="social-icon text-primary" href="javascript:void(0)"><i
                                    class="fe fe-globe"></i></a>
                        </div>
                        <a href="javascript:void(0)" class="my-auto">www.abcd.com</a>
                    </li>
                    <li class="list-group-item d-flex ps-3">
                        <div class="social social-profile-buttons me-2">
                            <a class="social-icon text-primary" href="javascript:void(0)"><i
                                    class="fe fe-phone"></i></a>
                        </div>
                        <a href="javascript:void(0)" class="my-auto">+125 5826 3658</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <form action="" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label for="exampleInputname"> Name</label>
                                <input type="text" name="name" value="{{ old('name', $user_data->name) }}"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputname"
                                    placeholder="First Name">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" value="{{ old('email', $user_data->email) }}" name="email"
                            class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                            placeholder="Email address">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputnumber">Nomer Handpone</label>
                        <input type="number" name="NoHP" value="{{ old('NoHP', $user_data->NoHP) }}"
                            class="form-control @error('NoHP') is-invalid @enderror" id="exampleInputnumber"
                            placeholder="Contact number">
                        @error('NoHP')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            rows="6">{{ old('alamat', $user_data->alamat) }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label"> Foto Profile </label>
                        <input type="file" name="foto_profile" id="foto-profile" class="form-control">
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-success my-1">Save</button>
                    <button type="reset" class="btn btn-danger my-1">Reset</button>
                </div>
        </form>
    </div>

</div>
</div>
@endsection
@section('addscript')
<script src="/assets/js/show-password.min.js"></script>
<script>
    $(document).ready(function() {
            $('#foto-profile').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
            $('#foto-profile-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            });
        })
</script>
@endsection