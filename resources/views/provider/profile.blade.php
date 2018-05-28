@extends('layouts')
@section('page')
    <style>
        .card-footer {
            padding: 10px;
            background-color: #f6f9fd;
            border-top: none;
        }
        .profile-stat-count {
            display: block;
            margin-bottom: 3px;
            font-size: 20px;
            font-weight: 100;
            color: #616161;
        }
        .profile-stat-count + span {
            color: #9e9e9e;
        }

    </style>
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-lg-6 col-xl-3 pull-xl-6">
                    <div class="card card-shadow text-center">
                        <div class="card-block">
                            <a class="avatar avatar-lg" href="javascript:void(0)">
                                <img src="../../../global/portraits/5.jpg" alt="...">
                            </a>
                            <h4 class="profile-user">Terrance arnold</h4>
                            <p class="profile-job">Service Provider</p>
                            <p class="profile-job">maikap.samir@gmail.com</p>
                            <p class="profile-job">9547176376</p>
                            <p class="profile-job">South Dum Dum, Kolkata, West Bengal 700074</p>
                            <p>Hi! I'm Adrian the Senior UI Designer at AmazingSurge. We hope
                                you enjoy the design and quality of Social.</p>
                        </div>
                        <div class="card-footer">
                            <div class="row no-space">
                                <div class="col-6">
                                    <strong class="profile-stat-count">260</strong>
                                    <span>Connects</span>
                                </div>
                                <div class="col-6">
                                    <strong class="profile-stat-count">180</strong>
                                    <span>Services</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Friend List -->
                    <div class="user-friends card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title mb-20">
                                Friends
                                <span>210</span>
                            </h4>
                            <ul class="list-group list-group-full m-0">
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-online" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/1.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                Herman Beck
                                            </h5>
                                            <small>CEO</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-busy" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/2.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                Mary Adams
                                            </h5>
                                            <small>CIO</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-off" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/3.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                Caleb Richards
                                            </h5>
                                            <small>CTO</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-away" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/4.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                June Lane
                                            </h5>
                                            <small>CVO</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Friends List -->
                </div>
                <div class="col-lg-6 col-xl-3 ">
                    <div class="user-friends card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title mb-20">
                                Friends
                                <span>210</span>
                            </h4>
                            <ul class="list-group list-group-full m-0">
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-online" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/1.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                Herman Beck
                                            </h5>
                                            <small>CEO</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-busy" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/2.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                Mary Adams
                                            </h5>
                                            <small>CIO</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-off" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/3.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                Caleb Richards
                                            </h5>
                                            <small>CTO</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="pr-20">
                                            <a class="avatar avatar-away" href="javascript:void(0)">
                                                <img class="img-fluid" src="../../../global/portraits/4.jpg" alt="...">
                                                <i></i>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-5 hover">
                                                June Lane
                                            </h5>
                                            <small>CVO</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 ">
                    <div class="user-friends card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title mb-20">
                                Service History
                                {{--<span>210</span>--}}
                            </h4>
                            <ul class="list-group list-group-full m-0">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="media">
                                                <div class="pr-20">
                                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                                        <img class="img-fluid" src="../../../global/portraits/1.jpg" alt="...">
                                                        <i></i>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-5 hover">
                                                        Herman Beck
                                                    </h5>
                                                    <small>South Dum Dum, Kolkata, West Bengal 700074</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="mt-0 mb-5 text-primary">
                                                4500
                                            </h5>
                                            <small>22 hours</small>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="badge badge-outline badge-success">Completed</span>
                                        </div>
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="media">
                                                <div class="pr-20">
                                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                                        <img class="img-fluid" src="../../../global/portraits/1.jpg" alt="...">
                                                        <i></i>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-5 hover">
                                                        Herman Beck
                                                    </h5>
                                                    <small>South Dum Dum, Kolkata, West Bengal 700074</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="mt-0 mb-5 text-primary">
                                                4500
                                            </h5>
                                            <small>22 hours</small>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="badge badge-outline badge-success">Completed</span>
                                        </div>
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="media">
                                                <div class="pr-20">
                                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                                        <img class="img-fluid" src="../../../global/portraits/1.jpg" alt="...">
                                                        <i></i>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-5 hover">
                                                        Herman Beck
                                                    </h5>
                                                    <small>South Dum Dum, Kolkata, West Bengal 700074</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="mt-0 mb-5 text-primary">
                                                4500
                                            </h5>
                                            <small>22 hours</small>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="badge badge-outline badge-success">Completed</span>
                                        </div>
                                    </div>

                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="media">
                                                <div class="pr-20">
                                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                                        <img class="img-fluid" src="../../../global/portraits/1.jpg" alt="...">
                                                        <i></i>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-5 hover">
                                                        Herman Beck
                                                    </h5>
                                                    <small>South Dum Dum, Kolkata, West Bengal 700074</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <h5 class="mt-0 mb-5 text-primary">
                                                4500
                                            </h5>
                                            <small>22 hours</small>
                                        </div>
                                        <div class="col-md-2">
                                            <span class="badge badge-outline badge-success">Completed</span>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection