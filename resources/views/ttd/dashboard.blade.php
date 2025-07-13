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
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    #map {
        position: relative;
        z-index: 0;
        height: 50vh;
    }

    .label-kecamatan {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        font-weight: bold;
        color: black;
    }

    .legend {
        background: white;
        padding: 6px;
        line-height: 18px;
    }

    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
</style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title')Dashboard @endslot
@endcomponent

@if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mt-2">Peta Sebaran</h3>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mt-2">Grafik Hasil HB</h3>

                    <div class="d-flex gap-2"> <!-- wrapper kanan dengan gap -->
                        <div class="dropdown card-header-dropdown">
                            <select id="puskesmasDonut" class="form-select w-auto">
                                <option value="00">Semua Puskesmas</option>
                                @foreach($puskesmass as $puskesmas)
                                <option value="{{ $puskesmas->id }}">{{ $puskesmas->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="dropdown card-header-dropdown">
                            <select id="bulanDonut" class="form-select w-auto">
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
                <div id="donutChart"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title mt-2">Grafik Capaian Pemeriksaan</h3>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <select id="bulanBar" class="form-select w-auto">
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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title mt-2">Grafik Konsumsi TTD</h3>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <select id="TTD" class="form-select w-auto">
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
                <canvas id="chart2" height="100px"></canvas>
            </div>
        </div>
    </div>
</div>
@endif

{!! NoCaptcha::renderJs() !!}

@endsection
@section('script')


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
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

<script>
    var map = L.map('map').setView([-7.75, 112.85], 10.3);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    function getColor(value) {
        return value > 100 ? '#006837' :
            value > 50 ? '#31a354' :
            value > 20 ? '#78c679' :
            value > 10 ? '#c2e699' :
            '#ffffcc';
    }

    function style(feature) {
        const total = feature.properties.total || 0; // handle null
        return {
            fillColor: getColor(total),
            weight: 1,
            opacity: 1,
            color: 'black',
            fillOpacity: 0.7
        };
    }

    function onEachFeature(feature, layer) {
        const p = feature.properties;

        // Handle nilai null untuk angka
        const total = p.total ?? 0;
        const normal = p.normal ?? 0;
        const ringan = p.ringan ?? 0;
        const sedang = p.sedang ?? 0;
        const berat = p.berat ?? 0;

        // Tooltip nama kecamatan di tengah
        layer.bindTooltip(p.kecamatan, {
            permanent: true,
            direction: 'center',
            className: 'label-kecamatan'
        });

        // Popup informasi detail
        const content = `
        <b>Kecamatan ${p.kecamatan}</b><br>
        Puskesmas: <b>${p.puskesmas}</b><br>
        Pemeriksaan: <b>${total}</b><br>
        Normal: ${normal}<br>
        Anemia Ringan: ${ringan}<br>
        Anemia Sedang: ${sedang}<br>
        Anemia Berat: ${berat}
    `;
        layer.bindPopup(content);
    }

    fetch("{{ route('geo-kec') }}")
        .then(res => res.json())
        .then(data => {
            L.geoJson(data, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);
        });

    var legend = L.control({
        position: 'bottomleft'
    });
    legend.onAdd = function(map) {
        var div = L.DomUtil.create('div', 'legend'),
            grades = [0, 10, 20, 50, 100],
            labels = ['0–10', '11–20', '21–50', '51–100', '100+'];

        div.innerHTML = '<b>Jumlah Pemeriksaan</b><br>';
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                labels[i] + '<br>';
        }
        return div;
    };
    legend.addTo(map);
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartContainer = document.querySelector("#donutChart");
        let chart;

        function renderChart(labels, data) {
            if (chart) {
                chart.updateOptions({
                    labels,
                    series: data
                });
            } else {
                chart = new ApexCharts(chartContainer, {
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    series: data,
                    colors: ['#e74c3c', '#f39c12', '#3498db', '#2ecc71']
                });
                chart.render();
            }
        }

        const baseUrl = "{{ route('donutChart', ['bulan' => 'dummy', 'puskesmas' => 'dummy']) }}"
            .replace('/dummy/dummy', '');

        function fetchData(bulan, puskesmas) {
            fetch(`${baseUrl}/${bulan}/${puskesmas}`)
                .then(response => response.ok ? response.json() : response.text().then(t => {
                    throw new Error(t)
                }))
                .then(res => renderChart(res.labels, res.data))
                .catch(err => {
                    console.error("Fetch error:", err);
                    chartContainer.innerHTML = `<pre>${err.message}</pre>`;
                });
        }

        const bulanSelect = document.getElementById("bulanDonut");
        const puskesmasSelect = document.getElementById("puskesmasDonut");

        function loadFilteredChart() {
            const bulan = bulanSelect.value;
            const puskesmas = puskesmasSelect.value;
            fetchData(bulan, puskesmas);
        }

        bulanSelect.addEventListener("change", loadFilteredChart);
        puskesmasSelect.addEventListener("change", loadFilteredChart);

        // Load pertama
        fetchData("00", "00");
    });
