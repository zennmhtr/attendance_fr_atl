<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Payroll;
use App\Models\StatusPtkp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PayrollController extends Controller
{
    public function index()
    {
        $bulan = request()->input('bulan');
        $tahun = request()->input('tahun');
        if (auth()->user()->is_admin == 'admin') {
            $data = Payroll::when($bulan, function ($query) use ($bulan) {
                                return $query->where('bulan', $bulan);
                            })
                            ->when($tahun, function ($query) use ($tahun) {
                                return $query->where('tahun', $tahun);
                            })
                            ->orderBy('no_gaji', 'DESC');

            return view('payroll.index', [
                'title' => 'Payroll',
                'data' => $data->paginate(10)->withQueryString()
            ]);
        } else {
            $data = Payroll::where('user_id', auth()->user()->id)
                            ->when($bulan, function ($query) use ($bulan) {
                                return $query->where('bulan', $bulan);
                            })
                            ->when($tahun, function ($query) use ($tahun) {
                                return $query->where('tahun', $tahun);
                            })
                            ->orderBy('no_gaji', 'DESC');

            return view('payroll.indexuser', [
                'title' => 'Data Penggajian Karyawan',
                'data' => $data->paginate(10)->withQueryString()
            ]);
        }


    }

    public function tambah()
    {
        return view('payroll.tambah', [
            'title' => 'Tambah Data Penggajian Karyawan',
            'data_user' => User::select('id', 'name')->orderBy('name', 'ASC')->get(),
            'data_status' => StatusPtkp::select('id', 'name')->orderBy('name', 'ASC')->get()
        ]);
    }

    public function tambahProses(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'status_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'gaji' => 'required',
            'setoran_bpjs_kes' => 'nullable',
            'tunjangan_bpjs_kes' => 'nullable',
            'setoran_bpjs_tk' => 'nullable',
            'tunjangan_bpjs_tk' => 'nullable',
            'tunjangan_pensiun' => 'nullable',
            'tunjangan_komunikasi' => 'nullable',
            'tunjangan_pph_21' => 'nullable',
            'pot_lainnya' => 'nullable',
            'lembur' => 'nullable'
        ]);

        if(!$validated['gaji']){
            $validated['gaji'] = 0;
        }

        if(!$validated['setoran_bpjs_kes']){
            $validated['setoran_bpjs_kes'] = 0;
        }

        if(!$validated['tunjangan_bpjs_kes']){
            $validated['tunjangan_bpjs_kes'] = 0;
        }

        if(!$validated['setoran_bpjs_tk']){
            $validated['setoran_bpjs_tk'] = 0;
        }

        if(!$validated['tunjangan_bpjs_tk']){
            $validated['tunjangan_bpjs_tk'] = 0;
        }

        if(!$validated['tunjangan_pensiun']){
            $validated['tunjangan_pensiun'] = 0;
        }

        if(!$validated['tunjangan_komunikasi']){
            $validated['tunjangan_komunikasi'] = 0;
        }

        if(!$validated['tunjangan_pph_21']){
            $validated['tunjangan_pph_21'] = 0;
        }

        if(!$validated['pot_lainnya']){
            $validated['pot_lainnya'] = 0;
        }

        if(!$validated['lembur']){
            $validated['lembur'] = 0;
        }

        $validated['gaji'] = str_replace(',', '', $validated['gaji']);
        $validated['setoran_bpjs_kes'] = str_replace(',', '', $validated['setoran_bpjs_kes']);
        $validated['tunjangan_bpjs_kes'] = str_replace(',', '', $validated['tunjangan_bpjs_kes']);
        $validated['setoran_bpjs_tk'] = str_replace(',', '', $validated['setoran_bpjs_tk']);
        $validated['tunjangan_bpjs_tk'] = str_replace(',', '', $validated['tunjangan_bpjs_tk']);
        $validated['tunjangan_pensiun'] = str_replace(',', '', $validated['tunjangan_pensiun']);
        $validated['tunjangan_komunikasi'] = str_replace(',', '', $validated['tunjangan_komunikasi']);
        $validated['tunjangan_pph_21'] = str_replace(',', '', $validated['tunjangan_pph_21']);
        $validated['pot_lainnya'] = str_replace(',', '', $validated['pot_lainnya']);
        $validated['lembur'] = str_replace(',', '', $validated['lembur']);

        Payroll::create($validated);
        return redirect('/payroll')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function edit($id)
    {
        return view('payroll.edit', [
            'title' => 'Edit Data Penggajian',
            'data' => Payroll::find($id)
        ]);
    }
    public function update(Request $request, $id)
    {
        $payroll = Payroll::find($id);
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

        $user = User::find($payroll->user_id);
        $user->update(['saldo_kasbon' => $user->saldo_kasbon + $payroll->bayar_kasbon]);
        $payroll->update($validated);

        $user_update = User::find($request->user_id);
        $user_update->update(['saldo_kasbon' => $user->saldo_kasbon - $validated['bayar_kasbon']]);

        return redirect('payroll')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $payroll = Payroll::find($id);
        $user = User::find($payroll->user_id);
        $user->update(['saldo_kasbon' => $user->saldo_kasbon + $payroll->bayar_kasbon]);
        $payroll->delete();
        return redirect('/payroll')->with('success', 'Data Berhasil di Hapus');
    }

    public function download($id)
    {
        $pdf = Pdf::loadView('payroll.download', [
            'title' => 'Penggajian',
            'data' => Payroll::find($id)
        ]);

        return $pdf->stream();
    }
}
