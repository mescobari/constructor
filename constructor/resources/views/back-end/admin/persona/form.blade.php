
    <div class="col-md-12">
        <div class="row">            
            <div class="col-md-6">
                <label for="">Sección datos Personales</label>
                <br>
                <div class="form-group row">
                    <label for="nombres" class="col-lg-3 col-form-label requerido">Nombre(s)</label>
                    <div class="col-lg-8">
                        <input type="text" name="nombres" id="nombres" class="form-control" value="{{old('nombres', $persona->nombres ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="paterno" class="col-lg-3 col-form-label requerido">Apellido Paterno</label>
                    <div class="col-lg-8">
                        <input type="text" name="paterno" id="paterno" class="form-control" value="{{old('paterno', $persona->paterno ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="materno" class="col-lg-3 col-form-label requerido">Apellido Materno</label>
                    <div class="col-lg-8">
                        <input type="text" name="materno" id="materno" class="form-control" value="{{old('materno', $persona->materno ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sexo" class="col-lg-3 col-form-label">Género</label>
                    <div class="col-lg-8">
                        <select class="form-control" name="sexo" id="sexo" value="{{old('sexo', $persona->sexo ?? '')}}">
                            <option value="" selected disabled>Seleccione</option>
                            @php
                                foreach($generos as $genero){
                                    $selected = "";
                                    if(isset($persona)){                                        
                                        if($persona->sexo == $genero->id){
                                            $selected = "selected";
                                        }
                                    }
                                    echo('<option value="' . $genero->id . '"' . ' ' . $selected . '>' . $genero->valor . '</option>');
                                }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="direccion" class="col-lg-3 col-form-label requerido">Dirección</label>
                    <div class="col-lg-8">
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion', $persona->direccion ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="codigo_persona" class="col-lg-3 col-form-label requerido">Código de Persona</label>
                    <div class="col-lg-8">
                        <input type="text" name="codigo_persona" id="codigo_persona" class="form-control" value="{{old('codigo_persona', $persona->codigo_persona ?? '')}}" required/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="">Sección datos Personales/Documento de Identidad</label>
                <br>
                <div class="form-group row">
                    <label for="ci" class="col-lg-3 col-form-label requerido">Cedula de Identidad</label>
                    <div class="col-lg-8">
                        <input type="number" name="ci" id="ci" class="form-control" value="{{old('ci', $persona->ci ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="complemento" class="col-lg-3 col-form-label">Complemento</label>
                    <div class="col-lg-8">
                        <input type="number" name="complemento" id="complemento" class="form-control" value="{{old('complemento', $persona->complemento ?? '')}}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expedido" class="col-lg-3 col-form-label">Lugar donde fue Expedido</label>
                    <div class="col-lg-8">
                        <select class="form-control" name="expedido" id="expedido" value="{{old('expedido', $persona->expedido ?? '')}}">
                            <option value="" selected disabled>Seleccione</option>
                            @php
                                foreach($extenciones as $extencione){
                                    $selected = "";
                                    if(isset($persona)){ 
                                        if($persona->expedido == $extencione->id){
                                            $selected = "selected";
                                        }
                                    }
                                    echo('<option value="' . $extencione->id . '"' . ' ' . $selected . '>' . $extencione->valor . '</option>');
                                }
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fecha_nacimiento" class="col-lg-3 col-form-label requerido">Fecha de Nacimiento</label>
                    <div class="col-lg-8">
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{old('fecha_nacimiento', $persona->fecha_nacimiento ?? '')}}" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telefono" class="col-lg-3 col-form-label">Telefono</label>
                    <div class="col-lg-8">
                        <input type="number" name="telefono" id="telefono" class="form-control" value="{{old('telefono', $persona->telefono ?? '')}}" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="celular" class="col-lg-3 col-form-label requerido">Celular</label>
                    <div class="col-lg-8">
                        <input type="number" name="celular" id="celular" class="form-control" value="{{old('celular', $persona->celular ?? '')}}" required/>
                    </div>
                </div>
            </div>
        </div>
    </div>