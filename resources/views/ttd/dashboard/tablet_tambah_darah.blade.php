@extends('layouts.layouts-detached')
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
        <div class="card" style="background-color: #F5CBCB;">

            <div class="card-body">
                <img src="{{ URL::asset('build/images/tambah_darah2.png') }}" alt="" class="img-fluid move-animation" style="max-height: 200px;">
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
                <form action="{{route('tambah-darah.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_pemeriksaan" id="id_pemeriksaan" value="{{ $data->id ?? ''}}">
                    <div class="live-preview">
                        <div class="row gx-3  gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <label for="nik" class="form-label">NIK</label>
                                    <div class="input-group">
                                        <select class="form-control" id="nik" name="nik" required></select>
                                        <!-- <button type="button" class="btn btn-primary" id="btn_cari">Cari</button> -->
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan Nama Lengkap" value="{{ $data->nama ?? ''}}" required readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="tgl_minum" class="form-label">Tanggal Minum</label>
                                        <input type="date" class="form-control" id="tgl_minum" name="tgl_minum" required
                                            placeholder="Masukkan Tanggal Minum">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="jml_tablet" class="form-label">Jumlah Tablet</label>
                                        <input type="number" class="form-control" id="jml_tablet" name="jml_tablet" required
                                            placeholder="Masukkan Jumlah Tablet">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="pengawas" class="form-label">Nama Pengawas</label>
                                        <input type="text" class="form-control" id="pengawas" name="pengawas" required
                                            placeholder="Masukkan Pengawas Minum Tablet Tambah Darah">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="no_pengawas" class="form-label">No Telp Pengawas</label>
                                        <input type="text" class="form-control" id="no_pengawas" name="no_pengawas" required
                                            placeholder="Masukkan No Telp Pengawas" required>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="tgl_periksa_ulang" class="form-label">Tanggal diperiksa HB ulang</label>
                                        <input type="date" class="form-control" id="tgl_periksa_ulang" name="tgl_periksa_ulang"
                                            placeholder="Masukkan Tanggal diperiksa HB ulang" required>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                    <div>
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-auto mb-3" style="border-radius:10px;">
                                <div class=" bg-white p-3" style="border-radius:10px;">
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>

                    <div class="card-footer align-items-right" style="border-radius:10px;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
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
{!! NoCaptcha::renderJs() !!}
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
        $('#nik').select2({
            placeholder: 'Cari NIK...',
            allowClear: true,
            minimumInputLength: 3,
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
            $('#nama').val(data.nama);
            $('#id_pemeriksaan').val(data.idp);
        });
    });
</script>



@endsection