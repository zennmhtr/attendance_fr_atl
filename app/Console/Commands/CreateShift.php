<?php

namespace App\Console\Commands;

use App\Models\AutoShift;
use App\Models\MappingShift;
use App\Models\User;
use Illuminate\Console\Command;

class CreateShift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:shift';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat Shift Otomatis Setiap bulan';

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
        $auto_shift = AutoShift::all();
        foreach($auto_shift as $as){
            $user = User::where('jabatan_id', $as->jabatan_id)->get();
            foreach($user as $u){
                $tahun_skrg = date('Y');
                $bulan_skrg = date('m');
                $jmlh_hari = cal_days_in_month(CAL_GREGORIAN,$bulan_skrg,$tahun_skrg);
                $tgl_mulai = date('Y-m-01');
                $tgl_akhir = date('Y-m-'.$jmlh_hari);

                $begin = new \DateTime($tgl_mulai);
                $end = new \DateTime($tgl_akhir);
                $end = $end->modify('+1 day');

                $interval = new \DateInterval('P1D'); //referensi : https://en.wikipedia.org/wiki/ISO_8601#Durations
                $daterange = new \DatePeriod($begin, $interval ,$end);

                foreach ($daterange as $date) {
                    $tanggal = $date->format("Y-m-d");

                    $data = [
                        'user_id' => $u->id,
                        'shift_id' => $as->shift_id,
                        'tanggal' => $tanggal,
                    ];

                    if ($as->shift_id == 1) {
                        $data["status_absen"] = "Libur";
                    } else {
                        $data["status_absen"] = "Tidak Masuk";
                    }

                    MappingShift::create($data);
                }
            }
        }
    }
}
