<?php

namespace App\Http\Controllers;


use App\Career;
use App\Gender;
use App\Statu;
use App\StatuCivil;
use App\StudyGrade;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
	#Fncion de dashboard
	public function dashboard( Request $request ){

		$data["meta_title"] = "Dashboard";

		return view( "dashboard", $data );
	}

	#Vista de registro
	public function home( Request $request ){

		$data["gender"] = Gender::Where( "statu_id", 1 )->get();
		$data["statuCivil"] = StatuCivil::Where( "statu_id", 1 )->get();
		$data["studyGrade"] = StudyGrade::Where( "statu_id", 1 )->get();
		$data["meta_title"] = "Registro";

		return view( "home", $data );
	}

	public function login( Request $request ){

		$data["meta_title"] = "Login";

		return view( "login", $data );
	}

	public function logout( Request $request ){

		$request->session()->flush();

    	return redirect( '/' );
	}

	#función de registro de usuario
	public function save( Request $request ){

    	$messages = [
    		'name:required' => 'El campo Nombre es oligatorio',
    		'lastName:required' => 'El campo Apellido Paterno es oligatorio',
    		'lastNameSec:required' => 'El campo Apellido Materno es oligatorio',
    		'studyGrade:required' => 'El campo Grado de Estudio es oligatorio',
    		'studyGrade:exists' => 'El campo Grado de Estudio contiene un valor no válido',
    		'gender:required' => 'El campo Género es oligatorio',
    		'gender:exists' => 'El campo Género contiene un valor no válido',
    		'age:required' => 'El campo Edad es oligatorio',
    		'age:numeric' => 'El campo Edad debe ser númerico',
    		'age:max' => 'El campo Edad tiene como máximo 6 caracteres',
    		'statuCivil:required' => 'El Estado Civil Nombre es oligatorio',
    		'email:required' => 'El campo Email es oligatorio',
    		'email:unique' => 'El campo Email ya existe',
    		'email:email' => 'El campo Email no está en un formato válido',
    		'password:required' => 'El campo Contraseña es oligatorio',
    		'password:min' => 'El campo Contraseña mínimo son 6 caracteres',
    		'passwordRe:required' => 'El campo Repetir Contraseña es oligatorio',
    		'passwordRe:min' => 'El campo Repetir Contraseña mínimo son 6 caracteres',
    		'passwordRe:same' => 'El campo Repetir Contraseña no es igual a la contraseña',
        ];

        $validate = Validator::make( $request->all(), [
            
            'name' => 'required',
            'lastName' => 'required',
            'lastNameSec' => 'required',
            'studyGrade' => 'required|exists:study_grade,studyGrade_encrypted',
            'gender' => 'required|exists:gender,gender_encrypted',
            'age' => 'required|numeric|max:99',
            'statuCivil' => 'required',
            'email' => 'required|unique:user,user_email|email',
            'password' => 'required|min:6',
            'passwordRe' => 'required|min:6|same:password',
        ], $messages );
        
        if( $validate->fails() ){

            return redirect( '/' )
                ->withErrors( $validate )
                ->withInput();
        }
    	else{

    		try{
	    		$validatonCatalog = true;

	    		$user_name = $request->get( "name" );
	    		$user_lastName= $request->get( "lastName" );
	    		$user_lastNameSec = $request->get( "lastNameSec" );
	    		$studyGrade = $request->get( "studyGrade" );
	    		$gender = $request->get( "gender" );
	    		$user_age = $request->get( "age" );
	    		$statuCivil = $request->get( "statuCivil" );
	    		$user_email = $request->get( "email" );
	    		$user_password = md5( $request->get( "password" ) );
	    		$career = $request->get( "career" );

	    		$studyGrade_resut = StudyGrade::Where([ "studyGrade_encrypted" => $studyGrade, "statu_id" => 1 ])->get();
	    		if( count( $studyGrade_resut ) == 0 ){

	    			$validate->errors()->add( 'Grado de Estudio', 'El grado de estudio no existe' );
	    			$validatonCatalog = false;
	    		}
	    		else{

	    			$studyGrade_id = $studyGrade_resut[0]->studyGrade_id;
	    		}

	    		$gender_resut = Gender::Where([ "gender_encrypted" => $gender, "statu_id" => 1 ])->get();
	    		if( count( $gender_resut ) == 0 ){

	    			$validate->errors()->add( 'Género', 'El género no existe' );
	    			$validatonCatalog = false;
	    		}
	    		else{

	    			$gender_id = $gender_resut[0]->gender_id;
	    		}

	    		$statuCivil_resut = StatuCivil::Where([ "statuCivil_encrypted" => $statuCivil, "statu_id" => 1 ])->get();
	    		if( count( $statuCivil_resut ) == 0 ){

	    			$validate->errors()->add( 'Estado Civil', 'El Estado Civil no existe' );
	    			$validatonCatalog = false;
	    		}
	    		else{

	    			$statuCivil_id = $statuCivil_resut[0]->statuCivil_id;
	    		}

	    		#Valido que ese grado tenga o no tenga carrera y venga una selecciona
	    		$carrerstudyGrade_result = Career::Where([ "studyGrade_id" => $studyGrade_id, "statu_id" => 1 ])->get();
	    		if( count( $carrerstudyGrade_result ) > 0 && empty( $career ) ){

	    			$validate->errors()->add( 'Falta carrera', 'Este Grado de Estudio tiene carreras y debes elegir una' );
	    			$validatonCatalog = false;
	    		}
	    		elseif( count( $carrerstudyGrade_result ) == 0 ){

	    			$career_id = null;
	    		}
	    		else{

	    			$carrer_result = Career::Where([ "career_encrypted" => $career, "statu_id" => 1 ])->get();
		    		if( count( $carrer_result ) == 0 ){

		    			$validate->errors()->add( 'La carrera', 'La carrera no existe' );
		    			$validatonCatalog = false;

		    		}
		    		else{

		    			$career_id = $carrer_result[0]->carrer_id;
		    		}
	    		}

	    		if( $validatonCatalog ){

	    			$user = new User;
					$user->user_name = $user_name;
					$user->user_lastName = $user_lastName;
					$user->user_lastNameSec = $user_lastNameSec;
					$user->studyGrade_id = $studyGrade_id;
					$user->gender_id = $gender_id;
					$user->career_id = $career_id;
					$user->user_age = $user_age;
					$user->statuCivil_id = $statuCivil_id;
					$user->user_password = $user_password;
					$user->user_encrypted = md5( $user_email . date( "Y-m-d H:i:s" ) );
					$user->user_email = $user_email;
					$user->user_creationDate = date( "Y-m-d H:i:s" );
					$user->save();

					if( $user->id > 0 ){

						$request->session()->put( [ 'us3R-un1t3c' => $user->user_email, 'us3R-name' => $user->user_name, 'us3R-last-name' => $user->user_lastName, 'us3R-last-name-sec' => $user->user_lastNameSec, 'us3R-un1t3c_id' => $user->user_encrypted ] );

			    		return redirect( '/user/home' );
			    	}
					else{

						Log::warning( "User/save() --id :: " . print_r( $_POST, true ) );
						$validate->errors()->add( 'Error Inesperado', 'lo sentimos, ocurrió un error inesperado' );

						return redirect( '/' )
			                ->withErrors( $validate )
			                ->withInput();
					}
	    		}
	    		else{

	    			return redirect( '/' )
	                ->withErrors( $validate )
	                ->withInput();
	    		}
	    	}
	    	catch( \Exception $e ){

				DB::rollback();

				Log::warning( "User/save() -- catch :: " . $e->getMessage() );
				$validate->errors()->add( 'Error Inesperado', 'lo sentimos, ocurrió un error inesperado' );

				return redirect( '/' )
	                ->withErrors( $validate )
	                ->withInput();
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

    public function validate_login( Request $request ){

		$messages = [
    		'password-login:required' => 'El campo Contraseña es oligatorio',
    		'email-login:required' => 'El campo Email es oligatorio',
            'email-login:email' => 'No es un formato de email válido',
        ];

        $validate = Validator::make( $request->all(), [
            
            'password-login' => 'required|min:6',
            'email-login' => 'required|email',
        ], $messages );
        
        if( $validate->fails() ){

            return redirect( 'registro' )
                        ->withErrors( $validate )
                        ->withInput();
        }
        else{

        	$email = $request->get( "email-login" );
        	$password = md5( $request->get( "password-login" ) );

        	$user = User::where( [ "user_email" => $email, "user_password" => $password, "estatus_id" => 1 ] )->where( function( $query ){

        		$query->where( "rol_id", 1 )
        		->orwhere( "rol_id", 3 );
        	})->get();

        	if( count( $user ) > 0 ){

        		$request->session()->put( [ 'us3R-un1t3c' => $user->user_email, 'us3R-name' => $user->user_name, 'us3R-last-name' => $user->user_lastName, 'us3R-last-name-sec' => $user->user_lastNameSec, 'us3R-un1t3c_id' => $user->user_encrypted ] );
        	}
        	else{

        		$validate->errors()->add( 'login', 'los datos son incorrectos' );
                
                return redirect( 'registro' )
                        ->withErrors( $validate )
                        ->withInput();
        	}
        }
	}
}