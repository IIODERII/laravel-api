@extends('layouts.app')

@section('content')
    @foreach ($counts as $item)
        <div class="d-none labels">{{ $item }}</div>
    @endforeach
    @foreach ($numOfCount as $item)
        <div class="d-none counts">{{ $item }}</div>
    @endforeach
    @foreach ($numOfCategory as $item)
        <div class="d-none category">{{ $item }}</div>
    @endforeach

    <div class="container">
        <h2 class="fs-2 my-4 pb-5">
            Benvenuto/a {{ Auth::user()->name }}
        </h2>
        <div class="row align-items-center py-5 mt-5">
            <div class="col-8">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-4">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labelsT = [];
        document.querySelectorAll('div.labels').forEach((value) => {
            labelsT.push(value.textContent);
        });
        const countsT = [];
        document.querySelectorAll('div.counts').forEach((value) => {
            countsT.push(parseInt(value.textContent));
        });

        const ctx = document.getElementById('myChart');

        Chart.defaults.borderColor = '#fff';
        Chart.defaults.color = '#fff';
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsT,
                datasets: [{
                    label: '# of Votes',
                    data: countsT,
                    borderWidth: 1,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    color: '#ffffff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }
            }
        });


        const ctx2 = document.getElementById('myChart2');
        const catelabel = [];
        document.querySelectorAll('div.category').forEach((value) => {
            catelabel.push(parseInt(value.textContent));
        });

        Chart.defaults.borderColor = '#fff';
        Chart.defaults.color = '#fff';
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Front-End', 'Back-End', 'Full-Stack'],
                datasets: [{
                    label: '# of Votes',
                    data: catelabel,
                    borderWidth: 1,
                    backgroundColor: ['rgba(255, 100, 255, 0.5)', 'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    color: '#ffffff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                }
            }
        });
    </script>
@endsection
