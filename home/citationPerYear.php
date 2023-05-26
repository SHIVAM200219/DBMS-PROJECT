<script>
        window.onload = function() {
            var citations = <?php 
            echo '[';
            for ($i=0; $i < sizeof($citations); $i++) { 
                echo $citations[$i];
                if ($i != sizeof($citations) - 1) {
                    echo ',';
                }
            }
            echo ']';
            ?>;
            var pname = <?php 
            echo '[';
            for ($i=0; $i < sizeof($pname); $i++) { 
                echo '`',$pname[$i],'`';
                if ($i != sizeof($pname) - 1) {
                    echo ',';
                }
            }
            echo ']';
            ?>;
            const start = <?php echo $start_year;?>;
            const end = <?php echo $end_year;?>;
            let Data = [];
            for (let index = 0; index < 4; index++) {
                let datapoints = [];
                for (let year = 0; year <= end - start; year++) {
                    datapoints.push({
                        label: (year + start).toString(),
                        y: citations[6*index + year]
                    });
                }
                let obj = {
                    type: "spline",
                    visible: true,
                    showInLegend: true,
                    yValueFormatString: "##",
                    name: pname[index],
                    dataPoints: datapoints
                }
                Data.push(obj);
            }
            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "dark2",
                animationEnabled: true,
                title: {
                    text: "Citations count per year for our core faculty"
                },
                axisY: {
                    title: "Number of Citations",
                    suffix: ""
                },
                toolTip: {
                    shared: "true"
                },
                legend: {
                    cursor: "pointer",
                    itemclick: toggleDataSeries
                },
                data: Data
            });
            chart.render();

            function toggleDataSeries(e) {
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else {
                    e.dataSeries.visible = true;
                }
                chart.render();
            }
        }
    </script>