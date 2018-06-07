@if(isset($customers) && count($customers) > 0)
    @foreach($customers as $customer)
    <?php
    $now=\Carbon\Carbon::now();
    $updated=new \Carbon\Carbon($customer->created_at);
    $imageurl=url('uploads').'/';
    if(isset($customer->activity[0]->created_at)){
        $active=new \Carbon\Carbon($customer->activity[0]->created_at);
        $lastactive=$active->diffForHumans($now);
    }
    else{
        $lastactive='Last active n/a';
    }
    $city=$customer->city;
    ?>
 <div  class="col-md-3 customer-col">
    <a href="{{url('customer/profile').'/'.$customer->id}}" class="card card-shadow h-350 white">
        <div class="card-block p-20">
            <div class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                <img src="{{!empty($customer->photo) ? $customer->photo : $imageurl.'default-avatar.png'  }}" alt="">
            </div>
        </div>
        <div class="card-block grey-700">
            <h4 class="card-title">{{!empty($customer->name) ? ucwords($customer->name) : 'No Name' }}</h4>
            <span class="mt-3 mb-3 block blue-900 location-link" data-city="{{$city}}" data-lat="{{$customer->latitude}}" data-lon="{{$customer->longitude}}" data-type="customer">{{!empty($customer->city) ? $customer->city : 'City n/a'}}</span>
            <span class="block mt-3 mb-3">{{strtolower($customer->email)}}</span>
            <span class="block mt-3 mb-3">{{$customer->mobile}}</span>
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
