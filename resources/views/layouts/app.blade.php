<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Parking Apps')</title>

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
            &copy; 2022 <span>Parking Apps</span> All Rigths Reserved.
        </p>
    </main>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('assets/app.js') }}"></script>

    @yield('script')

</body>

</html>
