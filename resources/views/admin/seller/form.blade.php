@extends('layouts.master')

@section('admin_content')
<style type="text/css">
  .file-drop-area{
  display: block;
  padding: 2em;
  background: #eee;
  text-align: center;
  cursor: pointer;
}
</style>

<div class="right_col" role="main">
  <div class="page-title">
              <div class="title_left">
                <h3>Sellers</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Seller</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="locationForm" method="POST" action="{{ route('seller.store') }}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                      {{ csrf_field() }}

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="brand">Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="name" required="required" name="name" class="form-control">
                            @if ($errors->has('name'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('name') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Location <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="location" required="required" name="location" class="form-control">
                            @if ($errors->has('location'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('location') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="password" id="password" required="required" name="password" class="form-control">
                            @if ($errors->has('password'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('password') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="email" id="email" name="email" class="form-control">
                          @if ($errors->has('email'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('email') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="current_mp">Contact Number<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="number" name="number" required="required" class="form-control">
                          @if ($errors->has('number'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('number') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>



                      <div class="item form-group">
                        <div class="col-md-10 col-sm-10 offset-7">
                          <a href="{{ url()->previous() }}" class="btn btn-primary" type="button">Close</a>

                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('custom_script')

<script type="text/javascript" src="{{asset('slim/multipleuploader.js')}}"></script>



@endsection
