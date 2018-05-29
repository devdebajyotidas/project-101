@if(!empty($feedbacks))
    @foreach($feedbacks as $feedback)
        <?php
        $now=\Carbon\Carbon::now();
        $created=new \Carbon\Carbon($feedback->created_at);
        $imageurl=url('uploads').'/';
        $status=$feedback->is_blocked ==0 ? 'block' : 'unblock';
        ?>
        <div class="col-lg-12 mb-20 card-col">
            <ul class="list-group list-group-full list-group-dividered card card-shadow m-0">
                <div class="card-body">
                    <li class="list-group-item pl-20 pr-20 border-0">
                        <div class="media">
                            <div class="pr-20 media-avatar">
                                <a class="avatar {{$feedback->is_blocked==1 ? 'avatar-busy' : 'avatar-online' }}" href="javascript:void(0)">
                                    <img src="{{!empty($feedback->taker[0]->user->photo) ? $feedback->taker[0]->user->photo : $imageurl.'default-avatar.png'  }}" alt=""><i></i></a>
                            </div>
                            <div class="media-body">
                                <h6 class="media-heading">{{$feedback->taker[0]->user->name}} <span class="badge btn btn-flat badge-outline toggle-block {{$feedback->is_blocked==0 ? 'badge-danger' : 'badge-success'}} vertical-align-middle ml-10" style="cursor: pointer" data-user="{{$feedback->taker[0]->id}}">{{ucfirst($status)}}</span></h6>
                                <p class="text-muted">
                                    <time>{{($created->diff($now)->days < 1) ? 'Today' : $created->diffForHumans($now)}}</time>
                                </p>
                                <p class="text-dark">{{$feedback->comment[0]->comment}}</p>
                                <p class="mb-0">Reported by <a href="{{url('providers').'/'.$feedback->provider[0]->id}}">{{$feedback->provider[0]->user->name}}</a></p>
                            </div>

                        </div>
                    </li>
                </div>
            </ul>
        </div>
    @endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@else
    <h3 class="p-20 text-danger">No feedback available</h3>
@endif