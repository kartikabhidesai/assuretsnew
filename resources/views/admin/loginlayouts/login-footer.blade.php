<!-- Mainly scripts -->
    <script src="public/admin/js/jquery-3.1.1.min.js"></script>
    <script src="public/admin/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="public/admin/js/plugins/iCheck/icheck.min.js"></script>
    
   
        @if (!empty($js)) 
            @foreach ($js as $value) 
                <script src="{{ asset('public/js/'.$value) }}" type="text/javascript" >
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
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>