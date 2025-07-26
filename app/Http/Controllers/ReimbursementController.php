<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Reimbursement;

class ReimbursementController extends Controller
{
    public function index()
    {
        $title = 'Reimbursement';
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $reimbursement = Reimbursement::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                        $query->whereBetween('tanggal', [$mulai, $akhir]);
                    })
                    ->when(auth()->user()->is_admin == 'user', function ($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->orderBy('tanggal', 'DESC')
                    ->paginate(10)
                    ->withQueryString();

        if (auth()->user()->is_admin == 'admin') {
            return view('reimbursement.index', compact(
                'title',
                'reimbursement'
            ));
        } else {
            return view('reimbursement.indexUser', compact(
                'title',
                'reimbursement'
            ));
        }
    }

    public function tambah()
    {
        $title = 'Reimbursement';
        $user = User::orderBy('name', 'ASC')->get();
        $kategori = Kategori::orderBy('name', 'ASC')->where('active', 1)->get();
        if (auth()->user()->is_admin == 'admin') {
            return view('reimbursement.tambah', compact(
                'title',
                'user',
                'kategori',
            ));
        } else {
            return view('reimbursement.tambahUser', compact(
                'title',
                'user',
                'kategori',
            ));
        }

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'user_id' => 'required',
            'event' => 'required',
            'kategori_id' => 'required',
            'status' => 'required',
            'jumlah' => 'required',
            'file_path' => 'required'
        ]);

        $validated['jumlah'] = str_replace(',', '', $validated['jumlah']);

        if ($request->file('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('file_path');
            $validated['file_name'] = $request->file('file_path')->getClientOriginalName();
        }

        Reimbursement::create($validated);
        return redirect('/reimbursement')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $reimbursement = Reimbursement::find($id);
        $title = 'Reimbursement';
        $user = User::orderBy('name', 'ASC')->get();
        $kategori = Kategori::orderBy('name', 'ASC')->where('active', 1)->get();
        if (auth()->user()->is_admin == 'admin') {
            return view('reimbursement.edit', compact(
                'title',
                'user',
                'kategori',
                'reimbursement',
            ));
        } else {
            return view('reimbursement.editUser', compact(
                'title',
                'user',
                'kategori',
                'reimbursement',
            ));
        }

    }

    public function update(Request $request, $id)
    {
        $reimbursement = Reimbursement::find($id);
        $validated = $request->validate([
            'tanggal' => 'required',
            'user_id' => 'required',
            'event' => 'required',
            'kategori_id' => 'required',
            'status' => 'required',
            'jumlah' => 'required',
            'file_path' => 'nullable'
        ]);

        $validated['jumlah'] = str_replace(',', '', $validated['jumlah']);

        if ($request->file('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('file_path');
            $validated['file_name'] = $request->file('file_path')->getClientOriginalName();
        }

        $reimbursement->update($validated);
        return redirect('/reimbursement')->with('success', 'Data Berhasil Diupdate');
    }

    public function approval(Request $request, $id)
    {
        $reimbursement = Reimbursement::find($id);
        $validated = $request->validate([
            'status' => 'required',
        ]);
        $reimbursement->update($validated);
        return redirect('/reimbursement')->with('success', 'Data Berhasil Diupdate');
    }


    public function delete($id)
    {
        $reimbursement = Reimbursement::find($id);
        $reimbursement->delete();
        return redirect('/reimbursement')->with('success', 'Data Berhasil Didelete');
    }

}
