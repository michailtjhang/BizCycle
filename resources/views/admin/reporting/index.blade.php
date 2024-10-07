@extends('layouts.admin')

@section('css')
    <!-- daterange picker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Pivot JS -->
    <link href="https://pivottable.js.org/dist/pivot.css" rel="stylesheet" type="text/css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endSection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reporting</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('POST')
                        @yield('form')
                        <input type="dates" name="daterange">
                        <select class="js-example-basic-single" name="states[]" class="form-control" style="width: 200px;"
                            multiple="multiple">
                            @foreach ($product as $item)
                                <option value="{{ $item->id_product }}">{{ $item->name_product }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>

            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reporting Chart</h3>
                </div>
                <div class="card-body">
                    <canvas id="donutChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Reporting</h3>
                </div>
                <div class="card-body">
                    <div id="output" style="margin: 30px;" class="table-responsive" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('js')
    <script src="{{ asset('assets/vendor/adminlte') }}/plugins/chart.js/Chart.min.js"></script>

    <!-- daterange picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Pivot JS -->
    <script src="https://pivottable.js.org/dist/pivot.js"></script>

    <script>
        $('input[name="daterange"]').daterangepicker();
        $('.js-example-basic-single').select2();

        var donutChartCanvas = $('#donutChart').get(0).getContext('2d');

        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
        };

        $.ajax({
            url: '{{ route('reporting.chart-product') }}',
            success: function(data) {

                var donutData = {
                    labels: ['< 10,000', '10,000 - 20,000', '20,000 - 50,000', '50,000 - 100,000',
                        '> 100,000'
                    ],
                    datasets: [{
                        data: [
                            data.less_10000,
                            data._10000_20000,
                            data._20000_50000,
                            data._50000_100000,
                            data.more_100000
                        ],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
                    }]
                };

                // Buat chart dengan data dari respons
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching data: ", textStatus, errorThrown);
            }
        })

        $.ajax({
            url: '{{ route('reporting.all-data-product') }}',
            success: function(data) {
                $("#output").pivot(
                    data, {
                        rows: ["created_range"],
                        cols: ["price_range"],
                    }
                );
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching data: ", textStatus, errorThrown);
            }
        })
    </script>
@endSection
