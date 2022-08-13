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
                                {{-- <select style="text-transform: capitalize" name="daerah_irigasi"class="form-select" class="js-example-basic-single" aria-label="Default select example">
                                    <option value="{{ $infraction->di }}" selected>{{ $infraction->di }}</option>
                                  <option value="pemali">Pemali</option>
                                  <option value="cacaban">Cacaban</option>
                                  <option value="comal">Comal</option>
                                </select> --}}
                                <select name="di" id="daerah_irigasi" class="required">
                                    <option value="{{ $infraction->di }}" selected>{{ $infraction->di }}</option>
                                    <optgroup label="Korpokla Jlantah">
                                      <option value="Lemahbang II">Lemahbang II</option>
                                      <option value="Walikan">Walikan</option>
                                      <option value="Braholo">Braholo</option>
                                      <option value="Nglasem">Nglasem</option>
                                      <option value="Menggok">Menggok</option>
                                      <option value="Cangkring">Cangkring</option>
                                      <option value="Sidomakmur">Sidomakmur</option>
                                      <option value="Semanding">Semanding</option>
                                      <option value="Pulo">Pulo</option>
                                    </optgroup>
                                    <optgroup label="Korpokla Samin">
                                      <option value="Trani">Trani</option>
                                      <option value="Bakdalem II">Bakdalem II</option>
                                      <option value="Mindi">Mindi</option>
                                      <option value="Kwangsan">Kwangsan</option>
                                      <option value="Jetu">Jetu</option>
                                      <option value="Kasihan II">Kasihan II</option>
                                      <option value="Munggur">Munggur</option>
                                      <option value="Jetis">Jetis</option>
                                      <option value="Temantenan">Temantenan</option>
                                      <option value="Sudangan">Sudangan</option>
                                      <option value="Bonggo">Bonggo</option>
                                      <option value="Pulo">Pulo</option>
                                      <option value="Kepoh">Kepoh</option>
                                      <option value="Seloromo">Seloromo</option>
                                      <option value="Srambang">Srambang</option>
                                      <option value="Sedayu">Sedayu</option>
                                      <option value="Blingi">Blingi</option>
                                    </optgroup>
                                    <optgroup label="Korpokla Dengkeng">
                                      <option value="Jaban">Jaban</option>
                                      <option value="Ploso Wareng">Ploso Wareng</option>
                                    </optgroup>
                                    <optgroup label="Korpokla Gandul">
                                      <option value="Pundung">Pundung</option>
                                      <option value="Jumeneng">Jumeneng</option>
                                      <option value="Nyaen / Tirip">Nyaen / Tirip</option>
                                      <option value="Baran">Baran</option>
                                      <option value="Glodog">Glodog</option>
                                      <option value="Gunung Maling">Gunung Maling</option>
                                      <option value="Majegan">Majegan</option>
                                      <option value="Pakelan">Pakelan</option>
                                      <option value="Tritis">Tritis</option>
                                      <option value="Gisik">Gisik</option>
                                      <option value="Ngasem">Ngasem</option>
                                      <option value="Waduk Cengklik">Waduk Cengklik</option>
                                      <option value="Brajan">Brajan</option>
                                      <option value="Mantren">Mantren</option>
                                    </optgroup>
                                    <optgroup label="Korpokla Cemoro">
                                      <option value="Bapang">Bapang</option>
                                      <option value="Wonotoro">Wonotoro</option>
                                      <option value="Waduk Klego">Waduk Klego</option>
                                      <option value="Garat">Garat</option>
                                      <option value="Parean">Parean</option>
                                      <option value="Sb. Tlatar">Sb. Tlatar</option>
                                      <option value="Kedung Boyo">Kedung Boyo</option>
                                    </optgroup>
                                  </select>
                                <div class="error-mark @error('di') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                          <label for="">Kordinat <span>*</span></label>
                          <div class="input-field @error('kordinat') error @enderror">
                              <input type="text" placeholder="Kordinat" name="kordinat" value="{{ $infraction->kordinat }}" id="kordinat">
                              <div class="error-mark @error('kordinat') error-mark-show @enderror">
                                  <i class="bx bx-x"></i>
                              </div>
                          </div>
                        </div>

                        <div class="form_row">
                            <div id="map"></div>
                            <label>Kordinat:</label>
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

                        @if ($infraction->bukti_pelanggaran)
                        <div class="input-group">
                            <label for="">Image Preview </label>
                            <div class="input-field @error('foto') error @enderror" style="display: flex;justify-content: center;align-items: center">
                                <img style="display: block" src="{{ asset("storage/". $infraction->bukti_pelanggaran) }}" alt="" title="" width="300px"/>
                                <div class="error-mark @error('bukti_pelanggaran') error-mark-show @enderror">
                                    <i class="bx bx-x"></i>
                                </div>
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

@section('script')
    <script src="{{ asset('assets\jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets\jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets\swiper.min.js') }}"></script>
    <script src="{{ asset('assets\jquery.custom.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('assets\select2.full.js') }}"></script>
    <script src="{{ asset('assets\select2.full.min.js') }}"></script>
    <script src="{{ asset('assets\select2.js') }}"></script>
    <script src="{{ asset('assets\select2.min.js') }}"></script>

    <script>
    //      let latlong = ''
    // var map = L.map('map').fitWorld();

    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     maxZoom: 10,
    //     attribution: '© DL Tech Maps'
    // }).addTo(map);

    // map.locate({setView: true, maxZoom: 10});

    // function onLocationFound(e) {
    //   var radius = e.accuracy;
    //   const arrLatLong = Object.values(e.latlng)
    //   const latlong = arrLatLong.join(', ')
    //   console.log('=>', arrLatLong.join(', '));
    //   document.getElementById("kordinat").setAttribute('value', latlong);
      
    //   L.marker(e.latlng).addTo(map)
    //       .bindPopup("You are within " + radius + " meters from this point").openPopup();

    //   L.circle(e.latlng, radius).addTo(map);
    // }


    // map.on('locationfound', onLocationFound);

    // function onLocationError(e) {
    //   Swal.fire({
    //     title: 'Error!',
    //     text: 'Harus izinkan maps!',
    //     icon: 'error',
    //     confirmButtonText: 'Oke'
    //   })
     
    // }

    // map.on('locationerror', onLocationError);
    const [latString, longString] = document.getElementById("kordinat").value.split(",");
    // -7.558094809503133, 110.82646393830801

    const lat = Number(latString) ||  -7.558094809503133
    const long = Number(longString) ||  110.82646393830801

    // setInterval(() => {
    //     console.log(long);
    // }, 1000);
    
    var mymap = L.map('map',{attributionControl: false}).setView([lat, long], 18)
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2lkb2RvMTk5MSIsImEiOiJja3AzcG5zYW0xamVnMm9xaWNnamI1ODRpIn0.wr-0_-8cP9KfDPiesVdoPw', {
            maxZoom: 18,
            attribution:'',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset:-1,
            accessToken: 'pk.eyJ1IjoiZmF1emF5eXkiLCJhIjoiY2tqZng3OWw5MDlmejJ0cW9vbWg1bXlvMCJ9.zn3d3ptHQ38xKp4yM_55SQ'
          }).addTo(mymap);
    L.marker([lat, long]).addTo(mymap)
    L.circle([lat, long], 100, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5
		}).addTo(mymap).openPopup();
    L.popup();

    $("#daerah_irigasi").select2({
        dropdownCssClass:'increasezindex'
    });
    </script>
@endsection