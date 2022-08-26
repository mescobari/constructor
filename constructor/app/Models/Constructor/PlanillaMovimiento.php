<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Constructor\PlanillaItem;


class PlanillaMovimiento extends Model
{
    use HasFactory;

    public function planilla_item()
    {
        return $this->belongsTo(PlanillaItem::class);
    }

   

}
