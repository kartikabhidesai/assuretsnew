    
    
    <script src="{{ url('public/admin/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ url('public/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ url('public/admin/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/flot/jquery.flot.pie.js') }}"></script>

    <!-- Peity -->
    <script src="{{ url('public/admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('public/admin/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ url('public/admin/js/inspinia.js') }}"></script>
    <script src="{{ url('public/admin/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ url('public/admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- GITTER -->
    <script src="{{ url('public/admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ url('public/admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{ url('public/admin/js/demo/sparkline-demo.js') }}"></script>

    <!-- ChartJS-->
    <script src="{{ url('public/admin/js/plugins/chartJs/Chart.min.js') }}"></script>

   
        @if (!empty($js)) 
            @foreach ($js as $value) 
                <script src="{{ asset('public/js/'.$value) }}" type="text/javascript">
                </script>
            @endforeach
        @endif
        
        
        <script>
            jQuery(document).ready(function() {
                
                @if (!empty($funinit))
                    @foreach ($funinit as $value)
                        {{ $value }}
                    @endforeach
                @endif
            });
        </script>
        <script src="{!! url('public/js/plugins/dataTables/datatables.min.js') !!}" type="text/javascript"></script>
    <script src="{!! url('public/js/comman_function.js') !!}" type="text/javascript"></script>