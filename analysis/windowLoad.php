<script>
    window.onload = function() {
        var chart1 = new CanvasJS.Chart("chartContainer1", {
            theme: "dark2", // "light1", "light2", "dark1"
            colorSet: "colorSet2",
            animationEnabled: true,
            title: {
                text: "Paper count in different Research Areas"
            },
            axisX: {
                margin: 10,
                interval: 1,
                labelPlacement: "outside",
                labelFontSize: 12,
                tickPlacement: "inside",
            },
            axisY: {
                margin: 10,
                title: "No. of Papers"
            },

            data: [{
                type: "bar",
                interval: 1,
                yValueFormatString: "#,##0.## citations",
                dataPoints: [
                    <?php
                    $did1 = 1;
                    while ($did1 < 38) {
                        if ($did1 != 20) {
                            $sql1 = "SELECT d.dname AS label, COUNT(r.rdomain_label) AS y 
                                    FROM research_paper_domain_label r , domain_data d 
                                    WHERE SUBSTRING(r.rdomain_label,$did1,1) = '1' AND d.did = $did1";
                            $result1 = $conn1->query($sql1);
                            $row1 = $result1->fetch(PDO::FETCH_ASSOC);
                            if ($row1['y'] > 5) {
                                echo "{label:'" . $row1['label'] . "' , y:" . $row1['y'] . "},";
                            }
                        }
                        $did1++;
                    }
                    ?>
                ]

            }]
        });
        chart1.render();


        var chart2 = new CanvasJS.Chart("chartContainer2", {
            colorSet: "colorSet2",
            animationEnabled: true,
            // theme: "dark1",
            backgroundColor: "black",
            title: {
                text: `Number of research paper for each professor`,
                fontColor: "white"
            },
            axisX: {
                margin: 10,
                interval: 1,
                labelFontColor: "white",
            },
            axisY: {
                margin: 10,
                labelFontColor: "white",
                titleFontColor: "white",
                title: "No. of Research Paper"
            },
            data: [{
                type: "bar",
                yValueFormatString: "###\"\"",
                // indexLabel: "{label} ({y})",
                dataPoints: [
                    <?php
                    $stmt2 = $conn2->query("SELECT pname ,COUNT(rid) FROM research.relation_pid_to_rid R ,research.prof_data P WHERE R.pid = P.pid  GROUP BY R.pid");
                    while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                        echo "{label:'" . $row2['pname'] . "' , y:" . $row2['COUNT(rid)'] . "},";
                    }
                    ?>
                ]
            }]
        });
        chart2.render();
        // dark1
        var chart4 = new CanvasJS.Chart("chartContainer4", {
            animationEnabled: true,
            colorSet: "colorSet2",
            theme: "dark2",
            title: {
                text: "Total Citation Count Since 2018"
            },
            axisX: {
                margin: 10,
                interval: 1,
                labelPlacement: "outside",
                labelFontSize: 12,
                tickPlacement: "inside"
            },
            axisY: {
                margin: 10,
                title: "Citation Count"
            },
            data: [{
                type: "bar",
                interval: 1,
                yValueFormatString: "#,##0.## citations",
                dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart4.render();

        var chart5 = new CanvasJS.Chart("chartContainer5", {
            animationEnabled: true,
            theme: "dark1",
            // backgroundColor: "black",
            title: {
                text: "Total Citation Count",
                fontColor: "white",
            },
            axisX: {
                margin: 10,
                interval: 1,
                labelPlacement: "outside",
                labelFontSize: 12,
                labelFontColor: "white",
                tickPlacement: "inside"
            },
            axisY: {
                margin: 10,
                title: "Citation Count",
                labelFontColor: "white",
                titleFontColor: "white",
                includeZero: true,
                prefix: "",
                suffix: ""
            },
            data: [{
                type: "column",
                yValueFormatString: "",
                indexLabel: "",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart5.render();


        var chart6 = new CanvasJS.Chart("chartContainer6", {
            animationEnabled: true,
            margin: 10,
            // theme: "dark1",
            backgroundColor: "black",
            title: {
                text: "Distribution of Domains of Research Papers",
                fontColor: "white"
            },
            subtitles: [{
                text: "% of each domain based on papers",
                fontColor: "white"
            }],
            data: [{
                type: "pie",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "#,##0",
                indexLabelFontColor:"white",
                dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart6.render();

        var chart7 = new CanvasJS.Chart("chartContainer7", {
            animationEnabled: true,
            theme: "dark2",
            title: {
                text: "Frequent publishers of school's papers"
            },
            axisX:{
                margin: 10,
            },
            axisY: {
                margin: 10,
                title: "Count of papers published",
                includeZero: true,
                prefix: "",
                suffix: ""
            },
            data: [{
                type: "column",
                yValueFormatString: "",
                indexLabel: "",
                indexLabelPlacement: "inside",
                indexLabelFontWeight: "bolder",
                indexLabelFontColor: "white",
                dataPoints: <?php echo json_encode($dataPoints7, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart7.render();
    }
</script>