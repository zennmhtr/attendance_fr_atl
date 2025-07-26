<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function MappingShift()
    {
        return $this->hasMany(MappingShift::class);
    }

    public function AutoShift()
    {
        return $this->hasMany(AutoShift::class);
    }
    
    public function dinasLuar()
    {
        return $this->hasMany(dinasLuar::class);
    }
}
