<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Kategori Reimbursment';
        $search = request()->input('search');
        $kategori = Kategori::when($search, function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%'.$search.'%');
                    })
                    ->orderBy('name', 'ASC')
                    ->paginate(10)
                    ->withQueryString();

        return view('kategori.index', compact(
            'title',
            'kategori'
        ));
    }

    public function tambah()
    {
        $title = 'Kategori Reimbursment';
        return view('kategori.tambah', compact(
            'title',
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'active' => 'nullable',
        ]);

        $validated['active'] = $request['active'] ? $request['active'] : null;
        Kategori::create($validated);
        return redirect('/kategori')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $kategori = Kategori::find($id);
        $title = 'Kategori Reimbursment';
        return view('kategori.edit', compact(
            'title',
            'kategori',
        ));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'active' => 'nullable',
        ]);

        $validated['active'] = $request['active'] ? $request['active'] : null;
        $kategori->update($validated);
        return redirect('/kategori')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect('/kategori')->with('success', 'Data Berhasil Dihapus');
    }

}
