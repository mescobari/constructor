
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <label for="">Sección datos Usuario/autenticación</label>
                <br>
                <div class="form-group row">
                    <label for="userName" class="col-lg-3 col-form-label requerido">Usuario</label>
                    <div class="col-lg-8">
                        <input type="text" name="userName" id="userName" class="form-control" value="{{old('userName', $usuario->userName ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-lg-3 col-form-label requerido">E-Mail</label>
                    <div class="col-lg-8">
                        <input type="email" name="email" id="email" class="form-control" value="{{old('email', $usuario->email ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-lg-3 col-form-label {{!isset($usuario) ? 'requerido' : ''}}">Contraseña</label>
                    <div class="input-group col-lg-8">
                        <input value="{{old('password', ' ' ?? ' ')}}" class="form-control" type="password" name="password" id="password" {{!isset($usuario) ? 'required minlength="5"' : ''}}>
                        <span id="ver-password" action="hide" class="input-group-addon"><i class="m-1 fas fa-eye fa-2x"></i></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="re_password" class="col-lg-3 col-form-label {{!isset($usuario) ? 'requerido' : ''}}">Repetir Contraseña</label>
                    <div class="input-group col-lg-8">
                        <input value="" class="form-control" type="password" name="re_password" id="re_password" {{!isset($usuario) ? 'required minlength="5"' : ''}}>
                        <span id="ver-password2" action="hide" class="input-group-addon"><i class="m-1 fas fa-eye fa-2x"></i></span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="re_password" class="col-lg-3 col-form-label {{!isset($usuario) ? 'requerido' : ''}}">Estado de Usuario</label>
                    <div class="col-lg-8">
                        <input type="checkbox" name="estado" id="estado" style="width:30px; height: 30px;" <?php if(isset($usuario->estado)){if(trim($usuario->estado)=='ACT'){echo ('checked');}} ?>>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="">Sección Funcionario</label>
                <br>   
                <div class="form-group row">
                    <label for="institucion_id" class="col-lg-3 col-form-label requerido">Institucion a la que pertenece:</label>
                    <div class="col-lg-8">
                        <select class="form-control" name="institucion_id" id="institucion_id" value="{{old('institucion_id', $funcionario->institucion_id ?? '')}}">
                            <option value="" selected disabled>Seleccione</option>
                            @php
                                foreach($instituciones as $institucione){
                                    $selected = "";                                    
                                    if(isset($funcionario)){ 
                                        if($funcionario->institucion_id == $institucione->id){
                                            $selected = "selected";
                                        }
                                    }
                                    echo('<option value="' . $institucione->id . '"' . ' ' . $selected . '>' . $institucione->nombre . '</option>');
                                }
                            @endphp
                        </select>
                    </div>
                </div>             
                <div class="form-group row">
                    <label for="fecha_inicial" class="col-lg-3 col-form-label requerido">Fecha de Inicio</label>
                    <div class="col-lg-8">
                        <input type="date" name="fecha_inicial" id="fecha_inicial" class="form-control" value="{{old('fecha_inicial', $funcionario->fecha_inicial ?? '')}}" required/>
                    </div>
                </div>                    
                <div class="form-group row">
                    <label for="fecha_final" class="col-lg-3 col-form-label">Fecha de Conclusión</label>
                    <div class="col-lg-8">
                        <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="{{old('fecha_final', $funcionario->fecha_final ?? '')}}"/>
                    </div>
                </div>  
                
                <div class="form-group row">
                    <label for="persona_id" class="col-lg-3 col-form-label requerido">Persona asignada para este usuario:</label>
                    <div class="col-lg-8">
                        <select class="form-control" name="persona_id" id="persona_id" value="{{old('institucion_id', $persona->id ?? '')}}">
                            <option value="" selected disabled>Seleccione</option>
                            @php
                                foreach($personas as $person){
                                    $selected = "";                                    
                                    if(isset($funcionario)){ 
                                        if($persona->id == $person->id){
                                            $selected = "selected";
                                        }
                                    }
                                    echo('<option value="' . $person->id . '"' . ' ' . $selected . '>' . $person->nombres . ' ' . $person->paterno . ' ' . $person->materno . '</option>');
                                }
                            @endphp
                        </select>
                    </div>
                </div>                    
            </div>
        </div>
    </div>