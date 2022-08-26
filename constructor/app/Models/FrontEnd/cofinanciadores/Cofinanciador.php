<?php

namespace App\Models\FrontEnd\cofinanciadores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FrontEnd\cofinanciadores\CofinanciadorDocumento;
use App\Models\FrontEnd\intervenciones\ClaInstitucional;
use App\Models\FrontEnd\cofinanciadores\ClaOrganismos;
use App\Models\FrontEnd\cofinanciadores\TipoDocumento;

class Cofinanciador extends Model
{
    use HasFactory;
    protected $fillable = ['id','intervenciones_id', 'institucion_id',  'organismo_id' ];
	protected $table = 'cofinanciadores';

    public function cofinanciador_documento(){
        return $this->belongsTo(CofinanciadorDocumento::class, 'id', 'cofinanciadores_id')->with('tipo_documento');
    }

    public function institucion(){
        return $this->belongsTo(ClaInstitucional::class, 'institucion_id', 'id');
    }

    public function organismo(){
        return $this->belongsTo(ClaOrganismos::class, 'organismo_id', 'id');
    }
}
