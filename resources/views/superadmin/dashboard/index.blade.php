@extends('superadmin.temp_superadmin.index')
@section('content')
    <div class="container-fluid">
        @if (session('showSuccessModal'))
            <script>
                $(document).ready(function() {
                    // Your jQuery-dependent code
                    $('#successModal').modal('show');
                });
            </script>
            <div class="modal" tabindex="-1" id="successModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Berhasil Login KUD Sawit Jaya</h5>
                        </div>
                        <div class="modal-body">
                            <p>Selamat Anda Berhasil Melakukan Login :v</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="d-sm-flex align-items-center justify-content-between text-light">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="teks-manajemen h3 mb-0" style="color: black">Dashboard</h1>
            </div>
        </div>
        <div class="card w-100 mb-4" style="overflow: auto; background-color: #D9D9D9">
            <div class="card-body">
                <!-- Bar Chart -->
                @foreach ($chartData['datasets'] as $dataset)
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $dataset['label'] }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart_{{ $dataset['label'] }}"></canvas>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <!-- Page level plugins -->
    <script src="{{ asset('asset_admin/vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily =
            'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Function to format numbers
        function number_format(number, decimals, dec_point, thousands_sep) {
            // Format the number using the provided parameters
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };

            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec) + ' Kg';
        }

        // Array to store chart data
        var chartDataArray = [];

        // Loop through PHP datasets and add to chartDataArray
        // Loop through PHP datasets and add to chartDataArray
        @foreach ($chartData['datasets'] as $dataset)
            var chartData = {
                labels: @json($chartData['labels']),
                datasets: [{
                    'label': '{{ $dataset['label'] }}',
                    'data': @json($dataset['data']),
                    'backgroundColor': '{{ $dataset['backgroundColor'] }}',
                    'borderColor': '{{ $dataset['borderColor'] }}',
                    'borderWidth': {{ $dataset['borderWidth'] }},
                    @if (isset($dataset['maxBarThickness']))
                        'maxBarThickness': {{ $dataset['maxBarThickness'] }},
                    @endif
                }]
            };
            chartDataArray.push(chartData);
        @endforeach


        // Loop through chartDataArray and create charts
        chartDataArray.forEach(function(chartData) {
            var ctx = document.getElementById('myBarChart_' + chartData.datasets[0].label).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 6
                            },
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                padding: 10,
                                callback: function(value, index, values) {
                                    return '' + number_format(value);
                                }
                            },
                            gridLines: {
                                color: "rgb(255, 167, 50)",
                                zeroLineColor: "rgb(255, 167, 50)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#FFFBF5',
                        titleFontSize: 14,
                        backgroundColor: "rgb(48, 129, 208)",
                        bodyFontColor: "#FFFBF5",
                        borderColor: '#FFFBF5',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex]
                                    .label || '';
                                return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
                            }
                        }
                    },
                }
            });
        });
    </script>
@endsection
