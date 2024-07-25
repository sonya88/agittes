<!DOCTYPE html>
<html>
<head>
    <title>Sales Summary</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<canvas id="myChart1"></canvas>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $.ajax({
    url: "/home/salessummary",
    type: 'POST',  // Ensure this is POST
    processData: false,
    contentType: false,
    success: function (r) {
        if (r.status == "OK") {
            var ctx = document.getElementById("myChart1").getContext("2d");

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: "Revenue By Item Group",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "rgba(75,192,192,0.4)",
                        borderColor: "rgba(75,192,192,1)",
                        pointBorderColor: "rgba(75,192,192,1)",
                        pointBackgroundColor: "#fff",
                        data: [],
                    }]
                },
                options: {
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    }
                }
            });

            var labels = [];
            var val = [];
            $.each(r.items, (i, a) => {
                labels.push(a.item);
                val.push(a.revenue);
            });
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = val;
            myChart.update();
        } else {
            alert(`Error`);
        }
    }
});

</script>

</body>
</html>
