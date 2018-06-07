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
            left:-100px !important;
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

        .location-link{
            cursor: pointer;
        }
        .location-link:hover{
            text-decoration: underline;
        }
        @media  screen and (max-width: 980px) {
            .page-header .row .col-md-3{
                margin-bottom: 20px !important;
            }
            .page-header .dropdown-menu{
                left:-115px !important;
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
                    <h1 class="page-title">Providers</h1>
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
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="email_verified"
                                            />
                                            <label for="checkbox-1">Email verified</label>
                                        </li>
                                        <li class="dropdown-item text-left">
                                            <input type="checkbox" class="icheckbox-primary" id="checkbox-2" name="filter"
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="mobile_verified"
                                            />
                                            <label for="checkbox-2">Mobile verified</label>
                                        </li>
                                        <li class="dropdown-item text-left">
                                            <input type="checkbox" class="icheckbox-primary" id="checkbox-3" name="filter"
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="aadhaar_verified"
                                            />
                                            <label for="checkbox-3">Aadhaar verified</label>
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
            <div class="row" id="provider-container">
               {!! isset($providers) ? $providers : 'No result found' !!}
            </div>
            <div class="row text-center more-button-container" style="display: none">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-primary btn-round" id="more-button"><i class="icon md-long-arrow-down" aria-hidden="true"></i> <span class="total-count">More</span> </button>
                </div>
            </div>
        </div>

    </div>
    <input type="hidden" id="total_provider" value="0">
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
                        $('#provider-container').empty();
                        loadResult();
                    }, timeout);
                }
            });

            $('input[type="radio"]').on('ifChecked', function(){
                $('#provider-container').empty();
                loadResult();
            });

            $('input[type="checkbox"]').on('ifChanged',function(){
                $('#provider-container').empty();
                loadResult();
            })

            $('#more-button').click(function(){
                loadResult();
            })

            $('body').on('click','.location-link',function(e){
                e.stopImmediatePropagation();
                e.preventDefault();
                var lat=$(this).data('lat');
                var lon=$(this).data('lon');
                var type=$(this).data('type');
                var city=$(this).data('city');
                window.open("{{url('home/map/locate?lat=')}}"+lat+"&lon="+lon+"&city="+city+"&type="+type,'_blank');
            })

            function loadResult(){
                NProgress.start();
                var url="{{url('providers/load/result')}}";
                var search=$('#inputSearch').val();
                var sort=$("input[name='sort']:checked").val();
                if(!sort || sort=='undefined')sort='';
                var filter= $("input[name='filter']:checked")
                    .map(function(){return $(this).val();}).get().join(',');
                var offset=$('.page-content').find('.provider-col').length;
                var formdata="search="+search+"&sort="+sort+"&filter="+filter+"&offset="+offset;
                $.post(url,formdata,function(response){
                    NProgress.done();
                    $('#provider-container').append(response);
                    updateTotalCount();
                    showMoreButton();
                })
            }

            function showMoreButton(){
                var total=$('#total_provider').val();
                var offset=$('.page').find('.provider-col').length;
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
            }

        }


    </script>
@endsection
