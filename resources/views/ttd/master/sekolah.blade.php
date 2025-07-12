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
                            <!-- <th>Jenjang</th> -->
                            <th>Kecamatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit (Satu untuk semua) -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sekolah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row gy-3">
                        <div class="col-xxl-4 col-md-6">
                            <label for="editNPSN" class="form-label">NPSN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="npsn" id="editNPSN">
                            <div class="invalid-feedback feedback-npsn"></div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <label for="editNama" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama" id="editNama" required>
                            <div class="invalid-feedback feedback-nama"></div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <label for="editAlamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat" id="editAlamat" required>
                            <div class="invalid-feedback feedback-alamat"></div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <label for="editKelurahan" class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="kelurahan" id="editKelurahan" required>
                            <div class="invalid-feedback feedback-kelurahan"></div>
                        </div>
                        <!-- <div class="col-xxl-4 col-md-6">
                            <label for="editStatus" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" id="editStatus">
                                <option value="NEGERI">Negeri</option>
                                <option value="SWASTA">Swasta</option>
                            </select>
                        </div> -->
                        <!-- <div class="col-xxl-4 col-md-6">
                            <label for="editJenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                            <select class="form-select" name="jenjang" id="editJenjang">
                                <option value="Sekolah Dasar">Sekolah Dasar</option>
                                <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                            </select>
                        </div> -->
                        <div class="col-xxl-4 col-md-6">
                            <label for="editKecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select class="form-select" name="kecamatan_id" id="editKecamatan">
                                @foreach($kecamatans as $kecamatan)
                                <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data sekolah ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                    <div class="row gy-3">
                        <div class="col-xxl-4 col-md-6">
                            <label for="NPSN" class="form-label">NPSN <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('NPSN') is-invalid @enderror" name="npsn"
                                value="{{ old('npsn') }}" id="NPSN" placeholder="Masukkan NPSN">
                            @error('NPSN')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="invalid-feedback">
                                Please enter NPSN
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
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
                        <div class="col-xxl-4 col-md-6">
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
                        <div class="col-xxl-4 col-md-6">
                            <label for="kelurahan" class="form-label">Kelurahan/Desa <span class="text-danger">*</span></label>
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
                        <!-- <div class="col-xxl-4 col-md-6">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select class="js-example-basic-single" name="status">
                                    <option value="NEGERI">Negeri</option>
                                    <option value="SWASTA">Swasta</option>
                                </select>
                            </div>
                        </div> -->
                        <!-- <div class="col-xxl-4 col-md-6">
                            <label for="jenjang" class="form-label">Jenjang <span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <select class="js-example-basic-single" name="jenjang">
                                    <option value="Sekolah Dasar">Sekolah Dasar</option>
                                    <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-xxl-4 col-md-6">
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


<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#sekolah-table').DataTable({
            scrollX: true,
            responsive: false,
            processing: true,
            serverSide: true,
            ajax: "{{ route('sekolah.data') }}",
            columns: [
                // { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'npsn', name: 'npsn' },
                { data: 'nama', name: 'nama' },
                { data: 'alamat', name: 'alamat' },
                { data: 'kelurahan', name: 'kelurahan' },
                // { data: 'jenjang', name: 'jenjang' },
                { data: 'kecamatan.nama', name: 'kecamatan.nama' },
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
            // dom: 'Bfrtip', 
            // buttons: [
            //     'copy', 'csv', 'excel', 'print', 'colvis'
            // ]
        });

        // Handle Edit Button
        $('#sekolah-table').on('click', '.btn-edit', function() {
            var id = $(this).data('id');
            var editUrl = "{{ route('sekolah.update', ':id') }}".replace(':id', id);
            
            // Ambil data via AJAX
            $.get('/laravel_ttd/sekolah/' + id + '/edit', function(data) {
                // Isi form edit
                $('#editForm').attr('action', editUrl);
                $('#editNPSN').val(data.npsn);
                $('#editNama').val(data.nama);
                $('#editAlamat').val(data.alamat);
                $('#editKelurahan').val(data.kelurahan);
                $('#editStatus').val(data.status);
                $('#editJenjang').val(data.jenjang);
                $('#editKecamatan').val(data.kecamatan_id);
                
                // Tampilkan modal
                $('#editModal').modal('show');
            }).fail(function() {
                alert('Gagal memuat data sekolah');
            });
        });

        // Submit Form Edit
        $('#editForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(response) {
                    $('#editModal').modal('hide');
                    table.ajax.reload();
                    alert('Data berhasil diperbarui');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Validasi gagal
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#edit' + key.charAt(0).toUpperCase() + key.slice(1)).addClass('is-invalid');
                            $('.feedback-' + key).text(value[0]);
                        });
                    } else {
                        alert('Terjadi kesalahan saat menyimpan data');
                    }
                }
            });
        });

        // Handle Delete Button
        $('#sekolah-table').on('click', '.btn-delete', function() {
            var id = $(this).data('id');
            var deleteUrl = "{{ route('sekolah.destroy', ':id') }}".replace(':id', id);
            
            // Set form action dan tampilkan modal
            $('#deleteForm').attr('action', deleteUrl);
            $('#deleteModal').modal('show');
        });

        // Submit Form Delete - Versi diperbaiki
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            
            $.ajax({
                type: "POST", // Tetap POST karena Laravel hanya menerima POST untuk form
                url: url,
                data: {
                    _method: 'DELETE', // Laravel akan mengenali ini sebagai DELETE
                    _token: "{{ csrf_token() }}" // CSRF token
                },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    $('#sekolah-table').DataTable().ajax.reload(null, false);
                    alert('Data berhasil dihapus');
                },
                error: function(xhr) {
                    $('#deleteModal').modal('hide');
                    alert('Terjadi kesalahan saat menghapus data: ' + xhr.responseJSON.message);
                    console.error('Error:', xhr.responseText);
                }
            });
        });
    });
</script>
@endsection