<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class RekapExport implements FromQuery, WithColumnFormatting, WithMapping, WithHeadings,ShouldAutoSize,WithStyles
{
    use Exportable;

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();

        //BORDER
        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // HEADER
        $sheet->getStyle("A1:" . $highestColumn . "1")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // WRAP TEXT
        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getAlignment()->setWrapText(true);

        // ALIGNMENT TEXT
        $sheet->getStyle("A1:$highestColumn" . $highestRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        //BOLD FIRST ROW
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Total Cuti',
            'Total Izin Masuk',
            'Total Izin Telat',
            'Total Izin Pulang Cepat',
            'Total Hadir',
            'Total Alfa',
            'Total Libur',
            'Total Telat',
            'Total Pulang Cepat',
            'Total Lembur',
            'Persentase Kehadiran',
        ];
    }

    public function map($model): array
    {
        $tanggal_mulai = request()->input('mulai');
        $tanggal_akhir = request()->input('akhir');
        $cuti = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Cuti')->count();
        $izin_masuk = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Masuk')->count();
        $izin_telat = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Telat')->count();
        $izin_pulang_cepat = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Izin Pulang Cepat')->count();
        $masuk = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Masuk')->count();
        $total_hadir = $masuk + $izin_telat + $izin_pulang_cepat;
        $libur = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('status_absen', 'Libur')->count();
        $mulai = new \DateTime($tanggal_mulai);
        $akhir = new \DateTime($tanggal_akhir);
        $interval = $mulai->diff($akhir);
        $total_alfa = $interval->days + 1 - $masuk - $cuti - $izin_masuk - $libur;
        $total_telat = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('telat');
        $jam   = floor($total_telat / (60 * 60));
        $menit = $total_telat - ( $jam * (60 * 60) );
        $menit2 = floor($menit / 60);
        $jumlah_telat = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('telat', '>', 0)->count();
        $total_pulang_cepat = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('pulang_cepat');
        $jam_cepat   = floor($total_pulang_cepat / (60 * 60));
        $menit_cepat = $total_pulang_cepat - ( $jam_cepat * (60 * 60) );
        $menit_cepat2 = floor($menit_cepat / 60);
        $jumlah_pulang_cepat = $model->MappingShift->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->where('pulang_cepat', '>', 0)->count();
        $total_lembur = $model->Lembur->where('status', 'Approved')->whereBetween('tanggal', [$tanggal_mulai, $tanggal_akhir])->sum('total_lembur');
        $jam_lembur   = floor($total_lembur / (60 * 60));
        $menit_lembur = $total_lembur - ( $jam_lembur * (60 * 60) );
        $menit_lembur2 = floor($menit_lembur / 60);
        $timestamp_mulai = strtotime($tanggal_mulai);
        $timestamp_akhir = strtotime($tanggal_akhir);
        $selisih_timestamp = $timestamp_akhir - $timestamp_mulai;
        $jumlah_hari = (floor($selisih_timestamp / (60 * 60 * 24)))+1;
        $persentase_kehadiran = (($total_hadir + $libur) / $jumlah_hari) * 100;
        return [
            $model->name,
            $cuti . ' x',
            $izin_masuk . ' x',
            $izin_telat . ' x',
            $izin_pulang_cepat . ' x',
            $total_hadir . ' x',
            $total_alfa . ' x',
            $libur . ' x',
            $jam . " Jam " . $menit2 . " Menit\n" . $jumlah_telat . " x",
            $jam_cepat . " Jam " . $menit_cepat2 . " Menit\n" . $jumlah_pulang_cepat . " x",
            $jam_lembur." Jam ".$menit_lembur2." Menit",
            $persentase_kehadiran . ' %',

        ];


    }

    public function columnFormats(): array
    {
        return [

        ];
    }

    public function query()
    {
        return User::orderBy('name', 'ASC');
    }
}
