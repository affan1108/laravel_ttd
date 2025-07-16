@extends('layouts.layouts-horizontal')
@section('title') Master Data Pribadi @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />
    <style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
            font-size: 12px;
            border-radius: 5px;
        }
    </style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Tabel @endslot
@slot('title') Master Data Pribadi @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Master Data Pribadi</h5>
                <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add New
                        Data</button>
                </div>
            </div>
            <div class="card-body">

                <table id="example1" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>Nomer HP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat Lengkap</th>
                            <th>Puskesmas</th>
                            <th>Nama Sekolah</th>
                            <th>Kecamatan</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{@$row->nik}}</td>
                            <td>{{@$row->nama}}</td>
                            <td>{{@$row->nomer}}</td>
                            <td>{{@$row->tempat_lahir}}</td>
                            <td>{{@$row->tgl_lahir}}</td>
                            <td>{{@$row->alamat}}</td>
                            <td>{{@$row->puskesmas->nama}}</td>
                            <td>{{@$row->sekolah->nama}}</td>
                            <td>{{@$row->kecamatan->nama}}</td>
                            <td>{{@$row->kelas}}</td>
                            <td>{{@$row->jenis_kelamin == '1' ? 'Laki - laki' : 'Perempuan'}}</td>
                            <td>{{@$row->nama_ortu}}</td>
                            <td>
                                <a data-bs-toggle="modal"
                                                data-bs-target="#editModal{{@$row->id}}" class="btn btn-secondary">Detail</a>
                                <a data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal{{@$row->id}}" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{@$row->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-secondary p-3">
                                        <h5 class="modal-title text-light" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="{{route('pemeriksaan.update', @$row->id)}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nik" class="form-label">NIK</label>
                                                            <input type="text" class="form-control" id="nik" name="nik"
                                                                placeholder="Masukkan NIK" value="{{old('nik',@$row->nik)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control" id="nama" name="nama"
                                                                placeholder="Masukkan Nama Lengkap" value="{{old('nama',@$row->nama)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nomer" class="form-label">No HP</label>
                                                            <input type="text" class="form-control" id="nomer" name="nomer"
                                                                placeholder="Masukkan No HP" value="{{old('nomer',@$row->nomer)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                                                placeholder="Masukkan Tempat Lahir" value="{{old('tempat_lahir',@$row->tempat_lahir)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                                placeholder="Masukkan Tanggal Lahir" value="{{old('tgl_lahir',@$row->tgl_lahir)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                                placeholder="Masukkan Alamat Lengkap" value="{{old('alamat',@$row->alamat)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="puskesmas" class="form-label">Puskesmas</label>
                                                            <select class="js-example-basic-single" name="puskesmas_id" required>
                                                                @foreach($puskesmass as $puskesmas)
                                                                    <option value="{{ $puskesmas->id }}"
                                                                        {{ old('puskesmas_id', isset($row) ? $row->puskesmas_id : '') == $puskesmas->id ? 'selected' : '' }}>
                                                                        {{ $puskesmas->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                                            <select class="js-example-basic-single" name="sekolah_id" required>
                                                                @foreach($sekolahs as $sekolah)
                                                                    <option value="{{ $sekolah->id }}"
                                                                        {{ old('sekolah_id', isset($row) ? $row->sekolah_id : '') == $sekolah->id ? 'selected' : '' }}>
                                                                        {{ $sekolah->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama_kecamatan" class="form-label">Kecamatan</label>
                                                            <select class="js-example-basic-single" name="kecamatan_id" required>
                                                                @foreach($kecamatans as $kecamatan)
                                                                    <option value="{{ $kecamatan->id }}"
                                                                        {{ old('kecamatan_id', isset($row) ? $row->kecamatan_id : '') == $kecamatan->id ? 'selected' : '' }}>
                                                                        {{ $kecamatan->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="kelas" class="form-label">Kelas</label>
                                                            <select class="js-example-basic-single" name="kelas" id="kelas" value="{{old('kelas',@$row->kelas)}}">
                                                                @foreach (['7', '8', '9', '10', '11', '12'] as $kelas)
                                                                    <option value="{{ $kelas }}" 
                                                                        {{ old('kelas', @$row->kelas) == $kelas ? 'selected' : '' }}>
                                                                        {{ $kelas }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select class="js-example-basic-single" name="jenis_kelamin" id="jenis_kelamin" value="{{old('jenis_kelamin',@$row->jenis_kelamin)}}">
                                                                <option value="1" {{ old('jenis_kelamin', @$row->jenis_kelamin) == '1' ? 'selected' : '' }}>Laki - laki</option>
                                                                <option value="2" {{ old('jenis_kelamin', @$row->jenis_kelamin) == '2' ? 'selected' : '' }}>Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                                                            <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                                                placeholder="Masukkan Nama Orang Tua" value="{{old('nama_ortu',@$row->nama_ortu)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                        <div class="modal-footer align-items-right">
                                            <button type="submit" class="btn btn-secondary">Simpan</button>
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
                                    <form action="{{ route('pemeriksaan.destroy', @$row->id) }}" method="post">
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
                    <!-- <tfoot>
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>Nomer HP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat Lengkap</th>
                            <th>Puskesmas Domisili</th>
                            <th>Nama Sekolah</th>
                            <th>Kecamatan</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Master Data Pribadi (Deleted)</h5>
            </div>
            <div class="card-body">
                <table id="example2" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>NAMA</th>
                            <th>Nomer HP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat Lengkap</th>
                            <th>Puskesmas Domisili</th>
                            <th>Nama Sekolah</th>
                            <th>Kecamatan</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Orang Tua</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deletes as $row)
                        <tr>
                            <td>{{@$row->nik}}</td>
                            <td>{{@$row->nama}}</td>
                            <td>{{@$row->nomer}}</td>
                            <td>{{@$row->tempat_lahir}}</td>
                            <td>{{@$row->tgl_lahir}}</td>
                            <td>{{@$row->alamat}}</td>
                            <td>{{@$row->puskesmas->nama}}</td>
                            <td>{{@$row->sekolah->nama}}</td>
                            <td>{{@$row->kecamatan->nama}}</td>
                            <td>{{@$row->kelas}}</td>
                            <td>{{@$row->jenis_kelamin == '1' ? 'Laki - laki' : 'Perempuan'}}</td>
                            <td>{{@$row->nama_ortu}}</td>
                            <td>
                                <a data-bs-toggle="modal"
                                                data-bs-target="#editModal{{@$row->id}}" class="btn btn-secondary">Detail</a>
                                <a data-bs-toggle="modal"
                                                data-bs-target="#restoreModal{{@$row->id}}" class="btn btn-warning">Restore</a>
                            </td>
                        </tr>
                        <div class="modal fade" id="editModal{{@$row->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="{{route('pemeriksaan.update', @$row->id)}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nik" class="form-label">NIK</label>
                                                            <input type="text" class="form-control" id="nik" name="nik"
                                                                placeholder="Masukkan NIK" value="{{old('nik',@$row->nik)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control" id="nama" name="nama"
                                                                placeholder="Masukkan Nama Lengkap" value="{{old('nama',@$row->nama)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nomer" class="form-label">No HP</label>
                                                            <input type="text" class="form-control" id="nomer" name="nomer"
                                                                placeholder="Masukkan No HP" value="{{old('nomer',@$row->nomer)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                                                placeholder="Masukkan Tempat Lahir" value="{{old('tempat_lahir',@$row->tempat_lahir)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                                placeholder="Masukkan Tanggal Lahir" value="{{old('tgl_lahir',@$row->tgl_lahir)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                                placeholder="Masukkan Alamat Lengkap" value="{{old('alamat',@$row->alamat)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="puskesmas" class="form-label">Puskesmas Domisili</label>
                                                            <select class="js-example-basic-single" name="puskesmas_id" required>
                                                                @foreach($puskesmass as $puskesmas)
                                                                    <option value="{{ $puskesmas->id }}"
                                                                        {{ old('puskesmas_id', isset($row) ? $row->puskesmas_id : '') == $puskesmas->id ? 'selected' : '' }}>
                                                                        {{ $puskesmas->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                                            <select class="js-example-basic-single" name="sekolah_id" required>
                                                                @foreach($sekolahs as $sekolah)
                                                                    <option value="{{ $sekolah->id }}"
                                                                        {{ old('sekolah_id', isset($row) ? $row->sekolah_id : '') == $sekolah->id ? 'selected' : '' }}>
                                                                        {{ $sekolah->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama_kecamatan" class="form-label">Kecamatan</label>
                                                            <select class="js-example-basic-single" name="kecamatan_id" required>
                                                                @foreach($kecamatans as $kecamatan)
                                                                    <option value="{{ $kecamatan->id }}"
                                                                        {{ old('kecamatan_id', isset($row) ? $row->kecamatan_id : '') == $kecamatan->id ? 'selected' : '' }}>
                                                                        {{ $kecamatan->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="kelas" class="form-label">Kelas</label>
                                                            <select class="js-example-basic-single" name="kelas" id="kelas" value="{{old('kelas',@$row->kelas)}}">
                                                                <!-- <option value="0" selected>Pilih Jenis Kelamin</option> -->
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                                <option value="9">9</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                            <select class="js-example-basic-single" name="jenis_kelamin" id="jenis_kelamin" value="{{old('jenis_kelamin',@$row->jenis_kelamin)}}">
                                                                <!-- <option value="0" selected>Pilih Jenis Kelamin</option> -->
                                                                <option value="1">Laki - laki</option>
                                                                <option value="2">Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                                                            <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                                                placeholder="Masukkan Nama Orang Tua" value="{{old('nama_ortu',@$row->nama_ortu)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <!--end row-->
                                            </div>
                                        </div>
                                        <div class="modal-footer align-items-right">
                                            @if(@$row->deleted_at)
                                            <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                                            @else
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade zoomIn" id="restoreModal{{@$row->id}}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="{{ route('pemeriksaan.restore', @$row->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Are you Sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Yakin restore data?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn w-sm btn-warning "
                                                    id="delete-record">Yes,
                                                    Restore It!</button>
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
@endif

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary p-3">
                <h5 class="modal-title text-light" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form action="{{route('pemeriksaan.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}"
                                        placeholder="Masukkan NIK" required>
                                    @error('nik')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan Nama Lengkap" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomer" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="nomer" name="nomer" value="{{ old('nomer') }}"
                                        placeholder="Masukkan No HP" required>
                                    @error('nomer')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                        placeholder="Masukkan Tanggal Lahir" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Masukkan Alamat Lengkap" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="puskesmas" class="form-label">Puskesmas</label>
                                    <select class="js-example-basic-single" name="puskesmas_id" required>
                                        @foreach($puskesmass as $puskesmas)
                                        <option value="{{$puskesmas->id}}">{{$puskesmas->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                    <select class="js-example-basic-single" name="sekolah_id">
                                        <option value="" selected>Pilih Sekolah</option>
                                        @foreach($sekolahs as $sekolah)
                                        <option value="{{$sekolah->id}}">{{$sekolah->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="id_kecamatan" class="form-label">Kecamatan</label>
                                    <select class="js-example-basic-single" name="kecamatan_id" required>
                                        @foreach($kecamatans as $kecamatan)
                                        <option value="{{$kecamatan->id}}">{{$kecamatan->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select class="js-example-basic-single" name="kelas" id="kelas">
                                        <!-- <option value="0" selected>Pilih Jenis Kelamin</option> -->
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="js-example-basic-single" name="jenis_kelamin" id="jenis_kelamin">
                                        <!-- <option value="0" selected>Pilih Jenis Kelamin</option> -->
                                        <option value="1">Laki - laki</option>
                                        <option value="2">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                                    <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                        placeholder="Masukkan Nama Orang Tua" required>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <div class="modal-footer align-items-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- Plugin Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<!-- Library pendukung untuk export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myModal').on('shown.bs.modal', function () {
            console.log("Select2 initialized!"); // Debugging

            // Pastikan Select2 di dalam modal diinisialisasi ulang
            $(this).find('.js-example-basic-single').select2({
                dropdownParent: $(this),
                width: '100%',
                placeholder: "Pilih opsi"
            });
        });
        $('body').on('shown.bs.modal', '[id^="editModal"]', function () {
            console.log("Select2 initialized!");
            $(this).find('.js-example-basic-single').select2({
                dropdownParent: $(this),
                width: '100%',
                placeholder: "Pilih opsi"
            });
        });
    });

    $(function () {
    // Hancurkan instance DataTable jika sudah ada
    if ($.fn.DataTable.isDataTable('#example1')) {
        $('#example1').DataTable().destroy();
    }

    // Tambahkan input filter per kolom di bawah header
    $('#example1 tfoot th').each(function () {
        var title = $(this).text();
        if (title !== 'Aksi') {
            $(this).html('<input type="text" placeholder="Cari ' + title + '" />');
        } else {
            $(this).html('');
        }
    });

    // Inisialisasi ulang DataTable
    var table = $('#example1').DataTable({
        "scrollX": true,
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
        "search": false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: { columns: ':not(:last-child)' }
            },
            {
                extend: 'csv',
                exportOptions: { columns: ':not(:last-child)' }
            },
            {
                extend: 'excel',
                exportOptions: { columns: ':not(:last-child)' }
            },
            {
                extend: 'print',
                exportOptions: { columns: ':not(:last-child)' },
                customize: function (win) {
                    var css = '@page { size: landscape; }',
                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                        style = win.document.createElement('style');

                    style.type = 'text/css';
                    style.media = 'print';

                    if (style.styleSheet) {
                        style.styleSheet.cssText = css;
                    } else {
                        style.appendChild(win.document.createTextNode(css));
                    }

                    head.appendChild(style);

                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'colvis'
                }
            ]
        });

        // Filter per kolom
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on('keyup change clear', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });



    $(function () {
        $("#example2").DataTable({
            "scrollX": true,
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "search": true,
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'csv',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'excel',
                    exportOptions: { columns: ':not(:last-child)' }
                },
                {
                    extend: 'print',
                    exportOptions: { columns: ':not(:last-child)' },
                    customize: function (win) {
                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet) {
                            style.styleSheet.cssText = css;
                        } else {
                            style.appendChild(win.document.createTextNode(css));
                        }

                        head.appendChild(style);

                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'colvis'
                }
            ]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
