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

        table, th, td {
          border: 1px solid grey;
        }
        td {
          padding: .625rem;
          text-transform: uppercase;
        }
    </style>
    <div style="margin:0 auto;display:flex;align-items:center;flex-direction:column; width: 90%;">
        <img src="https://1.bp.blogspot.com/-QQd7JktIyVo/XUr7YH242bI/AAAAAAAAAVs/sNtR0VQ3hUs9rjCAYVwyFJfL9GkrkbOGgCLcBGAs/s1600/1.JATENG.png" alt="" style="width : 10mm; margin-bottom : 10px">
        <h1 class="tc fs-16">SIP-GARDAN</h1>
        {{-- <div class="barcode">
            <img src="data:images/png;base64,{{ DNS1D::getBarcodePNG($parking->barcode, 'C128') }}" alt="Barcode"
                height="40px" width="100%" style="margin:0 auto;" />
            <span>{{ $parking->barcode }}</span>
        </div> --}}
        {{-- <table class="rTable" style="">
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
        </table> --}}
        <table class="rTable" style="">
          <tbody>
              <tr>
                  <td>Nama</td>
                  <td>{{ $infraction->nama }}</td>
              </tr>
                <tr>
                    <td>Status</td>
                    <td style="color: red;">{{ $infraction->status }}</td>
                </tr>
                @if ($infraction->disposisi_datetime)
                    <tr>
                        <td>Ditetapkan</td>
                        <td style="color: red;">{{ $infraction->disposisi_datetime }}</td>
                    </tr>
                @endif
                @if ($infraction->keterangan_disposisi)
                    <tr>
                        <td>Keterangan</td>
                        <td style="color: red;">{{ $infraction->keterangan_disposisi }}</td>
                    </tr>
                @endif
              <tr>
                  <td>Alamat</td>
                  <td>{{ $infraction->alamat }}</td>
              </tr>
              <tr>
                  <td>No Telfon</td>
                  <td>{{ $infraction->phone }}</td>
              </tr>
              <tr>
                  <td>Daerah Irigas</td>
                  <td>{{ $infraction->di }}</td>
              </tr>
              <tr>
                  <td>Jenis Pelanggaran</td>
                  <td>{{ $infraction->jp }}</td>
              </tr>
              <tr>
                  <td>Kordinat</td>
                  <td>{{ $infraction->kordinat }}</td>
              </tr>
                <tr>
                    <td>Pelapor</td>
                    <td>{{ $infraction->pelapor_name }}</td>
                </tr>
              <tr>
                  <td>Foto</td>
                  <td style="text-align: center"><img src="{{ asset("storage/". $infraction->foto) }}" alt="" srcset=""></td>
              </tr>
                @if ($infraction->bukti_pelanggaran)
                    <tr>
                        <td>Bukti Pelanggaran</td>
                        <td style="text-align: center"><img src="{{ asset("storage/". $infraction->bukti_pelanggaran) }}" alt="" srcset=""></td>
                    </tr>
                @endif
                {{-- @if ($infraction->sp1)
                    <tr>
                        <td>SP-1</td>
                        <td>  <iframe style="display: block !important;" width="1000" height="500" style="display:none"
                            src="{{ asset("storage/". $infraction->sp1)  }}"></iframe></td>
                    </tr>
                @endif
                @if ($infraction->sp2)
                    <tr>
                        <td>SP-2</td>
                        <td>  <iframe style="display: block !important;" width="1000" height="500" style="display:none"
                            src="{{ asset("storage/". $infraction->sp2)  }}"></iframe></td>
                    </tr>
                @endif
                @if ($infraction->sp3)
                    <tr>
                        <td>SP-3</td>
                        <td>  <iframe style="display: block !important;" width="1000" height="500" style="display:none"
                            src="{{ asset("storage/". $infraction->sp3)  }}"></iframe></td>
                    </tr>
                @endif --}}
          </tbody>
        
      </table>   
        {{-- @if ($infraction->sp1)
            <iframe style="display: block !important;" width="1000" height="500" style="display:none"
            src="{{ asset("storage/". $infraction->sp1)  }}"></iframe>
        @endif --}}
    </div>
</body>

</html>
