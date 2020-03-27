<?php

namespace App\Http\Controllers;


use App\Career;
use App\Gender;
use App\Statu;
use App\StatuCivil;
use App\StudyGrade;
use App\User;

use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{

	#Vista de registro
	public function home( Request $request ){

		$data["gender"] = Gender::Where( "statu_id", 1 )->get();
		$data["statuCivil"] = StatuCivil::Where( "statu_id", 1 )->get();
		$data["studyGrade"] = StudyGrade::Where( "statu_id", 1 )->get();

		return view( "home", $data );
	}

	#función de registro de usuario
	public function register( Request $request ){

    	$messages = [
    		'user_id:required' => 'El campo es oligatorio',
    		'user_id:unique' => 'El usuario de facebook ya existe',
    		'nombre:required' => 'El campo nombre es oligatorio',
    		'apellido:required' => 'El campo apellido es oligatorio',
    		'email:required' => 'El email no existe',
        ];

        $validate = Validator::make( $request->all(), [
            
            'user_id' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
        ], $messages );
        
        if( $validate->fails() ){

            $error = $validate->errors()->all();

			return response()->json([
                "result" => 2,
                "message" => $error
            ], 200 );
        }
    	else{

    		$user_id = $request->get( "user_id" );
    		$email = $request->get( "email" );
    		$nombre = $request->get( "nombre" );
    		$apellido = $request->get( "apellido" );
    		$nick = $request->get( "nick" );

    		#Buscamos si el id del usuario ya existe
			$user_result = User::where( [ "user_facebookId" => $user_id, "estatus_id" => 1, "userType_id" => 2 ] )->where( function( $query ){

	    		$query->where( "rol_id", 1 )
	    		->orwhere( "rol_id", 3 );
	    	})->get();

	    	if( count( $user_result ) == 0 ){

	    		#Buscamos si el id del usuario ya existe
				$user_resultEmail = User::where( [ "user_email" => $email ] );

				if( $user_resultEmail->count() == 0 ){

					$user = new User;
					$user->user_facebookId = $user_id;
                    $user->user_password = md5( $user_id );
					$user->user_nickname = $nick;
					$user->user_name = $nombre;
					$user->user_surname = $apellido;
					$user->user_email = $email;
					$user->rol_id = 1;
					$user->userType_id = 2;
					$user->user_creationDate = date( "Y-m-d H:i:s" );

					$user->save();

					if( $user->id > 0 ){

						$request->session()->forget( "f1t70g0-sponsor" );

						Mail::to( $user->user_email )->send( new UserMail( $user, 'welcome', null ) );

			    		$request->session()->put( [ 'us3R-f1t70g0' => $user->user_email, 'us3R-f1t70g0_id' => $user->id ] );

			    		return response()->json([
			                "result" => 1,
			                "message" => "Accediendo a la plataforma"
			            ], 200 );
			    	}
					else{

						return response()->json([
			                "result" => 2,
			                "message" => "Ocurrio un error al crear el usuario, vuelve a intentarlo"
			            ], 200 );
					}
				}
				else{

					return response()->json([
		                "result" => 1,
		                "message" => "El correo ya existe, por favor incie sesión desde el sistema con su contraseña"
		            ], 200 );
				}
			}
			else{

				$user = User::where( [ "user_facebookId" => $user_id, "estatus_id" => 1, "userType_id" => 2 ] )->where( function( $query ){

		    		$query->where( "rol_id", 1 )
		    		->orwhere( "rol_id", 3 );
		    	})->get();

		    	if( count( $user ) > 0 ){

		    		$request->session()->put( [ 'us3R-f1t70g0' => $user[0]["user_email"], 'us3R-f1t70g0_id' => $user[0]["user_id"], 'us3R-r0l_id' => $user[0]["rol_id"] ] );

		    		return response()->json([
		                "result" => 1,
		                "message" => "Accediendo a la plataforma"
		            ], 200 );
		    	}
		    	else{

		    		return response()->json([
		                "result" => 2,
		                "message" => 'El usuario aún no está registrado'
		            ], 200 );
		    	}
			}
    	}
    }

    #Función de carreras de grado de estudio
    public function search_career( Request $request ){

    	$messages = [
    		'studyGrade:required' => 'El campo grado de estudio es oligatorio',
    		'studyGrade:exists' => 'El usuario de facebook ya existe',
        ];

        $validate = Validator::make( $request->all(), [
            
            'studyGrade' => 'required|exists:study_grade,studyGrade_encrypted',
        ], $messages );
        
        if( $validate->fails() ){

            $error = $validate->errors()->all();

			return response()->json([
                "result" => 2,
                "message" => $error
            ], 200 );
        }
    	else{

    		$studyGrade_encrypted = $request->get( "studyGrade" );
    		
    		#Buscamos si tiene carreras
			$studyGrade_result = StudyGrade::where( [ "studyGrade_encrypted" => $studyGrade_encrypted, "statu_id" => 1 ] )->get();

			if( count( $studyGrade_result ) > 0 ){

				$career_result = Career::where( [ "studyGrade_id" => $studyGrade_result[0]->studyGrade_id, "statu_id" => 1 ] )->get();

				return response()->json([
	                "result" => 1,
	                "data" => $career_result
	            ], 200 );
			}
			else{

				return response()->json([
	                "result" => 2,
	                "message" => array( "El grado de estudio no existe" )
	            ], 200 );
			}
    	}
    }
}