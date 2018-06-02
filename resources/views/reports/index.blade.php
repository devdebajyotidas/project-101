@extends('layouts')
@section('page')
    <style>
        .input-daterange input{
            text-align: left;
        }
       @media screen and (max-width: 1024px){
           .chart .card-block{
               height: auto !important;
           }
       }
    </style>
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow" id="widgetLineareaOne">
                        <div class="card-block p-20 pt-10">
                            <div class="clearfix">
                                <div class="grey-800 float-left py-10">
                                    <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>User
                                </div>
                                <span class="float-right blue-500 font-size-30 font-weight-500">{{!empty($user) ? $user['total_user'] : 0}}</span>
                            </div>
                            <div class="grey-500">
                                <?php
                                $current_user=!empty($user) ? $user['total_user_current'] : 0;
                                $last_user=!empty($user) ? $user['total_user_last'] : 0;
                                if($current_user > $last_user){
                                    $user_status='<i class="icon md-long-arrow-up green-500 font-size-16 mr-5"></i>';
                                    if($last_user > 0){
                                        $user_pc=($current_user/$last_user)*100;
                                    }
                                    else{
                                        $user_pc=$current_user*100;
                                    }
                                }
                                else{
                                    $user_status='<i class="icon md-long-arrow-down red-500 font-size-16 mr-5"></i>';
                                    if($current_user > 0){
                                        $user_pc=($last_user/$current_user)*100;
                                    }
                                    else{
                                        $user_pc=$last_user*100;
                                    }
                                }
                                ?>
                                 {!! $user_status !!} {{$user_pc}}% this Month
                            </div>
                        </div>
                    </div>
                    <!-- End Widget Linearea One -->
                </div>
                <div class="col-xl-3 col-md-6">
                    <!-- Widget Linearea Two -->
                    <div class="card card-shadow" id="widgetLineareaTwo">
                        <div class="card-block p-20 pt-10">
                            <div class="clearfix">
                                <div class="grey-800 float-left py-10">
                                    <i class="icon material-icons grey-600 font-size-24 vertical-align-middle mr-5">person</i>Customers
                                </div>
                                <span class="float-right blue-500 font-size-30 font-weight-500">{{!empty($customer) ? $customer['total_customer'] : 0}}</span>
                            </div>
                            <div class="grey-500">
                                <?php
                                $current_customer=!empty($customer) ? $customer['total_customer_current'] : 0;
                                $last_customer=!empty($customer) ? $customer['total_customer_last'] : 0;
                                if($current_customer > $last_customer){
                                    $customer_status='<i class="icon md-long-arrow-up green-500 font-size-16 mr-5"></i>';
                                    if($last_customer > 0){
                                        $customer_pc=($current_customer/$last_customer)*100;
                                    }
                                    else{
                                        $customer_pc=$current_customer*100;
                                    }
                                }
                                else{
                                    $customer_status='<i class="icon md-long-arrow-down red-500 font-size-16 mr-5"></i>';
                                    if($current_customer > 0){
                                        $customer_pc=($last_customer/$current_customer)*100;
                                    }
                                    else{
                                        $customer_pc=$last_customer*100;
                                    }
                                }
                                ?>
                                {!! $customer_status !!} {{$customer_pc}}% this Month
                            </div>
                        </div>
                    </div>
                    <!-- End Widget Linearea Two -->
                </div>
                <div class="col-xl-3 col-md-6">
                    <!-- Widget Linearea Three -->
                    <div class="card card-shadow" id="widgetLineareaThree">
                        <div class="card-block p-20 pt-10">
                            <div class="clearfix">
                                <div class="grey-800 float-left py-10">
                                    <i class="icon material-icons grey-600 font-size-24 vertical-align-middle mr-5">person_pin</i>Vendors
                                </div>
                                <span class="float-right blue-500 font-size-30 font-weight-500">{{!empty($vendor) ? $vendor['total_vendor'] : 0}}</span>
                            </div>
                            <div class="grey-500">
                                <?php
                                $current_vendor=!empty($vendor) ? $vendor['total_vendor_current'] : 0;
                                $last_vendor=!empty($vendor) ? $vendor['total_vendor_last'] : 0;
                                if($current_vendor > $last_vendor){
                                    $vendor_status='<i class="icon md-long-arrow-up green-500 font-size-16 mr-5"></i>';
                                    if($last_vendor > 0){
                                        $vendor_pc=($current_vendor/$last_vendor)*100;
                                    }
                                    else{
                                        $vendor_pc=$current_vendor*100;
                                    }
                                }
                                else{
                                    $vendor_status='<i class="icon md-long-arrow-down red-500 font-size-16 mr-5"></i>';
                                    if($current_vendor > 0){
                                        $vendor_pc=($last_vendor/$current_vendor)*100;
                                    }
                                    else{
                                        $vendor_pc=$last_vendor*100;
                                    }
                                }
                                ?>
                                {!! $vendor_status !!} {{$vendor_pc}}% this Month
                            </div>
                        </div>
                    </div>
                    <!-- End Widget Linearea Three -->
                </div>
                <div class="col-xl-3 col-md-6">
                    <!-- Widget Linearea Four -->
                    <div class="card card-shadow" id="widgetLineareaFour">
                        <div class="card-block p-20 pt-10">
                            <div class="clearfix">
                                <div class="grey-800 float-left py-10">
                                    <i class="icon material-icons grey-600 font-size-24 vertical-align-middle mr-5 ">beenhere</i>Service Taken
                                </div>
                                <span class="float-right blue-500 font-size-30 font-weight-500">{{!empty($taken) ? $taken['total_taken'] : 0}}</span>
                            </div>
                            <div class="grey-500">
                                <?php
                                $current_taken=!empty($taken) ? $taken['total_taken_current'] : 0;
                                $last_taken=!empty($taken) ? $taken['total_taken_last'] : 0;
                                if($current_taken > $last_taken){
                                    $taken_status='<i class="icon md-long-arrow-up green-500 font-size-16 mr-5"></i>';
                                    if($last_taken > 0){
                                        $taken_pc=($current_taken/$last_taken)*100;
                                    }
                                    else{
                                        $taken_pc=$current_taken*100;
                                    }
                                }
                                else{
                                    $taken_status='<i class="icon md-long-arrow-down red-500 font-size-16 mr-5"></i>';
                                    if($current_taken > 0){
                                        $taken_pc=($last_taken/$current_taken)*100;
                                    }
                                    else{
                                        $taken_pc=$last_taken*100;
                                    }
                                }
                                ?>
                                {!! $taken_status !!} {{$taken_pc}}% this Month
                            </div>
                        </div>
                    </div>
                    <!-- End Widget Linearea Four -->
                </div>
            </div>
            {{--Chart 1--}}
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-lg-4 chart">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title inline-block">Services</h4>
                        </div>
                        <div class="card-block h-400">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 chart">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title inline-block">Service Taken - <small class="text-muted service-range">{{date('F')}}</small></h4>
                            <button type="button" data-type="service" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic date-range float-lg-right" data-target="#dateModal" data-toggle="modal">
                                <i class="icon md-calendar"></i>
                            </button>
                        </div>
                        <div class="card-block h-400">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{--Chart 2--}}
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-lg-12 chart">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title inline-block">Customers - <small class="text-muted customer-range">{{date('F')}}</small></h4>
                            <button type="button" data-type="customer" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic date-range float-lg-right" data-target="#dateModal" data-toggle="modal">
                                <i class="icon md-calendar"></i>
                            </button>
                        </div>
                        <div class="card-block h-400">
                            <canvas id="lineChartOne"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{--Chart 3--}}
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-lg-12 chart">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title inline-block">Providers - <small class="text-muted provider-range">{{date('F')}}</small></h4>
                            <button type="button" data-type="vendor" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic date-range float-lg-right" data-target="#dateModal" data-toggle="modal">
                                <i class="icon md-calendar"></i>
                            </button>
                        </div>
                        <div class="card-block h-400">
                            <canvas id="lineChartTwo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{--Charts End--}}
        </div>

        <!-- Modal -->
        <div class="modal fade" id="dateModal" aria-hidden="true" aria-labelledby="dateModal" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-simple modal-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Filter by date</h4>
                    </div>
                    <div class="modal-body">
                        <form id="dateForm" onsubmit="return false;">
                            <div class="row input-daterange text-left" id="datePicker" data-plugin="datepicker">
                                <div class="col-md-6">
                                    <div class="form-group form-material floating" data-plugin="formMaterial">
                                        <input  type="text" class="form-control start-date" name="start_date" autocomplete="off" readonly />
                                        <label class="floating-label">Start Date</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group form-material floating" data-plugin="formMaterial">
                                        <input  type="text" class="form-control end-date" name="end_date" autocomplete="off" readonly/>
                                        <label class="floating-label">End Date</label>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="filter-name">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-pure reset-date" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary font-weight-500 text-uppercase" id="dateApply">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        {{--Prepare chart data--}}
        <?php
            $pie_label=[];
            $pie_data=[];
            if(count($service_category) > 0){
                foreach ($service_category as $key=>$sc){
                    $pie_label[]=$sc->name;
                    $pie_data[]=$sc->total_service;
                }
            }
        ?>

        <script>
            window.onload=function(){
                $(function(){
                     loadBarChart();
                     loadLineChartOne();
                     loadLineChartTwo();
                });

                $('.date-range').click(function () {
                    var type=$(this).data('type');
                   $('#filter-name').val(type);
                });

                $('#dateApply').click(function(){
                    var type=$('#filter-name').val();
                    var start=$('.start-date').val();
                    var end=$('.end-date').val();
                    var range=moment(start, 'MM/DD/YYYY').format('MMM Do YY')+' to '+moment(end, 'MM/DD/YYYY').format('MMM Do YY')

                    if(type=='customer'){
                        loadLineChartOne();
                        $('.customer-range').html(range);
                    }
                    else if(type=='vendor'){
                        loadLineChartTwo();
                        $('.provider-range').html(range);
                    }
                    else if(type=='service'){
                        loadBarChart();
                        $('.service-range').html(range);
                    }
                })

                var options={
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                };
                var pieCtx=document.getElementById("pieChart").getContext('2d');
                var pie_data=JSON.parse('{!! json_encode($pie_data) !!}');
                var pie_label=JSON.parse('{!! json_encode($pie_label) !!}');
                var colors=makeColors(pie_data.length);
                var pieChart = new Chart(pieCtx,{
                    type: 'pie',
                    data:{
                        datasets: [{
                            data: pie_data,
                            backgroundColor:colors,
                        }],
                        labels: pie_label
                    },
                    options: options
                });

                $('#dateModal').on('hidden.bs.modal', function () {
                   $('.start-date').val('').trigger('change').datepicker("clearDates");
                   $('.end-date').val('').trigger('change').datepicker("clearDates");
                   $('#filter-name').val('');
                })
            }

            function loadBarChart(){
                NProgress.start();
                var start=$('.start-date').val();
                var end=$('.end-date').val();
                var url="{{url('reports/load/service')}}";
                $.post(url,{'start':start,'end':end},function(response){
                    NProgress.done();
                    makeBarChart(response.data,response.label);
                })
            }

            function loadLineChartOne(){
                NProgress.start();
                var start=$('.start-date').val();
                var end=$('.end-date').val();
                var url="{{url('reports/load/customer')}}";
                $.post(url,{'start':start,'end':end},function(response){
                    makeLineChartOne(response.data,response.label);
                    NProgress.done();
                })
            }

            function loadLineChartTwo(){
                NProgress.start();
                var start=$('.start-date').val();
                var end=$('.end-date').val();
                var url="{{url('reports/load/vendor')}}";
                $.post(url,{'start':start,'end':end},function(response){
                    makeLineChartTwo(response.data,response.label)
                    NProgress.done();
                })
            }

            function makeBarChart(data,label){
                var options={
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                };
                var barCtx = document.getElementById("barChart").getContext('2d');
                var bar_colors=makeColors(data.length);
                var barChart = new Chart(barCtx, {
                    type: 'bar',
                    options:options,
                    data: {
                        labels: label,
                        datasets: [{
                            label: '# votes',
                            data: data,
                            backgroundColor: bar_colors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }

            function makeLineChartOne(data,label){
                var lineCtxOne=document.getElementById("lineChartOne").getContext('2d');
                var options={
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'lll',
                            }
                        }]
                    }
                };
                var color = Chart.helpers.color
                var lineChartOne = new Chart(lineCtxOne, {
                    type: 'line',
                    data:{
                        labels: label,

                        datasets: [
                            {
                                label: "Customers",
                                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                                borderColor: window.chartColors.blue,
                                fillColor: "rgba(33,98,243, 0.8)",
                                strokeColor: "rgba(33,98,243, 0.8)",
                                pointColor: "rgba(33,98,243, 0.8)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(33,98,243, 0.8)",
                                data: data,
                            }
                        ]
                    },
                    options: options
                });
            }

            function makeLineChartTwo(data,label){
                var lineCtxTwo=document.getElementById("lineChartTwo").getContext('2d');
                var options={
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'lll',
                            }
                        }]
                    }
                };
                var color = Chart.helpers.color
                var lineChartTwo = new Chart(lineCtxTwo, {
                    type: 'line',
                    data:{
                        labels: label,

                        datasets: [
                            {
                                label: "Providers",
                                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                                borderColor: window.chartColors.blue,
                                fillColor: "rgba(33,98,243, 0.8)",
                                strokeColor: "rgba(33,98,243, 0.8)",
                                pointColor: "rgba(33,98,243, 0.8)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(33,98,243, 0.8)",
                                data: data,
                            }
                        ]
                    },
                    options: options
                });
            }


            function makeColors(len=0){
                var colors=[];
                for (var i=0;i<len;i++){
                   var color='rgb(33,'+parseInt(parseInt(98)+(i*18))+',243)';
                   colors.push(rgbToHex(color));
                }
                return colors;
            }

            function componentFromStr(numStr, percent) {
                var num = Math.max(0, parseInt(numStr, 10));
                return percent ?
                    Math.floor(255 * Math.min(100, num) / 100) : Math.min(255, num);
            }

            function rgbToHex(rgb) {
                var rgbRegex = /^rgb\(\s*(-?\d+)(%?)\s*,\s*(-?\d+)(%?)\s*,\s*(-?\d+)(%?)\s*\)$/;
                var result, r, g, b, hex = "";
                if ( (result = rgbRegex.exec(rgb)) ) {
                    r = componentFromStr(result[1], result[2]);
                    g = componentFromStr(result[3], result[4]);
                    b = componentFromStr(result[5], result[6]);

                    hex = "#" + (0x1000000 + (r << 16) + (g << 8) + b).toString(16).slice(1);
                }
                return hex;
            }
        </script>
    </div>
@endsection