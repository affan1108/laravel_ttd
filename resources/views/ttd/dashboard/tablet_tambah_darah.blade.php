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
@slot('li_1') Entry Data @endslot
@slot('title')Tablet Tambah Darah @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Input Example</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">
                        <label for="form-grid-showcode" class="form-label text-muted">Show
                            Code</label>
                        <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                    </div>
                </div>
            </div> -->
            <form action="{{route('tambah-darah.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_pemeriksaan" value="{{ $data->id ?? ''}}">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <label for="nik" class="form-label">NIK</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="{{ $data->nik ?? ''}}"
                                        required>
                                    <button type="button" class="btn btn-primary" id="btn_cari">Cari</button>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan Nama Lengkap" value="{{ $data->nama ?? ''}}" required readonly>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nomer" class="form-label">No HP</label>
                                    <input type="text" class="form-control" id="nomer" name="nomer"
                                        placeholder="Masukkan No HP" value="{{ $data->nomer ?? ''}}" required readonly>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                        placeholder="Masukkan Tempat Lahir" value="{{ $data->tempat_lahir ?? ''}}" required readonly>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                        placeholder="Masukkan Tanggal Lahir" value="{{ $data->tgl_lahir ?? ''}}" required readonly>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Masukkan Alamat Lengkap" value="{{ $data->alamat ?? ''}}" required readonly>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_minum" class="form-label">Tanggal Minum</label>
                                    <input type="date" class="form-control" id="tgl_minum" name="tgl_minum"
                                        placeholder="Masukkan Tanggal Minum">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="jml_tablet" class="form-label">Jumlah Tablet</label>
                                    <input type="number" class="form-control" id="jml_tablet" name="jml_tablet"
                                        placeholder="Masukkan Jumlah Tablet">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="pengawas" class="form-label">Nama Pengawas</label>
                                    <input type="text" class="form-control" id="pengawas" name="pengawas"
                                        placeholder="Masukkan Pengawas Minum Tablet Tambah Darah">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="no_pengawas" class="form-label">No Telp Pengawas</label>
                                    <input type="text" class="form-control" id="no_pengawas" name="no_pengawas"
                                        placeholder="Masukkan No Telp Pengawas" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="tgl_periksa_ulang" class="form-label">Tanggal diperiksa HB ulang</label>
                                    <input type="date" class="form-control" id="tgl_periksa_ulang" name="tgl_periksa_ulang"
                                        placeholder="Masukkan Tanggal diperiksa HB ulang" required>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" rows="3"></textarea>
                                    <!-- <input type="text" class="form-control" id="keterangan" name="keterangan"
                                        placeholder="Masukkan Keterangan" required> -->
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <div class="card-footer align-items-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Result Modals -->
<div id="resultModal" class="modal fade" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Hasil Pencarian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <h5 class="fs-15">
                    Hasil ditemukan
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
    document.getElementById('btn_cari').addEventListener('click', function() {
        const nik = document.getElementById('nik').value;

        fetch(`/tambah-darah/cari-nik/${nik}`)
            .then(response => response.json())
            .then(data => {
                const modalBody = document.querySelector('#resultModal .modal-body');
                modalBody.innerHTML = ''; // reset

                if (data.status === 'success') {
                    const items = data.data;
                    modalBody.innerHTML = '<h5 class="fs-15">Hasil ditemukan</h5>';
                    items.forEach(darah => {
                        modalBody.innerHTML += `
                            <p class="text-muted">${darah.nik}</p>
                            <p class="text-muted">${darah.nama}</p>
                            <a href="/tambah-darah/${darah.id}" class="btn btn-info btn-sm mb-2">Detail</a>
                        `;
                    });
                } else {
                    modalBody.innerHTML = '<h5 class="text-danger">Data tidak ditemukan</h5>';
                }

                let modal = new bootstrap.Modal(document.getElementById('resultModal'));
                modal.show();
            })
            .catch(error => {
                alert('Terjadi kesalahan saat pencarian.');
                console.error(error);
            });
    });
</script>


@endsection