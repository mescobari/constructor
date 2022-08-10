<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Constructor\Unidad;

class PlanillaItem extends Model
{
    use HasFactory;

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id', 'id');
    }
}
