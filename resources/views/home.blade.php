<!DOCTYPE html>
<html>
<head>
    <title>Registro {{ env( 'name' ) }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset( 'css/main.css' ) }}" />
    <link rel="stylesheet" href="{{ asset( 'font/font-awesome/css/font-awesome.min.css' ) }}">
    <script type="text/javascript">
        var base_url = '<?= env( 'APP_URL' ) ?>';
    </script>
</head>
<body>

    <div class="container mt-5">
        
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <div class="row">
                    <div class="col-md-12">
                        <h3>Registro</h3>
                    </div>
                </div>

                <div class="alert alert-danger text-center d-none" role="alert"></div>
                
                <form action="{{ route( 'save' ) }}" id="form_user" name="form_user">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nombre(s)</label>
                                <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="{{ old( 'name' ) }}">
                                <small id="nameHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastName">Apellido Paterno</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="lastNameHelp" value="{{ old( 'name' ) }}">
                                <small id="lastNameHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastNameSec">Apellido Materno</label>
                                <input type="text" class="form-control" id="lastNameSec" name="lastNameSec" aria-describedby="lastNameSecHelp" value="{{ old( 'lastNameSec' ) }}">
                                <small id="lastNameSecHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="studyGrade">Grado de Estudio</label>
                                <select class="form-control" id="studyGrade" name="studyGrade" aria-describedby="studyGradeHelp">
                                    <option value="">Seleccionar Grado de Estudio</option>
                                    @for( $st = 0; $st < count( $studyGrade ); $st++ )

                                        <option {{ ( @old( 'studyGrade' ) == $studyGrade[$st]->studyGrade_encrypted )? 'selected' : '' }} value="{{ $studyGrade[$st]->studyGrade_encrypted }}">{{ $studyGrade[$st]->studyGrade_name }}</option>
                                    @endfor
                                </select>
                                <small id="studyGradeHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-6 div-carerr d-none" data-active="0">
                            <div class="form-group">
                                <label for="career">Carerra</label>
                                <select class="form-control" id="career" name="career" aria-describedby="careerHelp"></select>
                                <small id="careerHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="gender">Género</label>
                                <select class="form-control" id="gender" name="gender" aria-describedby="genderHelp">
                                    <option value="">Seleccionar Género</option>
                                    @for( $g = 0; $g < count( $gender ); $g++ )

                                        <option {{ ( @old( 'gender' ) == $gender[$g]->gender_encrypted )? 'selected' : '' }} value="{{ $gender[$g]->gender_encrypted }}">{{ $gender[$g]->gender_name }}</option>
                                    @endfor
                                </select>
                                <small id="genderHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input type="number" maxlength="3" class="form-control" id="age" name="age" aria-describedby="ageHelp" value="{{ old( 'age' ) }}">
                                <small id="ageHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="statuCivil">Estado Civil</label>
                                <select class="form-control" id="statuCivil" name="statuCivil" aria-describedby="statuCivilHelp">
                                    <option value="">Seleccionar Estado Civil</option>
                                    @for( $st = 0; $st < count( $statuCivil ); $st++ )

                                        <option {{ ( @old( 'statuCivil' ) == $statuCivil[$st]->statuCivil_encrypted )? 'selected' : '' }} value="{{ $statuCivil[$st]->statuCivil_encrypted }}">{{ $statuCivil[$st]->statuCivil_name }}</option>
                                    @endfor
                                </select>
                                <small id="statuCivilHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ old( 'email' ) }}">
                                <small id="emailHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="passwordHelp">
                                <small id="passwordHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="form-group">
                                <label for="passwordRe">Repetir Contraseña</label>
                                <input type="password" class="form-control" id="passwordRe" name="passwordRe" aria-describedby="passwordReHelp">
                                <small id="passwordReHelp" class="form-text text-muted"></small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset( 'js/user.js' ) }}"></script>
</body>
</html>