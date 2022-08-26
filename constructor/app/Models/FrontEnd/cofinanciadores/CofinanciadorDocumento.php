<?php

namespace App\Models\FrontEnd\cofinanciadores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FrontEnd\cofinanciadores\CofinanciadorDocumento;
use App\Models\FrontEnd\cofinanciadores\Cofinanciador;
use App\Models\FrontEnd\cofinanciadores\TipoDocumento;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\FrontEnd\cofinanciadores\ClaOrganismos;
use App\Models\FrontEnd\marco_logico\Objetivo;
use App\Models\User;

class CofinanciadorDocumento extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'cofinanciadores_id', 
        'document_type_id', 
        'objetivos_id', 
        'titulo', 
        'objeto', 
        'modifica',
        'fecha_firma', 
        'fecha_inicio',
        'fecha_vencimiento', 
        'duracion_dias', 
        'monto_bs', 
        'monto_Sus', 
        'padre', 
        'firma',
        'pathDocumento' 
    ];
	protected $table = 'cofinanciador_documento';

    public function tipo_documento(){
        return $this->belongsTo(TipoDocumento::class, 'document_type_id', 'id');
    }
    public function institucion(){
        return $this->belongsTo(Cofinanciador::class, 'cofinanciadores_id')->with('institucion', 'organismo');
    }
    public function padre(){
        return $this->belongsTo(CofinanciadorDocumento::class, 'padre');
    }
    public function cofinanciador(){
        return $this->belongsTo(Cofinanciador::class, 'cofinanciadores_id');
    }
    public function objetivo(){
        return $this->belongsTo(Objetivo::class, 'objetivos_id');
    }
}
