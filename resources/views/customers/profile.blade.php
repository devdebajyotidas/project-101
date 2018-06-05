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
                        <?php
                        $address=null;
                        if(isset($info) && !empty($info)){
                            $address.=!empty($info->account->address) ? $info->account->address : 'N/A';
                            $address.=!empty($info->account->city) ? ' ,'.$info->account->city: '' ;
                            $address.=!empty($info->account->state) ? ' ,'.$info->account->state: '' ;
                            $address.=!empty($info->account->zip) ? ' - '.$info->account->zip: '' ;

                            $now=\Carbon\Carbon::now();
                            $created=new \Carbon\Carbon($info->created_at);
                            $imageurl=url('uploads').'/';
                            $image=!empty($info->account->photo) ? $info->account->photo : $imageurl.'default-avatar.png';
                        }
                        ?>
                        <div class="card-block">
                            <div class="avatar  avatar-100">
                                <img src="{{$image}}" alt="...">
                            </div>
                            <h4 class="profile-user mt-15">{{isset($info->name) ? ucwords($info->name) : 'N/A'}}</h4>
                            <p class="profile-job">{{$address}}</p>
                            <p class="profile-job">{{isset($info->email) ? $info->email  : 'N/A'}}</p>
                            <p class="profile-job">{{isset($info->mobile) ? $info->mobile  : 'N/A'}}</p>
                            <p class="profile-job">Aadhaar: {{isset($info->account) ? !empty($info->account->aadhaar) ? $info->account->aadhaar : 'N/A' : 'N/A' }}</p>
                            @if(isset($info->account->is_blocked) && $info->account->is_blocked==0 )
                                <p class="profile-job text-success">Active</p>
                            @else
                                <p class="profile-job text-warning">Blocked</p>
                            @endif

                            <p class="profile-job">Joined {{($created->diff($now)->days < 1) ? 'today' : $created->diffForHumans($now)}}</p>
                        </div>
                        <div class="card-footer">
                            <div class="row no-space">
                                <div class="col-6">
                                    <strong class="profile-stat-count">{{isset($total_connects) ? $total_connects : 0}}</strong>
                                    <span>Connects</span>
                                </div>
                                <div class="col-6">
                                    <strong class="profile-stat-count">{{isset($total_services) ? $total_services : 0}}</strong>
                                    <span>Services Taken</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Friend List -->
                </div>
                <div class="col-lg-6 col-xl-3 ">
                    <div class="user-friends card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title mb-20">
                                Recent Connects
                            </h4>
                            <ul class="list-group list-group-full m-0">
                                @if(isset($connects) && count($connects) > 0)
                                    @foreach($connects as $connect)
                                        <?php
                                        $con_status=$connect->taker[0]->is_blocked == 0 ? 'avatar-online' : 'avatar-busy';
                                        $con_created=new \Carbon\Carbon($connect->created_at);
                                        $con_image=!empty($connect->taker[0]->photo) ? $connect->taker[0]->photo : $imageurl.'default-avatar.png';

                                        ?>
                                        <li class="list-group-item">
                                            <div class="media">
                                                <div class="pr-20">
                                                    <a  class="avatar {{$con_status}}" href="{{url('customers').'/'.$connect->taker[0]->id}}">
                                                        <img class="img-fluid" src="{{$con_image}}" alt="...">
                                                        <i></i>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="mt-0 mb-5 hover">
                                                        {{isset($connect->taker[0]->user) ? ucwords($connect->taker[0]->user->name) : 'N/A' }}
                                                    </h5>
                                                    <small>{{($con_created->diff($now)->days < 1) ? 'today' : $con_created->diffForHumans($now)}}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item "><h5 class="text-info">No connects available</h5></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-6 ">
                    <div class="user-friends card card-shadow">
                        <div class="card-block">
                            <h4 class="card-title mb-20">
                                Recent Service History
                            </h4>
                            <ul class="list-group list-group-full m-0">

                                @if(isset($serviceTakens) && count($serviceTakens) > 0)
                                    @foreach($serviceTakens as $st)
                                        <?php
                                        $now=\Carbon\Carbon::now();
                                        $created=new \Carbon\Carbon($st->created_at);
                                        $imageurl=url('uploads').'/';
                                        $image=!empty($st->account[0]->photo) ? $st->account[0]->photo : $imageurl.'default-avatar.png';

                                        $stu_status=$st->account[0]->is_blocked == 0 ? 'avatar-online' : 'avatar-busy';

                                        $completed_at=empty($st->completed_at) ? date('Y-m-d H:i:s') : $st->completed_at;
                                        $d1= \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$completed_at);
                                        $d2= \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s',$st->created_at);
                                        $interval= $d1->diff($d2);
                                        $duration=($interval->days * 24) + $interval->h;
                                        ?>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="media">
                                                        <div class="pr-20">
                                                            <a class="avatar {{$stu_status}}" href="{{url('customers').'/'.$st->account[0]->id}}">
                                                                <img class="img-fluid" src="{{$image}}" alt="...">
                                                                <i></i>
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-5 hover">
                                                                {{isset($st->account[0]->user) ? ucwords($st->account[0]->user->name) : 'N/A' }}
                                                            </h5>
                                                            <small>{{!empty($st->account[0]->address) ? $st->account[0]->address : 'N/A'}} {{!empty($st->account[0]->city) ? ' ,'.$st->account[0]->city : ''}} {{!empty($st->account[0]->zip) ? ' - '.$st->account[0]->zip : ''}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <h5 class="mt-0 mb-5 text-primary">
                                                        &#8377; {{isset($st->amount) ? $st->amount : 0 }}
                                                    </h5>
                                                    <small>{{$duration}} hours</small>
                                                </div>
                                                <div class="col-md-2">
                                                    @if(!empty($st->completed_at))
                                                        <span class="badge badge-outline badge-success">Completed</span>
                                                    @else
                                                        <span class="badge badge-outline badge-info">Ongoing</span>
                                                    @endif

                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="media">
                                                    <h5 class="text-info">No service history found</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection