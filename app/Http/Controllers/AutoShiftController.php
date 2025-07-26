<?php

namespace App\Http\Controllers;

use App\Models\AutoShift;
use App\Models\Jabatan;
use App\Models\Shift;
use Illuminate\Http\Request;

class AutoShiftController extends Controller
{
    public function index()
    {
        return view('autoshift.index', [
            'title' => 'Master Jadwal/Shift Otomatis',
            'data' => AutoShift::all()
        ]);
    }

    public function tambah()
    {
        return view('autoshift.tambah', [
            'title' => 'Tambah Data Auto Shift',
            'data_jabatan' => Jabatan::all(),
            'shift' => Shift::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "jabatan_id" => 'required',
            "shift_id" => 'required',
        ]);

        AutoShift::create($validatedData);
        return redirect('/auto-shift')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        return view('autoshift.edit', [
            'title' => 'Edit Data Auto Shift',
            'auto_shift' => AutoShift::findOrFail($id),
            'data_jabatan' => Jabatan::all(),
            'shift' => Shift::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "jabatan_id" => 'required',
            "shift_id" => 'required',
        ]);

        AutoShift::where('id', $id)->update($validatedData);
        return redirect('/auto-shift')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $delete = AutoShift::find($id);
        $delete->delete();
        return redirect('/auto-shift')->with('success', 'Data Berhasil di Delete');
    }
}
