@extends('layouts.layouts-horizontal')
@section('title') Master Sekolah @endsection
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
@slot('title') Master Sekolah @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Master Sekolah</h5>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add New
                        Data</button>
                </div>
            </div>
            <div class="card-body">

                <table id="sekolah-table" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NPSN</th>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Kelurahan</th>
                            <!-- <th>Status</th> -->
                            <th>Jenjang</th>
                            <th>Kecamatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($data as $row)
<div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Form edit -->
                <form action="{{ route('sekolah.update', $row->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="NPSN" class="form-label">NPSN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('NPSN') is-invalid @enderror" name="npsn"
                                    value="{{old('npsn',@$row->npsn)}}" id="NPSN" placeholder="Masukkan NPSN" required>
                                @error('NPSN')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter NPSN
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="Nama Sekolah" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('Nama Sekolah') is-invalid @enderror" name="nama"
                                    value="{{old('nama',@$row->nama)}}" id="nama" placeholder="Masukkan Nama Sekolah" required>
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter Nama Sekolah
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                    value="{{old('alamat',@$row->alamat)}}" id="alamat" placeholder="Masukkan Alamat" required>
                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter Alamat
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="kelurahan" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan"
                                    value="{{old('kelurahan',@$row->kelurahan)}}" id="kelurahan" placeholder="Masukkan Kelurahan" required>
                                @error('kelurahan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                    Please enter Kelurahan
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select class="js-example-basic-single" name="status">
                                        <option value="{{old('status', @$row->status)}}" selected>{{@$row->status}}</option>
                                        <option value="NEGERI">Negeri</option>
                                        <option value="SWASTA">Swasta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <select class="js-example-basic-single" name="jenjang">
                                        <option value="{{old('jenjang', @$row->jenjang)}}" selected>{{@$row->jenjang}}</option>
                                        <option value="Sekolah Dasar">Sekolah Dasar</option>
                                        <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-md-6">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                <select class="js-example-basic-single" name="kecamatan_id">
                                    @foreach($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}"
                                        {{ old('kecamatan_id', isset($row) ? $row->kecamatan_id : '') == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn" id="deleteRecordModal{{@$row->id}}" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" id="btn-close"></button>
            </div>
            <form action="{{ route('sekolah.destroy', @$row->id) }}" method="post">
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

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary p-3">
                <h5 class="modal-title text-light" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form method="POST" action="{{route('sekolah.store')}}" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-xxl-3 col-md-6">
                            <label for="NPSN" class="form-label">NPSN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('NPSN') is-invalid @enderror" name="npsn"
                                value="{{ old('npsn') }}" id="NPSN" placeholder="Masukkan NPSN" required>
                            @error('NPSN')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter NPSN
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <label for="Nama Sekolah" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('Nama Sekolah') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}" id="nama" placeholder="Masukkan Nama Sekolah" required>
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter Nama Sekolah
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                value="{{ old('alamat') }}" id="alamat" placeholder="Masukkan Alamat" required>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter Alamat
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <label for="kelurahan" class="form-label">Kelurahan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kelurahan') is-invalid @enderror" name="kelurahan"
                                value="{{ old('kelurahan') }}" id="kelurahan" placeholder="Masukkan Kelurahan" required>
                            @error('kelurahan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter Kelurahan
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select class="js-example-basic-single" name="status">
                                    <option value="NEGERI">Negeri</option>
                                    <option value="SWASTA">Swasta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <label for="jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select class="js-example-basic-single" name="jenjang">
                                    <option value="Sekolah Dasar">Sekolah Dasar</option>
                                    <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-md-6">
                            <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select class="js-example-basic-single" name="kecamatan_id">
                                @foreach($kecamatans as $kecamatan)
                                <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                                @endforeach
                            </select>
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
    $(function() {
        let t = $('#sekolah-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sekolah.data') }}",
            columns: [{
                    data: 'npsn',
                    name: 'npsn'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'kelurahan',
                    name: 'kelurahan'
                },
                // { data: 'status', name: 'status' },
                {
                    data: 'jenjang',
                    name: 'jenjang'
                },
                {
                    data: 'kecamatan.nama',
                    name: 'kecamatan.nama'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endsection