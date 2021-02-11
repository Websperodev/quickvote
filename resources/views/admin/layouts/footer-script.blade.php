        <!-- Vendor js -->
        <script src="{{ URL::asset('assets/js/vendor.min.js')}}"></script>

        <!-- third party js -->

        <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
       <!--  <script src="{{ URL::asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script> -->
        <script src="{{ URL::asset('assets/libs/ladda/ladda.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    
       
        @yield('script')

        <!-- App js -->
        <script src="{{ URL::asset('assets/js/app.min.js')}}"></script>
        
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                </script>
        @yield('script-bottom')
        