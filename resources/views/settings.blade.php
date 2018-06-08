@extends('layouts')
@section('page')
    <div class="page">
        <div class="page-header">
            <div class="row">
                <div class="col-md-3">
                    <h1 class="page-title">Admin Settings</h1>
                </div>
            </div>
        </div>
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-shadow">
                        <div class="card-block">
                            <h4>Service pre cancel keywords</h4>
                        </div>
                        <div class="card-block">
                            <form autocomplete="off">
                                <div class="form-group form-material" data-plugin="formMaterial">
                                    <label class="form-control-label" for="inputText">Keywords</label>
                                    <input type="text" class="form-control" id="inputText" name="inputText" data-plugin="tokenfield" placeholder="Press enter after inserting text"
                                    />
                                </div>
                            </form>
                        </div>
                        <div class="card-block">
                             <button class="btn btn-primary float-lg-right">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection