<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User()
    {
        return $this->hasMany(User::class);
    }

    public function AutoShift()
    {
        return $this->hasMany(AutoShift::class);
    }

    public function atasan($id)
    {
        return User::find($id);
    }

    public function anggota($id, $manager)
    {
        return User::where('jabatan_id', $id)->where('id', '!=', $manager)->orderBy('name', 'ASC')->get();
    }
}
