<template>
    <div class="chart-container" style="position: relative; height:25vh; width:30vw">
        <canvas id="chart" height="400" width="400"></canvas>
    </div>

</template>

<script>
    export default {
        props: ['revenue'],

        mounted() {
            var lab = Object.keys(this.revenue);
            var val = Object.values(this.revenue);
            console.log(val);
            var ctx = document.getElementById("chart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: lab,
                    datasets: [{
                        label: 'Revenue Generated',
                        data: val,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }
    }
</script>