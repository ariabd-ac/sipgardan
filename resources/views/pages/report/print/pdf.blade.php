<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>
<body>
    <style>
        table { page-break-inside:auto; width : 100%;border-collapse: collapse }
        table, td, th {
           border: 1px solid black;
        }

        tr { page-break-inside:avoid; page-break-after:auto; border: 1px solid black }

        thead {
            display: table-header-group;
            font-weight: 600
        }

        tfoot {
            display: table-row-group;
        }

        th, td {
            padding : 10px 5px
        }

    </style>
    <h1>Laporan</h1>
    <div class="" style="width : 100%; padding-bottom : 10px;">
        <span style="margin-left : auto">Tanggal : {{ date('d M Y', strtotime($start_date)) }} - {{ date('d M Y', strtotime($end_date)) }}</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Masuk</th>
                <th>Tgl Keluar</th>
                <th>Plat</th>
                <th>Nama</th>
                <th>Handphone</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td style="text-align: center">{{ date('d M Y H:i:s', strtotime($report->clockin)) }}</td>
                    <td style="text-align: center">{{ $report->clockout ? date('d M Y H:i:s', strtotime($report->clockout)) : "-" }}</td>
                    <td style="padding-left: 10px">{{ $report->motorcycle_plate }}</td>
                    <td style="padding-left: 10px">{{ $report->driver_name }}</td>
                    <td style="padding-left: 10px">{{ $report->phone_number }}</td>
                    <td style="padding-left: 10px; text-align:right">{{number_format($report->amount, 0, "", ".")}}</td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</body>
</html>