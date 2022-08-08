<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Data Pelanggaran</title>

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('assets/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/style_v2.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,900" rel="stylesheet"> 
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
                        <select name="di" class="required">
                          <option value="" disabled selected>Select options</option>
                          <option value="pemali">Pemali</option>
                          <option value="cacaban">Cacaban</option>
                          <option value="comal">Comal</option>
                        </select>
                      </div>
                    </div>

                    @error('di')
                      <div class="error-message" style="color: red;text-transform: capitalize">
                          {{ $message }}
                      </div>
                    @enderror

                    <div class="form_row">
                      <label>Kordinat:</label>
                      <input type="text" name="kordinat" value="" class="form_input" />
                    </div>

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

    <script src="{{ asset('assets\login.js') }}"></script>
    <script src="{{ asset('assets\jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets\jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets\swiper.min.js') }}"></script>
    <script src="{{ asset('assets\jquery.custom.js') }}"></script>
</body>

</html>
