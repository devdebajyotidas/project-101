@extends('layouts')
@section('page')
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row" data-plugin="matchHeight" data-by-row="true">
                <div class="col-xl-3 col-md-6">
                    <div class="card card-shadow" id="widgetLineareaOne">
                        <div class="card-block p-20 pt-10">
                            <div class="clearfix">
                                <div class="grey-800 float-left py-10">
                                    <i class="icon md-account grey-600 font-size-24 vertical-align-bottom mr-5"></i>                    User
                                </div>
                                <span class="float-right blue-500 font-size-30 font-weight-500">1,253</span>
                            </div>
                            <div class="grey-500">
                                <i class="icon md-long-arrow-up green-500 font-size-16 mr-5"></i>15% From this yesterday
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
                                <span class="float-right blue-500 font-size-30 font-weight-500">2,425</span>
                            </div>
                            <div class="grey-500">
                                <i class="icon md-long-arrow-up green-500 font-size-16 mr-5"></i>34.2% From this week
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
                                <span class="float-right blue-500 font-size-30 font-weight-500">1,864</span>
                            </div>
                            <div class="grey-500">
                                <i class="icon md-long-arrow-down red-500 font-size-16 mr-5"></i>15% From this yesterday
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
                                <span class="float-right blue-500 font-size-30 font-weight-500">845</span>
                            </div>
                            <div class="grey-500">
                                <i class="icon md-long-arrow-up green-500 font-size-16 vertical-align-middle mr-5"></i>18.4% This Month
                            </div>
                        </div>
                    </div>
                    <!-- End Widget Linearea Four -->
                </div>

                <div class="col-lg-6">
                    <!-- Example Curve -->
                    {{--<div class="example-wrap m-md-0">--}}
                        {{--<h4 class="example-title">Curve</h4>--}}
                        {{--<div class="example example-responsive">--}}
                            {{--<div class="width-sm-400" id="exampleFlotCurve"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <!-- End Example Curve -->
                </div>

            </div>
        </div>
    </div>
@endsection