<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\dinasLuar as ModelsDinasLuar;

class DinasLuar extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $user_login = auth()->user()->id;
        $tanggal = "";
        $tglskrg = date('Y-m-d');
        $tglkmrn = date('Y-m-d', strtotime('-1 days'));
        $dinas_luar = ModelsDinasLuar::where('user_id', $user_login)->where('tanggal', $tglkmrn)->get();
        if($dinas_luar->count() > 0) {
            foreach($dinas_luar as $mp) {
                $jam_absen = $mp->jam_absen;
                $jam_pulang = $mp->jam_pulang;
            }
        } else {
            $jam_absen = "-";
            $jam_pulang = "-";
        }
        if($jam_absen != null && $jam_pulang == null) {
            $tanggal = $tglkmrn;
        } else {
            $tanggal = $tglskrg;
        }
        if (auth()->user()->is_admin == 'admin') {
            return view('dinasluar.index', [
                'title' => 'Absen',
                'dinas_luar' => ModelsDinasLuar::where('user_id', $user_login)->where('tanggal', $tanggal)->get()
            ]);
        } else {
            return view('dinasluar.indexuser', [
                'title' => 'Absen',
                'dinas_luar' => ModelsDinasLuar::where('user_id', $user_login)->where('tanggal', $tanggal)->first()
            ]);
        }
    }
    public function absenMasukDinas(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request["jam_absen"] = date('H:i');
        
            $foto_jam_absen = $request["foto_jam_absen"];

            $image_parts = explode(";base64,", $foto_jam_absen);
    
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_dinas_luar_masuk/' . uniqid() . '.png';
    
            Storage::put($fileName, $image_base64);
    
    
            $request["foto_jam_absen"] = $fileName;
    
            $request["status_absen"] = "Masuk";
    
            $dinas_luar = ModelsDinasLuar::where('id', $id)->get();
    
            foreach ($dinas_luar as $dl) {
                $shift = $dl->Shift->jam_masuk;
                $tanggal = $dl->tanggal;
            }
    
            $tgl_skrg = date("Y-m-d");
    
            $awal  = strtotime($tanggal . $shift);
            $akhir = strtotime($tgl_skrg . $request["jam_absen"]);
            $diff  = $akhir - $awal;
    
            if ($diff <= 0) {
                $request["telat"] = 0;
            } else {
                $request["telat"] = $diff;
            }
 
            $validatedData = $request->validate([
                'jam_absen' => 'required',
                'telat' => 'nullable',
                'lat_absen' => 'required',
                'long_absen' => 'required',
                'foto_jam_absen' => 'required',
                'status_absen' => 'required'
            ]);
    
            ModelsDinasLuar::where('id', $id)->update($validatedData);
    
            $request->session()->flash('success', 'Berhasil Absen Masuk');
    
            return redirect('/dinas-luar');
    }

    public function absenPulangDinas(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request["jam_pulang"] = date('H:i');
        
            $foto_jam_pulang = $request["foto_jam_pulang"];

            $image_parts = explode(";base64,", $foto_jam_pulang);
    
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_dinas_luar_pulang/' . uniqid() . '.png';
    
            Storage::put($fileName, $image_base64);
    
            $request["foto_jam_pulang"] = $fileName;
    
            $dinas_luar = ModelsDinasLuar::where('id', $id)->get();
            foreach ($dinas_luar as $dl) {
                $shiftmasuk = $dl->Shift->jam_masuk;
                $shiftpulang = $dl->Shift->jam_keluar;
                $tanggal = $dl->tanggal;
            }
            $new_tanggal = "";
            $timeMasuk = strtotime($shiftmasuk);
            $timePulang = strtotime($shiftpulang);
    
    
            if ($timePulang < $timeMasuk) {
                $new_tanggal = date('Y-m-d', strtotime('+1 days', strtotime($tanggal)));
            } else {
                $new_tanggal = $tanggal;
            }
    
            $tgl_skrg = date("Y-m-d");
    
            $akhir = strtotime($new_tanggal . $shiftpulang);
            $awal  = strtotime($tgl_skrg . $request["jam_pulang"]);
            $diff  = $akhir - $awal;
    
            if ($diff <= 0) {
                $request["pulang_cepat"] = 0;
            } else {
                $request["pulang_cepat"] = $diff;
            }

            $validatedData = $request->validate([
                'jam_pulang' => 'required',
                'foto_jam_pulang' => 'required',
                'lat_pulang' => 'required',
                'long_pulang' => 'required',
                'pulang_cepat' => 'required',
            ]);
    
            ModelsDinasLuar::where('id', $id)->update($validatedData);
    
            return redirect('/dinas-luar')->with('success', 'Berhasil Absen Pulang');
    }

    public function dataAbsenDinas(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d');
        $user_id = request()->input('user_id');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $data_absen = ModelsDinasLuar::where('tanggal', $tglskrg)
                                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                                        return $query->where('user_id', auth()->user()->id);
                                    })
                                    ->when($user_id, function ($query) use ($user_id) {
                                        return $query->where('users.id', $user_id);
                                    })
                                    ->when($mulai && $akhir, function ($q) use ($mulai, $akhir, $user_id) {
                                        return ModelsDinasLuar::when(auth()->user()->is_admin == 'user', function ($query) {
                                                                return $query->where('user_id', auth()->user()->id);
                                                            })
                                                            ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                                                                return $query->whereBetween('tanggal', [$mulai, $akhir]);
                                                            })
                                                            ->when($user_id, function ($query) use ($user_id) {
                                                                return $query->where('users.id', $user_id);
                                                            });
                                    });

        return view('dinasluar.dataabsendinas', [
            'title' => 'Data Dinas Luar',
            'user' => User::select('id', 'name')->get(),
            'data_absen' => $data_absen->paginate(10)->withQueryString()
        ]);
    }

    public function myDinasLuar(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d');
        $data_absen = ModelsDinasLuar::where('tanggal', $tglskrg)->where('user_id', auth()->user()->id);

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["mulai"] && $request["akhir"]) {
            $data_absen = ModelsDinasLuar::where('user_id', auth()->user()->id)->whereBetween('tanggal', [$request["mulai"], $request["akhir"]]);
        }

        if (auth()->user()->is_admin == 'admin') {
            return view('dinasluar.mydinasluar', [
                'title' => 'My Dinas Luar',
                'data_absen' => $data_absen->get()
            ]);
        } else {
            return view('dinasluar.mydinasluaruser', [
                'title' => 'My Dinas Luar',
                'data_absen' => $data_absen->paginate(10)->withQueryString()
            ]);
        }
    }
}
