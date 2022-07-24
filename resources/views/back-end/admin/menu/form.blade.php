<div class="form-group row">
    <label for="nombre" class="col-lg-3 col-form-label requerido">Nombre</label>
    <div class="col-lg-8">
    <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $data->nombre ?? '')}}" required/>
    </div>
</div>
<div class="form-group row">
    <label for="descripcion" class="col-lg-3 col-form-label requerido">Descripción</label>
    <div class="col-lg-8">
    <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{old('nombre', $data->descripcion ?? '')}}" required/>
    </div>
</div>
<div class="form-group row">
    <label for="link_url" class="col-lg-3 col-form-label requerido">Url</label>
    <div class="col-lg-8">
    <input type="text" name="link_url" id="link_url" class="form-control" value="{{old('url', $data->link_url ?? 'no_link')}}" required/>
    </div>
</div>
<div class="form-group row">
    <label for="icon_logo" class="col-lg-3 col-form-label">Icono</label>
    <div class="col-md-3">
        <input type="text" name="icon_logo" id="icon_logo" class="form-control" value="{{old('icon_logo', $data->icon_logo ?? '')}}"/>
    </div>
    <div class="col-md-1 {{old('icon_logo_color', $data->icon_logo_color ?? '')}}" id="muestra_icono_form">
        <i class="{{old('icon_logo', $data->icon_logo ?? '')}} fa-2x"></i>
    </div>
    <div class="col-md-3 text-success">
        <div class="input-group">
            <select name="icon_logo_color"  id="icon_logo_color" class="form-control" onchange="cargar_color_icono()" value="text-primary">
                <option value="0" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="0"){echo "selected";}}?>>Sin Color</option>
                <option value="text-primary" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-primary"){echo "selected";}}?>>Color Primario</option>
                <option value="text-secondary" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-secondary"){echo "selected";}}?>>Color Secundario</option>
                <option value="text-danger" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-danger"){echo "selected";}}?>>Color Peligro</option>
                <option value="text-warning" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-warning"){echo "selected";}}?>>Color Alerta</option>
                <option value="text-success" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-success"){echo "selected";}}?>>Color Exito</option>
                <option value="text-info" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-info"){echo "selected";}}?>>Color Informativo</option>
                <option value="text-dark" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-dark"){echo "selected";}}?>>Color Oscuro-Negro</option>
                <option value="text-white" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-white"){echo "selected";}}?>>Color Claro-Blanco</option>
                <option value="text-light" <?php if(isset($data->icon_logo_color)){ if($data->icon_logo_color=="text-light"){echo "selected";}}?>>Color ligero</option>
            </select>
            <div class="input-group-prepend">
                <span style="font-size: 1.5em;" class="input-group-text bg-white"><i class="fas fa-palette text-warning" title="Selección de color"></i></span>
              {{-- <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span> --}}
            </div>
          </div>
        {{-- <div class="input-control">            
            
            <span style="font-size: 1.5em"><i class="fas fa-palette fa-2x text-warning" title="Selección de color"></i></span>
        </div> --}}
    </div>
    <div class="col-md-1 text-primary" onclick="cargar_iconos()" title="Selección de icono">
        <i class="fas fa-question-circle fa-2x"></i>
    </div>
</div>

<div class="form-group row">
    <label for="icon_logo" class="col-lg-3 col-form-label">Estado</label>
    <div class="col-lg-8">
        <div class="form-check">            
            <input class="form-check-input" type="checkbox" value="{{old('icon_logo', $data->icon_logo ?? 'NAN')}}" id="estado" name="estado" <?php if(isset($data->estado)){ if($data->estado == 'ACT'){ echo ("checked"); }else{ if($data->estado == 'ACT'){ } } }?> style="width: 30px; height: 30px;">
            
        </div>
    </div>
</div>
