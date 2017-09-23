<template>
    <div class="chart-container" style="position: relative; height:25vh; width:30vw">
        <canvas id="viewersChart" height="400" width="400"></canvas>
    </div>

</template>

<script>
    export default {
        props: ['viewers'],

        mounted() {
            var lab = Object.keys(this.viewers);
            var val = Object.values(this.viewers);
            console.log(val);
            var ctx = document.getElementById("viewersChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: lab,
                    datasets: [{
                        label: 'Viewers',
                        data: val,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
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