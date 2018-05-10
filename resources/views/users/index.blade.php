@extends('app')
@section('content')
    {{--<div class="content-header card row page-header ml-0 mr-0">--}}
        {{--<h2>ChangeLog</h2>--}}
    {{--</div>--}}
    <div class="content-header row mb-1">
        <div class="content-header-left col-md-6 col-xs-12">
            <h2 class="content-header-title">ChangeLog</h2>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3 content-header-right col-xs-12">
            <div class="form-group">
                <i class="material-icons search-icon">search</i>
                <input id="search" class="form-control page-search card" placeholder="Search" name="search" type="text">
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="timeline" class="timeline-left timeline-wrapper">
            <div class="row match-height">
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="{{'assets'}}/images/carousel/06.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum brownie pastry gummies jelly.</p>
                                <a href="#" class="btn btn-outline-deep-orange">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="{{'assets'}}/images/carousel/06.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum brownie pastry gummies jelly.</p>
                                <a href="#" class="btn btn-outline-deep-orange">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="{{'assets'}}/images/carousel/06.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum brownie pastry gummies jelly.</p>
                                <a href="#" class="btn btn-outline-deep-orange">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="{{'assets'}}/images/carousel/06.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum brownie pastry gummies jelly.</p>
                                <a href="#" class="btn btn-outline-deep-orange">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <img class="card-img-top img-fluid" src="{{'assets'}}/images/carousel/06.jpg" alt="Card image cap">
                            <div class="card-block">
                                <h4 class="card-title">Card title</h4>
                                <p class="card-text">Icing powder caramels macaroon. Toffee sugar plum brownie pastry gummies jelly.</p>
                                <a href="#" class="btn btn-outline-deep-orange">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection