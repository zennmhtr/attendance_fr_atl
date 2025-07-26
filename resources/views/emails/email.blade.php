@component('mail::message')
# Dear {{ $data->User->name }}

Masa Berlaku Dokumen {{ $data->nama_dokumen }} Akan Habis Pada Tanggal {{ $data->tanggal_berakhir }}, Segera Perbaharui.

Thanks,<br>
<h1 style="color: green">GPI<sup>Click</sup></h1>
@endcomponent
