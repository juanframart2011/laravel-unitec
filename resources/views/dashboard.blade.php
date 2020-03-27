@extends( "layout.app" )

@section( "content" )

	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Hola <b>{{ session( 'us3R-name' ) . ' ' . session( 'us3R-last-name' ) . ' ' . session( 'us3R-last-name-sec' ) }}</b></h5>
			<h6 class="card-subtitle mb-2 text-muted">{{ session( 'us3R-un1t3c' ) }}</h6>
			<p class="card-text">
				Gracias por entra a nuestro sistema
			</p>
			<a href="{{ route( 'logout' ) }}" class="card-link">Salir</a>
		</div>
	</div>
@endsection