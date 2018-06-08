@if(isset($providers) && count($providers) > 0)
    @foreach($providers as $provider)
        <?php
        $now=\Carbon\Carbon::now();
        $updated=new \Carbon\Carbon($provider->created_at);
        $imageurl=url('uploads').'/';
        if(isset($provider->activity[0]->created_at)){
            $active=new \Carbon\Carbon($provider->activity[0]->created_at);
            $lastactive=$active->diffForHumans($now);
        }
        else{
            $lastactive='Last active n/a';
        }
        $city=$provider->city;
        ?>
        <div  class="col-md-3 provider-col">
            <a href="{{url('providers/profile').'/'.$provider->id}}" class="card card-shadow h-350 white">
                <div class="card-block p-20">
                    <div class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                        <img src="{{!empty($provider->photo) ? $provider->photo : $imageurl.'default-avatar.png'  }}" alt="">
                    </div>
                </div>
                <div class="card-block grey-700">
                    <h4 class="card-title">{{!empty($provider->name) ? ucwords($provider->name) : 'No Name' }}</h4>
                    <span class="mt-3 mb-3 block blue-900 location-link" data-city="{{$city}}" data-lat="{{$provider->latitude}}" data-lon="{{$provider->longitude}}" data-type="provider">{{!empty($provider->city) ? $provider->city : 'City n/a'}}</span>
                    <span class="block mt-3 mb-3">{{strtolower($provider->email)}}</span>
                    <span class="block mt-3 mb-3">{{$provider->mobile}}</span>
                    <span class="block mt-3 mb-3">{{$lastactive}}</span>
                    <span class="card-text mt-3 mb-3">
                <small class="text-muted">Joined {{($updated->diff($now)->days < 1) ? 'today' : $updated->diffForHumans($now)}}</small>
            </span>
                </div>
            </a>
        </div>
    @endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@endif
