<?php

namespace App\Console\Commands;

use App\Models\ResetCuti as ModelsResetCuti;
use App\Models\User;
use Illuminate\Console\Command;

class resetCuti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:cuti';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Cuti Pertanggal Masuk Kantor';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tglskrg = date('Y-m-d');
        $users = User::where('tgl_join', $tglskrg)->get();
        $reset_cuti = ModelsResetCuti::first();
        foreach($users as $user) {
            $data = [
                "izin_cuti" => $reset_cuti->izin_cuti,
                "izin_dinas_luar" => $reset_cuti->izin_dinas_luar,
                "izin_sakit" => $reset_cuti->izin_sakit,
                "izin_cek_kesehatan" => $reset_cuti->izin_cek_kesehatan,
                "izin_keperluan_pribadi" => $reset_cuti->izin_keperluan_pribadi,
                "izin_lainnya" => $reset_cuti->izin_lainnya,
                "izin_telat" => $reset_cuti->izin_telat,
                "izin_pulang_cepat" => $reset_cuti->izin_pulang_cepat
            ];
            User::where('id', $user->id)->update($data);
        }
    }
}