</script>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ url('/chart/hasil') }}")
            .then(res => res.json())
            .then(res => {
                console.log(res); // cek response-nya
                var options = {
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: res.labels,
                    series: res.data,
                    colors: ['#e74c3c', '#f39c12', '#3498db', '#2ecc71'],
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#donutChart"), options);
                chart.render();
            }).catch(error => {
                console.error('Gagal ambil data chart:', error);
            });
    });
</script> -->

<script>
    const dataByMonth = {!!json_encode($monthlyPuskesmasData) !!};
    const dataByMonthttd = {!!json_encode($monthlyTTDPuskesmasData) !!};

    const ctx1 = document.getElementById('chart').getContext('2d');
    const ctx2 = document.getElementById('chart2').getContext('2d');

    let chart1; // Untuk chart pertama
    let chart2; // Untuk chart kedua

    function renderChart(month = '00') {
        let labels = [];
        let dataLaki = [];
        let dataPerempuan = [];
        const temp = {};
        const isCombined = (month === '00');
        const loopData = isCombined ? Object.values(dataByMonth).flat() : dataByMonth[month];

        loopData.forEach(item => {
            const match = item.name.match(/^(.*) \((L|P)\)$/);
            if (!match) return;

            const nama = match[1];
            const gender = match[2];

            if (!temp[nama]) {
                temp[nama] = {
                    L: 0,
                    P: 0
                };
            }
            temp[nama][gender] += item.value;
        });

        for (const nama in temp) {
            labels.push(nama);
            dataLaki.push(temp[nama].L);
            dataPerempuan.push(temp[nama].P);
        }

        if (chart1) chart1.destroy();

        chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
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

    function renderChartttd(month = '00') {
        let labels = [];
        let dataLaki = [];
        let dataPerempuan = [];
        const temp = {};
        const isCombined = (month === '00');
        const loopData = isCombined ? Object.values(dataByMonthttd).flat() : dataByMonthttd[month];

        loopData.forEach(item => {
            const match = item.name.match(/^(.*) \((L|P)\)$/);
            if (!match) return;

            const nama = match[1];
            const gender = match[2];

            if (!temp[nama]) {
                temp[nama] = {
                    L: 0,
                    P: 0
                };
            }
            temp[nama][gender] += item.value;
        });

        for (const nama in temp) {
            labels.push(nama);
            dataLaki.push(temp[nama].L);
            dataPerempuan.push(temp[nama].P);
        }

        if (chart2) chart2.destroy();

        chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
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

    // Listener dropdown
    document.getElementById('bulanBar').addEventListener('change', function() {
        const bulan = this.value;
        renderChart(bulan);
        // renderChartttd(bulan);
    });// Listener dropdown
    document.getElementById('TTD').addEventListener('change', function() {
        const bulan = this.value;
        // renderChart(bulan);
        renderChartttd(bulan);
    });

    // Initial render
    renderChart('00');
    renderChartttd('00');
</script>
@endsection