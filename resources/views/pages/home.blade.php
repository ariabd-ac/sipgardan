@extends('layouts.app')

@section('content')
<div class="container-home" style="position :relative; left: 0">
    <h3 class="title-home">Parkir Pandaan</h3>
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
                <span class="information-title" style="color: #4d934d">Total Parkir</span>
                <span class="information-desc">Total parkir yang disediakan</span>
            </div>
            <span class="information-value" style="color: #4d934d">{{$space}}</span>
        </div>

        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(15, 101, 221)">Total Terpakai</span>
                <span class="information-desc">Total parkir yang telah terpakai</span>
            </div>
            <span class="information-value" style="color: rgb(15, 101, 221)">{{$ongoing}}</span>
        </div>

        <div class="card-information">
            <div class="information-tag">
                <span class="information-title" style="color: rgb(255, 166, 0)">Total Tidak Terpakai</span>
                <span class="information-desc">Total parkir yang tidak terpakai</span>
            </div>
            <span class="information-value" style="color: rgb(255, 166, 0)">{{$empty}}</span>
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
                        label: '# Parkir / bulan',
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
                        label: '# Parkir / minggu',
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