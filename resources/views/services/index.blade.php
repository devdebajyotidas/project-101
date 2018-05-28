@extends('layouts')
@section('page')
    <style>
        .icon{
            transform: rotate(0.03deg);
        }
        .page-header{
            z-index: 999 !important;
        }
        .page-header .dropdown-menu{
            left:-60px !important;
        }
        .page-header-actions .btn-icon:last-child{
            margin-right: 0 !important;
        }
        .page-header-actions{
            margin-right: -10px;
        }
        #service-container .card{
            transition: all 0.3s ease-out;
        }
        #service-container .card:hover{
            text-decoration: none !important;
            box-shadow: 0 2px 7px rgba(0,0,0,.14) !important;
            transition: all 0.3s ease-out;
        }

        .page-header .dropdown-menu .dropdown-item label{
            margin-bottom: 0;
            margin-left: 5px;
        }
        @media  screen and (max-width: 980px) {
            .page-header .row .col-md-3{
                margin-bottom: 20px !important;
            }
            .page-header .dropdown-menu{
                left:-75px !important;
            }
        }
        @media  screen and (max-width: 480px) {
            .page-header{
                padding: 20px 10px !important;
            }
            .page-header-actions{
                margin-top: -70px !important;
            }
        }
    </style>
    <div class="page">
        <div class="page-header">
            <div class="row">
                <div class="col-md-3">
                    <h1 class="page-title">Services - <small class="grey-500 total-result-count">0</small></h1>

                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="input-search ">
                                <i class="input-search-icon md-search" aria-hidden="true"></i>
                                <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="page-header-actions">
                                <button type="button" class="btn btn-sm btn-icon btn-raised btn-primary btn-round waves-effect waves-classic add-service" data-target="#serviceModal" data-toggle="modal">
                                    <i class="icon md-plus" aria-hidden="true"></i>
                                </button>
                                <div class="inline-block">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="dropdown"  id="sortDropdown" aria-expanded="false">
                                        <i class="icon md-sort-asc"></i>
                                    </button>
                                    <ul class="dropdown-menu animation-scale-up animation-top-right animation-duration-250 w-200"
                                        role="menu"  aria-labelledby="sortDropdown">
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-1" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="name asc" checked
                                            />
                                            <label for="rad-1">Name a-z</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-2" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="name desc"
                                            />
                                            <label for="rad-2">Name z-a</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-3" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="created_at desc"
                                            />
                                            <label for="rad-3">Newest</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-4" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="created_at asc"
                                            />
                                            <label for="rad-4">Oldest</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-4" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="usage desc"
                                            />
                                            <label for="rad-4">Usage High</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-4" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="usage asc"
                                            />
                                            <label for="rad-4">Usage Low</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="inline-block">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" id="filterDropdown"
                                            data-toggle="dropdown" aria-expanded="false">
                                        <i class="icon md-filter-list"></i>
                                    </button>
                                    <ul class="dropdown-menu animation-scale-up animation-top-right animation-duration-250 w-200"
                                        role="menu"  aria-labelledby="filterDropdown">
                                        <li class="dropdown-item text-left">
                                            <input type="checkbox" class="icheckbox-primary" id="checkbox-1" name="filter"
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="deleted_at"
                                            />
                                            <label for="checkbox-1">Show archived</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content container-fluid">
            <div class="row" id="service-container">
                {!! isset($services) ? $services : 'No service found' !!}
            </div>
            <div class="row text-center more-button-container" style="display: none">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-primary btn-round" id="more-button"><i class="icon md-long-arrow-down" aria-hidden="true"></i> <span class="total-count">More</span> </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="serviceModal" aria-hidden="true" aria-labelledby="serviceModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">New Service</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="serviceForm" name="serviceForm" onsubmit="return false;" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group text-center form-material floating" data-plugin="formMaterial">
                            <a class="avatar avatar-100 avatar-square bg-white mb-10 m-xs-0" href="javascript:void(0)">
                                <img id="serviceImageHolder" src="{{url('uploads/service')}}/default-service.png" alt="">
                            </a>
                            <input name="image" type="file" id="serviceImage" style="display: none" onchange="previewImage(this)" accept="*.png,*.jpeg,*.jpg">
                        </div>
                        <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="name" />
                            <label class="floating-label">Name</label>
                        </div>
                        <input type="hidden" name="id" id="serviceId">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary font-weight-500 text-uppercase" id="serviceSubmit">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!--Page Script-->
    <script>
        function previewImage(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#serviceImageHolder').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

       window.onload=function(){
           $(function(){
               updateTotalCount();
           })

           $('#serviceImageHolder').click(function(){
               $('#serviceImage').trigger('click');
           })

           $('#serviceSubmit').click(function(){
               var formdata=new FormData($('#serviceForm')[0]);
               var url="{{url('service/new')}}"
               $.ajax({
                   url:url,
                   type:'post',
                   data: formdata,
                   processData: false,
                   contentType: false,
                   async:false,
                   success:function(response){
                       NProgress.done();
                       if(response.status){
                           $('#service-container').empty();
                           $("#serviceModal").modal('hide');
                           resetForm();
                           loadResult();
                           alertify.logPosition("bottom right");
                           alertify.success(response.message)
                       }
                       else{
                           alertify.logPosition("bottom right");
                           alertify.error(response.message);
                       }
                   },
                   error:function(xhr){
                       console.log(xhr.responseText);
                   }
               })
           })

           var timer;
           var timeout = 1000;

           $('#inputSearch').keyup(function(){
               clearTimeout(timer);
               if ($('#inputSearch').val) {
                   timer = setTimeout(function(){
                       $('#service-container').empty();
                       loadResult();
                   }, timeout);
               }
           });

           $('input[type="radio"]').on('ifChecked', function(){
               $('#service-container').empty();
               loadResult();
           });

           $('input[type="checkbox"]').on('ifChanged',function(){
               $('#service-container').empty();
               loadResult();
           })

           function loadResult(){
               NProgress.start();
               var url="{{url('services/load/result')}}";
               var search=$('#inputSearch').val();
               var sort=$("input[name='sort']:checked").val();
               if(!sort || sort=='undefined')sort='';
               var filter= $("input[name='filter']:checked")
                   .map(function(){return $(this).val();}).get().join(',');
               var offset=$('.page-content').find('.provider-col').length;
               var formdata="search="+search+"&sort="+sort+"&filter="+filter+"&offset="+offset;
               $.post(url,formdata,function(response){
                   NProgress.done();
                   $('#service-container').append(response);
                   updateTotalCount();
               }).fail(function(xhr){
                   console.log(xhr.responseText);
               })
           }

           $('#service-container').on('click','.toggle-service-action',function(){
               var action=$(this).data('action');
               var id=$(this).parent().parent().attr('id');
               var url="{{url('services')}}"+'/'+id+'/archive';
               var message="All services linked with this will be "+action+'d';
               alertify.confirm(message, function () {
                   $.post(url,{'action':action},function(response){
                       alertify.logPosition("bottom right");
                       if(response.status){
                           $('#service-container').empty();
                           loadResult();
                           alertify.success(response.message);
                       }
                       else{
                           alertify.error(response.message);
                       }
                   }).fail(function(xhr){
                       console.log(xhr.responseText);
                   })
               });
           })

           $('#service-container').on('click','.edit-service',function(){
               initEditor($(this));
           });

           $('.add-service').click(function(){
               $('.modal-title').html('New Service');
               resetForm();
           })

           function resetForm(){
               $('#serviceForm')[0].reset();
               $('input[name="name"]').trigger('change');
               $('#serviceImageHolder').attr('src',"{{url('uploads/service')}}/default-service.png")
           }

           function updateTotalCount(){
               var count=$('.total-result:last').val();
               $('.total-result-count').html(count);
           }

           function initEditor($this){
               $('.modal-title').html('Update Service');
               $('#serviceModal').modal('show');
               var name=$this.parent().parent().find('.service-name').html();
               var img=$this.parent().parent().find('.service-image').attr('src');
               var id=$this.parent().parent().attr('id');
               $('#serviceImageHolder').attr('src',img);
               $('input[name="name"]').val(name).trigger('change');
               $('#serviceId').val(id);
           }

       }
    </script>
    <!--End Page Script-->
@endsection