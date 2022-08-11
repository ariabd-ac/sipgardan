<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Add Data Pelanggaran</title>

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('assets/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style_v2.css') }}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,900" rel="stylesheet"> 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>

    
    
    <style>
      #map { height: 180px; }

      .select2-dropdown {
          z-index:99999;
      }

      .select2-dropdown.increasezindex {
          z-index:99999;
      }


      #cover {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.80;
        background: #aaa;
        z-index: 10;
        display: none;
      }
    </style>
</head>

<body id="mobile_wrap">

  <div class="panel-overlay"></div>

  <div class="panel panel-left panel-reveal">
		<!-- Slider -->
		<div class="swiper-container-subnav multinav">
			<div class="swiper-wrapper">
        <div class="swiper-slide">
					<nav class="main_nav_underline">
            <ul>
              <li><a href="/infractions"><img src="{{ asset("assets\images/icons/gray/home.png") }}" alt="" title="" /><span>Home</span></a>
							</li>
              <li><a href="{{ route('infraction.create') }}"><img src="{{ asset("assets\images/icons/gray/users.png") }}" alt="" title="" /><span>Buat Pelanggaran</span></a>
							</li>
            </ul>
          </nav>
				</div>
      </div>
		</div>
	</div>

  <div class="views">

		<div class="view view-main">
			<div class="pages">
				<div data-page="blog" class="page">
					<div class="page-content">
            <div class="navbar navbar--fixed navbar--fixed-top navbar--bg">
              <div class="navbar__col navbar__col--title">
								<a href="/infractions">SIP-GARDAN</a>
							</div>
              <div class="navbar__col navbar__col--icon navbar__col--icon-right">
								<a href="#" data-panel="left" class="open-panel"><img src="{{ asset('assets\images/icons/white/menu.png') }}" alt=""
										title="" /></a>
							</div>
            </div>
            
            <div id="pages_maincontent">
              <h2 class="page_title">Pelanggaran Tambah</h2>
							<div class="page_single layout_fullwidth_padding">
                <div class="contactform">
                  <form action="{{ route('infraction.store') }}" method="POST" class="" id="CustomForm" enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="_method" value="PUT" style=""> --}}

                    <div class="form_row">
                      <label>Name:</label>
                      <input type="text" name="nama" value="{{ old('nama') }}" class="form_input" required/>
                    </div>

                    @error('nama')
                        <div class="error-message" style="color: red;text-transform: capitalize">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form_row">
                      <label>Alamat:</label>
                      <input type="text" name="alamat" value="{{ old('alamat') }}" class="form_input" />
                    </div>

                    @error('alamat')
                      <div class="error-message" style="color: red;text-transform: capitalize">
                          {{ $message }}
                      </div>
                    @enderror

                    <div class="form_row">
                      <label>Nomor Telphone:</label>
                      <input type="number" name="phone" value="{{ old('phone') }}" class="form_input"  pattern="^-?[0-9]\d*\.?\d*$" />
                    </div>

                    @error('phone')
                      <div class="error-message" style="color: red;text-transform: capitalize">
                          {{ $message }}
                      </div>
                    @enderror
                    
                    
                    <div class="form_row">
                      <label>Daerah Irigasi:</label>
                      <div class="selector_overlay">
                        <select name="di" id="daerah_irigasi" class="required">
                          <option value="" disabled selected>Select options</option>
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
                      </div>
                    </div>

                    @error('di')
                      <div class="error-message" style="color: red;text-transform: capitalize">
                          {{ $message }}
                      </div>
                    @enderror

                    <div class="form_row">
                      <div id="map"></div>
                      <label>Kordinat:</label>
                      <input type="text" name="kordinat" value="" class="form_input" id="kordinat" readonly disabled/>
                    </div>

                    @error('kordinat')
                        <div class="error-message" style="color: red;text-transform: capitalize">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form_row">
                      <label>Jenis Pelanggaran:</label>
                      <input type="text" name="jp" value="{{ old('alamat') }}" class="form_input" required/>
                    </div>

                    @error('jp')
                      <div class="error-message" style="color: red;text-transform: capitalize">
                          {{ $message }}
                      </div>
                    @enderror

                    <div class="form_row">
                      <label>Foto:</label>
                      <input type="file" name="foto" value="" class="form_input" />
                    </div>

                    @error('foto')
                    <div class="error-message" style="color: red;text-transform: capitalize">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form_row">
                      <label>Nama Pelapor:</label>
                      <input type="text" name="pelapor_name" value="{{ old('pelapor_name') }}" class="form_input" required/>
                    </div>
                    

                    <div class="form_row">
                      <input type="hidden" name="status" value="draft" class="form_input" />
                    </div>

                     <input type="submit" class="form_submit" id="submit" value="Send" />
                  </form>
                </div>
            </div>
					</div>
				</div>
			</div>

		</div>
	</div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script src="{{ asset('assets\login.js') }}"></script> --}}
    <script src="{{ asset('assets\jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets\jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets\swiper.min.js') }}"></script>
    <script src="{{ asset('assets\jquery.custom.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('assets\select2.full.js') }}"></script>
    <script src="{{ asset('assets\select2.full.min.js') }}"></script>
    <script src="{{ asset('assets\select2.js') }}"></script>
    <script src="{{ asset('assets\select2.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>
   
   
   <script>
    let latlong = ''
    var map = L.map('map').fitWorld();

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 20,
        attribution: '© DL Tech Maps'
    }).addTo(map);

    map.locate({setView: true, maxZoom: 20});

    function onLocationFound(e) {
      var radius = e.accuracy;
      const arrLatLong = Object.values(e.latlng)
      const latlong = arrLatLong.join(', ')
      console.log('=>', arrLatLong.join(', '));
      document.getElementById("kordinat").value = latlong;
      
      L.marker(e.latlng).addTo(map)
          .bindPopup("You are within " + radius + " meters from this point").openPopup();

      L.circle(e.latlng, radius).addTo(map);
    }


    map.on('locationfound', onLocationFound);

    function onLocationError(e) {
      Swal.fire({
        title: 'Error!',
        text: 'Harus izinkan maps!',
        icon: 'error',
        confirmButtonText: 'Oke'
      })
      console.log(e);
      if (e) {
        
        $("body").append('<div id="overlay" style="background-color:grey;position:absolute;top:0;left:0;height:100%;width:100%;z-index:999"></div>');
      }
    }

    map.on('locationerror', onLocationError);

    $("#daerah_irigasi").select2({
        dropdownCssClass:'increasezindex'
    });
   </script>
</body>

</html>
