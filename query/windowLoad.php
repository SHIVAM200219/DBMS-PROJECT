<script>
    window.onload = function() {
        
        document.getElementById('query_plot').classList.remove("d-none");
        document.getElementById('query_plot').classList.add("d-flex");
        var citations = <?php
                        echo '[';
                        for ($i = 0; $i < sizeof($citations); $i++) {

                            echo $citations[$i];
                            if ($i != sizeof($citations) - 1) {
                                echo ',';
                            }
                        }
                        echo ']';
                        ?>;
        var pname = <?php
                    echo '[';
                    for ($i = 0; $i < sizeof($pname); $i++) {
                        echo '`', $pname[$i], '`';
                        if ($i != sizeof($pname) - 1) {
                            echo ',';
                        }
                    }
                    echo ']';
                    ?>;

        const start = <?php echo $start_year; ?>;
        const end = <?php echo $end_year; ?>;
        let Data = [];
        for (let index = 0; index < <?php echo sizeof($pname); ?>; index++) {
            let datapoints11 = [];
            for (let year = 0; year <= end - start; year++) {
                datapoints11.push({
                    label: (year + start).toString(),
                    y: citations[4 * index + year]
                });
            }
            let obj = {
                type: "spline",
                visible: true,
                showInLegend: true,
                yValueFormatString: "##",
                name: pname[index],
                dataPoints: datapoints11
            }
            Data.push(obj);
        }

        // var chart11 = new CanvasJS.Chart("chartContainer11", {
        //     theme: "dark2",
        //     animationEnabled: true,
        //     title: {
        //         text: "Citations count for last 3 years."
        //     },
        //     axisY: {
        //         title: "Number of Citations",
        //         suffix: ""
        //     },
        //     toolTip: {
        //         shared: "true"
        //     },
        //     legend: {
        //         cursor: "pointer",
        //         itemclick: toggleDataSeries
        //     },
        //     data: Data
        // });
        // chart11.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            chart11.render();
        }



        var chart12 = new CanvasJS.Chart("chartContainer12", {
            animationEnabled: true,
            theme: "dark2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Co-authors worked with <?php echo $Prof_title; ?> "
            },
            axisY: {
                title: "Number of times they worked together",
            },
            axisX: {
                title: "Co-authors"
            },
            data: [{
                type: "doughnut",
                indexLabel: "{label} ({y})",
                yValueFormatString: "###\"\"",
                dataPoints: [
                    <?php
                    for ($i = 0; $i < sizeof($co_auth_name); $i++) {
                        echo "{label:'" . $co_auth_name[$i] . "' , y:" . $co_auth_count[$i] . "},";
                    }
                    ?>

                ]
            }]
        });
        chart12.render();

        var chart13 = new CanvasJS.Chart("chartContainer13", {
            animationEnabled: true,
            theme: "dark2",
            title: {
                text: "Citation Count Per Year for Professor <?php echo $name; ?>"
            },
            subtitles: [{
                text: ""
            }],
            axisY: {
                title: "Citation Count"
            },
            data: [{
                type: "column",
                yValueFormatString: "#,##0.## citations",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart13.render();
        document.getElementById('nav_query').classList.add('active');   
    }
</script>