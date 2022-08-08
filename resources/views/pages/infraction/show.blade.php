<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Data Pelanggaran</title>

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

              <a href="/infractions" class="backto"><img src="{{ asset("assets\images/icons/black/back.png") }}" alt="" title="" /></a>
              <h2 class="blog_title">{{ $infraction->nama }}</h2>

              <!-- Slider -->
              <div class="swiper-container-pages">
                <div class="swiper-wrapper">

                  <div class="swiper-slide" style="display: flex; justify-content: center">
                    @if ($infraction->foto)
                    <img src="{{ asset("storage/". $infraction->foto) }}" alt="" title="" />
                    @else
                    <img src="{{ asset("assets\images/page_photo.jpg") }}" alt="" title="" />
                    @endif
                  </div>
               

                </div>
                <div class="swiper-pagination"></div>
              </div>
              <div class="page_single layout_fullwidth_padding">
                <div class="post_single">

                    <table class="table">
                      <tbody>
                          <tr>
                              <td>Nama</td>
                              <td>{{ $infraction->nama }}</td>
                          </tr>
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
                              <td>{{ $infraction->kordinat }}</td>
                          </tr>
                      </tbody>
                      {{-- <tbody>
                          @php
                              $no = 1;
                          @endphp
                              <tr>
                                  <td>{{ $infraction->nama }}</td>
                                  <td>{{ $infraction->alamat }}</td>
                                  <td>{{ $infraction->phone }}</td>
                                  <td>{{ $infraction->di }}
                                  </td>
                                  <td>{{ $infraction->jp }}
                                  </td>
                                  <td>{{ $infraction->kordinat }}
                                  </td>
                              </tr>
                      </tbody> --}}
                  </table>                 
                  <span class="post_date">{{ $infraction->created_at }}</span>
                  <span class="post_author"> <a href="#">{{ $infraction->pelapor_name }}</a></span>
                  <span style="text-transform: uppercase" class="post_comments"><a href="#">{{ $infraction->status }}</a></span>
                </div>
                <a href="#" data-popup=".popup-social" class="btn btn--full open-popup">SHARE THIS POST</a>



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
