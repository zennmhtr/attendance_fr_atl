<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $title = 'Pengaturan';
        $data = settings::first();
        return view('settings.index', compact(
            'title',
            'data'
        ));
    }

    public function store(Request $request)
    {
        $settings = settings::first();

        $validated = $request->validate([
            'name' => 'required',
            'logo' => 'image|file|max:10240|nullable',
            'alamat' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
        ]);
        if ($request->file('logo')) {
            $validated['logo'] = $request->file('logo')->store('logo');
        }
        $settings->update($validated);
        return back()->with('success', 'Data Berhasil Ditambahkan');
    }
}
