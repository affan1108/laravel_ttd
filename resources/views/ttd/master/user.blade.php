@extends('layouts.layouts-horizontal')
@section('title') Master User @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tables @endslot
@slot('title') Master User @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Master User</h5>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add New
                        Data</button>
                </div>
            </div>
            <div class="card-body">

                <table id="add-rows" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{@$row->name}}</td>
                            <td>{{@$row->email}}</td>
                            <td>{{@$row->role}}</td>
                            <td>{{@$row->created_at}}</td>
                            <td>
                                <a data-bs-toggle="modal"
                                                data-bs-target="#editModal{{@$row->id}}" class="btn btn-secondary">Edit</a>
                                <a data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal{{@$row->id}}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{@$row->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary p-3">
                                        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form method="POST" action="{{route('user.update', @$row->id)}}" autocomplete="off"
                                        enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Username</label>
                                                <input type="text" id="customername-field" class="form-control"
                                                    placeholder="Masukkan Username" name="name"
                                                    value="{{ old('name', @$row->name) }}" required />
                                                <div class="invalid-feedback">Masukkan Username</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Role</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="role">
                                                        <option value="{{old('name', @$row->role)}}" selected>
                                                            {{@$row->role}}</option>
                                                        <!-- <option value="superadmin">Super Admin</option> -->
                                                        <option value="admin">Super Admin</option>
                                                        <option value="puskesmas">Admin Puskesmas</option>
                                                        <option value="sekolah">Admin Sekolah</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @php
                                                $akses_user = $aksess->where('user_id', $row->id)->first();
                                            @endphp
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Kecamatan</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="kecamatan_id">
                                                        <option value="" selected>Full Akses</option>
                                                        @foreach($kecamatans as $kecamatan)
                                                        <option value="{{ $kecamatan->id }}" 
                                                            {{ old('kecamatan_id', isset($row) && $akses_user ? $akses_user->kecamatan_id : '') == $kecamatan->id ? 'selected' : '' }}>
                                                            {{ $kecamatan->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Pilih Kecamatan</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Sekolah</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="sekolah_id">
                                                        <option value="" selected>Full Akses</option>
                                                        @foreach($sekolahs as $sekolah)
                                                        <option value="{{$sekolah->id}}" {{ old('sekolah_id', isset($row) && $akses_user ? $akses_user->sekolah_id : '') == $sekolah->id ? 'selected' : '' }}>
                                                            {{ $sekolah->nama }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Pilih Sekolah</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customername-field" class="form-label">Puskesmas</label>
                                                <div class="col-lg-12">
                                                    <select class="js-example-basic-single" name="puskesmas_id">
                                                        <option value="" selected>Full Akses</option>
                                                        @foreach($puskesmass as $puskesmas)
                                                        <option value="{{$puskesmas->id}}" {{ old('puskesmas_id', isset($row) && $akses_user ? $akses_user->puskesmas_id : '') == $puskesmas->id ? 'selected' : '' }}>
                                                                        {{ $puskesmas->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="invalid-feedback">Pilih Puskesmas</div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-secondary" id="add-btn">Edit
                                                    Data</button>
                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade zoomIn" id="deleteRecordModal{{@$row->id}}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="{{ route('user.destroy', @$row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you Sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Are you Sure You want to Remove this
                                                        Record ?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn w-sm btn-danger "
                                                    id="delete-record">Yes,
                                                    Delete It!</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary p-3">
                <h5 class="modal-title text-light" id="exampleModalLabel">Add New Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{route('user.store')}}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" id="useremail" placeholder="Enter email address" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter email
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" id="username" placeholder="Enter username" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter username
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="userpassword" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="userpassword" placeholder="Enter password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter password
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="input-password">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="input-password" placeholder="Enter Confirm Password"
                                    required>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="customername-field" class="form-label">Role</label>
                                <div class="col-lg-12">
                                    <select class="js-example-basic-single" name="role" id="role">
                                        <!-- <option value="superadmin">Super Admin</option> -->
                                        <option value="admin">Super Admin</option>
                                        <option value="puskesmas">Admin Puskesmas</option>
                                        <option value="sekolah">Admin Sekolah</option>
                                    </select>
                                </div>
                                <div class="invalid-feedback">Pilih Role</div>
                            </div>
                            <div class="col-xxl-3 col-md-6" id="kecamatan-group">
                                <label for="customername-field" class="form-label">Kecamatan</label>
                                <div class="col-lg-12">
                                    <select class="js-example-basic-single" name="kecamatan_id">
                                        <option value="" selected>Full Akses</option>
                                        @foreach($kecamatans as $kecamatan)
                                        <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">Pilih Kecamatan</div>
                            </div>
                            <div class="col-xxl-3 col-md-6" id="sekolah-group" >
                                <label for="customername-field" class="form-label">Sekolah</label>
                                <div class="col-lg-12">
                                    <select class="js-example-basic-single" name="sekolah_id">
                                        <option value="" selected>Full Akses</option>
                                        @foreach($sekolahs as $sekolah)
                                        <option value="{{$sekolah->id}}">{{$sekolah->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">Pilih Sekolah</div>
                            </div>
                            <div class="col-xxl-3 col-md-6" id="puskesmas-group">
                                <label for="customername-field" class="form-label">Puskesmas</label>
                                <div class="col-lg-12">
                                    <select class="js-example-basic-single" name="puskesmas_id">
                                        <option value="" selected>Full Akses</option>
                                        @foreach($puskesmass as $puskesmas)
                                        <option value="{{$puskesmas->id}}">{{$puskesmas->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="invalid-feedback">Pilih Puskesmas</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Data</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi semua select2 default
        $('.js-example-basic-single').select2({
            width: '100%',
            dropdownAutoWidth: true
        });

        // Jika select2 ada dalam modal, reinit saat modal dibuka
        $('.modal').on('shown.bs.modal', function () {
            $(this).find('.js-example-basic-single').select2({
                dropdownParent: $(this),
                width: '100%',
                dropdownAutoWidth: true
            });
        });
    });
</script>
<script>
$(document).ready(function () {
    function toggleGroups() {
        const role = $('#role').val();

        if (role === 'admin') {
            $('#kecamatan-group').hide();
            $('#sekolah-group').hide();
            $('#puskesmas-group').hide();
        } else {
            $('#kecamatan-group').show();
            $('#sekolah-group').show();
            $('#puskesmas-group').show();
        }
    }

    // Saat halaman dimuat pertama kali
    toggleGroups();

    // Saat pilihan role diubah
    $('#role').on('change', function () {
        toggleGroups();
    });
});
</script>

@endsection
