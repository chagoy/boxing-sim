<template>
    <div class="chart-container" style="position: relative; height:25vh; width:30vw">
        <canvas id="attendanceChart" height="400" width="400"></canvas>
    </div>

</template>

<script>
    export default {
        props: ['attendance'],

        mounted() {
            var lab = Object.keys(this.attendance);
            var val = Object.values(this.attendance);
            console.log(val);
            var ctx = document.getElementById("attendanceChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: lab,
                    datasets: [{
                        label: 'Attendance Generated',
                        data: val,
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
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