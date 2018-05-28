@extends('layouts')
@section('page')

    <div class="page">
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-lg-6 col-xl-4 pull-xl-6">
                    <div class="card card-inverse card-shadow bg-blue-600 white">
                        <div class="card-block p-30">
                            <a class="avatar avatar-100 img-bordered bg-white float-left mr-20" href="javascript:void(0)">
                                <img src="../../../global/portraits/11.jpg" alt="">
                            </a>
                            <div class="vertical-align h-100 text-truncate">
                                <div class="vertical-align-middle">
                                    <div class="font-size-20 mb-5 text-truncate">Gwendolyn Wheeler</div>
                                    <div class="font-size-14 text-truncate">Adminnistrator</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-20 card-shadow">
                        <div class="card-title block">
                            <h4 class="vertical-align-middle">Information</h4>
                            <button class="vertical-align-middle btn btn-inverse h-40 w-40 btn-round text-center text-primary ml-10 p-0 border-0 float-right"><i class="material-icons ml-5 mt-5" style="font-size: 20px">create</i></button>
                        </div>
                        <div class="card-block p-0">
                            <p data-info-type="phone" class="mb-10 text-nowrap">
                                <i class="icon md-account mr-10"></i>
                                <span class="text-break">00971123456789</span>
                            </p>
                            <p data-info-type="email" class="mb-10 text-nowrap">
                                <i class="icon md-email mr-10"></i>
                                <span class="text-break">malinda.h@gmail.com</span>
                            </p>
                            <p data-info-type="fb" class="mb-10 text-nowrap">
                                <i class="icon bd-facebook mr-10"></i>
                                <span class="text-break">malinda.hollaway</span>
                            </p>
                            <p data-info-type="twitter" class="mb-10 text-nowrap">
                                <i class="icon bd-twitter mr-10"></i>
                                <span class="text-break">@malinda (twitter.com/malinda)</span>
                            </p>
                            <p data-info-type="address" class="mb-10 text-nowrap">
                                <i class="icon md-pin mr-10"></i>
                                <span class="text-break">44-46 Morningside Road,Edinburgh,Scotland</span>
                            </p>
                            <p data-info-type="address" class="mb-10 text-nowrap">
                                <i class="icon md-pin mr-10"></i>
                                <span class="text-break">44-46 Morningside Road,Edinburgh,Scotland</span>
                            </p>
                            <p data-info-type="address" class="mb-10 text-nowrap">
                                <i class="icon md-pin mr-10"></i>
                                <span class="text-break">44-46 Morningside Road,Edinburgh,Scotland</span>
                            </p>
                            <p data-info-type="address" class="mb-10 text-nowrap">
                                <i class="icon md-pin mr-10"></i>
                                <span class="text-break">44-46 Morningside Road,Edinburgh,Scotland</span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-shadow p-20">
                        <div class="card-header card-header-transparent">
                            <h4 class="mb-0">Recent Activity</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-full">
                                <li class="list-group-item">
                                    <h5 class="mt-0 mb-5">Crystal Bates</h5>
                                    <p>Porta ac consectetur ac. Porta ac consectetur ac.</p>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="mt-0 mb-5">Crystal Bates</h5>
                                    <p>Porta ac consectetur ac. Porta ac consectetur ac.</p>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="mt-0 mb-5">Crystal Bates</h5>
                                    <p>Porta ac consectetur ac. Porta ac consectetur ac.</p>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection