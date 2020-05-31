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
                <h3>Cars</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add New Car</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="locationForm" method="POST" action="{{ route('car.store') }}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                      {{ csrf_field() }}

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="brand">Brand<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="brand" required="required" name="brand" class="form-control">
                            @if ($errors->has('brand'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('brand') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="model" required="required" name="model" class="form-control">
                            @if ($errors->has('model'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('model') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="version">Version <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="text" id="version" name="version" class="form-control">
                          @if ($errors->has('version'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('version') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="current_mp">Price (Rs.) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" step="0.01" id="current_mp" name="current_mp" required="required" class="form-control">
                          @if ($errors->has('price'))
                              <span class="help-block" style="color: red;">
                                <strong>{{ $errors->first('price') }}</strong>
                              </span>
                            @endif
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Features <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea id="features" type="text" class="form-control" rows="6" cols="50"
                                        name="features" value="{{ old('features') }}" required autofocus></textarea>
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
