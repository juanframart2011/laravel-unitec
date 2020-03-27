@extends( "layout.app" )

@section( "content" )

    <div class="row">
        <div class="col-md-12">
            <h3>Login</h3>
        </div>
    </div>

    @if( !$errors->isEmpty() )
        
        <div class="alert alert-danger text-center" role="alert">
            
            @foreach ( $errors->all() as $error )
                <strong>{{$error}}</strong><br>
            @endforeach
        </div>
    @else

        <div class="alert alert-danger text-center d-none" role="alert"></div>
    @endif                
    
    <form action="{{ route( 'login' ) }}" id="form_login" method="POST" name="form_login">

        {{ csrf_field() }}
        
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old( 'email' ) }}">
                    <small id="emailHelp" class="form-text text-muted"></small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                    <small id="passwordHelp" class="form-text text-muted"></small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <button type="submit" class="btn btn-block btn-primary">Entrar</button>
            </div>
        </div>
    </form>

    <br>
    
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route( 'home' ) }}">Registro</a>
        </div>
    </div>
@endsection

@section( "script_extra" )
    
    <script src="{{ asset( 'js/user.js' ) }}"></script>
@endsection