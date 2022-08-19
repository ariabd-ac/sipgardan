<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Data Pelanggaran</title>

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
              <h2 class="page_title">Data Pelanggaran</h2>
              <div class="page_single layout_fullwidth_padding" style="height: 50px;">
                <div class="contactform">
                  <form action="/infractions"  id="CustomForm" style="width: 100%;">
                      <div class="form_row">
                        <input type="text" name="search"  class="form_input" value="{{ request('search') }}"/>
                        <input type="submit" class="form_submit" id="submit" value="Search" />
                      </div>
                  </form>
                </div>
              </div>
							<div class="page_single layout_fullwidth_padding">

                <ul class="posts">

                  @php
                   $no = 1;   
                  @endphp

                  @foreach ($infractions as $infraction)
                      
                  
                  <li class="swipeout">
										<div class="swiper-wrapper">
											<div class="swiper-slide swipeout-content item-content">
												<div class="post_entry">
													<div class="post_thumb">
                            @if ($infraction->foto)
                            <img src="{{ asset("storage/" . $infraction->foto) }}" alt="" title="" />
                            @else
                            <img src="{{ asset("assets\images/photos/photo8.jpg") }}" alt="" title="" />
                            @endif
                          </div>
													<div class="post_details">
														<div class="post_category"><a href="{{ route('infraction.show', $infraction->id) }}">{{ $infraction->nama }}</a></div>
														<h2><a href="{{ route('infraction.show', $infraction->id) }}">{{ $infraction->alamat }}</a>
														</h2>
													</div>
													<div class="post_swipe"><img src="{{ asset("assets\images/swipe_more.png") }}" alt="" title="" /></div>
												</div>
											</div>
										
										</div>
									</li>

                  @endforeach


                </ul>
                <div id="loadMore" class="btn btn--full">LOAD MORE</div>
								<div id="showLess">END</div>
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
