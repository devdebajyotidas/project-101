@if(isset($shouts))
    @foreach($shouts as $shout)
        <?php
        if(!empty($shout->taken_by)){
            $taken_by=ucwords($shout->provider[0]->user->name);
            $taker_link=url('providers').'/'.$shout->provider[0]->id;
        }
        else{
            $taken_by='Nobody';
            $taker_link='javascript:void(0)';
        }

        if(!empty($shout->user_id)){
            $shouted_by=ucwords($shout->taker[0]->user->name);
            $shout_link=url('customers').'/'.$shout->taker[0]->id;
        }
        else{
            $shouted_by="Nobody";
            $shout_link='javascript:void(0)';
        }

        $now=\Carbon\Carbon::now();
        $created=new \Carbon\Carbon($shout->created_at);
        $imageurl=url('uploads/service').'/';

        ?>
        <div  class="col-md-3 provider-col">
            <div class="card card-shadow white">
                <div class="card-block p-20">
                    <div class="avatar avatar-100 avatar-square float-left mr-20" href="javascript:void(0)">
                        <img src="{{$imageurl.$shout->image  }}" alt="">
                    </div>
                </div>
                <div class="card-block h-170 text-dark">
                    <h4 class="card-title">{{$shout->name}}</h4>
                    <p>{{!empty($shout->area) ? $shout->area : 'Not available'}}</p>
                    <p>Shouted By : <a href="{{$shout_link}}">{{$shouted_by}}</a></p>
                    <p>Taken by : <a href="{{$taker_link}}">{{$taken_by}}</a></p>
                    <p class="card-text">
                        <small class="text-muted">{{($created->diff($now)->days < 1) ? 'Today' : $created->diffForHumans($now)}}</small>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@endif
