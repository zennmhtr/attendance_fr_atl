<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Golongan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GolonganController extends Controller
{
    public function index()
    {
        return view('golongan.index', [
            'title' => 'Master Golongan',
            'data' => Golongan::all()
        ]);
    }

    public function tambah()
    {
        return view('golongan.tambah', [
            'title' => 'Tambah Data Golongan'
        ]);
    }

    public function tambahProses(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Golongan::create($validatedData);
        return redirect('/golongan')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function edit($id)
    {
        return view('golongan.edit', [
            'title' => 'Edit Data Golongan',
            'data' => Golongan::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Golongan::where('id', $id)->update($validatedData);
        return redirect('/golongan')->with('success', 'Data Berhasil di Update');
    }

    public function delete($id)
    {
        $user = User::where('golongan_id', $id)->count();
        if ($user > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Golongan Ini!');
            return redirect('/golongan');
        } else {
            Golongan::where('id', $id)->delete();
            return redirect('/golongan')->with('success', 'Data Berhasil di Delete');
        }
    }
}
