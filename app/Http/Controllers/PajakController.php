<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;

class PajakController extends Controller
{
    public function index(Request $request)
    {
        $data = Payroll::orderBy('id', 'DESC');

        if($request['tahun'] !== null && $request['bulan'] == null){
            $data = Payroll::orderBy('id', 'DESC')->where('tahun', $request['tahun']);
        } else if ($request['tahun'] !== null && $request['bulan'] !== null) {
            $data = Payroll::orderBy('id', 'DESC')->where('tahun', $request['tahun'])->where('bulan', $request['bulan']);
        } else {
            $data = Payroll::orderBy('id', 'DESC');
        }
        return view('pajak.index', [
            'title' => 'Data Pajak Karyawan',
            'data' => $data->paginate(10)->withQueryString()
        ]);
    }
}
