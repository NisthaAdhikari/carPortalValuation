@extends('layouts.master')

@section('admin_content')

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
                    <h2>Cars Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{route('car.form')}}" class="btn btn-primary">Add New Car</a>
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="x_content bs-example-popovers">

                      @if(Session::has('flash_message'))
                        <div class="alert alert-info " role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          {{ Session::get('flash_message') }}
                        </div>
                      @endif

                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <table id="datatable" class="table table-hover table-bordered" style="width:100%">
                            <thead>
                              <tr>
                                <th>SN</th>
                              <th>Car Details</th>
                              <th >Current Market Price (Rs.)</th>
                              <th>Features</th>
                              <th>Action

                              </th>
                              </tr>
                            </thead>

                            <tbody>
                              @if($cars)
                                @foreach($cars as $key => $list)
                                <tr>
                                  <td>{{++$key}}</td>
                                 <td id="">
                                  <strong>BRAND: {{$list->brand}} </strong> <br>
                                  <strong>MODEL: {{$list->model}} </strong>
                                </td>
                                  <td>
                                    {{number_format((float)$list->current_mp,2)}}
                                  </td>
                                  <td>{{$list->features}}<br></td>

                                  <td><a href="{{route('car.edit', $list->id)}}" title="Edit" id="editCategory" class="btn btn-success">
                                      <i class="fa fa-edit"></i></a>
                                      </i>
                                        <a href="{{route('car.delete', $list->id)}}" class="btn btn-danger">
                                          <i class="fa fa-trash"> </i></a>
                                  </td>
                                </tr>
                                @endforeach
                              @endif

                            </tbody>
                          </table>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@section('custom_script')


@endsection
