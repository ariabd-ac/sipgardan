@extends('layouts.app')

@section('title')
    Parkir
@endsection

@section('content')
    <div class="container-parking">
        <div class="card-box card-box-detail" style="">
            <div class="card-box-header">
                <div class="card-box-title">Detail</div>
            </div>
            <div class="card-box-body">
                <div class="" style="text-align:center;width: 100%">
                    <h1>IndePark</h1>
                </div>
                
                <div class="barcode-container">
                    <img src="data:images/png;base64,{{ DNS1D::getBarcodePNG($parking->barcode, 'C128') }}" alt="Barcode"
                        height="50px" width="60%" />
                </div>
                <table class="detail-table">
                    <tbody>
                        <tr>
                            <td class="detail-left">
                                Plat Motor
                            </td>
                            <td class="detail-right">
                                {{ $parking->motorcycle_plate }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-left">
                                Nama
                            </td>
                            <td class="detail-right">{{ $parking->driver_name }}</td>
                        </tr>

                        <tr>
                            <td class="detail-left">
                                Nomor Handphone
                            </td>
                            <td class="detail-right">{{ $parking->phone_number }}</td>
                        </tr>
                        <tr>
                            <td class="detail-left">Tanggal Masuk</td>
                            <td class="detail-right">{{ date('Y-m-d H:i:s', strtotime($parking->clockin)) }}</td>
                        </tr>
                        <tr>
                            <td class="detail-left">Tanggal Keluar</td>
                            <td class="detail-right">
                                {{ $parking->clockout ? date('Y-m-d H:i:s', strtotime($parking->clockout)) : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-left">Durasi</td>
                            <td class="detail-right">
                                {{ $parking->clockout
                                    ? round(abs(strtotime($parking->clockout) - strtotime($parking->clockin)) / 60, 2) . ' Menit'
                                    : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-left">Total</td>
                            <td class="detail-right">
                                {{ $parking->clockout
                                    ? "Rp. ".number_format($parking->amount,0,"",".")
                                    : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-left">Bayar</td>
                            <td class="detail-right">
                                {{ $parking->clockout ? "Rp. ".number_format($parking->payment,0,"",".") : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="detail-left">Kembalian</td>
                            <td class="detail-right">{{ $parking->clockout ? "Rp. ".number_format($parking->change,0,"",".") : '-' }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="" style="width : 100%; display:flex; align-items:center; gap : 1rem">
                    <button class="btn btn-main" onclick="printDiv()">Print</button>
                </div>
            </div>
            <iframe id="print_frame" width="" style="display:none"
                src="{{ route('parking.print', $parking->id) }}"></iframe>
        </div>
    </div>
@endsection

@section('script')
    <script>
        window.onload = function() {
            if (localStorage.getItem("hasCodeRunBefore") === null) {
                /** Your code here. **/
                localStorage.setItem("hasCodeRunBefore", true);
                printDiv();
            }
        }


        function printDiv(divId) {
            window.frames["print_frame"].contentWindow.document.body.focus();
            window.frames["print_frame"].contentWindow.print();
        }
    </script>
@endsection
