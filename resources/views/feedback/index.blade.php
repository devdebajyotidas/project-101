@extends('layouts')
@section('page')
    <style>
        .page-header{
            z-index: 999 !important;
        }
        .page-header .dropdown-menu{
            left:-115px !important;
        }
        .page-header-actions .btn-icon:last-child{
            margin-right: 0 !important;
        }
        .page-header-actions{
            margin-right: -10px;
            margin-top: 20px;
        }
        #provider-container .card{
            transition: all 0.3s ease-out;
        }
        #provider-container .card:hover{
            text-decoration: none;
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
                left:-115px !important;
            }
            .page-header-actions{
                margin-right: -10px;
                margin-top: -40px;
            }
        }
        @media  screen and (max-width: 480px) {
            .page-header{
                padding: 20px 10px !important;
            }
            .page-header-actions{
                margin-top: -30px !important;
            }
        }
    </style>
    <div class="page">
        <div class="page-header">
            <div class="row">
                <div class="col-md-3">
                    <h1 class="page-title">Abuse reports - <small class="grey-500 total-result-count">0</small></h1>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-header-actions">
                                <div class="inline-block">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic" data-toggle="dropdown"  id="sortDropdown" aria-expanded="false">
                                        <i class="icon md-sort-asc"></i>
                                    </button>
                                    <ul class="dropdown-menu animation-scale-up animation-top-right animation-duration-250 w-200"
                                        role="menu"  aria-labelledby="sortDropdown">
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-3" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="created_at asc"
                                            />
                                            <label for="rad-3">Newest</label>
                                        </li>
                                        <li class="dropdown-item">
                                            <input type="radio" class="icheckbox-primary" id="rad-4" name="sort"
                                                   data-plugin="iCheck" data-radio-class="iradio_flat-blue" value="created_at desc"
                                            />
                                            <label for="rad-4">Oldest</label>
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
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="blocked"
                                            />
                                            <label for="checkbox-1">Show blocked</label>
                                        </li>
                                        <li class="dropdown-item text-left">
                                            <input type="checkbox" class="icheckbox-primary" id="checkbox-2" name="filter"
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="not_blocked"
                                            />
                                            <label for="checkbox-2">Show not blocked</label>
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
            <div class="row" id="feedback-container">
               {!! isset($feedbacks) ? $feedbacks : '<h3 class="p-20 text-danger">No Feedback available</h3>' !!}
            </div>
            <div class="row text-center more-button-container" style="display: none">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-primary btn-round" id="more-button"><i class="icon md-long-arrow-down" aria-hidden="true"></i> <span class="total-count">More</span> </button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="total_feedback" value="0">
    <script>
        window.onload=function(){
            $(function(){
                updateTotalCount();
                showMoreButton();
            })

            var timer;
            var timeout = 1000;

            $('#inputSearch').keyup(function(){
                clearTimeout(timer);
                if ($('#inputSearch').val) {
                    timer = setTimeout(function(){
                        $('#feedback-container').empty();
                        loadResult();
                    }, timeout);
                }
            });

            $('input[type="radio"]').on('ifChecked', function(){
                $('#feedback-container').empty();
                loadResult();
            });

            $('input[type="checkbox"]').on('ifChanged',function(){
                $('#feedback-container').empty();
                loadResult();
            })

            $('#more-button').click(function(){
                loadResult();
            })

            $('#feedback-container').on('click','.toggle-block',function(){
                var id=$(this).data('user');
                var status=($(this).text()).toLowerCase();
                var url="{{url('customer')}}/"+id+"/block";
                var message="Are you sure?"
                alertify.confirm(message, function () {
                    $.post(url,{'status':status},function(response){
                        alertify.logPosition("bottom right");
                        if(response.status){
                            $('#feedback-container').empty();
                            loadResult();
                            alertify.success(response.message);
                        }
                        else{
                            alertify.error(response.message);
                        }
                    })
                });

            })

            function loadResult(){
                NProgress.start();
                var url="{{url('feedback/load/result')}}";
                var sort=$("input[name='sort']:checked").val();
                if(!sort || sort=='undefined')sort='';
                var filter= $("input[name='filter']:checked")
                    .map(function(){return $(this).val();}).get().join(',');
                var offset=$('.page-content').find('.card-col').length;
                var formdata="sort="+sort+"&filter="+filter+"&offset="+offset;
                $.post(url,formdata,function(response){
                    NProgress.done();
                    $('#feedback-container').append(response);
                    updateTotalCount();
                    showMoreButton();
                })
            }

            function showMoreButton(){
                var total=$('#total_feedback').val();
                var offset=$('.page').find('.card-col').length;
                var left=parseInt(total) - parseInt(offset);
                if(left > 0){
                    $('.more-button-container').show().find('.total-count').html(left+" More")
                }
                else{
                    $('.more-button-container').hide();
                }
            }

            function updateTotalCount(){
                var last=$('.total-result:last').val();
                $('#total_feedback').val(last);
                $('.total-result-count').html(last);
            }

        }


    </script>
@endsection