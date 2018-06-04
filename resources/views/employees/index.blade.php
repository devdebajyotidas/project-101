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
                    <h1 class="page-title">Employees - <small class="grey-500 total-result-count">0</small></h1>
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
                                <button type="button" class="btn btn-sm btn-icon btn-raised btn-primary btn-round waves-effect waves-classic add-employee" data-target="#employeeModal" data-toggle="modal">
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
                                                   data-plugin="iCheck" data-checkbox-class="icheckbox_flat-blue" value="invited"
                                            />
                                            <label for="checkbox-1">Show invited</label>
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
            <div class="row" id="employee-container">
                {!! isset($employees) ? $employees : 'No result found' !!}
            </div>
            <div class="row text-center more-button-container" style="display: none">
                <div class="col-lg-12 text-center">
                    <button type="button" class="btn btn-primary btn-round" id="more-button"><i class="icon md-long-arrow-down" aria-hidden="true"></i> <span class="total-count">0</span> More </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="employeeModal" aria-hidden="true" aria-labelledby="employeeModal" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Invite Employee</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" id="inviationForm" name="employeeForm" onsubmit="return false;" enctype="multipart/form-data">
                        <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="name" />
                            <label class="floating-label">Name</label>
                        </div>
                        <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="email" class="form-control" name="email" />
                            <label class="floating-label">Email</label>
                        </div>
                        <div class="form-group form-material floating" data-plugin="formMaterial">
                            <input type="text" class="form-control" name="mobile" />
                            <label class="floating-label">Mobile</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary font-weight-500 text-uppercase" id="sendInvite">Send</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <input type="hidden" id="total_employee" value="0">
    <script>
        window.onload=function(){
            $(function(){
                updateTotalCount();
            })

            var timer;
            var timeout = 1000;

            $('#inputSearch').keyup(function(){
                clearTimeout(timer);
                if ($('#inputSearch').val) {
                    timer = setTimeout(function(){
                        $('#employee-container').empty();
                        loadResult();
                    }, timeout);
                }
            });

            $('input[type="radio"]').on('ifChecked', function(){
                $('#employee-container').empty();
                loadResult();
            });

            $('input[type="checkbox"]').on('ifChanged',function(){
                $('#employee-container').empty();
                loadResult();
            })

            $('#sendInvite').click(function(){
                NProgress.start();
                var formdata=$('#inviationForm').serialize();
                var url="{{url('employees/invite')}}";
                $.post(url,formdata,function(response){
                    alertify.logPosition("bottom right");
                    if(response.status){
                        $('#employeeModal').modal('hide');
                        $('#inviationForm')[0].reset();
                        alertify.success(response.message)
                    }
                    else{
                        alertify.error(response.message)
                    }
                    NProgress.done();
                })
            });

            function loadResult(){
                NProgress.start();
                var url="{{url('employees/load/result')}}";
                var search=$('#inputSearch').val();
                var sort=$("input[name='sort']:checked").val();
                if(!sort || sort=='undefined')sort='';
                var filter=$("input[name='filter']:checked").val();
                var formdata="search="+search+"&sort="+sort+"&filter="+filter;
                $.post(url,formdata,function(response){
                    console.log(response);
                    NProgress.done();
                    $('#employee-container').append(response);
                    updateTotalCount();
                }).fail(function(xhr){
                    console.log(xhr.responseText);
                })
            }


            function updateTotalCount(){
                var last=$('.total-result:last').val();
                $('#total_employee').val(last);
                $('.total-result-count').html(last);
            }
        }
    </script>
@endsection
