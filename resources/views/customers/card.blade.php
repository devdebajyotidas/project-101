@if(isset($customers) && count($customers) > 0)
    @foreach($customers as $customer)
    <?php
    $now=\Carbon\Carbon::now();
    $updated=new \Carbon\Carbon($customer->created_at);
    $imageurl=url('uploads').'/';
    ?>
 <div  class="col-md-3 customer-col">
    <a href="{{url('customer/pr').'/'.$customer->account_id}}" class="card card-shadow h-350 white">
        <div class="card-block p-20">
            <div class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                <img src="{{!empty($customer->account->photo) ? $customer->account->photo : $imageurl.'default-avatar.png'  }}" alt="">
            </div>
        </div>
        <div class="card-block text-info">
            <h4 class="card-title">{{!empty($customer->name) ? ucwords($customer->name) : 'No Name' }}</h4>
            <p class="card-text">{{strtolower($customer->email)}}</p>
            <p class="card-text">{{$customer->mobile}}</p>
            <p class="card-text">
                <small class="text-muted">Last updated {{($updated->diff($now)->days < 1) ? 'today' : $updated->diffForHumans($now)}}</small>
            </p>
        </div>
    </a>
</div>
@endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@endif
