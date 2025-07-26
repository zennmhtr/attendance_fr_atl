<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class jabatanController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $jabatan = Jabatan::when($search, function ($query) use ($search) {
                        $query->where('nama_jabatan', 'LIKE', '%' . $search . '%');
                    })
                    ->orderBy('nama_jabatan', 'ASC')
                    ->paginate(10)
                    ->withQueryString();

        return view('jabatan.index', [
            'title' => 'Data Jabatan',
            'data_jabatan' => $jabatan
        ]);
    }

    public function create()
    {
        return view('jabatan.create', [
            'title' => 'Tambah Data Jabatan',
            'users' => User::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function insert(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|max:255',
            'manager' => 'nullable',
        ]);

        Jabatan::create($validatedData);
        return redirect('/jabatan')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function edit($id)
    {
        return view('jabatan.edit', [
            'title' => 'Edit Data Jabatan',
            'data_jabatan' => Jabatan::findOrFail($id),
            'users' => User::select('id', 'name')->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|max:255',
            'manager' => 'nullable',
        ]);

        Jabatan::where('id', $id)->update($validatedData);
        return redirect('/jabatan')->with('success', 'Data Berhasil di Update');
    }

    public function delete($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $user = User::where('jabatan_id', $id)->count();
        if ($user > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Jabatan Ini!');
            return redirect('/jabatan');
        } else {
            $jabatan->delete();
            return redirect('/jabatan')->with('success', 'Data Berhasil di Delete');
        }
    }
}
