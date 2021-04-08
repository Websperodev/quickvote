
        @yield('css')

        <link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/libs/ladda/ladda.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('assets/css/admin.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 -->
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
        <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> -->
        <style>
            .loader_wrapper{position: absolute;height: 100%;width: 100%;left: 0;top: 0;z-index: 99999;background-color: rgba(50, 58, 70, 0.9);}
            .loader_wrapper .spinner-border {position: fixed;left: 45%;top: 45%;}
            .form-control[readonly] {background-color: #eee;}
            .form-control[disabled] {background-color: #eee;}
            .error {
                color: #f36a7e;
                margin-bottom: 0px;
            }
            .filter-option-inner-inner:first-letter, .table td:first-letter  {
                text-transform: uppercase;
            }
            .card-widgets{
                height: auto !important;
            }
        </style>

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ URL::asset('assets/js/jquery.datetimepicker.full.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.datetimepicker.full.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.datetimepicker.min.js')}}"></script>
        <link href="{{ URL::asset('assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
         <script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
       <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    
        @yield('bottom-css')