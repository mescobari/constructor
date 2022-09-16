<?php

namespace App\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaDocument extends Model
{
    use HasFactory;
    protected $fillable = ['planilla_id', 'document_id' ];
	protected $table = 'planilla_documents';
}
