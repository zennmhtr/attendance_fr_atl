<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPtkp extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Payroll()
    {
        return $this->hasMany(Payroll::class, 'status_id');
    }
}
