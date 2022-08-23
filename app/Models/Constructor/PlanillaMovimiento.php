<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Constructor\PlanillaItem;


class PlanillaMovimiento extends Model
{
    use HasFactory;

    public function planilla_item()
    {
        return $this->belongsTo(PlanillaItem::class);
    }

   

    public function getPlanilla($planilla_id)
    {
        $json=PlanillaMovimiento::where('planilla_id',$planilla_id )
        ->get();

        $obj = json_decode($json, true);

        return $obj;
    }





}
