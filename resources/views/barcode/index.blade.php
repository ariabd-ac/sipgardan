<html>

<head></head>

<body style="padding: 0; margin:0;">
    <style>
        .barcode {
            width: 100%;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            padding: 0 auto;
        }

        span {
            padding-top: 8px;
            font-weight: bold;
            letter-spacing: 2px;
            font-size: 0.8rem;
        }

        .tc {
            text-align: center;
        }

        .rTable {
            width: 100%;
            margin-top: 10px;
            font-size: 8px;
        }

        .fs-16 {
            font-size: 16px;
        }

        .w50 {
            width: 50%;
        }

        .w10 {
            width: 10%;
        }

        .w40 {
            width: 40%;
        }

        .fs-12 {
            font-size: 8px;
            font-weight: bold;
        }
    </style>
    <div style="margin:0 auto;display:flex;align-items:center;flex-direction:column; width: 90%;">
        <h1 class="tc fs-16">IndePark</h1>
        <img src="{{asset('img/logo-print.png')}}" alt="" style="width : 50mm; margin-bottom : 10px">
        <div class="barcode">
            <img src="data:images/png;base64,{{ DNS1D::getBarcodePNG($parking->barcode, 'C128') }}" alt="Barcode"
                height="40px" width="100%" style="margin:0 auto;" />
            <span>{{ $parking->barcode }}</span>
        </div>
        <table class="rTable" style="">
            <tbody>
                <tr>
                    <td class="w40">
                        Nama Operator
                    </td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ Auth::user()->name }}
                    </td>
                </tr>
                <tr>
                    <td class="w40">
                        Plat Motor
                    </td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ $parking->motorcycle_plate }}
                    </td>
                </tr>
                <tr>
                    <td class="w40">
                        Nama
                    </td>
                    <td class="w10">:</td>
                    <td class="w50">{{ $parking->driver_name }}</td>
                </tr>
                <tr>
                    <td class="w40">
                        No Handphone
                    </td>
                    <td class="w10">:</td>
                    <td class="w50">{{ $parking->phone_number }}</td>
                </tr>
                <tr>
                    <td class="w40">Tanggal Masuk</td>
                    <td class="w10">:</td>
                    <td class="w50">{{ date('Y-m-d H:i:s', strtotime($parking->clockin)) }}</td>
                </tr>
                <tr>
                    <td class="w40">Tanggal Keluar</td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ $parking->clockout ? date('Y-m-d H:i:s', strtotime($parking->clockout)) : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="w40">Durasi</td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ $parking->clockout
                            ? round(abs(strtotime($parking->clockout) - strtotime($parking->clockin)) / 60, 2) . ' Menit'
                            : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="w40">Total</td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ $parking->clockout ? 'Rp. ' . number_format($parking->amount, 0, '', '.') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="w40">Bayar</td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ $parking->clockout ? 'Rp. ' . number_format($parking->payment, 0, '', '.') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="w40">Kembalian</td>
                    <td class="w10">:</td>
                    <td class="w50">
                        {{ $parking->clockout ? 'Rp. ' . number_format($parking->change, 0, '', '.') : '-' }}</td>
                </tr>
            </tbody>
        </table>
        <h5 class="tc fs-12">Terimakasih telah mempercayai IndePark</p>
    </div>
</body>

</html>
