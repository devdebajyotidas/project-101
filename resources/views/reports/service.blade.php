@extends('layouts')
@section('page')

    <div class="page">
        <div class="page-header">
            <h4 class="page-title">Reports for {{isset($name) ? $name : 'N/A'}}</h4>
        </div>
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-lg-12">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title inline-block">Usage History - <small class="text-muted usage-range">{{date('F')}}</small></h4>
                            <button type="button" data-type="usage" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic date-range float-lg-right" data-target="#dateModal" data-toggle="modal">
                                <i class="icon md-calendar"></i>
                            </button>
                        </div>
                        <div class="card-block h-400">
                            <canvas id="lineChartOne"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title inline-block">Taken History - <small class="text-muted taken-range">{{date('F')}}</small></h4>
                            <button type="button" data-type="taken" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic date-range float-lg-right" data-target="#dateModal" data-toggle="modal">
                                <i class="icon md-calendar"></i>
                            </button>
                        </div>
                        <div class="card-block h-400">
                            <canvas id="lineChartTwo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script>
        window.onload=function() {
            $(function(){
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

                if(type=='usage'){
                    loadLineChartOne();
                    $('.usage-range').html(range);
                }
                else if(type=='taken'){
                    loadLineChartTwo();
                    $('.taken-range').html(range);
                }
            })

            $('#dateModal').on('hidden.bs.modal', function () {
                $('.start-date').val('').trigger('change').datepicker("clearDates");
                $('.end-date').val('').trigger('change').datepicker("clearDates");
                $('#filter-name').val('');
            })

            function loadLineChartOne(){
                NProgress.start();
                var start=$('.start-date').val();
                var end=$('.end-date').val();
                var service_id="{{$service_id}}";
                var url="{{url('reports/load/service/usage')}}/"+service_id;
                $.post(url,{'start':start,'end':end},function(response){
                    makeLineChartOne(response.data,response.label);
                    NProgress.done();
                })
            }

            function loadLineChartTwo(){
                NProgress.start();
                var start=$('.start-date').val();
                var end=$('.end-date').val();
                var service_id="{{$service_id}}";
                var url="{{url('reports/load/service/taken')}}/"+service_id;
                $.post(url,{'start':start,'end':end},function(response){
                    makeLineChartTwo(response.data,response.label)
                    NProgress.done();
                })
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

        }
    </script>
@endsection