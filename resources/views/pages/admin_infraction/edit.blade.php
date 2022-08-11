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
                Update Data Pelanggaran
            </div>
            <div class="card-box-body">
                <div class="user-container">
                  <div class=""><a href="{{ route('admin_infraction') }}">Kembali</a></div>
                    <form action="{{route('admin_infraction.update', $infraction->id)}}" method="POST" class="" id="CustomForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="input-group">
                            <label for="">Nama <span>*</span></label>
                            <div class="input-field @error('nama') error @enderror">
                                <input type="text" placeholder="Nama" name="nama"
                                    value="{{ $infraction->nama }}">
                                <div class="error-mark @error('nama') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="">Alamat <span>*</span></label>
                            <div class="input-field @error('alamat') error @enderror">
                                <input type="text" placeholder="Alamat" name="alamat" value="{{ $infraction->alamat }}">
                                <div class="error-mark @error('alamat') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="">Nomor Handphone <span>*</span></label>
                            <div class="input-field @error('phone') error @enderror">
                                <input type="number" placeholder="Nomor Handphone" name="phone" value="{{ $infraction->phone }}">
                                <div class="error-mark @error('phone') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="">Daerah Irigasi<span>*</span></label>
                            <div class="input-field @error('di') error @enderror">
                                {{-- <input type="number" placeholder="Nomor Handphone" name="di" value="{{ old('di') }}"> --}}
                                <select style="text-transform: capitalize" name="di"class="form-select" class="js-example-basic-single" aria-label="Default select example">
                                    <option value="{{ $infraction->di }}" selected>{{ $infraction->di }}</option>
                                  <option value="pemali">Pemali</option>
                                  <option value="cacaban">Cacaban</option>
                                  <option value="comal">Comal</option>
                                </select>
                                <div class="error-mark @error('di') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                          <label for="">Kordinat <span>*</span></label>
                          <div class="input-field @error('kordinat') error @enderror">
                              <input type="text" placeholder="Kordinat" name="kordinat" value="{{ $infraction->kordinat }}">
                              <div class="error-mark @error('kordinat') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group">
                          <label for="">Jenis Pelanggaran <span>*</span></label>
                          <div class="input-field @error('jp') error @enderror">
                              <input type="text" placeholder="Jenis Pelanggaran" name="jp" value="{{ $infraction->jp }}">
                              <div class="error-mark @error('jp') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        @if ($infraction->foto)
                        <div class="input-group">
                            <label for="">Image Preview </label>
                            <div class="input-field @error('foto') error @enderror" style="display: flex;justify-content: center;align-items: center">
                                <img style="display: block" src="{{ asset("storage/". $infraction->foto) }}" alt="" title="" width="300px"/>
                                <input type="hidden" name="foto_old" value="{{ $infraction->foto }}" class="form_input" />
                                <div class="error-mark @error('foto') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>
                        @endif

                        
                        <div class="input-group">
                          <label for="">Foto <span>*</span></label>
                          <div class="input-field @error('foto') error @enderror">
                              <input type="file" name="foto" value="" class="form_input" />
                              <div class="error-mark @error('foto') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group">
                          <label for="">Nama Pelapor <span>*</span></label>
                          <div class="input-field @error('pelapor_name') error @enderror">
                              <input type="text" name="pelapor_name" value="{{ $infraction->pelapor_name }}">
                              <div class="error-mark @error('pelapor_name') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="input-group">
                          <label for="">Status<span>*</span></label>
                          <div class="input-field @error('status') error @enderror">
                                <select style="text-transform: capitalize" name="status" class="js-example-basic-single" aria-label="Default select example">
                                    <option value="{{ $infraction->status }}" selected>{{ $infraction->status }}</option>
                                    {{-- <option value="{{ $infraction->status }}" disabled selected> {{ $infraction->status }}</option> --}}
                                    @role('admin')
                                    <option value="draft">Draft</option>
                                    <option value="disposisi">Disposisi</option>
                                    @endrole
                                    <option value="pelanggaran">Pelanggaran</option>
                                    <option value="ditolak">Ditolak</option>
                                    @role('admin')
                                    <option value="sp1">SP-1</option>
                                    <option value="sp2">SP-2</option>
                                    <option value="sp3">SP-3</option>
                                    @endrole

                              </select>
                              <div class="error-mark @error('status') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        @if($infraction->status == 'disposisi') 
                            <div class="input-group">
                                <label for="">Bukti Pelanggaran <span>*</span></label>
                                <div class="input-field @error('foto') error @enderror">
                                    <input type="file" name="bukti_pelanggaran" value="" class="form_input" />
                                    <div class="error-mark @error('bukti_pelanggaran') error-mark-show @enderror">
                                        <i class="bx bx-x"></i>
                                    </div>
                                </div>
                              </div>
                        
                        @endif

                        

                        @role('admin')
                        @if ($infraction->status == 'pelanggaran')
                            
                            <div class="input-group">
                                <label for="">SP 1 <span>*</span></label>
                                <div class="input-field @error('sp1') error @enderror">
                                    <input type="file" name="sp1" value="" accept="application/pdf">
                                    <div class="error-mark @error('sp1') error-mark-show @enderror">
                                        <i class="bx bx-x"></i>
                                    </div>
                                </div>
                                @error('sp1')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        @if ($infraction->status == 'sp1')
                            <div class="input-group">
                                <label for="">SP 2 <span>*</span></label>
                                <div class="input-field @error('sp2') error @enderror">
                                    <input type="file" name="sp2" value="" accept="application/pdf">
                                    <div class="error-mark @error('sp2') error-mark-show @enderror">
                                        <i class="bx bx-x"></i>
                                    </div>
                                </div>
                                @error('sp2')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        @if ($infraction->status == 'sp2')
                            <div class="input-group">
                                <label for="">SP 3 <span>*</span></label>
                                <div class="input-field @error('sp3') error @enderror">
                                    <input type="file" name="sp3" value="" accept="application/pdf">
                                    <div class="error-mark @error('sp3') error-mark-show @enderror">
                                        <i class="bx bx-x"></i>
                                    </div>
                                </div>
                                @error('sp3')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif


                        @endrole
                        
                        @if ($infraction->sp1)
                        <div class="input-group">
                            <label for="">SP 1 Preview</label>
                            <div class="input-field @error('sp1') error @enderror">
                                <iframe style="display: block !important;" width="1000" height="500" style="display:none"
                                src="{{ asset("storage/". $infraction->sp1)  }}"></iframe>
                            </div>
                        </div>
                        @endif

                        @if ($infraction->sp2)
                        <div class="input-group">
                            <label for="">SP 2 Preview</label>
                            <div class="input-field @error('sp2') error @enderror">
                                <iframe style="display: block !important;" width="1000" height="500" style="display:none"
                                src="{{ asset("storage/". $infraction->sp2)  }}"></iframe>
                            </div>
                        </div>
                        @endif

                        @if ($infraction->sp3)
                        <div class="input-group">
                            <label for="">SP 3 Preview</label>
                            <div class="input-field @error('sp3') error @enderror">
                                <iframe style="display: block !important;" width="1000" height="500" style="display:none"
                                src="{{ asset("storage/". $infraction->sp3)  }}"></iframe>
                            </div>
                        </div>
                        @endif
                        

                        <div class="">
                          <button type="submit" class="btn btn-main" style="padding : 0.8rem 2rem">Update</button>
                      </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

