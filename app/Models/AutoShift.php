<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoShift extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function Jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
