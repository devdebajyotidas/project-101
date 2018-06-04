@if(isset($employees) && count($employees) > 0)
    @foreach($employees as $employee)
        <?php
        $now=\Carbon\Carbon::now();
        $updated=new \Carbon\Carbon($employee->created_at);
        $imageurl=url('uploads').'/';
        $photo=isset($employee->photo) ? $employee->photo : '';
        $account
        ?>
        <div  class="col-md-3 employee-col">
            <a href="{{isset($employee->account_id) ? url('employees/profile').'/'.$employee->account_id : 'javascript:void(0)'}}" class="card card-shadow h-350 white">
                <div class="card-block p-20">
                    <div class="avatar avatar-100 float-left mr-20" href="javascript:void(0)">
                        <img src="{{!empty($photo) ? $photo : $imageurl.'default-avatar.png'  }}" alt="">
                    </div>
                </div>
                <div class="card-block text-info">
                    <h4 class="card-title">{{!empty($employee->name) ? ucwords($employee->name) : 'No Name' }}</h4>
                    <p class="card-text">{{strtolower($employee->email)}}</p>
                    <p class="card-text">{{$employee->mobile}}</p>
                    @if(isset($employee->account_id))
                        <p class="card-text text-success">Active</p>
                    @else
                        <p class="card-text text-warning">Invited</p>
                    @endif
                    <p class="card-text">
                        <small class="text-muted">Last updated {{($updated->diff($now)->days < 1) ? 'today' : $updated->diffForHumans($now)}}</small>
                    </p>
                </div>
            </a>
        </div>
    @endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@else
    <div class="col-md-12 card card-shadow text-center p-20"><h4 class="text-danger">No results found</h4></div>
    <input type="hidden"  class="total-result" value="0">
@endif
