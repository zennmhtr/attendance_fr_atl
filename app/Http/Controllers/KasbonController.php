<?php

namespace App\Http\Controllers;

use App\Models\Kasbon;
use App\Models\User;
use Illuminate\Http\Request;

class KasbonController extends Controller
{
    public function index()
    {
        $tanggal = request()->input('tanggal');
        $status = request()->input('status');
        if (auth()->user()->is_admin == 'admin') {
            $data = Kasbon::when($tanggal, function ($query) use ($tanggal) {
                                return $query->where('tanggal', $tanggal);
                            })
                            ->when($status, function ($query) use ($status) {
                                return $query->where('status', $status);
                            })
                            ->orderBy('id', 'DESC');
                            
            return view('kasbon.index', [
                'title' => 'Data Kasbon Pegawai',
                'data' => $data->paginate(10)->withQueryString()
            ]);
        } else {
           $data = Kasbon::where('user_id', auth()->user()->id)
                            ->when($tanggal, function ($query) use ($tanggal) {
                                return $query->where('tanggal', $tanggal);
                            })
                            ->when($status, function ($query) use ($status) {
                                return $query->where('status', $status);
                            })
                            ->orderBy('id', 'DESC');
            
            return view('kasbon.indexuser', [
                'title' => 'Data Kasbon Pegawai',
                'data' => $data->paginate(10)->withQueryString()
            ]);
        }
        

    }

    public function tambah()
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('kasbon.tambah', [
                'title' => 'Tambah Data Kasbon',
                'data_user' => User::orderBy('name', 'asc')->get()
            ]);
        } else {
            return view('kasbon.tambahuser', [
                'title' => 'Tambah Data Kasbon',
                'data_user' => User::orderBy('name', 'asc')->get()
            ]);
        }

    }
    
    public function tambahProses(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'keperluan' => 'required',
            'status' => 'required',
        ]);

        $validated['nominal'] = str_replace(',', '', $validated['nominal']);

        Kasbon::create($validated);
        return redirect('/kasbon')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('kasbon.edit', [
                'title' => 'Edit Data Kasbon',
                'data_user' => User::orderBy('name', 'asc')->get(),
                'kasbon' => Kasbon::find($id),
            ]);
        } else {
            return view('kasbon.edituser', [
                'title' => 'Edit Data Kasbon',
                'data_user' => User::orderBy('name', 'asc')->get(),
                'kasbon' => Kasbon::find($id),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $kasbon = Kasbon::find($id);
        $validated = $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'keperluan' => 'required',
            'status' => 'required',
        ]);

        $validated['nominal'] = str_replace(',', '', $validated['nominal']);

        if ($validated['status'] == 'ACC') {
            $user = User::find($validated['user_id']);
            $user->update(['saldo_kasbon' => $user->saldo_kasbon + $validated['nominal']]);
        }

        $kasbon->update($validated);
        return redirect('/kasbon')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $kasbon = Kasbon::find($id);
        if ($kasbon->status == 'ACC') {
            $user = User::find($kasbon->user_id);
            $user->update(['saldo_kasbon' => $user->saldo_kasbon - $kasbon->nominal]);
        }
        $kasbon->delete();
        return redirect('/kasbon')->with('success', 'Data Berhasil di Hapus');
    }

}
