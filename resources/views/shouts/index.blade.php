@extends('layouts')
@section('page')
    <style>
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
                    <h1 class="page-title">Shouts - <small class="grey-500 total-result-count">0</small></h1>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="input-search ">
                                <i class="input-search-icon md-search" aria-hidden="true"></i>
                                <input type="text" class="form-control" id="inputSearch" name="search" placeholder="Search Users">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="page-header-actions">
                                <div class="inline-block">
                                    <button type="button" class="btn btn-sm btn-icon btn-primary btn-round waves-effect waves-classic date-range" data-target="#dateModal" data-toggle="modal">
                                        <i class="icon md-calendar"></i>
                                    </button>
                                </div>
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
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="taken"
                                            />
                                            <label for="checkbox-1">Show Taken</label>
                                        </li>
                                        <li class="dropdown-item text-left">
                                            <input type="checkbox" class="icheckbox-primary" id="checkbox-2" name="filter"
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="not_taken"
                                            />
                                            <label for="checkbox-2">Show not Taken</label>
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
            <div class="row" id="shout-container">
               {!! isset($shouts) ? $shouts : 'No shouts found' !!}
            </div>
            <div class="row text-center more-button-container" style="display: none">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-primary btn-round" id="more-button"><i class="icon md-long-arrow-down" aria-hidden="true"></i> <span class="total-count">More</span> </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dateModal" aria-hidden="true" aria-labelledby="dateModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Filter by date</h4>
                </div>
                <div class="modal-body">
                    <div class="row input-daterange text-left" data-plugin="datepicker">
                        <div class="col-md-6">
                            <div class="form-group form-material floating" data-plugin="formMaterial">
                                <input  type="text" class="form-control start-date" name="start_date" autocomplete="off" readonly />
                                <label class="floating-label">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-material floating" data-plugin="formMaterial">
                                <input  type="text" class="form-control end-date" name="end_date" autocomplete="off" readonly/>
                                <label class="floating-label">End Date</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure reset-date" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary font-weight-500 text-uppercase" id="dateApply">Apply</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script>
        window.onload=function(){

            $(function(){
                updateTotalCount();
            })

            $('.input-daterange input').each(function() {
                $(this).datepicker('clearDates');
            });

            var timer;
            var timeout = 1000;

            $('#inputSearch').keyup(function(){
                clearTimeout(timer);
                if ($('#inputSearch').val) {
                    timer = setTimeout(function(){
                        $('#shout-container').empty();
                        loadResult();
                    }, timeout);
                }
            });

            $('input[type="radio"]').on('ifChecked', function(){
                $('#shout-container').empty();
                loadResult();
            });

            $('input[type="checkbox"]').on('ifChanged',function(){
                $('#shout-container').empty();
                loadResult();
            });

            $('#more-button').click(function(){
                loadResult();
            })

            $('.reset-date').click(function(){
                $('.start-date').val('').trigger('change');
                $('.end-date').val('').trigger('change');
                $('#shout-container').empty();
                loadResult();
            });

            $('#dateApply').click(function(){
                $('#shout-container').empty();
                loadResult();
            })

            function loadResult(){
                NProgress.start();
                var url="{{url('shouts/load/result')}}";
                var search=$('#inputSearch').val();
                var sort=$("input[name='sort']:checked").val();
                if(!sort || sort=='undefined')sort='';
                var filter= $("input[name='filter']:checked")
                    .map(function(){return $(this).val();}).get().join(',');
                var start_date=$('.start-date').val();
                var end_date=$('.end-date').val();
                var offset=$('.page-content').find('.provider-col').length;
                var formdata="search="+search+"&sort="+sort+"&filter="+filter+"&start="+start_date+"&end="+end_date+"&offset="+offset;
                $.post(url,formdata,function(response){
                    NProgress.done();
                    console.log(response);
                    $('#shout-container').append(response);
                    updateTotalCount();
                    showMoreButton();
                }).fail(function(xhr){
                    console.log(xhr.responseText);
                })
            }

            function showMoreButton(){
                var total=$('#total_provider').val();
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
                $('#total_provider').val(last);
                $('.total-result-count').html(last);
            }
        }
    </script>
@endsection