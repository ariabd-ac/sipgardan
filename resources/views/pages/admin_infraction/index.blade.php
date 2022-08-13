@extends('layouts.app')

@section('title')
    SIP-GARDAN
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
                <span class="card-box-title">Semua Pelanggaran</span>
                @role('admin')
                <a href="{{ route('admin_infraction.create') }}" class="btn btn-main" style="font-size: 0.8rem">Tambah Pelanggaran</a>
                @endrole
            </div>
            <div class="card-box-body">
                <table id="parking-table" style="text-transform: uppercase">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Daerah Irigasi</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Pelapor</th>
                            <th>Status</th>
                            <th style="text-align: right">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($infractions as $infraction)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $infraction->nama }}</td>
                                <td>{{ $infraction->di }}</td>
                                <td>{{ $infraction->jp }}</td>
                                <td>{{ $infraction->pelapor_name }}</td>
                                <td>{{ $infraction->status }}</td>

                                <td style="display: flex; gap : 1rem; justify-content:flex-end; align-items : center; text-align: right">

                                  <form action="{{ route('admin_infraction.destroy', $infraction->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="_method" value="DELETE">

                                    <button style="display: none" type="submit"
                                        id="form-delete-infraction-{{ $infraction->id }}"></button>
                                  </form>

                                    
                                    
                                    <i style="font-size: 1.7rem" class='bx bx-barcode icon-btn icon-btn-main'onclick="window.location.href='{{ route('admin_infraction.show', $infraction->id) }}'"></i>


                                    @if ($infraction->status == 'disposisi')
                                    <i style="font-size: 1.7rem;
                                    @role('admin')
                                    display:none;
                                    @endrole
                                    "
                                        class='bx bx-edit-alt icon-btn icon-btn-edit'onclick="window.location.href='{{ route('admin_infraction.edit', $infraction->id) }}'"></i>
                                    @endif

                                    @role('admin')
                                    <i style="font-size: 1.7rem"
                                        class='bx bx-edit-alt icon-btn icon-btn-edit'onclick="window.location.href='{{ route('admin_infraction.edit', $infraction->id) }}'"></i>
                                    @endrole





                                    @role('admin')
                                    <i style="font-size: 1.7rem" class='bx bx-trash icon-btn icon-btn-trash'onclick="showAlertConfirmation('form-delete-infraction-{{ $infraction->id }}', 'Peringatan', 'Data akan dihapus secara permanen')"></i>
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
