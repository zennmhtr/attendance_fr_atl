<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lembur;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LemburController extends Controller
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $user_login = auth()->user()->id;
        $tanggal = "";
        $tglskrg = date("Y-m-d");
        $tglkmrn = date('Y-m-d', strtotime('-1 days'));
        $lembur = Lembur::where('user_id', $user_login)->where('tanggal', $tglkmrn)->get();
        if($lembur->count() > 0) {
            foreach($lembur as $l) {
                $jam_keluar = $l->jam_keluar;
            }
        } else {
            $jam_keluar = "-";
        }
        if($jam_keluar == null){
            $tanggal = $tglkmrn;
        } else {
            $tanggal = $tglskrg;
        }

        if (auth()->user()->is_admin == 'admin') {
            return view('lembur.index', [
                'title' => 'Absen Lembur',
                'lembur' => Lembur::where('user_id', $user_login)->where('tanggal', $tanggal)->get()
            ]);
        } else {
            return view('lembur.indexuser', [
                'title' => 'Absen Lembur',
                'lembur' => Lembur::where('user_id', $user_login)->where('tanggal', $tanggal)->first()
            ]);
        }

    }
    
    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
      
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public function masuk(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        $lat_kantor = auth()->user()->Lokasi->lat_kantor;
        $long_kantor = auth()->user()->Lokasi->long_kantor;
        $radius = auth()->user()->Lokasi->radius;
        $nama_lokasi = auth()->user()->Lokasi->nama_lokasi;

        $request["jarak_masuk"] = $this->distance($request["lat_masuk"], $request["long_masuk"], $lat_kantor, $long_kantor, "K") * 1000;

        if($request["jarak_masuk"] > $radius) {
            Alert::error('Diluar Jangkauan', 'Lokasi Anda Diluar Radius ' . $nama_lokasi);
            return redirect('/lembur');
        } else {
            $foto_jam_masuk = $request["foto_jam_masuk"];

            $image_parts = explode(";base64,", $foto_jam_masuk);
    
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_jam_masuk_lembur/' . uniqid() . '.png';
    
            Storage::put($fileName, $image_base64);
    
            $request["foto_jam_masuk"] = $fileName;

            $validatedData = $request->validate([
                'user_id' => 'required',
                'tanggal' => 'required',
                'jam_masuk' => 'required',
                'foto_jam_masuk' => 'required',
                'lat_masuk' => 'required',
                'long_masuk' => 'required',
                'jarak_masuk' => 'required',
                'status' => 'required'
            ]);
    
            Lembur::create($validatedData);
    
            $request->session()->flash('success', 'Berhasil Masuk Lembur');
    
            return redirect('/lembur');
        }

    }

    public function pulang(Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $lat_kantor = auth()->user()->Lokasi->lat_kantor;
        $long_kantor = auth()->user()->Lokasi->long_kantor;
        $radius = auth()->user()->Lokasi->radius;
        $nama_lokasi = auth()->user()->Lokasi->nama_lokasi;

        $request["jarak_keluar"] = $this->distance($request["lat_keluar"], $request["long_keluar"], $lat_kantor, $long_kantor, "K") * 1000;

        if($request["jarak_keluar"] > $radius) {
            Alert::error('Diluar Jangkauan', 'Lokasi Anda Diluar Radius ' . $nama_lokasi);
            return redirect('/lembur');
        } else {
            $foto_jam_keluar = $request["foto_jam_keluar"];

            $image_parts = explode(";base64,", $foto_jam_keluar);

            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_jam_keluar_lembur/' . uniqid() . '.png';

            Storage::put($fileName, $image_base64);

            $request["foto_jam_keluar"] = $fileName;

            $lembur = Lembur::find($id);
            
            $jam_masuk = $lembur->jam_masuk;
            $time_masuk = strtotime($jam_masuk);
            $time_keluar = strtotime($request["jam_keluar"]);

            $diff = $time_keluar - $time_masuk;

            $request["total_lembur"] = $diff;
            
            $validatedData = $request->validate([
                'jam_keluar' => 'required',
                'lat_keluar' => 'required',
                'long_keluar' => 'required',
                'jarak_keluar' => 'required',
                'foto_jam_keluar' => 'required',
                'total_lembur' => 'required'
            ]);
    
            Lembur::where('id', $id)->update($validatedData);

            $users = User::where('is_admin', 'admin')->get();
            foreach ($users as $user) {
                $type = 'Approval';
                $notif = 'Pengajuan Lembur Dari ' . auth()->user()->name . ' Butuh Approval Anda'; 
                $url = url('/data-lembur?user_id='.$lembur->user_id.'&mulai='.$lembur->tanggal.'&akhir='.$lembur->tanggal); 
    
                $user->messages = [
                    'user_id'   =>  auth()->user()->id,
                    'from'   =>  auth()->user()->name,
                    'message'   =>  $notif,
                    'action'   =>  '/data-lembur?user_id='.$user->id.'&mulai='.$lembur->tanggal.'&akhir='.$lembur->tanggal
                ];
                $user->notify(new \App\Notifications\UserNotification);
    
                NotifApproval::dispatch($type, $user->id, $notif, $url);
            }

    
            return redirect('/lembur')->with('success', 'Berhasil Pulang Lembur');
        }

    }

    public function dataLembur(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d');
        $data_lembur = Lembur::where('tanggal', $tglskrg);

        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["user_id"] && $request["mulai"] && $request["akhir"]) {
            $data_lembur = Lembur::where('user_id', $request["user_id"])->whereBetween('tanggal', [$request["mulai"], $request["akhir"]]);
        }

        return view('lembur.datalembur', [
            'title' => 'Data Lembur',
            'user' => User::select('id', 'name')->get(),
            'data_lembur' => $data_lembur->paginate(10)->withQueryString()
        ]);
    }

    public function myLembur(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tglskrg = date('Y-m-d');
        $data_lembur = Lembur::where('tanggal', $tglskrg)->where('user_id', auth()->user()->id);
        if($request["mulai"] == null) {
            $request["mulai"] = $request["akhir"];
        }

        if($request["akhir"] == null) {
            $request["akhir"] = $request["mulai"];
        }

        if ($request["mulai"] && $request["akhir"]) {
            $data_lembur = Lembur::where('user_id', auth()->user()->id)->whereBetween('tanggal', [$request["mulai"], $request["akhir"]]);
        }

        if (auth()->user()->is_admin == 'admin') {
            return view('lembur.mylembur', [
                'title' => 'My Lembur',
                'data_lembur' => $data_lembur->get()
            ]);
        } else {
            return view('lembur.mylemburuser', [
                'title' => 'My Lembur',
                'data_lembur' => $data_lembur->paginate(10)->withQueryString()
            ]);
        }
    }

    public function approval(Request $request, $id)
    {
        $lembur = Lembur::find($id);
        $validated = $request->validate([
            'status' => 'required',
            'notes' => 'nullable',
            'approved_by' => 'required',
        ]);

        if ($request['status'] == 'Approved') {
            $stat = 'Approve';
            $user = User::find($lembur->user_id);
            $type = 'Approved';
            $notif = 'Lembur Anda Telah Di Approve Oleh ' . auth()->user()->name; 
            $url = url('/my-lembur?mulai='.$lembur->tanggal.'&akhir='.$lembur->tanggal); 
    
            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/my-lembur?mulai='.$lembur->tanggal.'&akhir='.$lembur->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);
    
            NotifApproval::dispatch($type, $user->id, $notif, $url);
        } else {
            $stat = 'Reject';
            $user = User::find($lembur->user_id);
            $type = 'Rejected';
            $notif = 'Lembur Anda Telah Di Reject Oleh ' . auth()->user()->name; 
            $url = url('/my-lembur?mulai='.$lembur->tanggal.'&akhir='.$lembur->tanggal); 
    
            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/my-lembur?mulai='.$lembur->tanggal.'&akhir='.$lembur->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);
    
            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        $lembur->update($validated);
        return redirect('/data-lembur')->with('success', 'Berhasil ' . $stat . ' Lembur');
    }
}
