@extends('layouts.layouts-horizontal')
@section('title') @lang('translation.datatables') @endsection
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
@slot('li_1') Tabel @endslot
@slot('title') Tablet Tambah Darah @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show material-shadow" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show material-shadow" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Add Rows</h5>
                    <div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add New
                            Data</button>
                    </div>
                </div>
                <table id="example1" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <!-- <th>Nomer HP</th> -->
                            <th>Jenis Kelamin</th>
                            <th>Puskesmas</th>
                            <th>Tgl Minum TTD</th>
                            <th>Pengawas TTD</th>
                            <th>No HP Pengawas TTD</th>
                            <th>Tgl Minum TTD</th>
                            <th>Tgl Periksa Ulang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{@$row->nik}}</td>
                            <td>{{@$row->pemeriksaan->nama}}</td>
                            <!-- <td>{{@$row->pemeriksaan->nomer}}</td> -->
                            <td>{{@$row->pemeriksaan->jenis_kelamin == '1' ? 'Laki - laki' : 'Perempuan'}}</td>
                            <td>{{@$row->pemeriksaan->puskesmas->nama}}</td>
                            <td>{{@$row->tgl_minum}}</td>
                            <td>{{@$row->pengawas}}</td>
                            <td>{{@$row->nomor_pengawas}}</td>
                            <td>{{@$row->tgl_minum}}</td>
                            <td>{{@$row->tgl_periksa_ulang}}</td>
                            <td>{{@$row->keterangan}}</td>
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
                                    <div class="modal-header bg-light p-3">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="close-modal"></button>
                                    </div>
                                    <form action="{{route('tambah-darah.update', @$row->id)}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="live-preview">
                                                <div class="row gy-4">
                                                    <div class="col-xxl-3 col-md-6">
                                                        <label for="nik" class="form-label">NIK</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="{{ $row->nik ?? ''}}" disabled>
                                                            <input type="hidden" id="nik" name="nik" value="{{ $row->nik ?? ''}}" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nama" class="form-label">Nama Lengkap</label>
                                                            <input type="text" class="form-control" id="nama" name="nama"
                                                                placeholder="Masukkan Nama Lengkap" value="{{ @$row->pemeriksaan->nama }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nomer" class="form-label">No HP</label>
                                                            <input type="text" class="form-control" id="nomer" name="nomer"
                                                                placeholder="Masukkan No HP" value="{{ @$row->pemeriksaan->nomer }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                                                placeholder="Masukkan Tempat Lahir" value="{{ @$row->pemeriksaan->tempat_lahir }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                                placeholder="Masukkan Tanggal Lahir" value="{{ @$row->pemeriksaan->tgl_lahir }}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="alamat" class="form-label">Alamat Lengkap</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                                placeholder="Masukkan Alamat Lengkap" value="{{ @$row->pemeriksaan->alamat }}" required disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tgl_minum" class="form-label">Tanggal Minum</label>
                                                            <input type="date" class="form-control" id="tgl_minum" name="tgl_minum" value="{{ @$row->tgl_minum }}"
                                                                placeholder="Masukkan Tanggal Minum">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="jumlah_tablet" class="form-label">Jumlah Tablet</label>
                                                            <input type="number" class="form-control" id="jumlah_tablet" name="jumlah_tablet" value="{{ @$row->jumlah_tablet }}"
                                                                placeholder="Masukkan Jumlah Tablet">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="pengawas" class="form-label">Nama Pengawas</label>
                                                            <input type="text" class="form-control" id="pengawas" name="pengawas" value="{{ @$row->pengawas }}"
                                                                placeholder="Masukkan Pengawas Minum Tablet Tambah Darah">
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="nomor_pengawas" class="form-label">No Telp Pengawas</label>
                                                            <input type="text" class="form-control" id="nomor_pengawas" name="nomor_pengawas" value="{{ @$row->nomor_pengawas }}"
                                                                placeholder="Masukkan No Telp Pengawas" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="tgl_periksa_ulang" class="form-label">Tanggal diperiksa HB ulang</label>
                                                            <input type="date" class="form-control" id="tgl_periksa_ulang" name="tgl_periksa_ulang" value="{{ @$row->tgl_periksa_ulang }}"
                                                                placeholder="Masukkan Tanggal diperiksa HB ulang" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-xxl-3 col-md-6">
                                                        <div>
                                                            <label for="keterangan" class="form-label">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" rows="3">{{ @$row->keterangan }}</textarea>
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
                        <!-- Modal -->
                        <div class="modal fade zoomIn" id="deleteRecordModal{{@$row->id}}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close" id="btn-close"></button>
                                    </div>
                                    <form action="{{ route('tambah-darah.destroy', @$row->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:50px;height:50px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Konfirmasi</h4>
                                                    <p class="text-muted mx-4 mb-0">Apakah anda yakin menghapus data ini.?</p>
                                                </div>
                                                <!-- Data Card -->
                                                <div class="card border-danger mb-4 shadow-lg" style="border-left: 4px solid #dc3545; border-radius: 8px;">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                                                                <i class="ri-user-fill text-danger" style="font-size: 1.5rem;"></i>
                                                            </div>
                                                            <div>
                                                                <h5 class="mb-0 text-danger">{{ @$row->pemeriksaan->nama }}</h5>
                                                                <small class="text-muted">{{ @$row->pemeriksaan->nomer }}</small>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3">


                                                            <div class="col-md-6">
                                                                <div class="info-item hover-effect">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="icon-wrapper bg-soft-danger me-3">
                                                                            <i class="ri-calendar-fill text-danger"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-1 text-uppercase text-muted fs-12">Tanggal Minum</h6>
                                                                            <p class="mb-0 fw-semibold fs-6">{{ date('d M Y', strtotime(@$row->tgl_minum)) }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="info-item hover-effect">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="icon-wrapper bg-soft-danger me-3">
                                                                            <i class="ri-eye-2-line text-danger"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-1 text-uppercase text-muted fs-12">Jumlah Tablet</h6>
                                                                            <p class="mb-0 fw-semibold fs-6">
                                                                                {{ @$row->jumlah_tablet }}
                                                                                <small class="text-muted ms-1">tablet</small>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="info-item hover-effect">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="icon-wrapper bg-soft-danger me-3">
                                                                            <i class="ri-user-follow-fill text-danger"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-1 text-uppercase text-muted fs-12">Pengawas Minum</h6>
                                                                            <p class="mb-0 fw-semibold fs-6">{{ @$row->pengawas }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="info-item hover-effect">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="icon-wrapper bg-soft-danger me-3">
                                                                            <i class="ri-calendar-check-fill text-danger"></i>
                                                                        </div>
                                                                        <div>
                                                                            <h6 class="mb-1 text-uppercase text-muted fs-12">Periksa Ulang</h6>
                                                                            <p class="mb-0 fw-semibold fs-6">{{ date('d M Y', strtotime(@$row->tgl_periksa_ulang)) }}

                                                                            </p> <small class="text-muted ms-2">
                                                                                ({{ Carbon\Carbon::parse(@$row->tgl_periksa_ulang)->diffForHumans() }})
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>

                                                <style>
                                                    .info-item {
                                                        padding: 12px;
                                                        border-radius: 8px;
                                                        transition: all 0.3s ease;
                                                    }

                                                    .info-item.hover-effect:hover {
                                                        background-color: rgba(220, 53, 69, 0.05);
                                                        transform: translateY(-2px);
                                                    }

                                                    .icon-wrapper {
                                                        width: 40px;
                                                        height: 40px;
                                                        display: flex;
                                                        align-items: center;
                                                        justify-content: center;
                                                        border-radius: 8px;
                                                    }

                                                    .bg-soft-danger {
                                                        background-color: rgba(220, 53, 69, 0.1) !important;
                                                    }

                                                    .shadow-lg {
                                                        box-shadow: 0 10px 25px -5px rgba(220, 53, 69, 0.1),
                                                            0 10px 10px -5px rgba(220, 53, 69, 0.04) !important;
                                                    }
                                                </style>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn w-sm btn-danger "
                                                    id="delete-record">Ya, Hapus!</button>
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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Add Rows</h5>
            </div>
            <div class="card-body">

                <table id="example2" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nomer HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Puskesmas</th>
                            <th>Nama Orang Tua</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" id="close-modal"></button>
            </div>
            <form action="{{route('tambah-darah.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_pemeriksaan_add" name="id_pemeriksaan">
                <div class="modal-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nik_add" name="nik" value="{{old('nik')}}" placeholder="Masukkan NIK" required>
                                    <button type="button" class="btn btn-primary" id="btn_cari">Cari</button>
                                </div>
                                <span id="nik_feedback"></span>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_add" name="nama"
                                        placeholder="Masukkan Nama Lengkap" value="{{old('nama')}}" disabled required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomer" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="nomer_add" name="nomer"
                                        placeholder="Masukkan No HP" value="{{old('nomer')}}" disabled>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir_add" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" value="{{old('tempat_lahir')}}" disabled required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir_add" name="tgl_lahir"
                                        placeholder="Masukkan Tanggal Lahir" value="{{old('tgl_lahir')}}" disabled required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat_add" name="alamat"
                                        placeholder="Masukkan Alamat Lengkap" value="{{old('alamat')}}" disabled required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_minum" class="form-label">Tanggal Minum</label>
                                    <input type="date" class="form-control" id="tgl_minum_add" name="tgl_minum" value="{{old('tgl_minum')}}" required
                                        placeholder="Masukkan Tanggal Minum">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="jumlah_tablet" class="form-label">Jumlah Tablet</label>
                                    <input type="number" class="form-control" id="jumlah_tablet_add" name="jml_tablet" value="{{old('jml_tablet')}}" required
                                        placeholder="Masukkan Jumlah Tablet">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="pengawas" class="form-label">Nama Pengawas</label>
                                    <input type="text" class="form-control" id="pengawas_add" name="pengawas" value="{{old('pengawas')}}" required
                                        placeholder="Masukkan Pengawas Minum Tablet Tambah Darah">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomor_pengawas" class="form-label">No Telp Pengawas</label>
                                    <input type="text" class="form-control" id="nomor_pengawas_add" name="no_pengawas" value="{{old('no_pengawas')}}" required
                                        placeholder="Masukkan No Telp Pengawas" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_periksa_ulang" class="form-label">Tanggal diperiksa HB ulang</label>
                                    <input type="date" class="form-control" id="tgl_periksa_ulang_add" name="tgl_periksa_ulang" value="{{old('tgl_periksa_ulang')}}" required
                                        placeholder="Masukkan Tanggal diperiksa HB ulang" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan_add" placeholder="Masukkan Keterangan" rows="3">{{old('keterangan')}}</textarea>
                                    <!-- <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        placeholder="Masukkan Keterangan" required> -->
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
        $('body').on('shown.bs.modal', '[id^="editModal"]', function() {
            console.log("Select2 initialized!");
            $(this).find('.js-example-basic-single').select2({
                dropdownParent: $(this),
                width: '100%',
                placeholder: "Pilih opsi"
            });
        });
    });

    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "search": true,
            "buttons": ["copy", "csv", "excel", "pdf"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(function() {
        $("#example2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "search": true,
            "buttons": ["copy", "csv", "excel", "pdf"]
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    document.getElementById("btn_cari").addEventListener("click", function() {
        const nik = document.getElementById("nik_add").value;
        const feedback = document.getElementById("nik_feedback");

        // Reset feedback
        feedback.textContent = '';
        feedback.className = 'form-text';

        if (!nik) {
            feedback.textContent = 'NIK harus diisi.';
            feedback.classList.add('text-danger');
            return;
        }

        fetch(`/tambah-darah/cari-nik/${nik}`)
            .then(response => response.json())
            .then(result => {
                if (result.status === "success" && result.data.length > 0) {
                    const data = result.data[0];

                    document.getElementById("id_pemeriksaan_add").value = data.id || "";
                    document.getElementById("nama_add").value = data.nama || "";
                    document.getElementById("nomer_add").value = data.nomer || "";
                    document.getElementById("tempat_lahir_add").value = data.tempat_lahir || "";
                    document.getElementById("tgl_lahir_add").value = data.tgl_lahir || "";
                    document.getElementById("alamat_add").value = data.alamat || "";

                    // Tampilkan pesan sukses
                    feedback.textContent = "Data ditemukan.";
                    feedback.classList.add("text-success");

                } else {

                    document.getElementById("id_pemeriksaan_add").value = "";
                    document.getElementById("nama_add").value = "";
                    document.getElementById("nomer_add").value = "";
                    document.getElementById("tempat_lahir_add").value = "";
                    document.getElementById("tgl_lahir_add").value = "";
                    document.getElementById("alamat_add").value = "";


                    // Data tidak ditemukan
                    feedback.textContent = "Data tidak ditemukan.";
                    feedback.classList.add("text-danger");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                feedback.textContent = "Terjadi kesalahan saat mengambil data.";
                feedback.classList.add("text-danger");
            });
    });
</script>

@endsection