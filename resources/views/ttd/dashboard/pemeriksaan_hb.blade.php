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
    @slot('title')Data Pribadi @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="background-color: #F5CBCB;">
                <form action="{{route('pemeriksaan.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <img src="{{ URL::asset('build/images/tambah_darah2.png') }}" alt="" class="img-fluid move-animation" style="max-height: 200px;">
                
                        <div class="live-preview">
                            <div class="row gx-3  gy-4">
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="nik" class="form-label">NIK</label>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            placeholder="Masukkan NIK" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Masukkan Nama Lengkap" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="nomer" class="form-label">No HP</label>
                                        <input type="text" class="form-control" id="nomer" name="nomer"
                                            placeholder="Masukkan No HP" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                            placeholder="Masukkan Tempat Lahir" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                            placeholder="Masukkan Tanggal Lahir" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            placeholder="Masukkan Alamat Lengkap" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="puskesmas" class="form-label">Puskesmas Domisili</label>
                                        <select class="js-example-basic-single" name="puskesmas_id" required>
                                            @foreach($puskesmass as $puskesmas)
                                                <option value="{{$puskesmas->id}}">{{$puskesmas->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                        <select class="js-example-basic-single" name="sekolah_id" required>
                                            @foreach($sekolahs as $sekolah)
                                                <option value="{{$sekolah->id}}">{{$sekolah->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xxl-3 col-md-6">
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
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
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
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
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
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
                                    <div class="bg-white p-3 h-100" style="border-radius:10px;">
                                        <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                                        <input type="text" class="form-control" id="nama_ortu" name="nama_ortu"
                                            placeholder="Masukkan Nama Orang Tua" required>
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
                    </div>

                    <div class="card-footer align-items-right  m-3" style="border-radius:10px;">
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

@endsection