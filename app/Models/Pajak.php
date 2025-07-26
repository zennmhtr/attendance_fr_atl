<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    protected $table = 'pajaks'; // sesuaikan jika nama tabel berbeda

    // Kolom-kolom fillable, relasi, dll.
    protected $fillable = [
        'nama_pajak', 'jumlah', 'user_id', // contoh kolom
    ];
}
