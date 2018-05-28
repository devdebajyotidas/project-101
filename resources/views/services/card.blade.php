@if(isset($services) && count($services) > 0)
    @foreach($services as $service)
        <?php
        $imageurl=url('uploads/service').'/';
        $now=\Carbon\Carbon::now();
        $created=new \Carbon\Carbon($service->created_at);
        $deleted=isset($service->deleted_at) ? $service->deleted_at : null;
        ?>
        <div class="col-xl-4 col-lg-6 ">
            <div class="card card-inverse card-shadow bg-white" id="{{$service->id}}">
                <div class="card-block p-30 overlay overlay-hover">
                    <div class="avatar avatar-100 avatar-square float-left  mr-10">
                        <img class="img-fluid service-image" src="{{!empty($service->image) ? $imageurl.$service->image : $imageurl.'default-service.png'}}" alt="">
                    </div>
                    <div class="vertical-align text-left h-100 text-truncate">
                        <div class="vertical-align-middle">
                            <div class="font-size-20 mb-5 blue-600 text-truncate service-name">{{$service->name}}</div>
                            <div class="font-size-14 text-truncate">{{$service->usage}} usage</div>
                            <div class="font-size-14 text-truncate {{empty($deleted) ? "text-success" : "text-danger"}}">{{empty($deleted) ? "Active" : "Archived"}}</div>
                            <div class="text-truncate">
                                <small class="text-muted">Added {{($created->diff($now)->days < 1) ? 'today' : $created->diffForHumans($now)}}</small>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-inverse h-40 w-40 btn-round p-0 mr-20  text-primary edit-service" title="Edit"><i style="line-height: 40px" class="material-icons">edit</i></button>
                @if(empty($deleted))
                        <button class="btn btn-inverse h-40 w-40 btn-round p-0 mr-10 text-primary toggle-service-action"  data-action="archive" title="Archive"><i style="line-height: 40px" class="material-icons">archive</i></button>
                    @else
                        <button class="btn btn-inverse h-40 w-40 btn-round p-0 mr-10 text-primary toggle-service-action" data-action="restore" title="Restore"><i style="line-height: 40px" class="material-icons">unarchive</i></button>
                    @endif

                    <a href="{{url('reports/service').'/'.$service->id}}"  class="btn btn-inverse h-40 w-40 btn-round p-0 ml-5 text-primary" title="Reports"><i style="line-height: 40px" class="material-icons">bar_chart</i></a>
                </div>
            </div>
        </div>
    @endforeach
    <input type="hidden"  class="total-result" value="{{$total_result}}">
@endif