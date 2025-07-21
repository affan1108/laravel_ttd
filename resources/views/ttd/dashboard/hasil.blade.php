@extends('layouts.layouts-detached')
@section('title') Dashboard @endsection
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
@slot('title')Hasil Pemeriksaan HB @endslot
@endcomponent

<div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color: #F5CBCB;">
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
                <form action="{{route('hasil-pemeriksaan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <img src="{{ URL::asset('build/images/tambah_darah2.png') }}" alt=""
                            class="img-fluid move-animation" style="max-height: 200px;">

                        <div class="live-preview">
                            <div class="row gx-3 gy-4">
                                <div class="col-xxl-4 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">

                                        <label for="id_biodata" class="form-label">NIK</label>
                                        <select id="id_biodata" name="id_biodata" class="form-control js-nik-search"
                                            required></select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="tgl_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
                                        <input type="date" class="form-control" id="tgl_pemeriksaan" name="tgl_pemeriksaan"
                                            placeholder="Masukkan Tanggal Pemeriksaan" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="hasil" class="form-label">HB Hasil Pemeriksaan</label>
                                        <input type="text" class="form-control" id="hasil" name="hasil"
                                            placeholder="contoh: 9.6" required>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!-- <div class="row gy-2 mt-2 mb-3">
                                <div class="col-xxl-4 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <div>Apakah pemeriksaan hb dilakukan di puskesmas sesuai domisili?</div>
                                        <div class="mt-2 d-flex justify-content-evenly">
                                            <div class="form-check form-radio-primary mb-3">
                                                <input class="form-check-input" type="radio" name="pemeriksaan_domisili"
                                                    id="radio_ya" value="1" checked>
                                                <label class="form-check-label" for="radio_ya">Iya</label>
                                            </div>
                                            <div class="form-check form-radio-primary mb-3">
                                                <input class="form-check-input" type="radio" name="pemeriksaan_domisili"
                                                    id="radio_tidak" value="0">
                                                <label class="form-check-label" for="radio_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-4 col-md-6" id="puskesmas_dom_container">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="puskesmas" class="form-label">Puskesmas Pemeriksaan</label>
                                        <select class="form-select js-example-basic-single" name="id_puskesmas">
                                            @foreach($puskesmass as $puskesmas)
                                                <option value="{{$puskesmas->id}}">{{$puskesmas->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-auto mt-2 mb-3" style="border-radius:10px;">
                                <div class=" bg-white p-3" style="border-radius:10px;">
                                    {!! NoCaptcha::display() !!}
                                    @error('g-recaptcha-response')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                    <div class="card-footer align-items-right m-3"  style="border-radius:10px;">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    {!! NoCaptcha::renderJs() !!}

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
        $('.js-nik-search').select2({
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
                        q: params.term // input dari user
                    };
                },
                processResults: function(data) {
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

        function togglePuskesmasSelect() {
            const selected = $('input[name="pemeriksaan_domisili"]:checked').val();
            if (selected === '0') {
                $('#puskesmas_dom_container').show();
            } else {
                $('#puskesmas_dom_container').hide();
            }
        }

        // Jalankan saat halaman dimuat
        togglePuskesmasSelect();

        // Jalankan saat user ganti pilihan
        $('input[name="pemeriksaan_domisili"]').on('change', function() {
            togglePuskesmasSelect();
        });
    });
</script>

@endsection