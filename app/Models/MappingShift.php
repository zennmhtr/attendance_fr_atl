<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingShift extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public static function dataAbsen()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d');

        $user_id = request()->input('user_id');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $data_absen = MappingShift::select('mapping_shifts.*', 'users.name')
                                    ->rightJoin('users', function($join) use ($tglskrg, $mulai, $akhir) {
                                        $join->on('users.id', '=', 'mapping_shifts.user_id')
                                            ->when(!$mulai && !$akhir, function ($query) use ($tglskrg) {
                                                return $query->where('mapping_shifts.tanggal', '=', $tglskrg);
                                            })
                                            ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                                return $query->whereBetween('tanggal', [$mulai, $akhir]);
                                            });
                                    })
                                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                                        return $query->where('users.id', auth()->user()->id);
                                    })
                                    ->when($user_id, function ($query) use ($user_id) {
                                        return $query->where('users.id', $user_id);
                                    })
                                    ->orderBy('tanggal', 'ASC')
                                    ->orderBy('users.name', 'ASC');

        return $data_absen;
    }
}
