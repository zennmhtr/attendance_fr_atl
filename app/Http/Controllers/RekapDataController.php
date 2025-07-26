<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use App\Models\Lembur;
use App\Models\Counter;
use App\Models\Payroll;
use App\Exports\RekapExport;
use App\Models\MappingShift;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class RekapDataController extends Controller
{
    public function index()
    {
        return view('rekapdata.index', [
            'title' => 'Rekapitulasi Absensi',
        ]);
    }

    public function getData()
    {
        request()->validate([
            'mulai' => 'required',
            'akhir' => 'required',
        ]);

        date_default_timezone_set('Asia/Jakarta');

        $user = User::orderBy('name', 'ASC')->paginate(10)->withQueryString();

        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $title = "Rekap Data Absensi";

        return view('rekapdata.getdata', [
            'title' => $title,
            'data_user' => $user,
            'tanggal_mulai' => $mulai,
            'tanggal_akhir' => $akhir
        ]);
    }

    public function export()
    {
        return (new RekapExport($_GET))->download('List Rekap Data.xlsx');
    }

    public function payroll($id)
    {
        $user = User::find($id);
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');
        $counter = Counter::where('name', 'Gaji')->first();
        $counter->update(['counter' => $counter->counter + 1]);
        $next_number = str_pad($counter->counter, 6, '0', STR_PAD_LEFT);
        $no_gaji = $counter->text . $next_number;

        return view('rekapdata.payroll', [
            'title' => 'Penggajian',
            'user' => $user,
            'tanggal_mulai' => $mulai,
            'tanggal_akhir' => $akhir,
            'no_gaji' => $no_gaji
        ]);
    }

    public function tambahPayroll(Request $request)
    {
        $cek = Payroll::where('user_id', $request['user_id'])->where('bulan', $request['bulan'])->where('tahun', $request['tahun'])->first();
        if ($cek) {
            Alert::error('Failed', 'Sudah Ada Data Pada Bulan Dan Tahun Tersebut!');
            return redirect('/rekap-data/get-data?mulai='.$request['tanggal_mulai'].'&akhir='.$request['tanggal_akhir'])->with('failed', 'Data Berhasil Disimpan');
        } else {
            $validated = $request->validate([
                'user_id' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_akhir' => 'required',
                'persentase_kehadiran' => 'required',
                'no_gaji' => 'required',
                'gaji_pokok' => 'required',
                'total_reimbursement' => 'required',
                'uang_transport' => 'required',
                'jumlah_mangkir' => 'required',
                'uang_mangkir' => 'required',
                'total_mangkir' => 'required',
                'jumlah_lembur' => 'required',
                'uang_lembur' => 'required',
                'total_lembur' => 'required',
                'jumlah_izin' => 'required',
                'uang_izin' => 'required',
                'total_izin' => 'required',
                'jumlah_bonus' => 'required',
                'uang_bonus' => 'required',
                'total_bonus' => 'required',
                'jumlah_terlambat' => 'required',
                'uang_terlambat' => 'required',
                'total_terlambat' => 'required',
                'jumlah_kehadiran' => 'required',
                'uang_kehadiran' => 'required',
                'total_kehadiran' => 'required',
                'saldo_kasbon' => 'required',
                'bayar_kasbon' => 'required',
                'jumlah_thr' => 'required',
                'uang_thr' => 'required',
                'total_thr' => 'required',
                'loss' => 'required',
                'total_penjumlahan' => 'required',
                'total_pengurangan' => 'required',
                'grand_total' => 'required',
            ]);

            $validated['gaji_pokok'] = str_replace(',', '', $validated['gaji_pokok']);
            $validated['total_reimbursement'] = str_replace(',', '', $validated['total_reimbursement']);
            $validated['uang_transport'] = str_replace(',', '', $validated['uang_transport']);
            $validated['uang_mangkir'] = str_replace(',', '', $validated['uang_mangkir']);
            $validated['total_mangkir'] = str_replace(',', '', $validated['total_mangkir']);
            $validated['uang_lembur'] = str_replace(',', '', $validated['uang_lembur']);
            $validated['total_lembur'] = str_replace(',', '', $validated['total_lembur']);
            $validated['uang_izin'] = str_replace(',', '', $validated['uang_izin']);
            $validated['total_izin'] = str_replace(',', '', $validated['total_izin']);
            $validated['uang_bonus'] = str_replace(',', '', $validated['uang_bonus']);
            $validated['total_bonus'] = str_replace(',', '', $validated['total_bonus']);
            $validated['uang_terlambat'] = str_replace(',', '', $validated['uang_terlambat']);
            $validated['total_terlambat'] = str_replace(',', '', $validated['total_terlambat']);
            $validated['uang_kehadiran'] = str_replace(',', '', $validated['uang_kehadiran']);
            $validated['total_kehadiran'] = str_replace(',', '', $validated['total_kehadiran']);
            $validated['saldo_kasbon'] = str_replace(',', '', $validated['saldo_kasbon']);
            $validated['bayar_kasbon'] = str_replace(',', '', $validated['bayar_kasbon']);
            $validated['uang_thr'] = str_replace(',', '', $validated['uang_thr']);
            $validated['total_thr'] = str_replace(',', '', $validated['total_thr']);
            $validated['loss'] = str_replace(',', '', $validated['loss']);
            $validated['total_penjumlahan'] = str_replace(',', '', $validated['total_penjumlahan']);
            $validated['total_pengurangan'] = str_replace(',', '', $validated['total_pengurangan']);
            $validated['grand_total'] = str_replace(',', '', $validated['grand_total']);

            $user = User::find($request['user_id']);
            $user->update(['saldo_kasbon' => $user->saldo_kasbon - $validated['bayar_kasbon']]);

            Payroll::create($validated);
            return redirect('/rekap-data/get-data?mulai='.$request['tanggal_mulai'].'&akhir='.$request['tanggal_akhir'])->with('success', 'Data Berhasil Disimpan');
        }
    }

    public function detailPdf()
    {
        $pdf = Pdf::loadView('rekapdata.detailPdf', [
            'title' => 'Detail PDF',
            'data' => MappingShift::dataAbsen()->get()
        ]);

        return $pdf->stream();
    }

    public function rekapPdf()
    {
        $pdf = Pdf::loadView('rekapdata.rekapPdf', [
            'title' => 'Rekap PDF',
            'data' => User::orderBy('name', 'ASC')->get()
        ]);

        return $pdf->stream();
    }
}
