<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class KunjunganController extends Controller
{
    public function index()
    {
        $title = 'Kunjungan';
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $kunjungan = Kunjungan::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                        $query->whereBetween('tanggal', [$mulai, $akhir]);
                    })
                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->orderBy('tanggal', 'DESC')
                    ->paginate(10)
                    ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.index', compact(
                'title',
                'kunjungan'
            ));
        } else {
            return view('kunjungan.indexUser', compact(
                'title',
                'kunjungan'
            ));
        }
    }

    public function tambah()
    {
        $title = 'Kunjungan';
        $user = User::orderBy('name', 'ASC')->get();
        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.tambah', compact(
                'title',
                'user',
            ));
        } else {
            return view('kunjungan.tambahUser', compact(
                'title',
                'user',
            ));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'visit_in' => 'required',
            'visit_out' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'keterangan' => 'required',
            'foto' => 'required|image|file|max:10240',
        ]);
        if ($request->file('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto');
        }

        Kunjungan::create($validated);
        return redirect('/kunjungan')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $title = 'Kunjungan';
        $user = User::orderBy('name', 'ASC')->get();
        $kunjungan = Kunjungan::find($id);
        if (auth()->user()->is_admin == 'admin') {
            return view('kunjungan.edit', compact(
                'title',
                'user',
                'kunjungan',
            ));
        } else {
            return view('kunjungan.editUser', compact(
                'title',
                'user',
                'kunjungan',
            ));
        }
    }

    public function update(Request $request, $id)
    {
        $kunjungan = Kunjungan::find($id);
        $validated = $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'visit_in' => 'required',
            'visit_out' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'keterangan' => 'required',
            'foto' => 'image|file|max:10240',
        ]);
        if ($request->file('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto');
        }

        $kunjungan->update($validated);
        return redirect('/kunjungan')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $kunjungan = Kunjungan::find($id);
        $kunjungan->delete();
        return redirect('/kunjungan')->with('success', 'Data Berhasil Dihapus');
    }

}
