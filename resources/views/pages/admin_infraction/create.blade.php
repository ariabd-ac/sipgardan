@extends('layouts.app')

@section('title')
    SIPGARDAN
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
                Tambah Data Pelanggaran
            </div>
            <div class="card-box-body">
                <div class="user-container">
                    <form action="{{ route('admin_infraction.store') }}" method="POST" class="" id="CustomForm" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group" style="width: 40%">
                            <label for="">Nama <span>*</span></label>
                            <div class="input-field @error('nama') error @enderror">
                                <input type="text" placeholder="Nama" name="nama"
                                    value="{{ old('nama') }}">
                                <div class="error-mark @error('nama') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('nama')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Alamat <span>*</span></label>
                            <div class="input-field @error('alamat') error @enderror">
                                <input type="text" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}">
                                <div class="error-mark @error('alamat') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('alamat')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Nomor Handphone <span>*</span></label>
                            <div class="input-field @error('phone') error @enderror">
                                <input type="number" placeholder="Nomor Handphone" name="phone" value="{{ old('phone') }}">
                                <div class="error-mark @error('phone') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('phone')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Daerah Irigasi<span>*</span></label>
                            <div class="input-field @error('di') error @enderror">
                                {{-- <input type="number" placeholder="Nomor Handphone" name="di" value="{{ old('di') }}"> --}}
                                <select name="di"class="form-select" class="js-example-basic-single" aria-label="Default select example">
                                  <option value="" disabled selected>Select options</option>
                                  <option value="pemali">Pemali</option>
                                  <option value="cacaban">Cacaban</option>
                                  <option value="comal">Comal</option>
                                </select>
                                <div class="error-mark @error('di') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                            @error('di')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Kordinat <span>*</span></label>
                          <div class="input-field @error('kordinat') error @enderror">
                              <input type="text" placeholder="Kordinat" name="kordinat" value="{{ old('kordinat') }}">
                              <div class="error-mark @error('kordinat') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                          @error('kordinat')
                              <div class="error-message">
                                  {{ $message }}
                              </div>
                          @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Jenis Pelanggaran <span>*</span></label>
                          <div class="input-field @error('jp') error @enderror">
                              <input type="text" placeholder="Jenis Pelanggaran" name="jp" value="{{ old('jp') }}">
                              <div class="error-mark @error('jp') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                          @error('jp')
                              <div class="error-message">
                                  {{ $message }}
                              </div>
                          @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Foto <span>*</span></label>
                          <div class="input-field @error('foto') error @enderror">
                              <input type="file" name="foto" value="{{ old('foto') }}">
                              <div class="error-mark @error('foto') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                          @error('foto')
                              <div class="error-message">
                                  {{ $message }}
                              </div>
                          @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Nama Pelapor <span>*</span></label>
                          <div class="input-field @error('pelapor_name') error @enderror">
                              <input type="text" name="pelapor_name" value="{{ old('pelapor_name') }}">
                              <div class="error-mark @error('pelapor_name') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                          @error('pelapor_name')
                              <div class="error-message">
                                  {{ $message }}
                              </div>
                          @enderror
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Status<span>*</span></label>
                          <div class="input-field @error('status') error @enderror">
                                <select name="status" class="js-example-basic-single" aria-label="Default select example">
                                <option value="" disabled selected>Select options</option>
                                <option value="draft">Draft</option>
                                <option value="disposisi">Disposisi</option>
                                <option value="pelanggaran">Pelanggaran</option>
                                <option value="ditolak">Ditolak</option>
                                <option value="sp1">SP-1</option>
                                <option value="sp2">SP-2</option>
                                <option value="sp3">SP-3</option>
                              </select>
                              <div class="error-mark @error('status') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                          @error('status')
                              <div class="error-message">
                                  {{ $message }}
                              </div>
                          @enderror
                        </div>

                        <div class="">
                            <button type="submit" class="btn btn-main" style="padding : 0.8rem 2rem">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')

    <script>
        var buttonSubmitChangeSlot = document.querySelector('#change-slot');
        var inputChangeSlot = document.querySelector('#input-change-slot');
        var buttonChangeSlot = document.querySelector('#first-change-slot');

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
