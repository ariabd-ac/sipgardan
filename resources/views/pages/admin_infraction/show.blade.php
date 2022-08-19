@extends('layouts.app')

@section('title')
    SIPGARDAN
@endsection

@section('style')
    <style>
    table, th, td {
        border: 1px solid grey;
    }

    table {
        width: 100%;
    }

    td {
        padding: .625rem;
        text-transform: uppercase;
    }
    </style>
@endsection

@section('content')
    <div class="container-camera" id="container-camera" style="display :none">
        <div class="popup-camera">
            <div class="popup-camera-close">
                <i class="bx bx-x" id="closeCamera"></i>
            </div>
            <select id="pilihKamera" style="max-width:400px; display:none">
            </select>
            <div class="video-preview">
                <video id="previewKamera" style=""></video>
            </div>
        </div>
    </div>
    <div class="container-parking">
        <div class="card-box">
            <div class="card-box-header">
                Detail Data Pelanggaran
            </div>
            <div class="card-box-body">
                <div class="user-container">
                  <div class=""><a href="{{ route('admin_infraction') }}">Kembali</a></div>
                    @role('admin')
                    <div class="" style="width : 100%; display:flex; align-items:center; gap : 1rem;justify-content: end">
                        <button class="btn btn-main" onclick="printDiv()">Print</button>
                    </div>
                    @endrole
                    <div style="display: flex">
                        <table class="table">
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
                                    <td id="kordinat">{{ $infraction->kordinat }}</td>
                                </tr>
                                <tr>
                                    <td>Maps</td>
                                    <td><div id="map"></div></td>
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
                                @if ($infraction->sp1)
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
                                @endif
                            </tbody>
                        </table>    
                        {{-- <div id="map"></div> --}}
                    </div>
                   
                    @role('admin')
                    <iframe id="print_frame" width="" style="display:none"
                    src="{{ route('admin_infraction.print', $infraction->id) }}"></iframe>
                    @endrole
                </div>
            </div>
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

    <script>
   

        // map.on('locationerror', onLocationError);
        
        document.getElementById ( "kordinat" ).textContent

        var tdElem = document.getElementById ( "kordinat" );
        var tdText = tdElem.innerHTML || tdElem.textContent;
        // -7.558094809503133, 110.82646393830801

        
        // setInterval(() => {
        //     // console.log(tdElem);
        //     console.log(tdText);
        // }, 1000);
        const [latString, longString] = tdText.split(",");
        const lat = Number(latString) ||  -7.558094809503133
        const long = Number(longString) ||  110.82646393830801
        var mymap = L.map('map', {attributionControl: false}).setView([lat, long], 18)
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2lkb2RvMTk5MSIsImEiOiJja3AzcG5zYW0xamVnMm9xaWNnamI1ODRpIn0.wr-0_-8cP9KfDPiesVdoPw', {
                maxZoom: 18,
                attribution:'',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset:-1,
                accessToken: 'pk.eyJ1IjoiZmF1emF5eXkiLCJhIjoiY2tqZng3OWw5MDlmejJ0cW9vbWg1bXlvMCJ9.zn3d3ptHQ38xKp4yM_55SQ'
            }).addTo(mymap);
        L.marker([lat, long]).addTo(mymap)
        L.circle([lat, long], 50, {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5
            }).addTo(mymap).openPopup();
        L.popup();

        
    </script>
@endsection
