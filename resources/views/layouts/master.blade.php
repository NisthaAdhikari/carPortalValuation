<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Car Portal With Valuation</title>

        <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


        <link rel="stylesheet" href="{{asset('slim/slim.min.css')}}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


        <link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
        <script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>

        <script src="https://code.highcharts.com/highcharts.js"></script>


        <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>


        <!-- Bootstrap -->
        <link href="{{ asset('template/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->
        <!-- Font Awesome -->
        <link href="{{ asset('template/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
        <!-- NProgress -->
        <link href="{{ asset('template/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
        <!-- iCheck -->
        <link href="{{ asset('template/iCheck/skins/flat/green.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->

        <!-- bootstrap-progressbar -->
        <link href="{{ asset('template/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet"> -->
        <!-- JQVMap -->
        <link href="{{ asset('template/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset('template/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
        <!-- <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> -->

        <!-- Datatables -->
        <link href="{{ asset('template/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('template/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('template/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('template/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('template/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.css">


        <!-- Custom Theme Style -->

        <link href="{{ asset('template/build/css/custom.min.css')}}" rel="stylesheet">
        <!-- <link href="../build/css/custom.min.css" rel="stylesheet"> -->


        <!-- Styles -->
        @yield('custom_css')

    </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col" >
          <div class="left_col">

            <div class="navbar nav_title" style="border: 0;">
              <a href="{{route('home')}}" class="site_title"><i class="fa fa-car"></i> <span>Car-Valuation</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <!-- <div class="profile_pic">
                <img src="images/img.jpg" alt="..." class="img-circle profile_img">
              </div> -->
              <div class="profile_info">
                <span>Bonjour! <h2>{{Auth::user()->name}}</h2></span>

              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href=""><i class="fa fa-home"></i>Home</a>
                  </li>
                  <li><a><i class="fa fa-list"></i> Cars <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('car.index')}}">View Cars</a></li>

                    </ul>
                  </li>
                  <li><a href="{{ route('seller.index') }}"><i class="fa fa-street-view"></i>Add Seller</a>

                  </li>
                  <li><a><i class="fa fa-edit"></i> Cars On Sale<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('sellingcar.index')}}">View Cars On Sale</a></li>

                    </ul>
                  </li>

                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <!-- <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{route('logout')}}"> -->

                <a href="{{ route('logout') }}" data-toggle="tooltip" data-placement="top" title="Logout"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">


                                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">{{Auth::user()->name}}
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a href="{{ route('logout') }}" class="dropdown-item"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="fa fa-sign-out pull-right"></i>
                                            Logout

                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                  </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">


                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->

         <div>

            @yield('admin_content')

         </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('template/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- <script src="../vendors/jquery/dist/jquery.min.js"></script> -->
    <!-- Bootstrap -->
      <script src="{{ asset('template/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <!-- <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- FastClick -->
    <script src="{{ asset('template/fastclick/lib/fastclick.js')}}"></script>
    <!-- <script src="../vendors/fastclick/lib/fastclick.js"></script> -->
    <!-- NProgress -->
    <script src="{{ asset('template/nprogress/nprogress.js')}}"></script>
    <!-- <script src="../vendors/nprogress/nprogress.js"></script> -->
    <!-- Chart.js -->
    <script src="{{ asset('template/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- <script src="../vendors/Chart.js/dist/Chart.min.js"></script> -->
    <!-- gauge.js -->
    <script src="{{ asset('template/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- <script src="../vendors/gauge.js/dist/gauge.min.js"></script> -->
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('template/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script> -->
    <!-- iCheck -->
    <script src="{{ asset('template/iCheck/icheck.min.js')}}"></script>
    <!-- <script src="../vendors/iCheck/icheck.min.js"></script> -->
    <!-- Skycons -->
    <script src="{{ asset('template/skycons/skycons.js')}}"></script>
    <!-- <script src="../vendors/skycons/skycons.js"></script> -->
    <!-- Flot -->
    <script src="{{ asset('template/Flot/jquery.flot.js')}}"></script>
    <script src="{{ asset('template/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{ asset('template/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{ asset('template/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{ asset('template/Flot/jquery.flot.resize.js')}}"></script>


    <!-- Flot plugins -->
    <script src="{{ asset('template/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{ asset('template/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{ asset('template/flot.curvedlines/curvedLines.js')}}"></script>

    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>

    <!-- DateJS -->
    <script src="{{ asset('template/DateJS/build/date.js')}}"></script>
    <!-- <script src="../vendors/DateJS/build/date.js"></script> -->
    <!-- JQVMap -->
    <script src="{{ asset('template/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{ asset('template/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{ asset('template/jqvmap/examples/js/jquery.vmap.sampledata.')}}"></script>


    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('template/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('template/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

    <!-- Datatables -->
    <script src="{{ asset('template/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('template/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{ asset('template/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{ asset('template/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{ asset('template/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('template/pdfmake/build/vfs_fonts.js')}}"></script>

    <script src="{{ asset('leaflet-search/leaflet-search.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('template/build/js/custom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('slim/slim.jquery.min.js')}}"></script>

    <!-- <script src="../build/js/custom.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js" type="text/javascript"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



            @yield('custom_script')


  </body>
</html>
