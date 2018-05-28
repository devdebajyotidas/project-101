@if(isset($providers) && count($providers) > 0)
    @foreach($providers as $provider)
    <?php
    $now=\Carbon\Carbon::now();
    $updated=new \Carbon\Carbon($provider->updated_at);
    $imageurl=url('uploads').'/';
    ?>
 <div  class="col-md-3 provider-col">
    <a href="{{url('providers/profile').'/'.$provider->account_id}}" class="card card-shadow h-350 white">
        <div class="card-block p-20">
            <div class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                <img src="{{!empty($provider->account->photo) ? $provider->account->photo : $imageurl.'default-avatar.png'  }}" alt="">
            </div>
        </div>
        <div class="card-block text-info">
            <h4 class="card-title">{{!empty($provider->name) ? ucwords($provider->name) : 'No Name' }}</h4>
            <p class="card-text">{{strtolower($provider->email)}}</p>
            <p class="card-text">{{$provider->mobile}}</p>
            <p class="card-text">
                <small class="text-muted">Last updated {{($updated->diff($now)->days < 1) ? 'today' : $updated->diffForHumans($now)}}</small>
            </p>
        </div>
    </a>
</div>
@endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@endif
