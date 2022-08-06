@extends('layouts.app')

@section('title')
    Parkir
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
        <div class="row-parking">
            <div class="col-parking">
                <div class="card-box" style="height: 175px">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Total Parkir
                    </div>
                    <div class="card-box-body">
                        <div class="" style="display:flex; gap: 1rem; align-items:center">
                            <h3 style="font-weight: 500; font-size:2rem">
                                {{ $space }}
                            </h3>
                            <form action="{{ route('slot.update', 1) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT" style="">
                                <div class="" style="display:flex; gap: 0.7rem; align-items:center">
                                    <div class="input-group" style="flex:1;display: none;padding: 0.5rem"
                                        id="input-change-slot">
                                        <div class="input-field @error('capasity') error @enderror">
                                            <input type="number" placeholder="Total" name="capasity">
                                            <div class="error-mark @error('capasity') error-mark-show @enderror">
                                                <i class="bx bx-x"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-main" type="submit" style="padding: 0.7rem 1rem;display: none"
                                        id="change-slot">Ubah</button>
                                </div>
                                @role("admin")
                                    <a href="" style="color:blue" id="first-change-slot">Ubah</a>
                                @endrole
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-parking">
                <div class="card-box" style="height: 175px">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Total Booking
                    </div>
                    <div class="card-box-body">
                        <div class="">
                            <h3 style="font-weight: 500; font-size:2rem">
                                {{ $ongoing }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-parking">
                <div class="card-box" style="height: 175px">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Total Parkir tersedia
                    </div>
                    <div class="card-box-body">
                        <div class="">
                            <h3 style="font-weight: 500; font-size:2rem">
                                {{ $empty }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-parking">
                <div class="card-box">
                    <div class="card-box-header" style="background-color : #e9e9e9;">
                        Parkir Keluar
                    </div>
                    <div class="card-box-body">
                        <form action="{{ route('parking.checkout') }}" method="GET" style="display: none" id="form-scanner">
                            @csrf
                            <div class="scanner-form" style="display:flex;align-items:center;gap:10px;padding:0.2rem 0">
                                <div class="input-group" style="flex:1">
                                    <div class="input-field">
                                        <input type="text" placeholder="Kode parkir" name="barcode" required id="barcode-field">
                                    </div>
                                </div>
                                <button class="btn btn-main button-scanner-form" style="padding: 0.7rem 1rem">Cari</button>
                            </div>
                        </form>
                        <div class="" style="width : 100%; display: flex; flex-direction:column; align-items :center; gap: 0.5rem">
                            <div class="btn btn-main" style="width: 100%; padding: 0.5rem 0;text-align:center;font-size: 14px; border-radius: 8px" id="btn-choose-scanner">Dengan scanner</div>
                            <div class="btn btn-main" style="width: 100%; padding: 0.5rem 0;text-align:center;font-size: 14px; border-radius: 8px" id="btn-choose-camera">Dengan kamera</div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box">
            <div class="card-box-header">
                <span class="card-box-title">Semua Parkir</span>
                <a href="{{ route('parking.create') }}" class="btn btn-main" style="font-size: 0.8rem">Tambah Parkir</a>

            </div>
            <div class="card-box-body">
                <table id="parking-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barcode</th>
                            <th>Plat Nomor</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Bayar</th>
                            <th style="text-align: right">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($parkings as $parking)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $parking->barcode }}</td>
                                <td>{{ $parking->motorcycle_plate }}</td>
                                <td>{{ date('d M Y h:i:s', strtotime($parking->clockin)) }}</td>
                                <td>{{ $parking->clockout ? date('d M Y h:i:s', strtotime($parking->clockout)) : '-' }}
                                </td>
                                <td>{{ $parking->amount ? 'Rp.' . number_format($parking->amount, 0, '', '.') : '-' }}
                                </td>

                                <td
                                    style="display: flex; gap : 1rem; justify-content:flex-end; align-items : center; text-align: right">

                                    <form action="{{ route('parking.destroy', $parking->id) }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="_method" value="DELETE">

                                        <button style="display: none" type="submit"
                                            id="form-delete-parking-{{ $parking->id }}"></button>
                                    </form>


                                    @if ($parking->clockout == null)
                                        <form action="{{ route('parking.checkout') }}" method="GET">
                                            @csrf

                                            <input type="hidden" placeholder="Kode parkir" name="barcode"
                                                value="{{ $parking->barcode }}">

                                            <button style="display: none" type="submit"
                                                id="form-checkout-parking-{{ $parking->id }}"></button>
                                        </form>

                                        <i
                                        style="font-size: 1.7rem"
                                            class='bx bx-barcode icon-btn icon-btn-main'onclick="window.location.href='{{ route('parking.show', $parking->id) }}'"></i>

                                        <i
                                        style="font-size: 1.7rem"
                                            class='bx bx-log-out-circle icon-btn icon-btn-primary'onclick="showAlertConfirmation('form-checkout-parking-{{ $parking->id }}', 'Peringatan', 'Apakah anda yakin ingin melanjutkan proses checkout kendaraan?')"></i>
                                    @endif

                                    @role('admin')
                                        @if ($parking->clockout == null)
                                            <i
                                            style="font-size: 1.7rem"
                                                class='bx bx-edit-alt icon-btn icon-btn-edit'onclick="window.location.href='{{ route('parking.edit', $parking->id) }}'"></i>
                                        @endif

                                        <i
                                        style="font-size: 1.7rem"
                                            class='bx bx-trash icon-btn icon-btn-trash'onclick="showAlertConfirmation('form-delete-parking-{{ $parking->id }}', 'Peringatan', 'Data akan dihapus secara permanen')"></i>
                                    @endrole




                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
