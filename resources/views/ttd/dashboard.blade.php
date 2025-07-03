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
        font-weight: 600;
        font-size: 13px;
        color: white;
        background: rgba(0, 0, 0, 0.5);
        padding: 4px 8px;
        border-radius: 4px;
        box-shadow: 0 0 3px #000;
        text-shadow: 0 0 2px #000;
        pointer-events: none;
        white-space: nowrap;
    }
    .legend { background: white; padding: 6px; line-height: 18px; }
    .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
  </style>
@endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title')Dashboard @endslot
@endcomponent

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div id="map"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div id="donutChart"></div>
        </div>
    </div>
</div>

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
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

<script>
    var map = L.map('map').setView([-7.75, 113], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    function getColor(persen) {
      return persen > 80 ? '#006837' :
             persen > 60 ? '#31a354' :
             persen > 40 ? '#addd8e' :
             persen > 20 ? '#fdae61' :
                           '#f46d43';
    }

    function style(feature) {
      const persen = feature.properties.persen_ttd || 0;
      return {
        fillColor: getColor(persen),
        weight: 1,
        opacity: 1,
        color: 'black',
        fillOpacity: 0.7
      };
    }

    function onEachFeature(feature, layer) {
        const nama = feature.properties.kecamatan;
        const persen = feature.properties.persen_ttd;
        layer.bindPopup(`<b>Kecamatan:</b> ${nama}<br><b>Minum TTD:</b> ${persen}%`);

        layer.bindTooltip(nama, {
            permanent: true,
            direction: 'center',
            className: 'label-kecamatan'
        });
    }

    fetch("{{ route('geo-kec') }}")
      .then(res => res.json())
      .then(data => {
        L.geoJSON(data, {
          style: style,
          onEachFeature: onEachFeature
        }).addTo(map);
      });

    // Legend
    var legend = L.control({position: 'bottomleft'});
    legend.onAdd = function (map) {
      var div = L.DomUtil.create('div', 'legend'),
          grades = [0, 20, 40, 60, 80],
          labels = ['0–20%', '20–40%', '40–60%', '60–80%', '80+%'];

      div.innerHTML = '<b>Minum TTD</b><br>';
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

<script>
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
</script>
@endsection
