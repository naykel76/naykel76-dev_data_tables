@props(['data'])

<canvas id="barChart"></canvas>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@push('scripts')
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g'],
                datasets: [{
                    label: "2016",
                    backgroundColor: "white",
                    borderWidth: 1,
                    borderColor: "#090",
                    fill: false,
                    data: [10, 8, 6, 5, 12, 8, 16, 17, 6, 7, 6, 10]
                }, {
                    label: "2017",
                    backgroundColor: "white",
                    borderWidth: 1,
                    borderColor: "red",
                    fill: false,
                    data: [8, 16, 17, 6, 7, 6, 10]
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
    </script>
@endpush
