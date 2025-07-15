@extends('layouts.layouts-horizontal')
@section('title') Master Hasil Pemeriksaan @endsection
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
@slot('title') Master Hasil Pemeriksaan @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">Data Master Hasil Pemeriksaan</h5>
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
                            <!-- <th>Puskesmas Pemeriksaan</th> -->
                            <th>Tanggal Pemeriksaan</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                        <tr>
                            <td>{{@$row->pemeriksaan->nik}}</td>
                            <td>{{@$row->pemeriksaan->nama}}</td>
                            <!-- <td>{{@$row->puskesmas->nama}}</td> -->
                            <td>{{@$row->tgl_pemeriksaan}}</td>
                            <td>{{@$row->hasil}}</td>
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
                                    <form action="{{route('hasil-pemeriksaan.update', @$row->id)}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="live-preview">
                                                <div class="row gy-3">
                                                    <div class="col-xxl-4 col-md-6">
                                                        <label for="id_biodata" class="form-label">NIK</label>
                                                        <select id="id_biodata" name="id_biodata" class="form-control js-nik-search" disabled>
                                                            @if(isset($row->pemeriksaan))
                                                                <option value="{{ $row->pemeriksaan->id }}" selected>
                                                                    {{ $row->pemeriksaan->nik }} - {{ $row->pemeriksaan->nama ?? '' }}
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div>
                                                            <label for="tgl_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
                                                            <input type="date" class="form-control" id="tgl_pemeriksaan" name="tgl_pemeriksaan"
                                                                placeholder="Masukkan Tanggal Pemeriksaan" value="{{old('tgl_pemeriksaan',@$row->tgl_pemeriksaan)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-xxl-4 col-md-6">
                                                        <div>
                                                            <label for="hasil" class="form-label">HB Hasil Pemeriksaan</label>
                                                            <input type="text" class="form-control" id="hasil" name="hasil"
                                                                placeholder="contoh: 9.6" value="{{old('hasil',@$row->hasil)}}" required>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                                <div class="row gy-2 mt-2">
                                                    <!-- <div class="col-md-6">
                                                        <div>Apakah pemeriksaan hb dilakukan di puskesmas sesuai domisili?</div>
                                                        <div class="mt-2 d-flex justify-content-evenly">
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio" name="pemeriksaan_domisili" id="radio_ya" value="1" checked>
                                                                <label class="form-check-label" for="radio_ya">Iya</label>
                                                            </div>
                                                            <div class="form-check form-radio-primary mb-3">
                                                                <input class="form-check-input" type="radio" name="pemeriksaan_domisili" id="radio_tidak" value="0">
                                                                <label class="form-check-label" for="radio_tidak">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div> -->

                                                    <!-- <div class="col-md-6" id="puskesmas_dom_container">
                                                        <label for="puskesmas" class="form-label">Puskesmas Pemeriksaan</label>
                                                        <select class="form-select js-example-basic-single" name="id_puskesmas">
                                                            @foreach($puskesmass as $puskesmas)
                                                                <option value="{{ $puskesmas->id }}"
                                                                    {{ old('id_puskesmas', $row->id_puskesmas) == $puskesmas->id ? 'selected' : '' }}>
                                                                    {{ $puskesmas->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div> -->
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
                                    <form action="{{ route('hasil-pemeriksaan.destroy', @$row->id) }}" method="post">
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
                <h5 class="modal-title text-light" id="exampleModalLabel">Add Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('hasil-pemeriksaan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="live-preview">
                            <div class="row gy-3">
                                <div class="col-xxl-4 col-md-6">
                                    <label for="id_biodata" class="form-label">NIK</label>
                                    <select id="id_biodata" name="id_biodata" class="form-control js-nik-search" required></select>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="tgl_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
                                        <input type="date" class="form-control" id="tgl_pemeriksaan" name="tgl_pemeriksaan"
                                            placeholder="Masukkan Tanggal Pemeriksaan" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div>
                                        <label for="hasil" class="form-label">HB Hasil Pemeriksaan</label>
                                        <input type="text" class="form-control" id="hasil" name="hasil"
                                            placeholder="contoh: 9.6" required>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <div class="row gy-2 mt-2">
                                <!-- <div class="col-md-6">
                                    <div>Apakah pemeriksaan hb dilakukan di puskesmas sesuai domisili?</div>
                                    <div class="mt-2 d-flex justify-content-evenly">
                                        <div class="form-check form-radio-primary mb-3">
                                            <input class="form-check-input" type="radio" name="pemeriksaan_domisili" id="radio_ya" value="1" checked>
                                            <label class="form-check-label" for="radio_ya">Iya</label>
                                        </div>
                                        <div class="form-check form-radio-primary mb-3">
                                            <input class="form-check-input" type="radio" name="pemeriksaan_domisili" id="radio_tidak" value="0">
                                            <label class="form-check-label" for="radio_tidak">Tidak</label>
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="col-md-6" id="puskesmas_dom_container">
                                    <label for="puskesmas" class="form-label">Puskesmas Pemeriksaan</label>
                                    <select class="form-select js-example-basic-single" name="id_puskesmas">
                                        @foreach($puskesmass as $puskesmas)
                                        <option value="{{$puskesmas->id}}">{{$puskesmas->nama}}</option>
                                        @endforeach
                                    </select>
                                </div> -->
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
            $(this).find('.js-nik-search').select2({
                dropdownParent: $(this),
                width: '100%',
                placeholder: "Pilih opsi"
            });
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

    $(function() {
        $('#example1').DataTable({
            "scrollX": true,
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "search": true,
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
    });
</script>
<script>
    $(document).ready(function() {
        $('#myModal').on('shown.bs.modal', function () {
            $(this).find('.js-nik-search').select2({
                dropdownParent: $(this),
                placeholder: 'Cari NIK...',
                allowClear: true,
                minimumInputLength: 3,
                language: {
                    inputTooShort: function () {
                        return 'Ketik minimal 3 angka NIK...';
                    },
                    noResults: function () {
                        return 'Data tidak ditemukan';
                    },
                    searching: function () {
                        return 'Mencari...';
                    }
                },
                ajax: {
                    url: '{{ route("biodata.cari-nik") }}',
                    dataType: 'json',
                    delay: 300,
                    data: function (params) {
                        return {
                            q: params.term // input dari user
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(item => ({
                                id: item.id,
                                text: item.nik + ' - ' + item.nama
                            }))
                        };
                    },
                    cache: true
                },
                minimumInputLength: 3
            });
        });

        // function togglePuskesmasSelect() {
        //     const selected = $('input[name="pemeriksaan_domisili"]:checked').val();
        //     if (selected === '0') {
        //         $('#puskesmas_dom_container').show();
        //     } else {
        //         $('#puskesmas_dom_container').hide();
        //     }
        // }

        // // Jalankan saat halaman dimuat
        // togglePuskesmasSelect();

        // // Jalankan saat user ganti pilihan
        // $('input[name="pemeriksaan_domisili"]').on('change', function () {
        //     togglePuskesmasSelect();
        // });
    });
</script>
@endsection
