@extends('layouts.app')

@section('content')
<div class="container-report" style="position :relative; left: 0">
    <h3 class="title-report">Laporan</h3>
    <div class="card-box">
        <div class="card-box-body">
            <form action="">
                <div class="report-choose-date">
                    <div class="input-group" style="flex: 1">
                        <label for="">Dari</label>
                        <div class="input-field @error('start_date') error @enderror">
                            <input style="padding: 2.5px;" type="date" placeholder="Dari" name="start_date" value="{{ old('start_date') }}" required>
                        </div>
                    </div>
                    <div class="input-group" style="flex: 1">
                        <label for="">Sampai</label>
                        <div class="input-field @error('end_date') error @enderror">
                            <input style="padding: 2.5px;" type="date" placeholder="Sampai" name="end_date" value="{{ old('end_date') }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-main" style="padding : 0.8rem 2rem">Cari</button>
                    <button type="button" onclick="window.location.href='{{route('report')}}'" class="btn btn-edit" style="padding : 0.8rem 2rem">Reset</button>
                </div>
            </form>

            <div class="container-report-print">
                @if (Request::get('start_date') && Request::get('end_date') )
                    <button type="button" class="btn" style="color:white; padding : 0.8rem 2rem; background:rgb(203, 2, 2); flex: 1"
                        onclick="window.open('{{route('report.pdf',['start_date' => Request::get('start_date'),'end_date' => Request::get('end_date')])}}', '_blank')"
                    >
                        <i class='bx bxs-file-pdf'></i> 
                        <span>PDF</span>
                    </button>    
                @else
                    <button type="button" class="btn" style="color:white; padding : 0.8rem 2rem; background:rgb(203, 2, 2); flex: 1"
                        onclick="window.open('{{route('report.pdf',)}}', '_blank')"
                    >
                        <i class='bx bxs-file-pdf'></i> 
                        <span>PDF</span>
                    </button>
                @endif
                @if (Request::get('start_date') && Request::get('end_date') )
                    <button type="button" class="btn" style="color:white; padding : 0.8rem 2rem; background:rgb(27, 173, 27); flex: 1"
                        onclick="window.open('{{route('report.excel',['start_date' => Request::get('start_date'),'end_date' => Request::get('end_date')])}}', '_blank')"
                    >
                        <i class='bx bx-spreadsheet'></i> 
                        <span>Excel</span>
                    </button>    
                @else
                    <button type="button" class="btn" style="color:white; padding : 0.8rem 2rem; background:rgb(27, 173, 27); flex: 1"
                        onclick="window.open('{{route('report.excel',)}}', '_blank')"
                    >
                        <i class='bx bx-spreadsheet'></i> 
                        <span>Excel</span>
                    </button>
                @endif
            </div>            

            <table id="report-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Plat Nomor</th>
                        <th>Nama</th>
                        <th>No. Handphone</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('d M Y H:i:s', strtotime($report->clockin)) }}</td>
                            <td>{{ $report->clockout ? date('d M Y H:i:s', strtotime($report->clockout)) : '-' }}</td>
                            <td>{{ $report->motorcycle_plate }}</td>
                            <td>{{ $report->driver_name }}</td>
                            <td>{{ $report->phone_number }}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#report-table').DataTable();
    });
</script>
@endsection