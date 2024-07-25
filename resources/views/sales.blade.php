<!DOCTYPE html>
<html>
<head>
    <title>Sales Summary</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <canvas id="myChart1" width="400" height="200"></canvas>
    <canvas id="myChart2" width="400" height="200"></canvas>

    <script>
        // Chart 1: Fetching data via GET request
        $.ajax({
            url: "/home/salessummary",
            type: 'GET',
            success: function (r) {
                if (r.status == "OK") {
                    var ctx = document.getElementById("myChart1").getContext("2d");

                    var myChart1 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: [],
                            datasets: [{
                                label: "Revenue By Item Group (GET)",
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
                    myChart1.data.labels = labels;
                    myChart1.data.datasets[0].data = val;
                    myChart1.update();
                } else {
                    alert("Error: " + r.status);
                }
            }
        });

        // Chart 2: Static data
        var ctx2 = document.getElementById("myChart2").getContext("2d");
        var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April", "May", "June"],
                datasets: [{
                    label: "Static Data",
                    backgroundColor: "rgba(153, 102, 255, 0.2)",
                    borderColor: "rgba(153, 102, 255, 1)",
                    borderWidth: 1,
                    data: [12, 19, 3, 5, 2, 3],
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
</body>
</html>