@endsection

@section('script')

    <script>
        var buttonSubmitChangeSlot = document.querySelector('#change-slot');
        var inputChangeSlot = document.querySelector('#input-change-slot');
        var buttonChangeSlot = document.querySelector('#first-change-slot');

        // if('')

        $(document).ready(function() {
            $('#parking-table').DataTable();
        });

        $('#first-change-slot').on('click', function(e) {
            e.preventDefault();

            buttonSubmitChangeSlot.style.display = 'block';
            inputChangeSlot.style.display = 'block';
            this.style.display = 'none';
        })
        let btnChooseScanner =  $('#btn-choose-scanner')
        let btnChooseCamera = $('#btn-choose-camera')
        let btnCloseContainerCamera = $('#closeCamera');
        let barcodeField = $('#barcode-field');

        let containerCamera = $("#container-camera")
        
        let formScanner = $('#form-scanner')

        const codeReader = new ZXing.BrowserMultiFormatReader();
        

        btnChooseScanner.click(function () {
            formScanner.show();
            codeReader.reset();
            $(this).hide();
        })

        btnChooseCamera.click(function() {
            containerCamera.show();
            formScanner.hide();
            btnChooseScanner.show();
            document.querySelector('body').style.overflow = 'hidden'
            initScanner();
        })

        btnCloseContainerCamera.click(function() {
            containerCamera.hide();
            document.querySelector('body').style.overflow = 'auto'
            codeReader.reset();
        })


        
        var selectedDeviceId = null;
        const sourceSelect = $("#pilihKamera");


        function initScanner() {
            codeReader
            .listVideoInputDevices()
            .then(videoInputDevices => {
                videoInputDevices.forEach(device =>
                    console.log(`${device.label}, ${device.deviceId}`)
                );
 
                if(videoInputDevices.length > 0){
                     
                    if(selectedDeviceId == null){
                        if(videoInputDevices.length > 1){
                            selectedDeviceId = videoInputDevices[1].deviceId
                        } else {
                            selectedDeviceId = videoInputDevices[0].deviceId
                        }
                    }
                     
                    if (videoInputDevices.length >= 1) {
                        sourceSelect.html('');
                        videoInputDevices.forEach((element) => {
                            const sourceOption = document.createElement('option')
                            sourceOption.text = element.label
                            sourceOption.value = element.deviceId
                            if(element.deviceId == selectedDeviceId){
                                sourceOption.selected = 'selected';
                            }
                            sourceSelect.append(sourceOption)
                        })
                 
                    }
 
                    codeReader
                        .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                        .then(result => {
 
                                //hasil scan
                                console.log(result)
                                // $("#hasilscan").val(result.text);
                                barcodeField.val(result.text);
                                containerCamera.hide();
                                document.querySelector('body').style.overflow = 'auto'

                             
                                if(codeReader){
                                    codeReader.reset()
                                    setTimeout(() => {
                                        formScanner.submit();
                                    }, 500);
                                }
                        })
                        .catch(err => console.error(err));
                     
                } else {
                    alert("Camera not found!")
                }
            })
            .catch(err => console.error(err.message));
        }


    </script>
    @error('capasity')
        <script>
            buttonSubmitChangeSlot.style.display = 'block';
            inputChangeSlot.style.display = 'block';
            buttonChangeSlot.style.display = 'none';
        </script>
    @else
        <script>
            $('#first-change-slot').on('click', function(e) {
                e.preventDefault();

                buttonSubmitChangeSlot.style.display = 'block';
                inputChangeSlot.style.display = 'block';
                this.style.display = 'none';
            })
        </script>
    @enderror
@endsection
