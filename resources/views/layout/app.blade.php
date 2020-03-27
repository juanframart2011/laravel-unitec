<!DOCTYPE html>
<html>
    @include( "layout.partial.head" )
<body>

    <div class="container mt-5">
        
        <div class="row">
            <div class="col-md-8 offset-md-2 col-xs-12">
                
                @yield( "content" )
            </div>
        </div>
    </div>

    @include( "layout.partial.script" )
    @yield( "script_extra" )
</body>
</html>