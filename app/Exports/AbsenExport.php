<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\MappingShift;

class AbsenExport implements FromQuery, WithColumnFormatting, WithMapping, WithHeadings,ShouldAutoSize,WithStyles
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
            'Shift',
            'Tanggal',
            'Jam Masuk',
            'Telat',
            'Keterangan Masuk',
            'Jam Pulang',
            'Pulang Cepat',
            'Keterangan Pulang',
            'Status Absen',
        ];
    }

    public function map($model): array
    {
        $telat = $model->telat;
        $jam   = floor($telat / (60 * 60));
        $menit = $telat - ( $jam * (60 * 60) );
        $menit2 = floor( $menit / 60 );
        $detik = $telat % 60;
        if($jam <= 0 && $menit2 <= 0){
            $late = '-';
        } else {
            $late = $jam . ' Jam ' . $menit2 . ' Menit ' . $detik . ' Detik';
        }

        $pulang_cepat = $model->pulang_cepat;
        $jam_pulang_cepat   = floor($pulang_cepat / (60 * 60));
        $menit_pulang_cepat = $pulang_cepat - ( $jam_pulang_cepat * (60 * 60) );
        $menit_pulang_cepat2 = floor( $menit_pulang_cepat / 60 );
        $detik_pulang_cepat = $pulang_cepat % 60;

        if($jam_pulang_cepat <= 0 && $menit_pulang_cepat2 <= 0){
            $quick_return = '-';
        } else {
            $quick_return = $jam_pulang_cepat . ' Hour ' . $menit_pulang_cepat2 . ' Minute ' . $detik_pulang_cepat . ' Second';
        }

        if ($model->Shift) {
            $shift_name = $model->Shift->nama_shift . ' ' . $model->Shift->jam_masuk . ' - ' . $model->Shift->jam_keluar;
        } else {
            $shift_name = '-';
        }

        return [
            $model->name,
            $shift_name,
            $model->tanggal ?? '-',
            $model->jam_absen ? $model->jam_absen : '-',
            $late,
            $model->keterangan_masuk,
            $model->jam_pulang ? $model->jam_pulang : '-',
            $quick_return,
            $model->keterangan_pulang,
            $model->status_absen,
        ];


    }

    public function columnFormats(): array
    {
        return [

        ];
    }

    public function query()
    {
        return MappingShift::dataAbsen();
    }
}
