@extends('layouts.master')

@section('admin_content')

<div class="right_col" role="main">
  <div class="page-title">
              <div class="title_left">
                <h3>Cars For Sale</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Cars Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{route('sellingcar.form')}}" class="btn btn-primary">Add Car For Sale</a>
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
                                <th>SN

                              </th>
                              <th>Car Details</th>
                              <th>Current Market Price (Rs.)</th>
                              <th>Additional details</th>
                              <th>Seller details</th>
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
                                  <strong>BRAND: {{$list->car->brand}} </strong> <br>
                                  <strong>MODEL: {{$list->car->model}} </strong><br>
                                  <strong>VERSION: {{$list->car->version}} </strong><br>
                                  <strong>KM RUN: {{$list->kms_run}} </strong><br>
                                  <strong>ENGINE CC: {{$list->car->version}} </strong><br>
                                  <strong>CAR STATUS: {{$list->car_status}} </strong><br>
                                  <strong>MANUFACTURED: {{$list->make_year}}</strong><br>
                                  <strong>COLOR: {{$list->color}}</strong><br>
                                </td>
                                  <td>
                                    {{number_format((float)$list->car->current_mp,2)}} <br>
                                    Asked Price: Rs. {{number_format((float)$list->asking_price,2)}}
                                  </td>
                                  <td>{{$list->additional_details}}<br></td>
                                  <td>
                                    <strong>SELLER NAME: {{isset($list->seller->name)? $list->seller->name :""}}</strong><br>
                                    <strong>CONTACT NO: {{isset($list->seller->number)? $list->seller->number :""}}</strong><br>
                                    <strong>LOCATION: {{isset($list->seller->location)? $list->seller->location :""}}</strong><br>

                                  </td>

                                  <td>
                                    <a href="{{route('sellingcar.edit', $list->id)}}" title="Edit" id="editCategory" class="btn btn-success">
                                        <i class="fa fa-edit"></i></a>
                                        </i>
                                        <a href="{{route('sellingcar.delete', $list->id)}}" class="btn btn-danger">
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
