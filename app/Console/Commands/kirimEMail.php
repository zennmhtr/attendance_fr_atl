<?php

namespace App\Console\Commands;

use App\Mail\Email;
use App\Models\Sip;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\API\UsersController;

class kirimEMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kirim:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim Email Setiap Hari Jika Ada Data SIP';

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
        $tglbesok = date('Y-m-d', strtotime('+7 month'));
        $data_dokumen = Sip::where('nama_dokumen', 'SIP')->whereBetween('tanggal_berakhir', [$tglskrg, $tglbesok])->get();
        foreach($data_dokumen as $data){
            Mail::to($data->User->email)->send(new Email($data));
        }
    }
}
