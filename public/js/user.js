$( document ).ready( function(){

	function _displayCareer(){

		$( ".div-carerr" ).addClass( 'd-none' );
		$( "#career" ).html( "" );
	}
	
	$( "#studyGrade").change( function(){

		var studyGrade = $( this ).val();

		$( "#studyGradeHelp" ).html( '' );

		if( studyGrade ){

			$.ajax({

				url: base_url + '/search-career',
				type: 'POST',
				dataType: 'json',
				data: $( "#studyGrade").serialize(),
				headers:{
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			})
			.done(function( data ){

				if( data.result == 1 ){

					console.log( data );
					
					if( data.data.length > 0 ){

						var option = "<option value=''>Seleccionar Carrera</option>";
						for( var c = 0; c < data.data.length; c++ ){

							option += "<option value='" + data.data[c].career_encrypted + "'>" + data.data[c].career_name + "</option>";
						}

						$( "#career" ).html( option );
						$( ".div-carerr" ).removeClass( 'd-none' );
					}
					else{

						_displayCareer();
					}
				}
				else{

					$( "#studyGradeHelp" ).html( data.message );
				}
			})
			.fail(function( error ){

				button.attr( "disabled", false ).html( "Agregar a La Orden" );
				console.log( error );
			});
		}
		else{

			_displayCareer();
		}
	});

	$( "#form_user" ).submit( function( event ){

		event.preventDefault();

		var button_txt = $( "#form_user" ).find( 'button' ).html();
		$( "#form_user" ).find( 'button' ).attr( 'disabled', true ).html( '<i class="fas fa-spinner fa-spin"></i> Registrando' );

		var returnF = 0;

		$( "#name, #app, #email, #phone, #password, #password2, #code-sponsor" ).css( "border", "solid 1px #4fea15" );
		$( this ).find( ".form-group" ).removeClass( 'has-error' );
		$( this ).find( ".help-block" ).html( "" );

		
		var name = $( "#name" ), app = $( "#app" ), password = $( "#password" ), password2 = $( "#password2" ), phone = $( "#phone" );
		var code = $( "#code-sponsor" );

		if( !name.val() ){

			returnF = 1;
			name.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 0 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 0 ).html( "El nombre es obligatorio" );
		}
		if( !app.val() ){

			returnF = 1;
			app.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 1 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 1 ).css( "color", "red" ).html( "El apellido es obligatorio" );
		}
		if( !email.val() ){

			returnF = 1;
			email.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 2 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 2 ).css( "color", "red" ).html( "El email es obligatorio" );
		}
		if( !email_validate.test( email.val() ) ){

			returnF = 1;
			email.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 2 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 2 ).css( "color", "red" ).html( "El email no está en el formato permitido" );
		}
		if( !phone.val() ){

			returnF = 1;
			phone.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 3 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 3 ).css( "color", "red" ).html( "El telefono es obligatorio" );
		}
		if( phone.val().length > 10 ){

			returnF = 1;
			phone.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 3 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 3 ).css( "color", "red" ).html( "El telefono no puede ser mayor a 10 digitos" );
		}
		if( isNaN( phone.val() ) ){

			returnF = 1;
			phone.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 3 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 3 ).css( "color", "red" ).html( "El telefono solo puede tener números" );
		}
		if( !password.val() || password.val().length < 6 ){

			returnF = 1;
			password.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 4 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 4 ).css( "color", "red" ).html( "La contraseña es obligatoria y mínimo 6 caracteres" );
		}
		if( !password2.val() || password.val().length < 6 ){

			returnF = 1;
			password2.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 5 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 5 ).css( "color", "red" ).html( "La repeticón de contraseña es obligatoria y mínimo 6 caracteres" );
		}
		if( password.val() != password2.val() ){

			returnF = 1;
			$( "#password, #password2" ).css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 4 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 4 ).css( "color", "red" ).html( "Son diferentes las contraseñas" );
			$( this ).find( ".form-group" ).eq( 5 ).addClass( 'has-error' );
			$( this ).find( ".help-block" ).eq( 5 ).css( "color", "red" ).html( "Son diferentes las contraseñas" );
		}
		if( view_sponsor != 1 ){

			if( yes_code == 1 && !code.val() ){

				returnF = 1;
				code.css( "border", "solid 1px red" );
				$( this ).find( ".form-group" ).eq( 7 ).addClass( 'has-error' );
				$( this ).find( ".help-block" ).eq( 6 ).css( "color", "red" ).html( "Agrega el codigo de embajador" );
			}
		}

		if( returnF == 0 ){

			document.getElementById( "form-register" ).submit();
		}
		else{

			$( "#form_user" ).find( 'button' ).attr( 'disabled', false );
		}
	});
});