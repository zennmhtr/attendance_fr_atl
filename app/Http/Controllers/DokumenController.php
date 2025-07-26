<?php

namespace App\Http\Controllers;

use App\Mail\Email;
use App\Models\Sip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $search = request()->input('search');
        $sip = Sip::when($search, function ($query) use ($search) {
                    $query->where('nama_dokumen', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('nama_dokumen', 'ASC')
                ->paginate(10)
                ->withQueryString();

        return view('dokumen.index', [
            'title' => 'Data Dokumen Pegawai',
            'data_dokumen' => $sip
        ]);
    }

    public function tambah()
    {
        return view('dokumen.tambah', [
            'title' => 'Tambah Data Dokumen',
            'data_user' => User::all()
        ]);
    }
    
    public function tambahProses(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_dokumen' => 'required',
            'tanggal_berakhir' => 'required',
            'file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:10000'
        ]);

        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('file');
        }

        Sip::create($validatedData);
        return redirect('/dokumen')->with('success', 'Dokumen Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        return view('dokumen.edit', [
            'title' => "Edit Data Dokumen",
            'data_user' => User::all(),
            'data_dokumen' => Sip::findOrFail($id)
        ]);
    }

    public function editProses(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_dokumen' => 'required',
            'file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:10000'
        ]);

        if ($request->file('file')) {
            if ($request->file_lama) {
                Storage::delete($request->file_lama);
            }
            $validatedData['file'] = $request->file('file')->store('file');
        }

        Sip::where('id', $id)->update($validatedData);
        return redirect('/dokumen')->with('success', 'Dokumen Berhasil Diupdate');
    }
    
    public function delete($id)
    {
        $dokumen = Sip::findOrFail($id);
        $dokumen->delete();
        Storage::delete($dokumen->file);
        return redirect('/dokumen')->with('success', 'Dokumen Berhasil Didelete');
    }
    
    public function myDokumen()
    {
        $search = request()->input('search');
        $sip = Sip::where('user_id', auth()->user()->id)
                ->when($search, function ($query) use ($search) {
                    $query->where('nama_dokumen', 'LIKE', '%' . $search . '%');
                })
                ->orderBy('nama_dokumen', 'ASC')
                ->paginate(10)
                ->withQueryString();
        if (auth()->user()->is_admin == 'admin') {
            return view('dokumen.mydokumen', [
                'title' => 'Data Dokumen Saya',
                'data_dokumen' => $sip
            ]);
        } else {
            return view('dokumen.mydokumenuser', [
                'title' => 'Data Dokumen Saya',
                'data_dokumen' => $sip
            ]);
        }
        
    }

    public function myDokumenTambah()
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('dokumen.mydokumentambah', [
                'title' => 'Tambah Data Dokumen'
            ]);
        } else {
            return view('dokumen.mydokumentambahuser', [
                'title' => 'Tambah Data Dokumen'
            ]);
        }
    }

    public function myDokumenTambahProses(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_dokumen' => 'required',
            'tanggal_berakhir' => 'required',
            'file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:10000'
        ]);

        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('file');
        }

        Sip::create($validatedData);
        return redirect('/my-dokumen')->with('success', 'Dokumen Berhasil Ditambahkan');
    }

    public function myDokumenEdit($id)
    {
        if (auth()->user()->is_admin == 'admin') {
            return view('dokumen.mydokumenedit', [
                'title' => "Edit Data Dokumen",
                'data_dokumen' => Sip::findOrFail($id)
            ]);
        } else {
            return view('dokumen.mydokumenedituser', [
                'title' => "Edit Data Dokumen",
                'data_dokumen' => Sip::findOrFail($id)
            ]);
        }

    }
    public function myDokumenEditProses(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_dokumen' => 'required',
            'file' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:10000'
        ]);

        if ($request->file('file')) {
            if ($request->file_lama) {
                Storage::delete($request->file_lama);
            }
            $validatedData['file'] = $request->file('file')->store('file');
        }

        Sip::where('id', $id)->update($validatedData);
        return redirect('/my-dokumen')->with('success', 'Dokumen Berhasil Diupdate');
    }

    public function myDokumenDelete($id)
    {
        $dokumen = Sip::findOrFail($id);
        $dokumen->delete();
        Storage::delete($dokumen->file);
        return redirect('/my-dokumen')->with('success', 'Dokumen Berhasil Didelete');
    }
}
