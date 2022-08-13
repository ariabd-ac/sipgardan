@extends('layouts.app')

@section('content')
<div class="container-home" style="position :relative; left: 0">
    <h3 class="title-home">SIP-GARDAN</h3>
    <div class="container-chart">
        <div class="card-chart">
            <canvas id="chart-monthly" ></canvas>
    
        </div>
        <div class="card-chart">
            <canvas id="chart-weekly" ></canvas>
        </div>
    </div>
    <div class="container-information">
        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: #4d934d">Total Pelanggaran</span>
                <span class="information-desc">Total semua pelanggaran</span>
            </div>
            <span class="information-value" style="color: #4d934d">{{$infractionCount}}</span>
        </div>

        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(15, 101, 221)">Total Disposisi</span>
                <span class="information-desc">Total status disposisi</span>
            </div>
            <span class="information-value" style="color: rgb(15, 101, 221)">{{$disposisi}}</span>
        </div>

        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(246, 4, 4)">Total Pelanggaran</span>
                <span class="information-desc">Total status pelanggaran</span>
            </div>
            <span class="information-value" style="color: rgb(246, 4, 4)">{{$pelanggaran}}</span>
        </div>

        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(80, 219, 38)">Total Draft</span>
                <span class="information-desc">Total status draft</span>
            </div>
            <span class="information-value" style="color: rgb(80, 219, 38)"">{{$draft}}</span>
        </div>
        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(173, 50, 50)">Total SP1</span>
                <span class="information-desc">Total status SP1</span>
            </div>
            <span class="information-value" style="color: rgb(37, 168, 209)">{{$sp1}}</span>
        </div>
        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(255, 0, 85)">Total SP2</span>
                <span class="information-desc">Total status SP2</span>
            </div>
            <span class="information-value" style="color: rgb(255, 0, 85)">{{$sp2}}</span>
        </div>
        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(207, 30, 30)">Total SP3</span>
                <span class="information-desc">Total status SP3</span>
            </div>
            <span class="information-value" style="color: rgb(207, 30, 30)">{{$sp3}}</span>
        </div>
        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(99, 162, 195)">Total Ditolak</span>
                <span class="information-desc">Total status ditolak</span>
            </div>
            <span class="information-value" style="color: rgb(99, 162, 195)">{{$ditolak}}</span>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const ctxMonthly = document.getElementById('chart-monthly').getContext('2d');
    const ctxWeekly = document.getElementById('chart-weekly').getContext('2d');
    var months = [];
    $.ajax({
        method : 'GET',
        url : '/chart-monthly',
        success : (data) => {
            const myChart = new Chart(ctxMonthly, {
                type: 'line',
                data: {
                    labels: Object.keys(data.data),
                    datasets: [{
                        label: '# Pelanggaran / bulan',
                        data: Object.values(data.data),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })

    $.ajax({
        method : 'GET',
        url : '/chart-weekly',
        success : (data) => {
            const myChart = new Chart(ctxWeekly, {
                type: 'line',
                data: {
                    labels: Object.keys(data.data),
                    datasets: [{
                        label: '# Pelanggaran / minggu',
                        data: Object.values(data.data),
                        backgroundColor: [
                            'rgba(0, 128, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(0, 128, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    })
    
    </script>
    
@endsection