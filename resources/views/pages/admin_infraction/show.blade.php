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
                    <form action="{{ route('admin_infraction.store') }}" method="POST" class="" id="CustomForm" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group" style="width: 40%">
                            <label for="">Nama <span>*</span></label>
                            <div class="input-field @error('nama') error @enderror">
                                <input type="text" placeholder="Nama" name="nama"
                                    value="{{ $infraction->nama }}" disabled>
                                <div class="error-mark @error('nama') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Alamat <span>*</span></label>
                            <div class="input-field @error('alamat') error @enderror">
                                <input type="text" placeholder="Alamat" name="alamat" value="{{ $infraction->alamat }}" disabled>
                                <div class="error-mark @error('alamat') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Nomor Handphone <span>*</span></label>
                            <div class="input-field @error('phone') error @enderror">
                                <input type="number" placeholder="Nomor Handphone" name="phone" value="{{ $infraction->phone }}" disabled>
                                <div class="error-mark @error('phone') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                            <label for="">Daerah Irigasi<span>*</span></label>
                            <div class="input-field @error('di') error @enderror">
                                {{-- <input type="number" placeholder="Nomor Handphone" name="di" value="{{ old('di') }}"> --}}
                                <select name="di"class="form-select" class="js-example-basic-single" aria-label="Default select example" disabled>
                                  <option value="{{ $infraction->di }}" disabled selected>{{ $infraction->di }}</option>
                                  <option value="pemali">Pemali</option>
                                  <option value="cacaban">Cacaban</option>
                                  <option value="comal">Comal</option>
                                </select>
                                <div class="error-mark @error('di') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Kordinat <span>*</span></label>
                          <div class="input-field @error('kordinat') error @enderror">
                              <input type="text" placeholder="Kordinat" name="kordinat" value="{{ $infraction->kordinat }}" disabled>
                              <div class="error-mark @error('kordinat') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Jenis Pelanggaran <span>*</span></label>
                          <div class="input-field @error('jp') error @enderror">
                              <input type="text" placeholder="Jenis Pelanggaran" name="jp" value="{{ $infraction->jp }}" disabled>
                              <div class="error-mark @error('jp') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Foto <span>*</span></label>
                          <div class="input-field @error('foto') error @enderror">
                              <img src="{{ asset("storage/". $infraction->foto) }}" alt="" title="" />
                              <div class="error-mark @error('foto') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Nama Pelapor <span>*</span></label>
                          <div class="input-field @error('pelapor_name') error @enderror">
                              <input type="text" name="pelapor_name" value="{{ $infraction->pelapor_name }}" disabled>
                              <div class="error-mark @error('pelapor_name') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group" style="width: 40%">
                          <label for="">Status<span>*</span></label>
                          <div class="input-field @error('status') error @enderror">
                                <select name="status" class="js-example-basic-single" aria-label="Default select example" disabled>
                                        <option value="{{ $infraction->status }}" disabled selected> {{ $infraction->status }}</option>
                                    
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
                        </div>

                    </form>
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
@endsection
