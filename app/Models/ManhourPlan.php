<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManhourPlan extends Model
{
    use HasFactory;

    protected $fillable = ['technician_id', 'date', 'planned_hours', 'actual_hours'];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
