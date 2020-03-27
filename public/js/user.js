$( document ).ready( function(){

	function _displayCareer(){

		$( ".div-carerr" ).addClass( 'd-none' ).attr( "data-active", 0 );
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
						$( ".div-carerr" ).removeClass( 'd-none' ).attr( "data-active", 1 );
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
		var email_validate	=	/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

		$( "#name, #lastName, #lastNameSec, #studyGrade, #career, #gender, #age, #statuCivil, #email, #password, #passwordRe" ).css( "border", "solid 1px #4fea15" );
		$( this ).find( ".form-group" ).removeClass( 'has-error' );
		$( this ).find( ".form-text" ).html( "" );

		var name = $( "#name" ), app = $( "#lastName" ), apm = $( "#lastNameSec" ), studyGrade = $( "#studyGrade" ), career = $( "#career" );
		var gender = $( "#gender" ), age = $( "#age" ), statuCivil = $( "#statuCivil" ), email = $( "#email" ), password = $( "#password" );
		var passwordRe = $( "#passwordRe" );

		if( !name.val() ){

			returnF = 1;
			name.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 0 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 0 ).html( "El nombre es obligatorio" );
		}
		if( !app.val() ){

			returnF = 1;
			app.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 1 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 1 ).css( "color", "red" ).html( "El apellido paterno es obligatorio" );
		}
		if( !apm.val() ){

			returnF = 1;
			apm.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 2 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 2 ).css( "color", "red" ).html( "El apellido materno es obligatorio" );
		}
		if( !studyGrade.val() ){

			returnF = 1;
			studyGrade.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 3 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 3 ).css( "color", "red" ).html( "El grado de estudio es obligatorio" );
		}
		else{

			if( $( ".div-carerr" ).data( "active" ) == 1 && !career.val() ){

				returnF = 1;
				career.css( "border", "solid 1px red" );
				$( this ).find( ".form-group" ).eq( 4 ).addClass( 'has-error' );
				$( this ).find( ".form-text" ).eq( 4 ).css( "color", "red" ).html( "La carrera es obligatoria" );
			}
		}

		if( !gender.val() ){

			returnF = 1;
			gender.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 5 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 5 ).css( "color", "red" ).html( "El apellido materno es obligatorio" );
		}
		if( !statuCivil.val() ){

			returnF = 1;
			statuCivil.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 7 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 7 ).css( "color", "red" ).html( "El estado civil es obligatorio" );
		}
		if( !email.val() ){

			returnF = 1;
			email.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 8 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 8 ).css( "color", "red" ).html( "El email es obligatorio" );
		}
		if( !email_validate.test( email.val() ) ){

			returnF = 1;
			email.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 8 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 8 ).css( "color", "red" ).html( "El email no está en el formato permitido" );
		}
		if( !age.val() ){

			returnF = 1;
			age.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 6 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 6 ).css( "color", "red" ).html( "La edad es obligatorio" );
		}
		if( age.val().length > 2 ){

			returnF = 1;
			age.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 6 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 6 ).css( "color", "red" ).html( "La edad no puede ser mayor a 2 digitos" );
		}
		if( isNaN( age.val() ) ){

			returnF = 1;
			age.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 6 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 6 ).css( "color", "red" ).html( "La edad solo puede tener números" );
		}
		if( !password.val() || password.val().length < 6 ){

			returnF = 1;
			password.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 9 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 9 ).css( "color", "red" ).html( "La contraseña es obligatoria y mínimo 6 caracteres" );
		}
		if( !passwordRe.val() || password.val().length < 6 ){

			returnF = 1;
			passwordRe.css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 10 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 10 ).css( "color", "red" ).html( "La repeticón de contraseña es obligatoria y mínimo 6 caracteres" );
		}
		if( password.val() != passwordRe.val() ){

			returnF = 1;
			$( "#password, #passwordRe" ).css( "border", "solid 1px red" );
			$( this ).find( ".form-group" ).eq( 9 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 9 ).css( "color", "red" ).html( "Son diferentes las contraseñas" );
			$( this ).find( ".form-group" ).eq( 10 ).addClass( 'has-error' );
			$( this ).find( ".form-text" ).eq( 10 ).css( "color", "red" ).html( "Son diferentes las contraseñas" );
		}

		if( returnF == 0 ){

			//document.getElementById( "form-user" ).submit();
		}
		else{

			$( "#form_user" ).find( 'button' ).attr( 'disabled', false ).html( button_txt );
		}
	});
});