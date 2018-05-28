@extends('layouts')
@section('page')
    <style>
        .list-group-dividered li:last-child{
            border-bottom: none;
        }
        @media only screen and (max-width: 600px) {
            .page-header{
                padding-left:10px !important;
                padding-right: 10px!important;
            }
            .page-header-actions{
                margin-right: -20px !important;
            }
            .media-button{
                padding-left: 0 !important;
                margin-top:10px !important;
            }
            .avatar{
                margin-bottom:10px !important;
            }
            .more-row{
                margin-bottom: 20px!important;
            }
        }
    </style>
    <div class="page">
        <div class="page-header">
            <h1 class="page-title">Providers</h1>
            <div class="page-header-actions">
                <button type="button" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="dropdown"  id="sortDropdown" data-original-title="Refresh">
                    <i class="icon md-filter-list"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="filterDropdown" role="menu">
                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Action</a>
                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Another action</a>
                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Something else here</a>
                    <a class="dropdown-item" href="javascript:void(0)" role="menuitem">Separated link</a>
                </div>
            </div>
        </div>
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-group list-group-full list-group-dividered card card-shadow m-0">
                        <li class="list-group-item pl-20 pr-20">
                            <div class="media">
                                <div class="pr-20 media-avatar">
                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                        <img class="img-fluid" src="../../../global/portraits/5.jpg"
                                             alt="..."><i></i></a>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading">Mary Adams</h6>
                                    <p class="text-muted">
                                        <time datetime="2017-06-17T20:22:05+08:00">30 minutes ago</time>
                                    </p>
                                    <p class="text-dark">Anyways, i would like just do it Anyways, i would like just do it Anyways, i would like just do it Anyways, i would like just do it Anyways, i would like just do it Anyways, i would like just do it</p>
                                    <p class="mb-0">Reported by <a href="">Samir Maikap</a></p>
                                </div>
                                <div class="pl-20 media-button">
                                    <button class="btn btn-round btn-inverse h-40 w-40 text-danger border-0 text-center p-0" title="Block"><i class="material-icons mt-10 m-0">thumb_down</i></button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row more-row text-center mt-10 pt-20">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-primary ladda-button btn-sx font-weight-500" data-style="zoom-in"
                            data-plugin="ladda">
                        <span class="ladda-label"><i class="icon md-long-arrow-down mr-5" aria-hidden="true"></i> More</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection