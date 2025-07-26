<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use RealRashid\SweetAlert\Facades\Alert;

class LokasiController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $lokasi = Lokasi::where('status', 'approved')
                    ->when($search, function ($query) use ($search) {
                        $query->where('nama_lokasi', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('nama_lokasi', 'ASC')
                    ->paginate(10)
                    ->withQueryString();

        return view('lokasi.index', [
            'title' => 'Lokasi Kantor',
            'data_lokasi' => $lokasi
        ]);
    }

    public function pendingLocation()
    {
        $search = request()->input('search');
        $lokasi = Lokasi::where('status', 'pending')
                    ->when($search, function ($query) use ($search) {
                        $query->where('nama_lokasi', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('nama_lokasi', 'ASC')
                    ->paginate(10)
                    ->withQueryString();
        return view('lokasi.indexpending', [
            'title' => 'Pending Location',
            'data_lokasi' => $lokasi
        ]);
    }

    public function requestLocation()
    {
        $search = request()->input('search');
        $lokasi = Lokasi::where('created_by', auth()->user()->id)
                        ->when($search, function ($query) use ($search) {
                            $query->where('nama_lokasi', 'LIKE', '%' . $search . '%');
                        })
                        ->paginate(10)
                        ->withQueryString();
        if (auth()->user()->is_admin == 'admin') {
            return view('lokasi.indexrequest', [
                'title' => 'Request Lokasi',
                'data_lokasi' => $lokasi
            ]);
        } else {
            return view('lokasi.indexrequestuser', [
                'title' => 'Request Lokasi',
                'data_lokasi' => $lokasi
            ]);
        }
    }

    public function tambahLokasi()
    {
        return view('lokasi.tambah', [
            'title' => 'Tambah Lokasi Kantor'
        ]);
    }

    public function tambahRequestLocation()
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('lokasi.tambahrequest', [
                'title' => 'Tambah Lokasi Kantor'
            ]);
        } else {
            return view('lokasi.tambahrequestUser', [
                'title' => 'Tambah Lokasi Kantor'
            ]);
        }

    }

    public function prosesTambahLokasi(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'radius' => 'required',
            'status' => 'required',
            'created_by' => 'required'
        ]);
        Lokasi::create($validatedData);
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Di Tambahkan');
    }
    
    public function prosesTambahRequestLocation(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'radius' => 'required',
            'status' => 'required',
            'created_by' => 'required'
        ]);
        
        $lokasi = Lokasi::create($validatedData);

        $users = User::where('is_admin', 'admin')->get();
        foreach ($users as $user) {
            $type = 'Approval';
            $notif = 'Request Lokasi Dari ' . auth()->user()->name . ' Butuh Approval Anda'; 
            $url = url('/lokasi-kantor/pending-location'); 

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/lokasi-kantor/pending-location'
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        return redirect('/request-location')->with('success', 'Lokasi Berhasil Di Tambahkan');
    }

    public function editLokasi($id)
    {
        return view('lokasi.edit', [
            'title' => 'Edit Lokasi Kantor',
            'lokasi' => Lokasi::findOrFail($id)
        ]);
    }

    public function editRequestLocation($id)
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('lokasi.editrequest', [
                'title' => 'Edit Lokasi Kantor',
                'lokasi' => Lokasi::findOrFail($id)
            ]);
        } else {
            return view('lokasi.editrequestuser', [
                'title' => 'Edit Lokasi Kantor',
                'lokasi' => Lokasi::findOrFail($id)
            ]);
        }
    }

    public function UpdatePendingLocation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required'
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        $lokasi = Lokasi::findOrFail($id);
        if($validatedData["status"] == 'approved'){
            $user_id = $lokasi->created_by;
            User::where('id', $user_id)->update(['lokasi_id' => $lokasi->id]);

            $user = User::find($lokasi->created_by);
            $type = 'Approved';
            $notif = 'Request Lokasi Anda Telah Di Approve Oleh ' . auth()->user()->name; 
            $url = url('/request-location'); 
    
            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/request-location'
            ];

            $user->notify(new \App\Notifications\UserNotification);
    
            NotifApproval::dispatch($type, $user->id, $notif, $url);

            return redirect('/lokasi-kantor/pending-location')->with('success', 'Lokasi Berhasil Di Approve');    
        } else {
            $user = User::find($lokasi->created_by);
            $type = 'Rejected';
            $notif = 'Request Lokasi Anda Telah Di Reject Oleh ' . auth()->user()->name; 
            $url = url('/request-location'); 
    
            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'message'   =>  $notif,
                'action'   =>  '/request-location'
            ];

            $user->notify(new \App\Notifications\UserNotification);
    
            NotifApproval::dispatch($type, $user->id, $notif, $url);

            return redirect('/lokasi-kantor/pending-location')->with('success', 'Lokasi Berhasil Di Reject');    
        }
    }

    public function updateLokasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required'
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Diupdate');    
    }

    public function updateRequestLocation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'lat_kantor' => 'required',
            'long_kantor' => 'required',
            'status' => 'required'
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/request-location')->with('success', 'Lokasi Berhasil Diupdate');    
    }

    public function updateRadiusLokasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'radius' => 'required',
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Diupdate');
    }

    public function updateRadiusRequestLocation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'radius' => 'required',
            'status' => 'required'
        ]);

        Lokasi::where('id', $id)->update($validatedData);
        return redirect('/request-location')->with('success', 'Lokasi Berhasil Diupdate');
    }

    public function deleteLokasi($id)
    {
        $check = User::where('lokasi_id', $id)->count();
        if ($check > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Lokasi Ini!');
            return back();
        } else {
            $lokasi = Lokasi::findOrFail($id);
            $lokasi->delete();
        }
        return redirect('/lokasi-kantor')->with('success', 'Lokasi Berhasil Di Delete');
    }

    public function deleteRequestLocation($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $user = User::where('lokasi_id', $id)->count();
        if($user > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Lokasi Ini!');
            return redirect('/request-location');
        } else {
            $lokasi->delete();
            return redirect('/request-location')->with('success', 'Lokasi Berhasil Di Delete');
        }
    }
}
