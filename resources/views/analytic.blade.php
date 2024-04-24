@extends('layouts.main')

@section('meta')
    @include('layouts.meta')
@endsection

@section('title')
    Analytic PAGE 
@endsection

@section('head')
    @include('layouts.head')
@endsection

@section('theme')
    @include('layouts.theme')
@endsection

@section('header')
    @include('layouts.header')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load Charts and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Draw the pie chart for local when Charts is loaded.
        google.charts.setOnLoadCallback(drawlocalChart);

        // Draw the pie chart for the rental when Charts is loaded.
        google.charts.setOnLoadCallback(drawrentalChart);

        // Draw the pie chart for the outstation when Charts is loaded.
        google.charts.setOnLoadCallback(drawoutstationChart);


        google.charts.setOnLoadCallback(drawoenquiryChart);

        
        // Callback that draws the pie chart for local.
        function drawlocalChart() {

            var data = google.visualization.arrayToDataTable([
                ['cancelled', 'completed'],
                <?php
                echo $data1;
                ?>
            ]);

            var options = {
                title: 'Local Ride',
                colors: ['#32CD32', 'red'],
                'width':'auto', 'height':'auto',
                pieSliceText: 'value',
                sliceVisibilityThreshold: 0,
                fontSize: 17,
                legend: {
                    position: 'labeled'
                },
            };

            var chart = new google.visualization.PieChart(document.getElementById('localchart'));

            chart.draw(data, options);
        }

        // Callback that draws the pie chart for rental.
        function drawrentalChart() {

            var data = google.visualization.arrayToDataTable([
                ['cancelled', 'completed'],
                <?php
                echo $data2;
                ?>
            ]);

            var options = {
                title: 'Rental Ride',
                colors: ['#32CD32', 'red'],
                'width':'auto', 'height':'auto',
                pieSliceText: 'value',
                sliceVisibilityThreshold: 0,
                fontSize: 17,
                legend: {
                    position: 'labeled'
                },
            };

            var chart = new google.visualization.PieChart(document.getElementById('rentalchart'));

            chart.draw(data, options);
        }


        // Callback that draws the pie chart for outstation.

        function drawoutstationChart() {

var data = google.visualization.arrayToDataTable([
    ['cancelled', 'completed'],
    <?php
    echo $data3;
    ?>
]);

var options = {
    title: 'Outstation Ride',
    colors: ['#32CD32', 'red'],
    'width':'auto', 'height':'auto',
    pieSliceText: 'value',
    sliceVisibilityThreshold: 0,
    fontSize: 17,
    legend: {
        position: 'labeled'
    },

};

var chart = new google.visualization.PieChart(document.getElementById('outstationchart'));

chart.draw(data, options);
} 

function drawoenquiryChart() {

 var data = new google.visualization.DataTable();
            data.addColumn('string', 'Status');
            data.addColumn('number', 'Count');
            
            // Add your data dynamically from the PHP variable
            var dataArray = [
                ["Convert", {{ $data4['convert'] }}],
                ["Pending", {{ $data4['pending'] }}]
            ];
            data.addRows(dataArray);

var options = {
    title: 'Enquiry Comparison',
    colors: ['#32CD32', 'red'],
    'width':'auto', 'height':'auto',
    pieSliceText: 'value',
    sliceVisibilityThreshold: 0,
    fontSize: 17,
    legend: {
        position: 'labeled'
    },

};

var chart = new google.visualization.PieChart(document.getElementById('enquirychart'));

chart.draw(data, options);
}
    </script>
@endsection

@section('sidebar')
    @include('layouts.sidebar')
@endsection

@section('content')
    <div class="container-fluid">
        @include('delete')
        <section class="mb-5">
            <!--Card-->
            <div class="card card-cascade narrower">

                <div class="card-body card-body-cascade">
                    <!--Table and divs that hold the pie charts-->

                    <form action="{{ route('analytic') }}" method="get">

                        <div class="row">
                            <div class="col">
                                <div class="md-form mt-3">
                                    <label for="date-picker-example" style="margin-top: -30px;">From Date</label>
                                    <input placeholder="From date" type="date" name="from_date" class="form-control"
                                        value="{{ app('request')->input('from_date') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <label for="date-picker-example" style="margin-top: -30px;">To Date</label>
                                    <input placeholder="To date" type="date" name="to_date" class="form-control"
                                        value="{{ app('request')->input('to_date') }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form mt-3">
                                    <button class="btn btn-info " type="submit">Submit</button>

                                </div>
                            </div>
                        </div>




                    </form>
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #ccc;border-bottom: 1px solid #ccc;margin-bottom:2px;">
                            <div id="localchart"></div>
                        </div>
                        <div class="col-md-6" style="border-bottom: 1px solid #ccc;margin-bottom:2px;">
                            <div id="rentalchart" ></div>
                        </div>
                        <div class="col-md-6" style="border-right: 1px solid #ccc;margin-bottom:2px;">
                            <div id="outstationchart" ></div>
                        </div>

                        <div class="col-md-6" style="border-right: 1px solid #ccc;margin-bottom:2px;">
                            <div id="enquirychart" ></div>
                        </div>

                    </div>


                </div>
                <!--/.Card content-->
            </div>

        </section>
        <!--Section: Table-->

    </div>
@endsection



@section('footer')
    @include('layouts.footer')
@endsection

@section('script')
    @include('layouts.script')
    @include('video.ajax')
@endsection
