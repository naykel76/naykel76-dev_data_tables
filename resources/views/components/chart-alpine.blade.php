<div>
    <div x-data="chart" wire:ignore
        wire:loading.class="opacity-05">
        <canvas class="w-full"></canvas>
    </div>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
    <script>
        Alpine.data('chart', () => {
            let chart;

            return {
                // The `init` method is called when the Alpine component is initialized.
                init() {
                    // Calls the Chart.js `initChart` method to initialize the chart with
                    // the `dataset` which is a public property of the Livewire component.
                    chart = this.initChart(this.$wire.dataset);

                    // Watches for changes in the `dataset` property of the Livewire component.
                    // When the `dataset` property changes, it calls the `updateChart` method
                    this.$wire.$watch('dataset', () => {
                        this.updateChart(chart, this.$wire.dataset);
                    })
                },

                // Updates the chart with the new dataset
                updateChart(chart, dataset) {
                    const { labels, values } = dataset;
                    chart.data.labels = labels;
                    chart.data.datasets[0].data = values;
                    chart.update();
                },

                // initialize the chart and pass the dataset
                initChart(dataset) {
                    // this.$wire.$el gives you the root element of the livewire component, so the
                    // we can find the canvas within it. This eliminates the need for a id to target
                    // the canvas element and allows up to use multiple components on the same page.
                    let el = this.$wire.$el.querySelector('canvas')

                    // destructure the dataset into labels and values
                    let { labels, values } = dataset;

                    return new Chart(el, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [
                                {
                                    tension: 0.1,
                                    label: 'Transaction Summary',
                                    data: values,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                },
                                // additional datasets can be added here
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    displayColors: false,
                                },
                            },
                            hover: {
                                mode: 'index',
                                intersect: false
                            },
                            layout: {
                                padding: {
                                    left: 0,
                                    right: 0,
                                },
                            },
                            scales: {
                                x: {
                                    display: false,
                                    border: {
                                        dash: [5, 5]
                                    },
                                    grid: {
                                        border: {
                                            display: false
                                        },
                                    },
                                }
                            },
                        },
                    })
                },
            }
        })
    </script>
@endscript
