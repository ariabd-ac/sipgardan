<table>
    <thead>
        <tr>
            <td style="text-align: center" colspan="6">Laporan Parkir Pandaan</td>
        </tr>
        <tr></tr>
        <tr>
            <th style="text-align: center; width: 30px; border: 1px solid black">Tgl Masuk</th>
            <th style="text-align: center; width: 30px; border: 1px solid black">Tgl Keluar</th>
            <th style="text-align: center; width: 30px; border: 1px solid black">Plat</th>
            <th style="text-align: center; width: 30px; border: 1px solid black">Nama</th>
            <th style="text-align: center; width: 30px; border: 1px solid black">Handphone</th>
            <th style="text-align: center; width: 30px; border: 1px solid black">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
        <tr>
            <td style="text-align: center; border: 1px solid black">{{ date('d M Y H:i:s', strtotime($report->clockin)) }}</td>
            <td style="text-align: center; border: 1px solid black">{{ date('d M Y H:i:s', strtotime($report->clockout)) }}</td>
            <td style="text-align: left; border: 1px solid black">{{ $report->motorcycle_plate }}</td>
            <td style="text-align: left; border: 1px solid black">{{ $report->driver_name }}</td>
            <td style="text-align: left; border: 1px solid black">{{ $report->phone_number }}</td>
            <td style="text-align: left; border: 1px solid black">Rp. {{number_format($report->amount)}}</td>
        </tr>
        @endforeach
    </tbody>
</table>