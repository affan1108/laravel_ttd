@extends('layouts.layouts-horizontal')
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
@slot('li_1') {!! Auth::check() ? 'Dashboard' : 'Grafik' !!} @endslot
@slot('title')Dashboard @endslot
@endcomponent

@if(Auth::user())
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title mt-2">Grafik</h3>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <select id="bulanFilter" class="form-select w-auto">
                                <option value="00">Semua Bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="chart" height="100px"></canvas>
            </div>
        </div>
    </div>
</div>

@else
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
            <form action="{{route('pemeriksaan.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik"
                                        placeholder="Masukkan NIK" required>
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
                                    <input type="text" class="form-control" id="nomer" name="nomer"
                                        placeholder="Masukkan No HP" required>
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
                                <div>
                                    <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah"
                                        placeholder="Masukkan Nama Sekolah">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                                    <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah"
                                        placeholder="Masukkan Alamat Sekolah">
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="kelas" name="kelas"
                                        placeholder="Masukkan Kelas">
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
                <div class="card-footer align-items-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

@endif

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
    const dataByMonth = {!! json_encode($monthlyPuskesmasData) !!};
    const ctx = document.getElementById('chart').getContext('2d');
    let chart; // Simpan chart instance global

    // console.log(dataByMonth);

    function renderChart(month = '00') {
        let labels = []; // Nama Puskesmas
        let dataLaki = []; // Nilai laki-laki
        let dataPerempuan = []; // Nilai perempuan

        const isCombined = (month === '00');

        const temp = {};

        // Gabung data (semua bulan) atau 1 bulan
        const loopData = isCombined ? Object.values(dataByMonth).flat() : dataByMonth[month];

        loopData.forEach(item => {
            // Pisah nama dan gender
            const match = item.name.match(/^(.*) \((L|P)\)$/);
            if (!match) return;

            const namaPuskesmas = match[1];
            const gender = match[2]; // 'L' atau 'P'

            if (!temp[namaPuskesmas]) {
                temp[namaPuskesmas] = { L: 0, P: 0 };
            }

            temp[namaPuskesmas][gender] += item.value;
        });

        // Susun labels dan nilai laki/perempuan
        for (const puskesmas in temp) {
            labels.push(puskesmas);
            dataLaki.push(temp[puskesmas]['L']);
            dataPerempuan.push(temp[puskesmas]['P']);
        }

        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Laki-laki',
                        data: dataLaki,
                        backgroundColor: 'blue'
                    },
                    {
                        label: 'Perempuan',
                        data: dataPerempuan,
                        backgroundColor: 'pink'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }



    document.getElementById('bulanFilter').addEventListener('change', function () {
        const bulan = this.value;
        renderChart(bulan);
    });

    // Load default chart (optional)
    renderChart('00'); // atau 'all'
</script>


@endsection
