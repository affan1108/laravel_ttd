@extends('layouts.layouts-horizontal')
@section('title') Tablet Tambah Darah @endsection
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

                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="card-title mb-0 flex-grow-1">Tabel Data Tablet Tambah Darah</h5>

                    <div class="d-flex gap-2">
                        <!-- Filter Jenis Data -->
                        <select class="form-select" name="filter_type" id="filter_type">
                            <option value="all">Semua Data</option>
                            <option value="total">Jumlah Total Tablet</option>
                        </select>

                        <!-- Filter Bulan -->
                        <select class="form-select" name="filter_month" id="filter_month">
                            <option value="all">Semua Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>

                        <!-- Tombol Tambah -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" style="width: 400px;">
                            <i class="las la-plus"></i> Tambah Data
                        </button>
                    </div>
                </div>

                <table id="example1" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Nomer HP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat Lengkap</th>
                            <th>Nama Sekolah</th>
                            <th>Kecamatan</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Puskesmas</th>
                            <th>Pengawas TTD</th>
                            <th>No HP Pengawas TTD</th>
                            <th>Jumlah Tablet</th>
                            <th>Tgl Minum TTD</th>
                            <th>Tgl Periksa Ulang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">

            <div class="card-body">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h5 class="card-title mb-0 flex-grow-1">Data Yang terhapus</h5>
                </div>
                <table id="example2" class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Nomer HP</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat Lengkap</th>
                            <th>Nama Sekolah</th>
                            <th>Kecamatan</th>
                            <th>Kelas</th>
                            <th>Jenis Kelamin</th>
                            <th>Puskesmas</th>
                            <th>Pengawas TTD</th>
                            <th>No HP Pengawas TTD</th>
                            <th>Jumlah Tablet</th>
                            <th>Tgl Minum TTD</th>
                            <th>Tgl Periksa Ulang</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" id="close-modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nik_edit" name="nik" placeholder="Masukkan NIK" disabled>
                                    <input type="hidden" id="nik_edit2" name="nik" readonly>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_edit" name="nama"
                                        placeholder="Masukkan Nama Lengkap" disabled>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomer" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="nomer_edit" name="nomer"
                                        placeholder="Masukkan No HP" disabled>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir_edit" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" disabled>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir_edit" name="tgl_lahir"
                                        placeholder="Masukkan Tanggal Lahir" disabled>
                                </div>
                            </div>

                            <!-- <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat_edit" name="alamat"
                                        placeholder="Masukkan Alamat Lengkap" required disabled>
                                </div>
                            </div> -->

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_minum" class="form-label">Tanggal Minum</label>
                                    <input type="date" class="form-control" id="tgl_minum_edit" name="tgl_minum"
                                        placeholder="Masukkan Tanggal Minum">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="jumlah_tablet" class="form-label">Jumlah Tablet</label>
                                    <input type="number" class="form-control" id="jumlah_tablet_edit" name="jumlah_tablet"
                                        placeholder="Masukkan Jumlah Tablet">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="pengawas" class="form-label">Nama Pengawas</label>
                                    <input type="text" class="form-control" id="pengawas_edit" name="pengawas"
                                        placeholder="Masukkan Pengawas Minum Tablet Tambah Darah">
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomor_pengawas" class="form-label">No Telp Pengawas</label>
                                    <input type="text" class="form-control" id="nomor_pengawas_edit" name="nomor_pengawas"
                                        placeholder="Masukkan No Telp Pengawas" required>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_periksa_ulang" class="form-label">Tanggal diperiksa HB ulang</label>
                                    <input type="date" class="form-control" id="tgl_periksa_ulang_edit" name="tgl_periksa_ulang"
                                        placeholder="Masukkan Tanggal diperiksa HB ulang" required>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan_edit" placeholder="Masukkan Keterangan" rows="3"></textarea>
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
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close" id="btn-close"></button>
            </div>
            <form method="post" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548"
                            style="width:50px;height:50px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Konfirmasi</h4>
                            <p class="text-muted mx-4 mb-0" id="keterangan_del"></p>
                        </div>
                        <!-- Data Card -->
                        <div class="card border-danger mb-4 shadow-lg" style="border-left: 4px solid #dc3545; border-radius: 8px;">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                                        <i class="ri-user-fill text-danger" style="font-size: 1.5rem;"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 text-danger" id="pemerikaan_nama"></h5>
                                        <small class="text-muted" id="pemeriksaan_nomer"></small>
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
                                                    <p class="mb-0 fw-semibold fs-6" id="tgl_minum_del"></p>
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
                                                    <p class="mb-0 fw-semibold fs-6" id="jumlah_tablet_del">
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
                                                    <p class="mb-0 fw-semibold fs-6" id="pengawas_del"></p>
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
                                                    <p class="mb-0 fw-semibold fs-6" id="tgl_periksa_ulang_del">

                                                    </p>
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


