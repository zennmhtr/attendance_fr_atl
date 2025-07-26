<?php

namespace App\Http\Controllers;

use App\Models\dinasLuar;
use App\Models\Shift;
use App\Models\MappingShift;


use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->input('search');
        $shift = Shift::when($search, function ($query) use ($search) {
                    $query->where('nama_shift', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('nama_shift', 'ASC')
                ->paginate(10)
                ->withQueryString();

        return view('shift.index', [
            'title' => 'Data Jadwal',
            'shift' => $shift
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shift.create', [
            'title' => 'Tambah Data Jadwal'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_shift' => 'required|max:255',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);

        Shift::create($validatedData);
        return redirect('/shift')->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("shift.edit", [
            'title' => 'Edit Jadwal',
            'shift' => Shift::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_shift' => 'required|max:255',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required'
        ]);

        Shift::where('id', $id)->update($validatedData);
        return redirect('/shift')->with('success', 'Data Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = MappingShift::where('shift_id', $id)->count();
        $check2 = dinasLuar::where('shift_id', $id)->count();
        if ($check > 0 || $check2 > 0) {
            Alert::error('Failed', 'Masih Ada User Yang Menggunakan Jadwal Ini!');
            return back();
        } else {
            $delete = Shift::find($id);
            $delete->delete();
        }
        return redirect('/shift')->with('success', 'Data Berhasil di Delete');
    }
}
