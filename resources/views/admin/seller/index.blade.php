@extends('layouts.master')

@section('admin_content')

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
                    <h2>Seller Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="{{route('seller.form')}}" class="btn btn-primary">Add Seller</a>
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
                              <th>Name</th>
                              <th>Location</th>
                              <th>Email</th>
                              <th>Contact Number</th>
                              <th>Action

                              </th>
                              </tr>
                            </thead>

                            <tbody>
                              @if($seller)
                                @foreach($seller as $key => $list)
                                <tr>
                                  <td>{{++$key}}</td>
                                  <td id="">
                                    {{ $list->name }}
                                   </td>
                                 <td id="">
                                 {{ $list->location }}
                                </td>
                                  <td>
                                    {{ $list->email }}
                                  </td>
                                  <td>{{ $list->number }}</td>

                                  <td><a href="{{route('seller.edit', $list->id)}}" title="Edit" id="editCategory" class="btn btn-success">
                                      <i class="fa fa-edit"></i></a>
                                      </i>
                                        <a href="{{route('seller.delete', $list->id)}}" class="btn btn-danger">
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