<!-- end modal -->
<div class="modal fade" id="myModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
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
                                    <select class="form-control" id="nik" name="nik" required></select>
                                    <!-- <button type="button" class="btn btn-primary" id="btn_cari">Cari</button> -->
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_add" name="nama"
                                        placeholder="Masukkan Nama Lengkap" value="{{old('nama')}}" disabled required>
                                </div>
                            </div>

                            <!-- <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomer" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="nomer_add" name="nomer"
                                        placeholder="Masukkan No HP" value="{{old('nomer')}}" disabled>
                                </div>
                            </div>
                            
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir_add" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" value="{{old('tempat_lahir')}}" disabled required>
                                </div>
                            </div>
                            
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir_add" name="tgl_lahir"
                                        placeholder="Masukkan Tanggal Lahir" value="{{old('tgl_lahir')}}" disabled required>
                                </div>
                            </div>
                            
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat_add" name="alamat"
                                        placeholder="Masukkan Alamat Lengkap" value="{{old('alamat')}}" disabled required>
                                </div>
                            </div> -->

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
        $('#nik').select2({
            placeholder: 'Cari NIK...',
            allowClear: true,
            minimumInputLength: 3,
            dropdownParent: $('#myModal'),
            language: {
                inputTooShort: function() {
                    return 'Ketik minimal 3 angka NIK...';
                },
                noResults: function() {
                    return 'Data tidak ditemukan';
                },
                searching: function() {
                    return 'Mencari...';
                }
            },
            ajax: {
                url: '{{ route("biodata.cari-nik") }}',
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            idp: item.id,
                            text: item.nik + ' - ' + item.nama,
                            nama: item.nama,
                            id: item.nik
                        }))
                    };
                },
                cache: true
            }
        });

        $('#nik').on('select2:select', function(e) {
            const data = e.params.data;
            $('#nama_add').val(data.nama);
            $('#id_pemeriksaan_add').val(data.idp);
        });
        // Handle Edit Button
        $('#example1').on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var editUrl = "{{ route('tambah-darah.update', ':id') }}".replace(':id', id);

            // Ambil data via AJAX
            $.get('tambah-darah/' + id + '/edit', function(data) {
                // Isi form edit
                $('#editForm').attr('action', editUrl);
                $('#nik_edit').val(data.pemeriksaan.nik);
                $('#nik_edit2').val(data.pemeriksaan.nik);
                $('#nama_edit').val(data.pemeriksaan.nama);
                $('#nomer_edit').val(data.pemeriksaan.nomer);
                $('#tempat_lahir_edit').val(data.pemeriksaan.tempat_lahir);
                $('#tgl_lahir_edit').val(data.pemeriksaan.tgl_lahir);
                $('#tgl_minum_edit').val(data.tgl_minum);
                $('#jumlah_tablet_edit').val(data.jumlah_tablet);
                $('#pengawas_edit').val(data.pengawas);
                $('#nomor_pengawas_edit').val(data.nomor_pengawas);
                $('#tgl_periksa_ulang_edit').val(data.tgl_periksa_ulang);
                $('#keterangan_edit').val(data.keterangan);


                // Tampilkan modal
                $('#editModal').modal('show');
            }).fail(function() {
                alert('Gagal memuat data sekolah');
            });
        });
        // Handle Delete Button
        $('#example1').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            var deleteUrl = "{{ route('tambah-darah.destroy', ':id') }}".replace(':id', id);

            // Set form action dan tampilkan modal

            // Ambil data via AJAX
            $.get('tambah-darah/' + id + '/edit', function(data2) {
                // Isi form edit

                $('#pemerikaan_nama').html(data2.pemeriksaan.nama);
                $('#pemeriksaan_nomer').html(data2.pemeriksaan.nomer);
                $('#tgl_minum_del').html(data2.tgl_minum);
                $('#jumlah_tablet_del').html(data2.jumlah_tablet);
                $('#pengawas_del').html(data2.pengawas);
                $('#tgl_periksa_ulang_del').html(data2.tgl_periksa_ulang);
                $('#keterangan_edit').html(data2.keterangan);
                $('#keterangan_del').html('Apakah Anda yakin ingin menghapus data ini?');


                // Tampilkan modal
                $('#deleteForm').attr('action', deleteUrl);

                $('#deleteRecordModal').modal('show');

                // $('#editModal').modal('show');
            }).fail(function() {
                alert('Gagal memuat data sekolah');
            });
        });


    });

    $(function() {
        const table = $('#example1').DataTable({
            scrollX: true,
            responsive: false,
            lengthChange: false,
            autoWidth: false,
            search: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tambah-darah.data') }}",
                data: function(d) {
                    d.filter_type = $('#filter_type').val();
                    d.filter_month = $('#filter_month').val();
                }
            },
            columns: [{
                      data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nomer',
                    name: 'nomer'
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir'
                },
                {
                    data: 'tgl_lahir',
                    name: 'tgl_lahir'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                
                {
                    data: 'nama_sekolah',
                    name: 'sekolah'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan'
                },
                
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'nama_puskesmas',
                    name: 'puskesmas'
                },
                {
                    data: 'pengawas',
                    name: 'pengawas'
                },
                {
                    data: 'nomor_pengawas',
                    name: 'nomor_pengawas'
                },
                {
                    data: 'jumlah_tablet',
                    name: 'jumlah_tablet'
                },
                {
                    data: 'tgl_minum',
                    name: 'tgl_minum'
                },
                {
                    data: 'tgl_periksa_ulang',
                    name: 'tgl_periksa_ulang'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    `;
                    }
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    },
                    customize: function(win) {
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
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'colvis'
                }
            ],
            columnDefs: [{
                targets: [2,3,4,5,7,10], // indeks kolom 
                visible: false,
                searchable: false
            }]
        });
        // ✅ Fungsi untuk toggle kolom aksi saat filter berubah
        function toggleActionColumn() {
            const filterType = $('#filter_type').val();
            const showAction = (filterType !== 'total');

            const table = $('#example1').DataTable();

            // Toggle visibility kolom action
            const actionColIndex = table.column(':contains(Aksi)').index(); // kolom berdasarkan nama header
            if (actionColIndex !== undefined) {
                table.column(actionColIndex).visible(showAction);
            }

            table.ajax.reload();
        }

        // Jalankan saat pertama kali
        toggleActionColumn();

        // Reload data saat filter berubah
        $('#filter_type, #filter_month').on('change', function() {
            table.ajax.reload();
            toggleActionColumn();
        });
        const table2 = $('#example2').DataTable({
            scrollX: true,
            responsive: false,
            lengthChange: false,
            autoWidth: false,
            search: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('tambah-darah.data') }}",
                data: function(d) {
                    d.filter_type = "unactive";
                }
            },
            columns: [{
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'nomer',
                    name: 'nomer'
                },
                {
                    data: 'tempat_lahir',
                    name: 'tempat_lahir'
                },
                {
                    data: 'tgl_lahir',
                    name: 'tgl_lahir'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                
                {
                    data: 'nama_sekolah',
                    name: 'sekolah'
                },
                {
                    data: 'kecamatan',
                    name: 'kecamatan'
                },
                
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'nama_puskesmas',
                    name: 'puskesmas'
                },
                {
                    data: 'pengawas',
                    name: 'pengawas'
                },
                {
                    data: 'nomor_pengawas',
                    name: 'nomor_pengawas'
                },
                {
                    data: 'jumlah_tablet',
                    name: 'jumlah_tablet'
                },
                {
                    data: 'tgl_minum',
                    name: 'tgl_minum'
                },
                {
                    data: 'tgl_periksa_ulang',
                    name: 'tgl_periksa_ulang'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                        <button class="btn btn-sm btn-warning btn-restore" data-id="${row.id}">
                            <i class="fas fa-restore"></i> Restore
                        </button>
                    `;
                    }
                }
            ],
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)'
                    },
                    customize: function(win) {
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
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                },
                {
                    extend: 'colvis'
                }
            ],
            columnDefs: [{
                targets: [2,3,4,5,7,10], // indeks kolom 
                visible: false,
                searchable: false
            }]
        });
        $('#example2').on('click', '.btn-restore', function() {
            var id = $(this).data('id');
            var restoreUrl = 'tambah-darah/' + id + '/restore'; // sesuai dengan definisi route
            console.log('Restore uri: ', restoreUrl);


            $.ajax({
                url: restoreUrl,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil direstore.',
                        confirmButtonText: 'OK'
                    });
                    table.ajax.reload();
                    table2.ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat merestore data.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

    });
</script>


@endsection