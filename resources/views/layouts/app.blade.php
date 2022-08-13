<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SIP-GARDAN')</title>

    {{-- Box Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">   
    {{-- ChartJs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    {{-- Style --}}
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    {{-- Scan Barcode --}}
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

    <!-- CSS only -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> --}}

    <link rel="stylesheet" href="{{ asset('assets/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2.min.css') }}">

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

    @yield('style')

</head>

<body>
    @include('layouts.sidebar')
    <main>
        <div class="content">
            
            @if (session('success'))
                <div class="alert-box show" data-alert="show">
                    <div class="">
                        <i class='bx bx-check-circle'></i>
                    </div>
                    <div class="">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert-box show" data-alert="show" style="background-color : red">
                    <div class="">
                        <i class='bx bx-x-circle'></i>
                    </div>
                    <div class="">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @yield('content')

            <div class="container-alert hide">
                <div class="alert-box-confirmation">
                    <i class='bx bxs-error-circle'></i>
                    <h3 id="title-alert">Peringatan</h3>
                    <p id='description-alert'>Data yang akan terhapus secara permanen</p>
                    <div class="alert-button">
                        <button class="btn btn-main" style="padding : 0.7rem 2rem; font-size : 1rem"
                            onclick="return okAlertConfirmation()">Ya</button>
                        <button class="btn btn-trash" style="padding : 0.7rem 2rem; font-size : 1rem"
                            onclick="return closeAlertConfirmation()">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <p class="copyright">
            &copy; 2022 <span>SIP-GARDAN</span> All Rigths Reserved.
        </p>
    </main>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}


    <script src="{{ asset('assets/app.js') }}"></script>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>

    @yield('script')

</body>

</html>
