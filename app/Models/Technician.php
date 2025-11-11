<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technician extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role_id', 'email', 'status'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Duplicate method removed

    public function manhourPlans()
    {
        return $this->hasMany(ManhourPlan::class);
    }
    public function assignments()
{
    return $this->hasMany(Assignment::class);
}

}
